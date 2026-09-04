<?php

declare(strict_types=1);

namespace App\Attaching\Service\Linking\Attachment;

use App\Attaching\Dto\Output\Attachment\AttachmentOwnerPurgeResult;
use App\Attaching\RepositoryInterface\Persistence\Attachment\AttachmentLinkRepositoryInterface;
use App\Attaching\RepositoryInterface\Persistence\Attachment\AttachmentRepositoryInterface;
use App\Attaching\Service\Validation\Attachment\AttachmentValidationService;
use App\Attaching\ServiceInterface\Linking\Attachment\AttachmentOwnerPurgeServiceInterface;

final readonly class AttachmentOwnerPurgeService implements AttachmentOwnerPurgeServiceInterface
{
    public function __construct(
        private AttachmentLinkRepositoryInterface $attachmentLinkRepository,
        private AttachmentRepositoryInterface $attachmentRepository,
        private AttachmentValidationService $attachmentValidationService,
    ) {
    }

    public function purge(string $ownerType, string $ownerId): AttachmentOwnerPurgeResult
    {
        $this->attachmentValidationService->validateOwnerReference($ownerType, $ownerId);

        $linkList = $this->attachmentLinkRepository->findByOwner($ownerType, $ownerId);
        $attachmentList = [];

        foreach ($linkList as $link) {
            $attachmentList[$link->getAttachment()->getId()] = $link->getAttachment();
            $this->attachmentLinkRepository->remove($link);
        }

        $deletedOrphanCount = 0;
        $retainedSharedCount = 0;

        foreach ($attachmentList as $attachment) {
            if ([] !== $this->attachmentLinkRepository->findByAttachment($attachment)) {
                ++$retainedSharedCount;
                continue;
            }

            $attachment->markDeleted();
            $this->attachmentRepository->save($attachment);
            ++$deletedOrphanCount;
        }

        return new AttachmentOwnerPurgeResult(
            ownerType: $ownerType,
            ownerId: $ownerId,
            detachedLinkCount: count($linkList),
            deletedOrphanCount: $deletedOrphanCount,
            retainedSharedCount: $retainedSharedCount,
        );
    }
}
