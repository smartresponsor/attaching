<?php

declare(strict_types=1);

namespace App\Attaching\Dto\Attachment\Output;

final readonly class AttachmentPrimaryLinkView
{
    public function __construct(
        public AttachmentLinkView $link,
        public AttachmentView $attachment,
    ) {
    }
}
