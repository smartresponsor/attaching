<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration\Fixture\Attachment;

use App\Attaching\DataFixtures\Demo\Attachment\AttachmentFixture;
use App\Attaching\DataFixtures\Demo\Attachment\AttachmentLinkFixture;
use App\Attaching\Entity\Persistence\Attachment\Attachment;
use App\Attaching\Entity\Persistence\Attachment\AttachmentLink;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\TestCase;

final class AttachmentDemoFixtureContractTest extends TestCase
{
    public function testDemoFixturesPersistIntegerPrimaryKeysAndAttachmentGraph(): void
    {
        $entityManager = $this->entityManager();
        $executor = new ORMExecutor($entityManager, new ORMPurger());
        $executor->execute([
            new AttachmentFixture(),
            new AttachmentLinkFixture(),
        ], append: false);

        /** @var list<Attachment> $attachmentList */
        $attachmentList = $entityManager->createQuery('SELECT attachment FROM '.Attachment::class.' attachment ORDER BY attachment.id ASC')->getResult();
        /** @var list<AttachmentLink> $attachmentLinkList */
        $attachmentLinkList = $entityManager->createQuery('SELECT link FROM '.AttachmentLink::class.' link ORDER BY link.id ASC')->getResult();

        self::assertCount(8, $attachmentList);
        self::assertCount(8, $attachmentLinkList);

        foreach ($attachmentList as $attachment) {
            self::assertGreaterThan(0, $attachment->getId());
            self::assertNotEmpty($attachment->getStoragePath());
            self::assertNotEmpty($attachment->getChecksum());
        }

        $primaryLinkCount = 0;
        foreach ($attachmentLinkList as $link) {
            self::assertGreaterThan(0, $link->getId());
            self::assertSame($link->getAttachment()->getId(), $entityManager->getUnitOfWork()->getSingleIdentifierValue($link->getAttachment()));

            if ($link->isPrimary()) {
                ++$primaryLinkCount;
            }
        }

        self::assertSame(6, $primaryLinkCount);
    }

    private function entityManager(): EntityManager
    {
        $projectDir = dirname(__DIR__, 4);
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
