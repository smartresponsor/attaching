<?php

declare(strict_types=1);

namespace App\Attaching\Service\Linking\Attachment;

use App\Attaching\DTO\Output\Attachment\AttachmentPrimaryLinkViewDTO;
use App\Attaching\RepositoryInterface\Doctrine\Attachment\AttachmentLinkRepositoryInterface;
use App\Attaching\Service\Query\Attachment\AttachmentLinkViewFactory;
use App\Attaching\Service\Query\Attachment\AttachmentViewFactory;
use App\Attaching\ServiceInterface\Linking\Attachment\AttachmentPrimaryLinkResolverServiceInterface;

/**
 * Resolves the canonical primary attachment for semantic owner/context/slot consumers.
 */
final readonly class AttachmentPrimaryLinkResolverService implements AttachmentPrimaryLinkResolverServiceInterface
{
    public function __construct(
        private AttachmentLinkRepositoryInterface $attachmentLinkRepository,
        private AttachmentLinkViewFactory $attachmentLinkViewFactory,
        private AttachmentViewFactory $attachmentViewFactory,
    ) {
    }

    public function resolvePrimary(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentPrimaryLinkViewDTO
    {
        $attachmentLink = $this->attachmentLinkRepository->findPrimaryForOwnerSlot($ownerType, $ownerId, $context, $slot);

        if (null === $attachmentLink) {
            return null;
        }

        $attachment = $attachmentLink->getAttachment();

        return new AttachmentPrimaryLinkViewDTO(
            link: $this->attachmentLinkViewFactory->create($attachmentLink),
            attachment: $this->attachmentViewFactory->create(
                $attachment,
                sprintf('/attachment/%d/download', $attachment->getId()),
            ),
        );
    }
}
