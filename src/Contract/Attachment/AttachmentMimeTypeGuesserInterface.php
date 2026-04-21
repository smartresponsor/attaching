<?php

declare(strict_types=1);

namespace App\Attaching\Contract\Attachment;

use App\Attaching\Enum\Attachment\AttachmentDocumentKind;
use App\Attaching\Enum\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Attachment\AttachmentType;

interface AttachmentMimeTypeGuesserInterface
{
    /**
     * @return array{type: AttachmentType, mediaKind: ?AttachmentMediaKind, documentKind: ?AttachmentDocumentKind}
     */
    public function classify(string $mimeType): array;
}
