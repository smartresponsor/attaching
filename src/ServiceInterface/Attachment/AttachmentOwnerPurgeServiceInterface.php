<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Attachment;

use App\Attaching\Dto\Attachment\Output\AttachmentOwnerPurgeResult;

interface AttachmentOwnerPurgeServiceInterface
{
    public function purge(string $ownerType, string $ownerId): AttachmentOwnerPurgeResult;
}
