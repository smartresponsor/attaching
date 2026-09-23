<?php

declare(strict_types=1);

namespace App\Attaching\Service\Query\Attachment;

use App\Attaching\DTO\Input\Attachment\AttachmentListInputDTO;
use App\Attaching\DTO\Output\Attachment\AttachmentListViewDTO;
use App\Attaching\Factory\Query\Attachment\AttachmentViewFactory;
use App\Attaching\RepositoryInterface\Persistence\Attachment\AttachmentLinkRepositoryInterface;
use App\Attaching\Service\Validation\Attachment\AttachmentValidationService;
use App\Attaching\ServiceInterface\Query\Attachment\AttachmentListServiceInterface;

final readonly class AttachmentListService implements AttachmentListServiceInterface
{
    public function __construct(
        private AttachmentLinkRepositoryInterface $attachmentLinkRepository,
        private AttachmentViewFactory $attachmentViewFactory,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    public function list(AttachmentListInputDTO $input): AttachmentListViewDTO
    {
        $this->attachmentValidationService->validateOwnerReference($input->ownerType, $input->ownerId);
        $this->attachmentValidationService->validateLinkScope($input->context, $input->slot);

        $items = [];

        foreach ($this->attachmentLinkRepository->findByOwner($input->ownerType, $input->ownerId, $input->context, $input->slot) as $attachmentLink) {
            $items[] = $this->attachmentViewFactory->create(
                $attachmentLink->getAttachment(),
                sprintf('/attachment/%d/download', $attachmentLink->getAttachment()->getId()),
                $attachmentLink->getContext(),
                $attachmentLink->getSlot(),
                $attachmentLink->isPrimary(),
                $attachmentLink->getPosition(),
            );
        }

        return new AttachmentListViewDTO(
            ownerType: $input->ownerType,
            ownerId: $input->ownerId,
            context: $input->context,
            slot: $input->slot,
            items: $items,
        );
    }
}
