<?php

declare(strict_types=1);

namespace App\Attaching\Command\Attachment;

use App\Attaching\DataFixtures\AttachmentFixture;
use App\Attaching\DataFixtures\AttachmentLinkFixture;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:attachment:bootstrap-runtime',
    description: 'Rebuild the standalone Attaching runtime schema from entities and load demo attachment fixtures.'
)]
final class BootstrapAttachmentRuntimeCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $environment = (string) ($_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? getenv('APP_ENV') ?: 'dev');

        if ('prod' === $environment) {
            $io->error('Runtime bootstrap is not allowed in prod environment.');

            return Command::FAILURE;
        }

        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();

        if ([] === $metadata) {
            $io->error('No Doctrine metadata was found for Attaching entities.');

            return Command::FAILURE;
        }

        $schemaTool = new SchemaTool($this->entityManager);

        try {
            $schemaTool->dropSchema($metadata);
        } catch (\Throwable) {
            // SQLite bootstrap can start from an empty database; missing tables are not a failure here.
        }

        $schemaTool->createSchema($metadata);

        $executor = new ORMExecutor($this->entityManager, new ORMPurger());
        $executor->execute([
            new AttachmentFixture(),
            new AttachmentLinkFixture(),
        ], true);

        $io->success('Attaching standalone runtime schema and demo fixtures were bootstrapped from entity metadata.');

        return Command::SUCCESS;
    }
}
