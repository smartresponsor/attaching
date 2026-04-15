<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Exception\Attachment\AttachmentNotFoundException;
use App\Repository\Attachment\AttachmentLinkRepository;
use App\Repository\Attachment\AttachmentRepository;
use App\ServiceInterface\Attachment\AttachmentDeleteServiceInterface;

final readonly class AttachmentDeleteService implements AttachmentDeleteServiceInterface
{
    public function __construct(
        private AttachmentRepository $attachmentRepository,
        private AttachmentLinkRepository $attachmentLinkRepository,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    /**
     * @param string $attachmentId
     *
     * @throws \Throwable
     */
    public function delete(string $attachmentId): void
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
