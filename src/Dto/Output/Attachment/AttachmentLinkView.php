<?php

declare(strict_types=1);

namespace App\Attaching\Dto\Output\Attachment;

final readonly class AttachmentLinkView
{
    public function __construct(
        public int $id,
        public int $attachmentId,
        public string $ownerType,
        public string $ownerId,
        public ?string $context,
        public ?string $slot,
        public int $position,
        public bool $isPrimary,
        public \DateTimeImmutable $createdAt,
    ) {
    }
}
