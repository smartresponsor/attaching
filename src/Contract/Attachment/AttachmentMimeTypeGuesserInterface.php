<?php

declare(strict_types=1);

namespace App\Contract\Attachment;

use App\Enum\Attachment\AttachmentDocumentKind;
use App\Enum\Attachment\AttachmentMediaKind;
use App\Enum\Attachment\AttachmentType;

interface AttachmentMimeTypeGuesserInterface
{
    /**
     * @return array{type: AttachmentType, mediaKind: ?AttachmentMediaKind, documentKind: ?AttachmentDocumentKind}
     */
    public function classify(string $mimeType): array;
}
