<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Validation\Attachment;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface AttachmentValidationServiceInterface
{
    public function validateUploadedFile(UploadedFile $uploadedFile): void;

    public function validateOwnerReference(string $ownerType, string $ownerId): void;

    public function validateLinkScope(?string $context, ?string $slot, int $position = 0): void;

    public function validateMetadata(?string $title, ?string $description, ?string $altText): void;

    public function validateAttachmentIdentifier(int $attachmentId): void;
}
