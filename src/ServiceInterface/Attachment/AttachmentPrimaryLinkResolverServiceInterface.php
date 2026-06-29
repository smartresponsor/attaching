<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Attachment;

use App\Attaching\Dto\Attachment\Output\AttachmentPrimaryLinkView;

interface AttachmentPrimaryLinkResolverServiceInterface
{
    public function resolvePrimary(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentPrimaryLinkView;
}
