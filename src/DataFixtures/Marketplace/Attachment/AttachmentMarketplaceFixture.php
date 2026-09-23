<?php

declare(strict_types=1);

namespace App\Attaching\DataFixtures\Marketplace\Attachment;

use App\Attaching\Entity\Attachment\AttachmentEntity as Attachment;
use App\Attaching\Entity\Attachment\AttachmentLinkEntity as AttachmentLink;
use App\Attaching\Enum\Classification\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentStorageKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentType;
use App\Attaching\Enum\Classification\Attachment\AttachmentVisibility;
use App\Attaching\RepositoryInterface\Marketplace\Attachment\AttachmentMarketplaceRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

final class AttachmentMarketplaceFixture extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private readonly AttachmentMarketplaceRepositoryInterface $attachmentMarketplaceRepository,
        private readonly Filesystem $filesystem = new Filesystem(),
    ) {
    }

    public static function getGroups(): array
    {
        return ['attaching_marketplace'];
    }

    public function load(ObjectManager $manager): void
    {
        $componentDir = dirname(__DIR__, 4);
        $storageRoot = $componentDir.'/var/storage/attachment';

        $this->attachRows(
            $storageRoot,
            $componentDir.'/tests/Resources/files/sample-category.png',
            'category',
            'catalog',
            'icon',
            $this->attachmentMarketplaceRepository->findRootCategoryOwnerIds(),
        );

        $this->attachRows(
            $storageRoot,
            $componentDir.'/tests/Resources/files/sample-product.png',
            'retail',
            'gallery',
            'image',
            $this->attachmentMarketplaceRepository->findPublishedRetailOwnerIds(),
        );

        $professionalVendorIds = $this->attachmentMarketplaceRepository->findProfessionalVendorOwnerIds();
        $this->attachRows($storageRoot, $componentDir.'/tests/Resources/files/sample-avatar.png', 'vendor', 'profile', 'avatar', $professionalVendorIds);
        $this->attachRows($storageRoot, $componentDir.'/tests/Resources/files/sample-banner.png', 'vendor', 'profile', 'cover', $professionalVendorIds);

        $this->attachRows(
            $storageRoot,
            $componentDir.'/tests/Resources/files/sample-avatar.png',
            'access',
            'profile',
            'avatar',
            $this->attachmentMarketplaceRepository->findCustomerOwnerIds(),
        );

        $this->attachmentMarketplaceRepository->flush();
    }

    /** @param list<string> $ownerIds */
    private function attachRows(
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
            $ownerId = trim($ownerId);
            if ('' === $ownerId) {
                continue;
            }

            if (null !== $this->attachmentMarketplaceRepository->findLink($ownerType, $ownerId, $context, $slot)) {
                continue;
            }

            $extension = strtolower((string) pathinfo($sourceFile, PATHINFO_EXTENSION));
            $storedName = sprintf('%s-%s-%s.%s', $ownerType, $ownerId, $slot, $extension);
            $storagePath = sprintf('media/marketplace/%s/%s/%s', $ownerType, $ownerId, $storedName);
            $absoluteTargetPath = $storageRoot.'/'.str_replace('/', DIRECTORY_SEPARATOR, $storagePath);
            $this->filesystem->mkdir(dirname($absoluteTargetPath));
            $this->filesystem->copy($sourceFile, $absoluteTargetPath, true);

            $attachment = $this->attachmentMarketplaceRepository->findAttachmentByStoragePath($storagePath);
            if (null === $attachment) {
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
                $this->attachmentMarketplaceRepository->persist($attachment);
            }

            $this->attachmentMarketplaceRepository->persist(new AttachmentLink(
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
