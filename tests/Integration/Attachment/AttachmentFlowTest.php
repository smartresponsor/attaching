<?php

declare(strict_types=1);

namespace App\Tests\Integration\Attachment;

use App\DataFixtures\AttachmentFixture;
use App\DataFixtures\AttachmentLinkFixture;
use App\Dto\Attachment\Input\ListAttachmentInput;
use App\ServiceInterface\Attachment\AttachmentDeleteServiceInterface;
use App\ServiceInterface\Attachment\AttachmentDownloadServiceInterface;
use App\ServiceInterface\Attachment\AttachmentListServiceInterface;

final class AttachmentFlowTest extends DoctrineIntegrationTestCase
{
    public function testFixtureBackedListDownloadDeleteFlow(): void
    {
        $this->loadFixtures([
            AttachmentFixture::class,
            AttachmentLinkFixture::class,
        ]);

        $listService = self::getContainer()->get(AttachmentListServiceInterface::class);
        $downloadService = self::getContainer()->get(AttachmentDownloadServiceInterface::class);
        $deleteService = self::getContainer()->get(AttachmentDeleteServiceInterface::class);

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
