<?php

declare(strict_types=1);

namespace App\Attaching\Enum\Attachment;

enum AttachmentVisibility: string
{
    case Private = 'private';
    case Public = 'public';
    case Restricted = 'restricted';
}
