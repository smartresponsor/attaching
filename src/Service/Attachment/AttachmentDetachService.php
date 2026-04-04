<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Dto\Attachment\Input\DetachAttachmentInput;
use App\Repository\Attachment\AttachmentLinkRepository;
use App\ServiceInterface\Attachment\AttachmentDetachServiceInterface;

final readonly class AttachmentDetachService implements AttachmentDetachServiceInterface
{
    public function __construct(
        private AttachmentLinkRepository $attachmentLinkRepository,
        private AttachmentValidationService $attachmentValidationService,
    )
    {
    }

    public function detach(DetachAttachmentInput $input): void
    {
        $this->attachmentValidationService->validateAttachmentIdentifier($input->attachmentId);
        $this->attachmentValidationService->validateOwnerReference($input->ownerType, $input->ownerId);

        $attachmentLink = $this->attachmentLinkRepository->findOne(
            $input->attachmentId,
            $input->ownerType,
            $input->ownerId,
            $input->context,
            $input->slot,
        );

        if (null === $attachmentLink) {
            return;
        }

        $this->attachmentLinkRepository->remove($attachmentLink);
    }
}
