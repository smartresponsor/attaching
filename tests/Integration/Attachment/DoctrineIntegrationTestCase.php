<?php

declare(strict_types=1);

namespace App\Tests\Integration\Attachment;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
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
        $entityManager = $container->get(EntityManagerInterface::class);
        self::assertInstanceOf(EntityManagerInterface::class, $entityManager);
        $this->entityManager = $entityManager;
        $this->filesystem = new Filesystem();
        $projectDir = $container->getParameter('kernel.project_dir');
        self::assertIsString($projectDir);
        $this->testDatabasePath = $projectDir.'/var/attachment.test.sqlite';
        $this->testStoragePath = $projectDir.'/var/storage/attachment';

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
        $fixtures = [];

        foreach ($fixtureClasses as $fixtureClass) {
            $fixtures[] = $this->getRequiredService($fixtureClass);
        }

        /** @var list<FixtureInterface> $fixtures */
        $fixtures = $fixtures;

        $executor = new ORMExecutor($this->entityManager, new ORMPurger());
        $executor->execute($fixtures, append: false);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $serviceId
     *
     * @return T
     */
    protected function getRequiredService(string $serviceId): object
    {
        $service = static::getContainer()->get($serviceId);
        self::assertInstanceOf($serviceId, $service);

        return $service;
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
