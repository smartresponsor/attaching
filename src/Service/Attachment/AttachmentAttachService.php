<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Dto\Attachment\Input\AttachAttachmentInput;
use App\Dto\Attachment\Output\AttachmentLinkView;
use App\Entity\Attachment\AttachmentLink;
use App\Repository\Attachment\AttachmentLinkRepository;
use App\Repository\Attachment\AttachmentRepository;
use App\ServiceInterface\Attachment\AttachmentAttachServiceInterface;

final readonly class AttachmentAttachService implements AttachmentAttachServiceInterface
{
    public function __construct(
        private AttachmentRepository $attachmentRepository,
        private AttachmentLinkRepository $attachmentLinkRepository,
        private AttachmentLinkViewFactory $attachmentLinkViewFactory,
    ) {
    }

    public function attach(AttachAttachmentInput $input): AttachmentLinkView
    {
        $attachment = $this->attachmentRepository->find($input->attachmentId);

        if (null === $attachment) {
            throw new \RuntimeException(sprintf('Attachment "%s" was not found.', $input->attachmentId));
        }

        if ($input->isPrimary) {
            $this->attachmentLinkRepository->clearPrimaryForOwnerSlot($input->ownerType, $input->ownerId, $input->context, $input->slot);
        }

        $attachmentLink = new AttachmentLink(
            id: $this->generateIdentifier(),
            attachment: $attachment,
            ownerType: $input->ownerType,
            ownerId: $input->ownerId,
            context: $input->context,
            slot: $input->slot,
            position: $input->position,
            isPrimary: $input->isPrimary,
        );

        $this->attachmentLinkRepository->save($attachmentLink);

        return $this->attachmentLinkViewFactory->create($attachmentLink);
    }

    private function generateIdentifier(): string
    {
        $hex = bin2hex(random_bytes(16));

        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12),
        );
    }
}
