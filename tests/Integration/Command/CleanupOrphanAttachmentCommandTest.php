<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration\Command;

use App\Attaching\Command\Attachment\CleanupOrphanAttachmentCommand;
use App\Attaching\DataFixtures\AttachmentFixture;
use App\Attaching\DataFixtures\AttachmentLinkFixture;
use App\Attaching\Repository\Attachment\AttachmentRepository;
use App\Attaching\ServiceInterface\Attachment\AttachmentDeleteServiceInterface;
use App\Attaching\Tests\Integration\Attachment\DoctrineIntegrationTestCase;
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

        $deleteService = $this->getRequiredService(AttachmentDeleteServiceInterface::class);
        $repository = $this->getRequiredService(AttachmentRepository::class);
        $command = $this->getRequiredService(CleanupOrphanAttachmentCommand::class);

        self::assertInstanceOf(AttachmentDeleteServiceInterface::class, $deleteService);
        self::assertInstanceOf(AttachmentRepository::class, $repository);
        self::assertInstanceOf(CleanupOrphanAttachmentCommand::class, $command);

        $deleteService->delete($attachmentId);
        self::assertNotNull($repository->find($attachmentId));

        $tester = new CommandTester($command);
        $exitCode = $tester->execute([]);

        self::assertSame(0, $exitCode);
        self::assertStringContainsString('Cleaned 1 orphan attachment(s).', $tester->getDisplay());
        self::assertNull($repository->find($attachmentId));
        self::assertFileDoesNotExist($filePath);
    }
}
