<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Dto\Attachment\Output\AttachmentLinkView;
use App\Entity\Attachment\AttachmentLink;

final class AttachmentLinkViewFactory
{
    public function create(AttachmentLink $attachmentLink): AttachmentLinkView
    {
        return new AttachmentLinkView(
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
