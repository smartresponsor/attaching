<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Dto\Attachment\Output\AttachmentLinkView;
use App\Entity\Attachment\AttachmentLink;

final class AttachmentLinkViewFactory
{
    public function create(AttachmentLink $attachmentLink): AttachmentLinkView
    {
        $reader = static fn (object $object, string $property): mixed => (function () use ($property) { return $this->$property; })->call($object);
        $attachment = $reader($attachmentLink, 'attachment');

        return new AttachmentLinkView(
            id: $reader($attachmentLink, 'id'),
            attachmentId: $reader($attachment, 'id'),
            ownerType: $reader($attachmentLink, 'ownerType'),
            ownerId: $reader($attachmentLink, 'ownerId'),
            context: $reader($attachmentLink, 'context'),
            slot: $reader($attachmentLink, 'slot'),
            position: $reader($attachmentLink, 'position'),
            isPrimary: $reader($attachmentLink, 'isPrimary'),
            createdAt: $reader($attachmentLink, 'createdAt'),
        );
    }
}
