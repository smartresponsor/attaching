<?php

declare(strict_types=1);

namespace App\Attaching\Enum\Classification\Attachment;

enum AttachmentType: string
{
    case Media = 'media';
    case Document = 'document';
}
