<?php

declare(strict_types=1);

namespace App\Attaching\Factory\Query\Attachment;

use App\Attaching\DTO\Output\Attachment\AttachmentViewDTO;
use App\Attaching\Entity\Attachment\AttachmentEntity as Attachment;

final class AttachmentViewFactory
{
    public function create(
        Attachment $attachment,
        ?string $downloadUrl = null,
        ?string $context = null,
        ?string $slot = null,
        bool $isPrimary = false,
        int $position = 0,
    ): AttachmentViewDTO {
        return new AttachmentViewDTO(
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
            context: $context,
            slot: $slot,
            isPrimary: $isPrimary,
            position: $position,
        );
    }
}
