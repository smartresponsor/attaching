<?php

declare(strict_types=1);

namespace App\Attaching\Service\Linking\Attachment;

use App\Attaching\Exception\Lookup\Attachment\AttachmentNotFoundException;
use App\Attaching\RepositoryInterface\Persistence\Attachment\AttachmentLinkRepositoryInterface;
use App\Attaching\RepositoryInterface\Persistence\Attachment\AttachmentRepositoryInterface;
use App\Attaching\Service\Validation\Attachment\AttachmentValidationService;
use App\Attaching\ServiceInterface\Linking\Attachment\AttachmentDeleteServiceInterface;

final readonly class AttachmentDeleteService implements AttachmentDeleteServiceInterface
{
    public function __construct(
        private AttachmentRepositoryInterface $attachmentRepository,
        private AttachmentLinkRepositoryInterface $attachmentLinkRepository,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    /**
     * @throws \Throwable
     */
    public function delete(int $attachmentId): void
    {
        $this->attachmentValidationService->validateAttachmentIdentifier($attachmentId);
        $attachment = $this->attachmentRepository->findActive($attachmentId);

        if (null === $attachment) {
            throw AttachmentNotFoundException::forAttachmentId($attachmentId);
        }

        foreach ($this->attachmentLinkRepository->findByAttachment($attachment) as $attachmentLink) {
            $this->attachmentLinkRepository->remove($attachmentLink);
        }

        $attachment->markDeleted();
        $this->attachmentRepository->save($attachment);
    }
}
