<?php

declare(strict_types=1);

namespace App\Attaching\Repository\Runtime\Attachment;

use App\Attaching\RepositoryInterface\Runtime\Attachment\AttachmentRuntimeRepositoryInterface;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;

final readonly class AttachmentRuntimeRepository implements AttachmentRuntimeRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function rebuildSchema(): bool
    {
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        if ([] === $metadata) {
            return false;
        }

        $schemaTool = new SchemaTool($this->entityManager);
        try {
            $schemaTool->dropSchema($metadata);
        } catch (\Throwable) {
            // SQLite bootstrap can start from an empty database; missing tables are not a failure here.
        }

        $schemaTool->createSchema($metadata);

        return true;
    }

    public function executeFixtures(array $fixtures): void
    {
        $executor = new ORMExecutor($this->entityManager, new ORMPurger());
        $executor->execute($fixtures, true);
    }
}
