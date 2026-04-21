<?php

declare(strict_types=1);

namespace App\Attaching\Dto\Attachment\Input;

use App\Attaching\Enum\Attachment\AttachmentVisibility;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final readonly class UploadAttachmentInput
{
    public function __construct(
        public UploadedFile $uploadedFile,
        public string $ownerType,
        public string $ownerId,
        public ?string $context = null,
        public ?string $slot = null,
        public bool $isPrimary = false,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $altText = null,
        public ?AttachmentVisibility $visibility = null,
    ) {
    }
}
