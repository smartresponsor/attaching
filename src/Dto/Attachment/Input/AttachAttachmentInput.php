<?php

declare(strict_types=1);

namespace App\Dto\Attachment\Input;

final readonly class AttachAttachmentInput
{
    public function __construct(
        public string $attachmentId,
        public string $ownerType,
        public string $ownerId,
        public ?string $context = null,
        public ?string $slot = null,
        public int $position = 0,
        public bool $isPrimary = false,
    ) {
    }
}
