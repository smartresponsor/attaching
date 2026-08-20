<?php

declare(strict_types=1);

namespace App\Attaching\DataFixtures;

use App\Attaching\Entity\Attachment\Attachment;
use App\Attaching\Entity\Attachment\AttachmentLink;
use App\Attaching\Enum\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Attachment\AttachmentStorageKind;
use App\Attaching\Enum\Attachment\AttachmentType;
use App\Attaching\Enum\Attachment\AttachmentVisibility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

final class MarketplaceAttachmentFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(private readonly Filesystem $filesystem = new Filesystem())
    {
    }

    public static function getGroups(): array
    {
        return ['attaching_marketplace'];
    }

    public function load(ObjectManager $manager): void
    {
        if (!$manager instanceof EntityManagerInterface) {
            throw new \RuntimeException('Doctrine entity manager is required to load marketplace attachment fixtures.');
        }

        $componentDir = dirname(__DIR__, 2);
        $storageRoot = $componentDir.'/var/storage/attachment';

        $this->attachRows(
            $manager,
            $storageRoot,
            $componentDir.'/tests/Resources/files/sample-category.png',
            'category',
            'catalog',
            'icon',
            $manager->getConnection()->fetchFirstColumn(<<<'SQL'
SELECT category.id::text
FROM category
JOIN catalog ON catalog.id = category.catalog_id
WHERE catalog.object_code = 'services'
  AND category.depth IN (1, 2)
  AND category.published = TRUE
ORDER BY category.id
SQL),
        );

        $this->attachRows(
            $manager,
            $storageRoot,
            $componentDir.'/tests/Resources/files/sample-product.png',
            'retail',
            'gallery',
            'image',
            $manager->getConnection()->fetchFirstColumn("SELECT id::text FROM retail WHERE kind IN ('service', 'task') AND object_status = 'published' ORDER BY id"),
        );

        $professionalVendorIds = $manager->getConnection()->fetchFirstColumn(<<<'SQL'
SELECT vendor.id::text
FROM vendor
JOIN access ON access.id = vendor.owner_user_id
WHERE vendor.object_status = 'active'
  AND access.roles::text LIKE '%ROLE_PRO%'
ORDER BY vendor.id
SQL);
        $this->attachRows($manager, $storageRoot, $componentDir.'/tests/Resources/files/sample-avatar.png', 'vendor', 'profile', 'avatar', $professionalVendorIds);
        $this->attachRows($manager, $storageRoot, $componentDir.'/tests/Resources/files/sample-banner.png', 'vendor', 'profile', 'cover', $professionalVendorIds);

        $customerIds = $manager->getConnection()->fetchFirstColumn(<<<'SQL'
SELECT id::text
FROM access
WHERE email LIKE '%.customer@smartresponsor.local'
  AND roles::text NOT LIKE '%ROLE_PRO%'
ORDER BY id
SQL);
        $this->attachRows($manager, $storageRoot, $componentDir.'/tests/Resources/files/sample-avatar.png', 'access', 'profile', 'avatar', $customerIds);

        $manager->flush();
    }

    /** @param list<string> $ownerIds */
    private function attachRows(
        EntityManagerInterface $manager,
        string $storageRoot,
        string $sourceFile,
        string $ownerType,
        string $context,
        string $slot,
        array $ownerIds,
    ): void {
        if (!is_file($sourceFile)) {
            throw new \RuntimeException(sprintf('Marketplace fixture media source is missing: %s', $sourceFile));
        }

        $checksum = hash_file('sha256', $sourceFile);
        if (false === $checksum) {
            throw new \RuntimeException(sprintf('Marketplace fixture media checksum failed: %s', $sourceFile));
        }

        foreach ($ownerIds as $ownerId) {
            $ownerId = trim((string) $ownerId);
            if ('' === $ownerId) {
                continue;
            }

            $existingLink = $manager->getRepository(AttachmentLink::class)->findOneBy([
                'ownerType' => $ownerType,
                'ownerId' => $ownerId,
                'context' => $context,
                'slot' => $slot,
            ]);
            if ($existingLink instanceof AttachmentLink) {
                continue;
            }

            $extension = strtolower((string) pathinfo($sourceFile, PATHINFO_EXTENSION));
            $storedName = sprintf('%s-%s-%s.%s', $ownerType, $ownerId, $slot, $extension);
            $storagePath = sprintf('media/marketplace/%s/%s/%s', $ownerType, $ownerId, $storedName);
            $absoluteTargetPath = $storageRoot.'/'.str_replace('/', DIRECTORY_SEPARATOR, $storagePath);
            $this->filesystem->mkdir(dirname($absoluteTargetPath));
            $this->filesystem->copy($sourceFile, $absoluteTargetPath, true);

            $attachment = $manager->getRepository(Attachment::class)->findOneBy(['storagePath' => $storagePath]);
            if (!$attachment instanceof Attachment) {
                $attachment = new Attachment(
                    type: AttachmentType::Media,
                    storageKind: AttachmentStorageKind::Local,
                    visibility: AttachmentVisibility::Public,
                    originalName: basename($sourceFile),
                    storedName: $storedName,
                    mimeType: 'image/png',
                    size: filesize($sourceFile) ?: 0,
                    checksum: $checksum,
                    storagePath: $storagePath,
                    extension: $extension,
                    mediaKind: AttachmentMediaKind::Image,
                    title: sprintf('%s %s', ucfirst($ownerType), $slot),
                    description: 'Marketplace fixture media bound to a real persisted owner identifier.',
                );
                $manager->persist($attachment);
            }

            $manager->persist(new AttachmentLink(
                attachment: $attachment,
                ownerType: $ownerType,
                ownerId: $ownerId,
                context: $context,
                slot: $slot,
                position: 0,
                isPrimary: true,
            ));
        }
    }
}
