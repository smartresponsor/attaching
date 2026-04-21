<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\Attachment;

use App\Attaching\Exception\Attachment\AttachmentValidationException;
use App\Attaching\Service\Attachment\AttachmentValidationService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class AttachmentValidationServiceTest extends TestCase
{
    public function testValidateOwnerReferenceRejectsEmptyOwnerType(): void
    {
        $service = new AttachmentValidationService();

        $this->expectException(AttachmentValidationException::class);
        $this->expectExceptionMessage('ownerType');

        $service->validateOwnerReference('', 'owner-1');
    }

    public function testValidateAttachmentIdentifierRejectsEmptyIdentifier(): void
    {
        $service = new AttachmentValidationService();

        $this->expectException(AttachmentValidationException::class);
        $this->expectExceptionMessage('identifier');

        $service->validateAttachmentIdentifier('   ');
    }

    public function testValidateUploadedFileRejectsUnsupportedMimeType(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'attachment-test-');
        self::assertNotFalse($path);
        file_put_contents($path, 'body');

        $service = new AttachmentValidationService(
            maxFileSizeInBytes: 1024,
            allowedMediaMimeTypes: ['image/png'],
            allowedDocumentMimeTypes: ['application/pdf'],
        );

        $uploadedFile = new UploadedFile(
            $path,
            'script.sh',
            'text/x-shellscript',
            null,
            true,
        );

        try {
            $this->expectException(AttachmentValidationException::class);
            $service->validateUploadedFile($uploadedFile);
        } finally {
            @unlink($path);
        }
    }
}
