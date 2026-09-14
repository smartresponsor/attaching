<?php

declare(strict_types=1);

namespace App\Attaching\Service\Linking\Attachment;

use App\Attaching\DTO\Input\Attachment\AttachmentAttachInputDTO;
use App\Attaching\DTO\Output\Attachment\AttachmentLinkViewDTO;
use App\Attaching\Entity\Persistence\Attachment\AttachmentLink;
use App\Attaching\Exception\Linking\Attachment\AttachmentLinkException;
use App\Attaching\Exception\Lookup\Attachment\AttachmentNotFoundException;
use App\Attaching\RepositoryInterface\Doctrine\Attachment\AttachmentLinkRepositoryInterface;
use App\Attaching\RepositoryInterface\Doctrine\Attachment\AttachmentRepositoryInterface;
use App\Attaching\Service\Query\Attachment\AttachmentLinkViewFactory;
use App\Attaching\Service\Validation\Attachment\AttachmentValidationService;
use App\Attaching\ServiceInterface\Linking\Attachment\AttachmentAttachServiceInterface;

final readonly class AttachmentAttachService implements AttachmentAttachServiceInterface
{
    public function __construct(
        private AttachmentRepositoryInterface $attachmentRepository,
        private AttachmentLinkRepositoryInterface $attachmentLinkRepository,
        private AttachmentLinkViewFactory $attachmentLinkViewFactory,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    /**
     * @param AttachmentAttachInputDTO $input
     *
     * @return AttachmentLinkViewDTO
     *
     * @throws \Throwable
     */
    public function attach(AttachmentAttachInputDTO $input): AttachmentLinkViewDTO
    {
        $this->attachmentValidationService->validateAttachmentIdentifier($input->attachmentId);
        $this->attachmentValidationService->validateOwnerReference($input->ownerType, $input->ownerId);
        $this->attachmentValidationService->validateLinkScope($input->context, $input->slot, $input->position);

        $attachment = $this->attachmentRepository->findActive($input->attachmentId);

        if (null === $attachment) {
            throw AttachmentNotFoundException::forAttachmentId($input->attachmentId);
        }

        if ($this->attachmentLinkRepository->exists($input->attachmentId, $input->ownerType, $input->ownerId, $input->context, $input->slot)) {
            throw new AttachmentLinkException('Attachment is already linked to this owner context and slot.');
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
