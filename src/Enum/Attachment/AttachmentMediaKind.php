<?php

declare(strict_types=1);

namespace App\Attaching\Enum\Attachment;

enum AttachmentMediaKind: string
{
    case Image = 'image';
    case Audio = 'audio';
    case Video = 'video';
    case Other = 'other';
}
