<?php

declare(strict_types=1);

namespace App\Tests\Integration\Command;

use App\Command\Attachment\CleanupOrphanAttachmentCommand;
use App\DataFixtures\AttachmentFixture;
use App\DataFixtures\AttachmentLinkFixture;
use App\Repository\Attachment\AttachmentRepository;
use App\ServiceInterface\Attachment\AttachmentDeleteServiceInterface;
use App\Tests\Integration\Attachment\DoctrineIntegrationTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class CleanupOrphanAttachmentCommandTest extends DoctrineIntegrationTestCase
{
    public function testCleanupRemovesDeletedOrphanAttachmentFileAndRecord(): void
    {
        $this->loadFixtures([
            AttachmentFixture::class,
            AttachmentLinkFixture::class,
        ]);

        $attachmentId = '11111111-1111-1111-1111-111111111111';
        $filePath = $this->testStoragePath.'/document/fixtures/message-note.txt';

        self::assertFileExists($filePath);

        $deleteService = self::getContainer()->get(AttachmentDeleteServiceInterface::class);
        $deleteService->delete($attachmentId);

        $repository = self::getContainer()->get(AttachmentRepository::class);
        self::assertNotNull($repository->find($attachmentId));

        $command = self::getContainer()->get(CleanupOrphanAttachmentCommand::class);
        $tester = new CommandTester($command);
        $exitCode = $tester->execute([]);

        self::assertSame(0, $exitCode);
        self::assertStringContainsString('Cleaned 1 orphan attachment(s).', $tester->getDisplay());
        self::assertNull($repository->find($attachmentId));
        self::assertFileDoesNotExist($filePath);
    }
}
