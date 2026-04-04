<?php

declare(strict_types=1);

namespace App\Dto\Attachment\Output;

final readonly class AttachmentLinkView
{
    public function __construct(
        public string $id,
        public string $attachmentId,
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
