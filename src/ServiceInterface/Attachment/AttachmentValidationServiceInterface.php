<?php

declare(strict_types=1);

namespace App\ServiceInterface\Attachment;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface AttachmentValidationServiceInterface
{
    public function validateUploadedFile(UploadedFile $uploadedFile): void;

    public function validateOwnerReference(string $ownerType, string $ownerId): void;

    public function validateAttachmentIdentifier(string $attachmentId): void;
}
