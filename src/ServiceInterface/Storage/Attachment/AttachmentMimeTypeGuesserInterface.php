<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Storage\Attachment;

use App\Attaching\Enum\Classification\Attachment\AttachmentDocumentKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentType;

interface AttachmentMimeTypeGuesserInterface
{
    /**
     * @return array{type: AttachmentType, mediaKind: ?AttachmentMediaKind, documentKind: ?AttachmentDocumentKind}
     */
    public function classify(string $mimeType): array;
}
