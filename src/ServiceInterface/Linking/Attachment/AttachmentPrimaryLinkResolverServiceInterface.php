<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

use App\Attaching\Dto\Output\Attachment\AttachmentPrimaryLinkView;

interface AttachmentPrimaryLinkResolverServiceInterface
{
    public function resolvePrimary(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentPrimaryLinkView;
}
