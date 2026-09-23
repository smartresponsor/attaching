<?php

declare(strict_types=1);

namespace App\Attaching\Command\Runtime\Attachment;

use App\Attaching\DataFixtures\Demo\Attachment\AttachmentFixture;
use App\Attaching\DataFixtures\Demo\Attachment\AttachmentLinkFixture;
use App\Attaching\RepositoryInterface\Runtime\Attachment\AttachmentRuntimeRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:attachment:bootstrap-runtime',
    description: 'Rebuild the standalone Attaching runtime schema from entities and load demo attachment fixtures.'
)]
final class AttachmentBootstrapRuntimeCommand extends Command
{
    public function __construct(private readonly AttachmentRuntimeRepositoryInterface $attachmentRuntimeRepository)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $environment = $this->environment();

        if ('prod' === $environment) {
            $io->error('Runtime bootstrap is not allowed in prod environment.');

            return Command::FAILURE;
        }

        if (!$this->attachmentRuntimeRepository->rebuildSchema()) {
            $io->error('No Doctrine metadata was found for Attaching entities.');

            return Command::FAILURE;
        }

        $this->attachmentRuntimeRepository->executeFixtures([
            new AttachmentFixture(),
            new AttachmentLinkFixture(),
        ]);

        $io->success('Attaching standalone runtime schema and demo fixtures were bootstrapped from entity metadata.');

        return Command::SUCCESS;
    }

    private function environment(): string
    {
        foreach ([$_SERVER['APP_ENV'] ?? null, $_ENV['APP_ENV'] ?? null, getenv('APP_ENV')] as $value) {
            if (!is_scalar($value)) {
                continue;
            }

            $environment = trim((string) $value);

            if ('' !== $environment) {
                return $environment;
            }
        }

        return 'dev';
    }
}
