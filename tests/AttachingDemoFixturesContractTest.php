<?php

declare(strict_types=1);

namespace App\Attaching\Tests;

use App\Attaching\DataFixtures\AttachmentFixture;
use App\Attaching\DataFixtures\AttachmentLinkFixture;
use App\Attaching\Entity\Attachment\Attachment;
use App\Attaching\Entity\Attachment\AttachmentLink;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\TestCase;

final class AttachingDemoFixturesContractTest extends TestCase
{
    public function testDemoFixturesPersistIntegerPrimaryKeysAndAttachmentGraph(): void
    {
        $entityManager = $this->entityManager();
        $executor = new ORMExecutor($entityManager, new ORMPurger());
        $executor->execute([
            new AttachmentFixture(),
            new AttachmentLinkFixture(),
        ], append: false);

        $attachments = $entityManager->createQuery('SELECT attachment FROM '.Attachment::class.' attachment ORDER BY attachment.id ASC')->getResult();
        $links = $entityManager->createQuery('SELECT link FROM '.AttachmentLink::class.' link ORDER BY link.id ASC')->getResult();

        self::assertCount(7, $attachments);
        self::assertCount(6, $links);

        foreach ($attachments as $attachment) {
            self::assertIsInt($attachment->getId());
            self::assertGreaterThan(0, $attachment->getId());
            self::assertNotEmpty($attachment->getStoragePath());
            self::assertNotEmpty($attachment->getChecksum());
        }

        $primaryLinks = 0;
        foreach ($links as $link) {
            self::assertIsInt($link->getId());
            self::assertGreaterThan(0, $link->getId());
            self::assertIsInt($link->getAttachment()->getId());
            self::assertSame($link->getAttachment()->getId(), $entityManager->getUnitOfWork()->getSingleIdentifierValue($link->getAttachment()));

            if ($link->isPrimary()) {
                ++$primaryLinks;
            }
        }

        self::assertSame(4, $primaryLinks);
    }

    private function entityManager(): EntityManager
    {
        $projectDir = dirname(__DIR__);
        $config = ORMSetup::createAttributeMetadataConfig([$projectDir.'/src/Entity'], true);
        $config->setNamingStrategy(new UnderscoreNamingStrategy());
        $config->enableNativeLazyObjects(true);
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'memory' => true,
        ]);

        $entityManager = new EntityManager($connection, $config);
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->createSchema($entityManager->getMetadataFactory()->getAllMetadata());

        return $entityManager;
    }
}
