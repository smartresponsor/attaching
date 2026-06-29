<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Dto\Attachment\Input\AttachAttachmentInput;
use App\Attaching\Dto\Attachment\Output\AttachmentLinkView;
use App\Attaching\Entity\Attachment\AttachmentLink;
use App\Attaching\Exception\Attachment\AttachmentNotFoundException;
use App\Attaching\Repository\Attachment\AttachmentLinkRepository;
use App\Attaching\Repository\Attachment\AttachmentRepository;
use App\Attaching\ServiceInterface\Attachment\AttachmentAttachServiceInterface;

final readonly class AttachmentAttachService implements AttachmentAttachServiceInterface
{
    public function __construct(
        private AttachmentRepository $attachmentRepository,
        private AttachmentLinkRepository $attachmentLinkRepository,
        private AttachmentLinkViewFactory $attachmentLinkViewFactory,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    /**
     * @param AttachAttachmentInput $input
     *
     * @return AttachmentLinkView
     *
     * @throws \Throwable
     */
    public function attach(AttachAttachmentInput $input): AttachmentLinkView
    {
        $this->attachmentValidationService->validateAttachmentIdentifier($input->attachmentId);
        $this->attachmentValidationService->validateOwnerReference($input->ownerType, $input->ownerId);

        $attachment = $this->attachmentRepository->findActive($input->attachmentId);

        if (null === $attachment) {
            throw AttachmentNotFoundException::forAttachmentId($input->attachmentId);
        }

        if ($input->isPrimary) {
            $this->attachmentLinkRepository->clearPrimaryForOwnerSlot($input->ownerType, $input->ownerId, $input->context, $input->slot);
        }

        $attachmentLink = new AttachmentLink(
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
}
