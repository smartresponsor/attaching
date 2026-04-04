<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\ServiceInterface\Attachment\AttachmentValidationServiceInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final readonly class AttachmentValidationService implements AttachmentValidationServiceInterface
{
    /**
     * @param list<string> $allowedMimeTypes
     */
    public function __construct(
        private int $maxBytes = 33554432,
        private array $allowedMimeTypes = [],
    ) {
    }

    public function validateUploadedFile(UploadedFile $uploadedFile): void
    {
        if ($uploadedFile->getSize() > $this->maxBytes) {
            throw new \InvalidArgumentException('Uploaded file exceeds the configured attachment size limit.');
        }

        $mimeType = $uploadedFile->getMimeType() ?? 'application/octet-stream';

        if ([] !== $this->allowedMimeTypes && !\in_array($mimeType, $this->allowedMimeTypes, true)) {
            throw new \InvalidArgumentException(sprintf('Mime type "%s" is not allowed for attachment upload.', $mimeType));
        }
    }
}
