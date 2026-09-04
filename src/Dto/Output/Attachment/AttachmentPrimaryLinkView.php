<?php

declare(strict_types=1);

namespace App\Attaching\Dto\Output\Attachment;

final readonly class AttachmentPrimaryLinkView
{
    public function __construct(
        public AttachmentLinkView $link,
        public AttachmentView $attachment,
    ) {
    }
}
