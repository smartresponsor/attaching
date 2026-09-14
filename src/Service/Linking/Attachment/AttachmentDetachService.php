<?php

declare(strict_types=1);

namespace App\Attaching\Service\Linking\Attachment;

use App\Attaching\DTO\Input\Attachment\AttachmentDetachInputDTO;
use App\Attaching\RepositoryInterface\Doctrine\Attachment\AttachmentLinkRepositoryInterface;
use App\Attaching\Service\Validation\Attachment\AttachmentValidationService;
use App\Attaching\ServiceInterface\Linking\Attachment\AttachmentDetachServiceInterface;

final readonly class AttachmentDetachService implements AttachmentDetachServiceInterface
{
    public function __construct(
        private AttachmentLinkRepositoryInterface $attachmentLinkRepository,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    public function detach(AttachmentDetachInputDTO $input): void
    {
        $this->attachmentValidationService->validateAttachmentIdentifier($input->attachmentId);
        $this->attachmentValidationService->validateOwnerReference($input->ownerType, $input->ownerId);
        $this->attachmentValidationService->validateLinkScope($input->context, $input->slot);

        $attachmentLink = $this->attachmentLinkRepository->findOne($input->attachmentId, $input->ownerType, $input->ownerId, $input->context, $input->slot);

        if (null === $attachmentLink) {
            return;
        }

        $this->attachmentLinkRepository->remove($attachmentLink);
    }
}
