<?php

declare(strict_types=1);

namespace App\Attaching\Enum\Attachment;

enum AttachmentDocumentKind: string
{
    case Pdf = 'pdf';
    case WordProcessing = 'word_processing';
    case Text = 'text';
    case Spreadsheet = 'spreadsheet';
    case Presentation = 'presentation';
    case Archive = 'archive';
    case Other = 'other';
}
