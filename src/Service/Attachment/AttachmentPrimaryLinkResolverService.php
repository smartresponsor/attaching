<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Dto\Attachment\Output\AttachmentPrimaryLinkView;
use App\Attaching\Repository\Attachment\AttachmentLinkRepository;
use App\Attaching\ServiceInterface\Attachment\AttachmentPrimaryLinkResolverServiceInterface;

/**
 * Resolves the canonical primary attachment for semantic owner/context/slot consumers.
 */
final readonly class AttachmentPrimaryLinkResolverService implements AttachmentPrimaryLinkResolverServiceInterface
{
    public function __construct(
        private AttachmentLinkRepository $attachmentLinkRepository,
        private AttachmentLinkViewFactory $attachmentLinkViewFactory,
        private AttachmentViewFactory $attachmentViewFactory,
    ) {
    }

    public function resolvePrimary(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentPrimaryLinkView
    {
        $attachmentLink = $this->attachmentLinkRepository->findPrimaryForOwnerSlot($ownerType, $ownerId, $context, $slot);

        if (null === $attachmentLink) {
            return null;
        }

        $attachment = $attachmentLink->getAttachment();

        return new AttachmentPrimaryLinkView(
            link: $this->attachmentLinkViewFactory->create($attachmentLink),
            attachment: $this->attachmentViewFactory->create(
                $attachment,
                sprintf('/attachments/%d/download', $attachment->getId()),
            ),
        );
    }
}
