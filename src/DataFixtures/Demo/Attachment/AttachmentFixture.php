<?php

declare(strict_types=1);

namespace App\Attaching\DataFixtures\Demo\Attachment;

use App\Attaching\Entity\Persistence\Attachment\Attachment;
use App\Attaching\Enum\Classification\Attachment\AttachmentDocumentKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentStorageKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentType;
use App\Attaching\Enum\Classification\Attachment\AttachmentVisibility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

final class AttachmentFixture extends Fixture
{
    public function __construct(
        private readonly Filesystem $filesystem = new Filesystem(),
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $componentDir = \dirname(__DIR__, 4);
        $storageRoot = $componentDir.'/var/storage/attachment';
        $this->filesystem->mkdir($storageRoot);

        $noteFixtureFile = $componentDir.'/tests/Resources/files/sample-note.txt';
        $gifFixtureFile = $componentDir.'/tests/Resources/files/sample-pixel.gif';
        $avatarFixtureFile = $componentDir.'/tests/Resources/files/sample-avatar.png';
        $productFixtureFile = $componentDir.'/tests/Resources/files/sample-product.png';
        $categoryFixtureFile = $componentDir.'/tests/Resources/files/sample-category.png';
        $bannerFixtureFile = $componentDir.'/tests/Resources/files/sample-banner.png';
        $noteChecksum = hash_file('sha256', $noteFixtureFile);
        $gifChecksum = hash_file('sha256', $gifFixtureFile);
        $avatarChecksum = hash_file('sha256', $avatarFixtureFile);
        $productChecksum = hash_file('sha256', $productFixtureFile);
        $categoryChecksum = hash_file('sha256', $categoryFixtureFile);
        $bannerChecksum = hash_file('sha256', $bannerFixtureFile);

        if (false === $noteChecksum || false === $gifChecksum || false === $avatarChecksum || false === $productChecksum || false === $categoryChecksum || false === $bannerChecksum) {
            throw new \RuntimeException('Fixture checksum generation failed.');
        }

        $fixtures = [
            [
                'reference' => 'attachment.message.1',
                'type' => AttachmentType::Document,
                'documentKind' => AttachmentDocumentKind::Text,
                'mediaKind' => null,
                'originalName' => 'sample-note.txt',
                'storedName' => 'message-note.txt',
                'mimeType' => 'text/plain',
                'extension' => 'txt',
                'sourceFile' => $noteFixtureFile,
                'storagePath' => 'document/fixtures/message-note.txt',
                'size' => filesize($noteFixtureFile) ?: 44,
                'checksum' => $noteChecksum,
                'title' => 'Message note',
                'description' => 'Fixture text attachment for message owner.',
                'ownerType' => 'message',
                'ownerId' => 'msg-fixture-1',
                'context' => 'message',
                'slot' => 'attachment',
                'isPrimary' => true,
            ],
            [
                'reference' => 'attachment.product.1',
                'type' => AttachmentType::Media,
                'documentKind' => null,
                'mediaKind' => AttachmentMediaKind::Image,
                'originalName' => 'sample-pixel.gif',
                'storedName' => 'product-image.gif',
                'mimeType' => 'image/gif',
                'extension' => 'gif',
                'sourceFile' => $gifFixtureFile,
                'storagePath' => 'media/fixtures/product-image.gif',
                'size' => filesize($gifFixtureFile) ?: 34,
                'checksum' => $gifChecksum,
                'title' => 'Product image',
                'description' => 'Fixture image attachment for product owner.',
                'ownerType' => 'product',
                'ownerId' => 'prod-fixture-1',
                'context' => 'gallery',
                'slot' => 'image',
                'isPrimary' => true,
                'width' => 1,
                'height' => 1,
            ],
            [
                'reference' => 'attachment.vendor.avatar.1',
                'type' => AttachmentType::Media,
                'documentKind' => null,
                'mediaKind' => AttachmentMediaKind::Image,
                'originalName' => 'sample-avatar.png',
                'storedName' => 'vendor-avatar.png',
                'mimeType' => 'image/png',
                'extension' => 'png',
                'sourceFile' => $avatarFixtureFile,
                'storagePath' => 'media/fixtures/vendor-avatar.png',
                'size' => filesize($avatarFixtureFile) ?: 0,
                'checksum' => $avatarChecksum,
                'title' => 'Vendor avatar',
                'description' => 'Fixture avatar image attachment for vendor profile owner.',
                'ownerType' => 'vendor',
                'ownerId' => 'vendor-fixture-1',
                'context' => 'profile',
                'slot' => 'avatar',
                'isPrimary' => true,
                'width' => 256,
                'height' => 256,
            ],
            [
                'reference' => 'attachment.product.banner.1',
                'type' => AttachmentType::Media,
                'documentKind' => null,
                'mediaKind' => AttachmentMediaKind::Image,
                'originalName' => 'sample-product.png',
                'storedName' => 'product-banner.png',
                'mimeType' => 'image/png',
                'extension' => 'png',
                'sourceFile' => $productFixtureFile,
                'storagePath' => 'media/fixtures/product-banner.png',
                'size' => filesize($productFixtureFile) ?: 0,
                'checksum' => $productChecksum,
                'title' => 'Product banner',
                'description' => 'Fixture product banner image attachment.',
                'ownerType' => 'product',
                'ownerId' => 'prod-fixture-1',
                'context' => 'gallery',
                'slot' => 'banner',
                'isPrimary' => false,
                'width' => 640,
                'height' => 480,
            ],
            [
                'reference' => 'attachment.category.icon.1',
                'type' => AttachmentType::Media,
                'documentKind' => null,
                'mediaKind' => AttachmentMediaKind::Image,
                'originalName' => 'sample-category.png',
                'storedName' => 'category-icon.png',
                'mimeType' => 'image/png',
                'extension' => 'png',
                'sourceFile' => $categoryFixtureFile,
                'storagePath' => 'media/fixtures/category-icon.png',
                'size' => filesize($categoryFixtureFile) ?: 0,
                'checksum' => $categoryChecksum,
                'title' => 'CategoryEntity icon',
                'description' => 'Fixture category icon image attachment.',
                'ownerType' => 'category',
                'ownerId' => 'catalog-fixture-1',
                'context' => 'catalog',
                'slot' => 'icon',
                'isPrimary' => true,
                'width' => 320,
                'height' => 320,
            ],
            [
                'reference' => 'attachment.vendor.banner.1',
                'type' => AttachmentType::Media,
                'documentKind' => null,
                'mediaKind' => AttachmentMediaKind::Image,
                'originalName' => 'sample-banner.png',
                'storedName' => 'vendor-banner.png',
                'mimeType' => 'image/png',
                'extension' => 'png',
                'sourceFile' => $bannerFixtureFile,
                'storagePath' => 'media/fixtures/vendor-banner.png',
                'size' => filesize($bannerFixtureFile) ?: 0,
                'checksum' => $bannerChecksum,
                'title' => 'Vendor banner',
                'description' => 'Fixture vendor banner image attachment.',
                'ownerType' => 'vendor',
                'ownerId' => 'vendor-fixture-1',
                'context' => 'profile',
                'slot' => 'cover',
                'isPrimary' => false,
                'width' => 1200,
                'height' => 400,
            ],
            [
                'reference' => 'attachment.vendor.1',
                'type' => AttachmentType::Document,
                'documentKind' => AttachmentDocumentKind::Pdf,
                'mediaKind' => null,
                'originalName' => 'vendor-policy.pdf',
                'storedName' => 'vendor-policy.pdf',
                'mimeType' => 'application/pdf',
                'extension' => 'pdf',
                'sourceFile' => $noteFixtureFile,
                'storagePath' => 'document/fixtures/vendor-policy.pdf',
                'size' => filesize($noteFixtureFile) ?: 44,
                'checksum' => $noteChecksum,
                'title' => 'Vendor policy',
                'description' => 'Fixture pseudo-pdf attachment for vendor owner.',
                'ownerType' => 'vendor',
                'ownerId' => 'vendor-fixture-1',
                'context' => 'document',
                'slot' => 'manual',
                'isPrimary' => false,
            ],
        ];

        foreach ($fixtures as $fixture) {
            $absoluteTargetPath = $storageRoot.'/'.str_replace('/', DIRECTORY_SEPARATOR, $fixture['storagePath']);
            $this->filesystem->mkdir(dirname($absoluteTargetPath));
            $this->filesystem->copy($fixture['sourceFile'], $absoluteTargetPath, true);

            $attachment = new Attachment(
                type: $fixture['type'],
                storageKind: AttachmentStorageKind::Local,
                visibility: AttachmentVisibility::Private,
                originalName: $fixture['originalName'],
                storedName: $fixture['storedName'],
                mimeType: $fixture['mimeType'],
                size: $fixture['size'],
                checksum: $fixture['checksum'],
                storagePath: $fixture['storagePath'],
                extension: $fixture['extension'],
                mediaKind: $fixture['mediaKind'],
                documentKind: $fixture['documentKind'],
                title: $fixture['title'],
                description: $fixture['description'],
                width: $fixture['width'] ?? null,
                height: $fixture['height'] ?? null,
            );

            $manager->persist($attachment);
            $this->addReference($fixture['reference'], $attachment);
        }

        $manager->flush();
    }
}
