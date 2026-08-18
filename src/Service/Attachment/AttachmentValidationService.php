<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Exception\Attachment\AttachmentValidationException;
use App\Attaching\ServiceInterface\Attachment\AttachmentValidationServiceInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final readonly class AttachmentValidationService implements AttachmentValidationServiceInterface
{
    private const OWNER_TYPE_LIST = ['vendor', 'product', 'project', 'order', 'message'];
    private const CONTEXT_LIST = ['vendor', 'product', 'project', 'order', 'message', 'profile', 'gallery', 'document', 'evidence'];
    private const SLOT_LIST = ['attachment', 'primary', 'gallery', 'image', 'avatar', 'document', 'evidence', 'cover'];

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
        $ownerType = trim($ownerType);
        $ownerId = trim($ownerId);

        if ('' === $ownerType) {
            throw new AttachmentValidationException('Attachment ownerType must not be empty.');
        }
        if (!\in_array($ownerType, self::OWNER_TYPE_LIST, true)) {
            throw new AttachmentValidationException(sprintf('Attachment ownerType "%s" is not supported.', $ownerType));
        }
        if ('' === $ownerId) {
            throw new AttachmentValidationException('Attachment ownerId must not be empty.');
        }
        if (mb_strlen($ownerId) > 191) {
            throw new AttachmentValidationException('Attachment ownerId must not exceed 191 characters.');
        }
    }

    public function validateLinkScope(?string $context, ?string $slot, int $position = 0): void
    {
        if (null !== $context && !\in_array(trim($context), self::CONTEXT_LIST, true)) {
            throw new AttachmentValidationException(sprintf('Attachment context "%s" is not supported.', $context));
        }
        if (null !== $slot && !\in_array(trim($slot), self::SLOT_LIST, true)) {
            throw new AttachmentValidationException(sprintf('Attachment slot "%s" is not supported.', $slot));
        }
        if ($position < 0) {
            throw new AttachmentValidationException('Attachment position must not be negative.');
        }
    }

    public function validateMetadata(?string $title, ?string $description, ?string $altText): void
    {
        if (null !== $title && mb_strlen(trim($title)) > 255) {
            throw new AttachmentValidationException('Attachment title must not exceed 255 characters.');
        }
        if (null !== $description && mb_strlen($description) > 12000) {
            throw new AttachmentValidationException('Attachment description must not exceed 12000 characters.');
        }
        if (null !== $altText && mb_strlen($altText) > 1000) {
            throw new AttachmentValidationException('Attachment altText must not exceed 1000 characters.');
        }
    }

    public function validateAttachmentIdentifier(int $attachmentId): void
    {
        if ($attachmentId <= 0) {
            throw new AttachmentValidationException('Attachment identifier must be a positive integer.');
        }
    }
}
