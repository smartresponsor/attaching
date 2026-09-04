<?php

declare(strict_types=1);

namespace App\Attaching\RepositoryInterface\Persistence\Attachment;

use App\Attaching\Entity\Persistence\Attachment\Attachment;
use App\Attaching\Entity\Persistence\Attachment\AttachmentLink;

interface AttachmentLinkRepositoryInterface
{
    public function save(AttachmentLink $attachmentLink): void;

    public function remove(AttachmentLink $attachmentLink): void;

    /** @return list<AttachmentLink> */
    public function findByOwner(string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): array;

    public function exists(int $attachmentId, string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): bool;

    public function findOne(int $attachmentId, string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): ?AttachmentLink;

    public function findPrimaryForOwnerSlot(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentLink;

    /**
     * @param list<int> $attachmentIds
     *
     * @return list<AttachmentLink>
     */
    public function findByAttachmentIds(array $attachmentIds): array;

    /** @return list<AttachmentLink> */
    public function findByAttachmentId(int $attachmentId): array;

    /** @return list<AttachmentLink> */
    public function findByAttachment(Attachment $attachment): array;

    public function clearPrimaryForOwnerSlot(string $ownerType, string $ownerId, ?string $context = null, ?string $slot = null): void;
}
