<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

use App\Attaching\Dto\Output\Attachment\AttachmentOwnerPurgeResult;

interface AttachmentOwnerPurgeServiceInterface
{
    public function purge(string $ownerType, string $ownerId): AttachmentOwnerPurgeResult;
}
