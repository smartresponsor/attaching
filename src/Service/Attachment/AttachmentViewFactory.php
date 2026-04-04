<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Dto\Attachment\Output\AttachmentView;
use App\Entity\Attachment\Attachment;

final class AttachmentViewFactory
{
    public function create(Attachment $attachment, ?string $downloadUrl = null): AttachmentView
    {
        return new AttachmentView(
            id: $attachment->getId(),
            type: $attachment->getType(),
            mediaKind: $attachment->getMediaKind(),
            documentKind: $attachment->getDocumentKind(),
            originalName: $attachment->getOriginalName(),
            mimeType: $attachment->getMimeType(),
            extension: $attachment->getExtension(),
            size: $attachment->getSize(),
            checksum: $attachment->getChecksum(),
            visibility: $attachment->getVisibility(),
            title: $attachment->getTitle(),
            description: $attachment->getDescription(),
            altText: $attachment->getAltText(),
            width: $attachment->getWidth(),
            height: $attachment->getHeight(),
            durationMs: $attachment->getDurationMs(),
            pageCount: $attachment->getPageCount(),
            downloadUrl: $downloadUrl,
            createdAt: $attachment->getCreatedAt(),
        );
    }
}
