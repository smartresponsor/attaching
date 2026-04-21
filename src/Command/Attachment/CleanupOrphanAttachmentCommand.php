<?php

declare(strict_types=1);

namespace App\Attaching\Command\Attachment;

use App\Attaching\Contract\Attachment\AttachmentStorageInterface;
use App\Attaching\Repository\Attachment\AttachmentRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:attachment:cleanup-orphan', description: 'Remove deleted attachments that no longer have owner links.')]
final class CleanupOrphanAttachmentCommand extends Command
{
    public function __construct(
        private readonly AttachmentRepository $attachmentRepository,
        private readonly AttachmentStorageInterface $attachmentStorage,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $deletedAttachments = $this->attachmentRepository->findDeletedWithoutLinks();

        foreach ($deletedAttachments as $attachment) {
            if ($this->attachmentStorage->exists($attachment->getStoragePath())) {
                $this->attachmentStorage->delete($attachment->getStoragePath());
            }

            $this->attachmentRepository->remove($attachment);
        }

        $io->success(sprintf('Cleaned %d orphan attachment(s).', count($deletedAttachments)));

        return Command::SUCCESS;
    }
}
