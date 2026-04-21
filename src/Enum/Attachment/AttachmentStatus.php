<?php

declare(strict_types=1);

namespace App\Attaching\Enum\Attachment;

enum AttachmentStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case Deleted = 'deleted';
    case Failed = 'failed';
    case Quarantined = 'quarantined';
}
