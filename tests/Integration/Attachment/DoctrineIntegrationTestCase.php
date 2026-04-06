<?php

declare(strict_types=1);

namespace App\Tests\Integration\Attachment;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;

abstract class DoctrineIntegrationTestCase extends KernelTestCase
{
    protected EntityManagerInterface $entityManager;
    protected Filesystem $filesystem;
    protected string $testDatabasePath;
    protected string $testStoragePath;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();

        $container = static::getContainer();
        $this->entityManager = $container->get(EntityManagerInterface::class);
        $this->filesystem = new Filesystem();
        $this->testDatabasePath = self::getContainer()->getParameter('kernel.project_dir').'/var/attachment.test.sqlite';
        $this->testStoragePath = self::getContainer()->getParameter('kernel.project_dir').'/var/storage/attachment';

        $this->resetPersistence();
        $this->resetStorage();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }

    /**
     * @param list<class-string> $fixtureClasses
     */
    protected function loadFixtures(array $fixtureClasses): void
    {
        $loader = new Loader();

        foreach ($fixtureClasses as $fixtureClass) {
            $loader->addFixture(new $fixtureClass());
        }

        $executor = new ORMExecutor($this->entityManager, new ORMPurger());
        $executor->execute($loader->getFixtures(), append: false);
    }

    private function resetPersistence(): void
    {
        if ($this->filesystem->exists($this->testDatabasePath)) {
            $this->filesystem->remove($this->testDatabasePath);
        }

        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->dropSchema($metadata);

        if ([] !== $metadata) {
            $schemaTool->createSchema($metadata);
        }
    }

    private function resetStorage(): void
    {
        if ($this->filesystem->exists($this->testStoragePath)) {
            $this->filesystem->remove($this->testStoragePath);
        }

        $this->filesystem->mkdir($this->testStoragePath);
    }
}
