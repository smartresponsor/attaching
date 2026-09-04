<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\Service\Validation\Attachment;

use App\Attaching\Exception\Validation\Attachment\AttachmentValidationException;
use App\Attaching\Service\Validation\Attachment\AttachmentValidationService;
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

    public function testValidateAttachmentIdentifierRejectsNonPositiveIdentifier(): void
    {
        $service = new AttachmentValidationService();

        $this->expectException(AttachmentValidationException::class);
        $this->expectExceptionMessage('identifier');

        $service->validateAttachmentIdentifier(0);
    }

    public function testValidateProfileAvatarScopeIsSupported(): void
    {
        $service = new AttachmentValidationService();
        self::expectNotToPerformAssertions();

        $service->validateLinkScope('profile', 'avatar');
    }

    public function testValidateOwnerReferenceRejectsUnsupportedOwnerType(): void
    {
        $service = new AttachmentValidationService();

        $this->expectException(AttachmentValidationException::class);
        $this->expectExceptionMessage('not supported');

        $service->validateOwnerReference('unknown-owner', 'owner-1');
    }

    public function testValidateProfileAndVerificationScopes(): void
    {
        $service = new AttachmentValidationService();

        $service->validateOwnerReference('vendor', 'vendor-fixture-1');
        $service->validateLinkScope('profile', 'avatar');
        $service->validateLinkScope('profile', 'cover');

        $service->validateOwnerReference('access', 'admin@smartresponsor.local');
        $service->validateLinkScope('verification', 'personal_identity');
        $service->validateLinkScope('verification', 'account');

        self::assertTrue(true);
    }

    public function testValidateLinkScopeRejectsUnknownSlot(): void
    {
        $service = new AttachmentValidationService();

        $this->expectException(AttachmentValidationException::class);
        $this->expectExceptionMessage('slot');

        $service->validateLinkScope('project', 'executable');
    }

    public function testValidateLinkScopeRejectsNegativePosition(): void
    {
        $service = new AttachmentValidationService();

        $this->expectException(AttachmentValidationException::class);
        $this->expectExceptionMessage('negative');

        $service->validateLinkScope('product', 'gallery', -1);
    }

    public function testValidateMetadataRejectsOversizedAltText(): void
    {
        $service = new AttachmentValidationService();

        $this->expectException(AttachmentValidationException::class);
        $this->expectExceptionMessage('altText');

        $service->validateMetadata(null, null, str_repeat('a', 1001));
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
