<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

use App\Attaching\DTO\Output\Attachment\AttachmentPrimaryLinkViewDTO;

interface AttachmentPrimaryLinkResolverServiceInterface
{
    public function resolvePrimary(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentPrimaryLinkViewDTO;
}
