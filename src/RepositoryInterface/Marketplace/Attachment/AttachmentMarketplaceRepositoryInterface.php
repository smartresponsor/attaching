<?php

declare(strict_types=1);

namespace App\Attaching\RepositoryInterface\Marketplace\Attachment;

use App\Attaching\Entity\Attachment\AttachmentEntity as Attachment;
use App\Attaching\Entity\Attachment\AttachmentLinkEntity as AttachmentLink;

interface AttachmentMarketplaceRepositoryInterface
{
    /** @return list<string> */
    public function findRootCategoryOwnerIds(): array;

    /** @return list<string> */
    public function findPublishedRetailOwnerIds(): array;

    /** @return list<string> */
    public function findProfessionalVendorOwnerIds(): array;

    /** @return list<string> */
    public function findCustomerOwnerIds(): array;

    public function findLink(string $ownerType, string $ownerId, string $context, string $slot): ?AttachmentLink;

    public function findAttachmentByStoragePath(string $storagePath): ?Attachment;

    public function persist(object $entity): void;

    public function flush(): void;
}
