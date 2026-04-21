<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration\Attachment;

use App\Attaching\DataFixtures\AttachmentFixture;
use App\Attaching\DataFixtures\AttachmentLinkFixture;
use App\Attaching\Dto\Attachment\Input\ListAttachmentInput;
use App\Attaching\ServiceInterface\Attachment\AttachmentDeleteServiceInterface;
use App\Attaching\ServiceInterface\Attachment\AttachmentDownloadServiceInterface;
use App\Attaching\ServiceInterface\Attachment\AttachmentListServiceInterface;

final class AttachmentFlowTest extends DoctrineIntegrationTestCase
{
    public function testFixtureBackedListDownloadDeleteFlow(): void
    {
        $this->loadFixtures([
            AttachmentFixture::class,
            AttachmentLinkFixture::class,
        ]);

        $listService = $this->getRequiredService(AttachmentListServiceInterface::class);
        $downloadService = $this->getRequiredService(AttachmentDownloadServiceInterface::class);
        $deleteService = $this->getRequiredService(AttachmentDeleteServiceInterface::class);

        self::assertInstanceOf(AttachmentListServiceInterface::class, $listService);
        self::assertInstanceOf(AttachmentDownloadServiceInterface::class, $downloadService);
        self::assertInstanceOf(AttachmentDeleteServiceInterface::class, $deleteService);

        $before = $listService->list(new ListAttachmentInput(
            ownerType: 'message',
            ownerId: 'msg-fixture-1',
            context: 'message',
            slot: 'attachment',
        ));

        self::assertCount(1, $before->items);
        $attachmentId = $before->items[0]->id;

        $downloadResponse = $downloadService->download($attachmentId);
        self::assertTrue($downloadResponse->headers->has('Content-Disposition'));

        $deleteService->delete($attachmentId);

        $after = $listService->list(new ListAttachmentInput(
            ownerType: 'message',
            ownerId: 'msg-fixture-1',
            context: 'message',
            slot: 'attachment',
        ));

        self::assertCount(0, $after->items);
    }
}
