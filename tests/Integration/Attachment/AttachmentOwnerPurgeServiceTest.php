<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration\Attachment;

use App\Attaching\Entity\Attachment\Attachment;
use App\Attaching\Entity\Attachment\AttachmentLink;
use App\Attaching\Enum\Attachment\AttachmentStatus;
use App\Attaching\Enum\Attachment\AttachmentStorageKind;
use App\Attaching\Enum\Attachment\AttachmentType;
use App\Attaching\Enum\Attachment\AttachmentVisibility;
use App\Attaching\Repository\Attachment\AttachmentLinkRepository;
use App\Attaching\Repository\Attachment\AttachmentRepository;
use App\Attaching\ServiceInterface\Attachment\AttachmentOwnerPurgeServiceInterface;

final class AttachmentOwnerPurgeServiceTest extends DoctrineIntegrationTestCase
{
    public function testPurgeDeletesOrphanAndRetainsSharedAttachment(): void
    {
        $attachmentRepository = $this->getRequiredService(AttachmentRepository::class);
        $linkRepository = $this->getRequiredService(AttachmentLinkRepository::class);
        $purgeService = $this->getRequiredService(AttachmentOwnerPurgeServiceInterface::class);

        $orphan = $this->attachment('orphan.txt', 'orphan');
        $shared = $this->attachment('shared.txt', 'shared');
        $attachmentRepository->save($orphan);
        $attachmentRepository->save($shared);

        $linkRepository->save(new AttachmentLink($orphan, 'vendor', 'vendor-1', 'vendor', 'attachment'));
        $linkRepository->save(new AttachmentLink($shared, 'vendor', 'vendor-1', 'vendor', 'attachment'));
        $linkRepository->save(new AttachmentLink($shared, 'project', 'project-1', 'project', 'document'));

        $result = $purgeService->purge('vendor', 'vendor-1');

        self::assertSame(2, $result->detachedLinkCount);
        self::assertSame(1, $result->deletedOrphanCount);
        self::assertSame(1, $result->retainedSharedCount);
        self::assertSame(AttachmentStatus::Deleted, $orphan->getStatus());
        self::assertSame(AttachmentStatus::Active, $shared->getStatus());
        self::assertCount(0, $linkRepository->findByOwner('vendor', 'vendor-1'));
        self::assertCount(1, $linkRepository->findByOwner('project', 'project-1'));
    }

    public function testPurgeIsIdempotentForMissingOwner(): void
    {
        $purgeService = $this->getRequiredService(AttachmentOwnerPurgeServiceInterface::class);

        $first = $purgeService->purge('vendor', 'missing-vendor');
        $second = $purgeService->purge('vendor', 'missing-vendor');

        self::assertSame(0, $first->detachedLinkCount);
        self::assertSame(0, $first->deletedOrphanCount);
        self::assertSame(0, $first->retainedSharedCount);
        self::assertSame(0, $second->detachedLinkCount);
        self::assertSame(0, $second->deletedOrphanCount);
        self::assertSame(0, $second->retainedSharedCount);
    }

    private function attachment(string $name, string $checksum): Attachment
    {
        return new Attachment(
            type: AttachmentType::Document,
            storageKind: AttachmentStorageKind::Local,
            visibility: AttachmentVisibility::Private,
            originalName: $name,
            storedName: $name,
            mimeType: 'text/plain',
            size: 4,
            checksum: $checksum,
            storagePath: 'document/test/'.$name,
            extension: 'txt',
        );
    }
}
