<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Dto\Attachment\Output\AttachmentView;
use App\Entity\Attachment\Attachment;

final class AttachmentViewFactory
{
    public function create(Attachment $attachment, ?string $downloadUrl = null): AttachmentView
    {
        $reader = static fn (object $object, string $property): mixed => (function () use ($property) { return $this->$property; })->call($object);

        return new AttachmentView(
            id: $reader($attachment, 'id'),
            type: $reader($attachment, 'type'),
            mediaKind: $reader($attachment, 'mediaKind'),
            documentKind: $reader($attachment, 'documentKind'),
            originalName: $reader($attachment, 'originalName'),
            mimeType: $reader($attachment, 'mimeType'),
            extension: $reader($attachment, 'extension'),
            size: $reader($attachment, 'size'),
            checksum: $reader($attachment, 'checksum'),
            visibility: $reader($attachment, 'visibility'),
            title: $reader($attachment, 'title'),
            description: $reader($attachment, 'description'),
            altText: $reader($attachment, 'altText'),
            width: $reader($attachment, 'width'),
            height: $reader($attachment, 'height'),
            durationMs: $reader($attachment, 'durationMs'),
            pageCount: $reader($attachment, 'pageCount'),
            downloadUrl: $downloadUrl,
            createdAt: $reader($attachment, 'createdAt'),
        );
    }
}
