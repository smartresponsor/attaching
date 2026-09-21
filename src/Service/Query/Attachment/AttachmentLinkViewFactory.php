<?php

declare(strict_types=1);

namespace App\Attaching\Service\Query\Attachment;

use App\Attaching\DTO\Output\Attachment\AttachmentLinkViewDTO;
use App\Attaching\Entity\Attachment\AttachmentLink;

final class AttachmentLinkViewFactory
{
    public function create(AttachmentLink $attachmentLink): AttachmentLinkViewDTO
    {
        return new AttachmentLinkViewDTO(
            id: $attachmentLink->getId(),
            attachmentId: $attachmentLink->getAttachment()->getId(),
            ownerType: $attachmentLink->getOwnerType(),
            ownerId: $attachmentLink->getOwnerId(),
            context: $attachmentLink->getContext(),
            slot: $attachmentLink->getSlot(),
            position: $attachmentLink->getPosition(),
            isPrimary: $attachmentLink->isPrimary(),
            createdAt: $attachmentLink->getCreatedAt(),
        );
    }
}
