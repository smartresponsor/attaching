<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Dto\Attachment\Input\ListAttachmentInput;
use App\Dto\Attachment\Output\AttachmentListView;
use App\Repository\Attachment\AttachmentLinkRepository;
use App\ServiceInterface\Attachment\AttachmentListServiceInterface;

final readonly class AttachmentListService implements AttachmentListServiceInterface
{
    public function __construct(
        private AttachmentLinkRepository $attachmentLinkRepository,
        private AttachmentViewFactory $attachmentViewFactory,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    public function list(ListAttachmentInput $input): AttachmentListView
    {
        $this->attachmentValidationService->validateOwnerReference($input->ownerType, $input->ownerId);

        $items = [];

        foreach ($this->attachmentLinkRepository->findByOwner($input->ownerType, $input->ownerId, $input->context, $input->slot) as $attachmentLink) {
            $items[] = $this->attachmentViewFactory->create(
                $attachmentLink->getAttachment(),
                sprintf('/attachments/%s/download', $attachmentLink->getAttachment()->getId()),
            );
        }

        return new AttachmentListView(
            ownerType: $input->ownerType,
            ownerId: $input->ownerId,
            context: $input->context,
            slot: $input->slot,
            items: $items,
        );
    }
}
