<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration\Attachment;

use App\Attaching\DataFixtures\AttachmentFixture;
use App\Attaching\Dto\Attachment\Input\AttachAttachmentInput;
use App\Attaching\Dto\Attachment\Input\ListAttachmentInput;
use App\Attaching\Entity\Attachment\Attachment;
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

        $attachmentRepository = $this->entityManager->getRepository(Attachment::class);
        self::assertInstanceOf(Attachment::class, $attachmentRepository->findOneBy(['originalName' => 'sample-note.txt']));
        self::assertInstanceOf(Attachment::class, $attachmentRepository->findOneBy(['originalName' => 'sample-pixel.gif']));

        $firstAttachment = $attachmentRepository->findOneBy(['originalName' => 'sample-note.txt']);
        $secondAttachment = $attachmentRepository->findOneBy(['originalName' => 'sample-pixel.gif']);
        self::assertInstanceOf(Attachment::class, $firstAttachment);
        self::assertInstanceOf(Attachment::class, $secondAttachment);

        $first = $attachService->attach(new AttachAttachmentInput(
            attachmentId: $firstAttachment->getId(),
            ownerType: 'product',
            ownerId: 'prod-primary-1',
            context: 'gallery',
            slot: 'image',
            isPrimary: true,
        ));

        $second = $attachService->attach(new AttachAttachmentInput(
            attachmentId: $secondAttachment->getId(),
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
