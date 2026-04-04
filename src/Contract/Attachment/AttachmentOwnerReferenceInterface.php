<?php

declare(strict_types=1);

namespace App\Contract\Attachment;

interface AttachmentOwnerReferenceInterface
{
    public function getAttachmentOwnerType(): string;

    public function getAttachmentOwnerId(): string;
}
