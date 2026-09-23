<?php

declare(strict_types=1);

namespace App\Attaching\DTO\Output\Attachment;

final readonly class AttachmentPrimaryLinkViewDTO
{
    public function __construct(
        public AttachmentLinkViewDTO $link,
        public AttachmentViewDTO $attachment,
    ) {
    }
}
