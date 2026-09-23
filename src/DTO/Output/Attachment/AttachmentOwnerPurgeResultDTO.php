<?php

declare(strict_types=1);

namespace App\Attaching\DTO\Output\Attachment;

final readonly class AttachmentOwnerPurgeResultDTO
{
    public function __construct(
        public string $ownerType,
        public string $ownerId,
        public int $detachedLinkCount,
        public int $deletedOrphanCount,
        public int $retainedSharedCount,
    ) {
    }
}
