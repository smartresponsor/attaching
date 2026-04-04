<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Repository\Attachment\AttachmentRepository;
use App\ServiceInterface\Attachment\AttachmentDeleteServiceInterface;

final readonly class AttachmentDeleteService implements AttachmentDeleteServiceInterface
{
    public function __construct(private AttachmentRepository $attachmentRepository)
    {
    }

    public function delete(string $attachmentId): void
    {
        $attachment = $this->attachmentRepository->find($attachmentId);

        if (null === $attachment) {
            return;
        }

        $attachment->markDeleted();
        $this->attachmentRepository->save($attachment);
    }
}
