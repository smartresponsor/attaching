<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Dto\Attachment\Output\AttachmentLinkView;
use App\Attaching\Entity\Attachment\AttachmentLink;

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
