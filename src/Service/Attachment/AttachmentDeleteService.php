<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Exception\Attachment\AttachmentNotFoundException;
use App\Repository\Attachment\AttachmentRepository;
use App\ServiceInterface\Attachment\AttachmentDeleteServiceInterface;

final readonly class AttachmentDeleteService implements AttachmentDeleteServiceInterface
{
    public function __construct(
        private AttachmentRepository $attachmentRepository,
        private AttachmentValidationService $attachmentValidationService,
    )
    {
    }

    public function delete(string $attachmentId): void
    {
        $this->attachmentValidationService->validateAttachmentIdentifier($attachmentId);
        $attachment = $this->attachmentRepository->find($attachmentId);

        if (null === $attachment) {
            throw AttachmentNotFoundException::forAttachmentId($attachmentId);
        }

        $attachment->markDeleted();
        $this->attachmentRepository->save($attachment);
    }
}
