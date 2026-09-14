<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

use App\Attaching\DTO\Output\Attachment\AttachmentOwnerPurgeResultDTO;

interface AttachmentOwnerPurgeServiceInterface
{
    public function purge(string $ownerType, string $ownerId): AttachmentOwnerPurgeResultDTO;
}
