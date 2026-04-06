<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Exception\Attachment\AttachmentValidationException;
use App\ServiceInterface\Attachment\AttachmentValidationServiceInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final readonly class AttachmentValidationService implements AttachmentValidationServiceInterface
{
    /**
     * @param list<string> $allowedMediaMimeTypes
     * @param list<string> $allowedDocumentMimeTypes
     */
    public function __construct(
        private int $maxFileSizeInBytes = 33554432,
        private array $allowedMediaMimeTypes = [],
        private array $allowedDocumentMimeTypes = [],
    ) {
    }

    public function validateUploadedFile(UploadedFile $uploadedFile): void
    {
        if (!$uploadedFile->isValid()) {
            throw new AttachmentValidationException('Uploaded file is not valid.');
        }

        $size = $uploadedFile->getSize();

        if (false !== $size && $size > $this->maxFileSizeInBytes) {
            throw new AttachmentValidationException('Uploaded file exceeds the configured attachment size limit.');
        }

        $mimeType = $uploadedFile->getMimeType() ?? 'application/octet-stream';
        $allowedMimeTypes = array_values(array_unique(array_merge($this->allowedMediaMimeTypes, $this->allowedDocumentMimeTypes)));

        if ([] !== $allowedMimeTypes && !\in_array($mimeType, $allowedMimeTypes, true)) {
            throw new AttachmentValidationException(sprintf('Mime type "%s" is not allowed for attachment upload.', $mimeType));
        }
    }

    public function validateOwnerReference(string $ownerType, string $ownerId): void
    {
        if ('' === trim($ownerType)) {
            throw new AttachmentValidationException('Attachment ownerType must not be empty.');
        }

        if ('' === trim($ownerId)) {
            throw new AttachmentValidationException('Attachment ownerId must not be empty.');
        }
    }

    public function validateAttachmentIdentifier(string $attachmentId): void
    {
        if ('' === trim($attachmentId)) {
            throw new AttachmentValidationException('Attachment identifier must not be empty.');
        }
    }
}
