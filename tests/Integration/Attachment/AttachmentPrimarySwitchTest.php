<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration\Attachment;

use App\Attaching\DataFixtures\AttachmentFixture;
use App\Attaching\Dto\Attachment\Input\AttachAttachmentInput;
use App\Attaching\Dto\Attachment\Input\ListAttachmentInput;
use App\Attaching\Repository\Attachment\AttachmentLinkRepository;
use App\Attaching\ServiceInterface\Attachment\AttachmentAttachServiceInterface;
use App\Attaching\ServiceInterface\Attachment\AttachmentListServiceInterface;

final class AttachmentPrimarySwitchTest extends DoctrineIntegrationTestCase
{
    public function testPrimarySwitchClearsPreviousPrimaryInSameOwnerSlot(): void
    {
        $this->loadFixtures([
            AttachmentFixture::class,
        ]);

        $attachService = $this->getRequiredService(AttachmentAttachServiceInterface::class);
        $linkRepository = $this->getRequiredService(AttachmentLinkRepository::class);
        $listService = $this->getRequiredService(AttachmentListServiceInterface::class);

        self::assertInstanceOf(AttachmentAttachServiceInterface::class, $attachService);
        self::assertInstanceOf(AttachmentLinkRepository::class, $linkRepository);
        self::assertInstanceOf(AttachmentListServiceInterface::class, $listService);

        $first = $attachService->attach(new AttachAttachmentInput(
            attachmentId: '11111111-1111-1111-1111-111111111111',
            ownerType: 'product',
            ownerId: 'prod-primary-1',
            context: 'gallery',
            slot: 'image',
            isPrimary: true,
        ));

        $second = $attachService->attach(new AttachAttachmentInput(
            attachmentId: '22222222-2222-2222-2222-222222222222',
            ownerType: 'product',
            ownerId: 'prod-primary-1',
            context: 'gallery',
            slot: 'image',
            isPrimary: true,
        ));

        $links = $linkRepository->findByOwner('product', 'prod-primary-1', 'gallery', 'image');
        self::assertCount(2, $links);

        $primaryCount = 0;
        foreach ($links as $link) {
            if ($link->isPrimary()) {
                ++$primaryCount;
                self::assertSame($second->attachmentId, $link->getAttachment()->getId());
            }
        }

        self::assertSame(1, $primaryCount);

        $list = $listService->list(new ListAttachmentInput(
            ownerType: 'product',
            ownerId: 'prod-primary-1',
            context: 'gallery',
            slot: 'image',
        ));
        self::assertCount(2, $list->items);
        self::assertNotSame($first->attachmentId, $second->attachmentId);
    }
}
