<?php

declare(strict_types=1);

namespace App\Attaching\Dto\Attachment\Output;

final readonly class AttachmentOwnerPurgeResult
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
