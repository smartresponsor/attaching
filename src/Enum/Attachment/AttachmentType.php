<?php

declare(strict_types=1);

namespace App\Enum\Attachment;

enum AttachmentType: string
{
    case Media = 'media';
    case Document = 'document';
}
