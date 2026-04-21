<?php

declare(strict_types=1);

namespace App\Attaching\Enum\Attachment;

enum AttachmentType: string
{
    case Media = 'media';
    case Document = 'document';
}
