<?php

declare(strict_types=1);

namespace App\Attaching\DataFixtures;

use App\Attaching\Entity\Attachment\Attachment;
use App\Attaching\Enum\Attachment\AttachmentDocumentKind;
use App\Attaching\Enum\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Attachment\AttachmentStorageKind;
use App\Attaching\Enum\Attachment\AttachmentType;
use App\Attaching\Enum\Attachment\AttachmentVisibility;
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
        $componentDir = \dirname(__DIR__, 2);
        $storageRoot = $componentDir.'/var/storage/attachment';
        $this->filesystem->mkdir($storageRoot);

        $noteFixtureFile = $componentDir.'/tests/Resources/files/sample-note.txt';
        $gifFixtureFile = $componentDir.'/tests/Resources/files/sample-pixel.gif';
        $avatarFixtureFile = $componentDir.'/tests/Resources/files/sample-avatar.png';
        $productFixtureFile = $componentDir.'/tests/Resources/files/sample-product.png';
        $categoryFixtureFile = $componentDir.'/tests/Resources/files/sample-category.png';
        $bannerFixtureFile = $componentDir.'/tests/Resources/files/sample-banner.png';
        $verificationFixtureFile = $componentDir.'/tests/Resources/files/sample-verification.pdf';

        $files = [
            'note' => $noteFixtureFile,
            'gif' => $gifFixtureFile,
            'avatar' => $avatarFixtureFile,
            'product' => $productFixtureFile,
            'category' => $categoryFixtureFile,
            'banner' => $bannerFixtureFile,
            'verification' => $verificationFixtureFile,
        ];

        $checksums = [];
        foreach ($files as $key => $path) {
            $checksum = hash_file('sha256', $path);
            if (false === $checksum) {
                throw new \RuntimeException(sprintf('Fixture checksum generation failed for "%s".', $path));
            }
            $checksums[$key] = $checksum;
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
                'checksum' => $checksums['note'],
                'title' => 'Message note',
                'description' => 'Fixture text attachment for message owner.',
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
                'checksum' => $checksums['gif'],
                'title' => 'Product image',
                'description' => 'Fixture image attachment for product owner.',
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
                'checksum' => $checksums['avatar'],
                'title' => 'Vendor avatar',
                'description' => 'Fixture avatar image attachment for vendor profile owner.',
                'width' => 256,
                'height' => 256,
            ],
            [
                'reference' => 'attachment.vendor.cover.1',
                'type' => AttachmentType::Media,
                'documentKind' => null,
                'mediaKind' => AttachmentMediaKind::Image,
                'originalName' => 'sample-banner.png',
                'storedName' => 'vendor-cover.png',
                'mimeType' => 'image/png',
                'extension' => 'png',
                'sourceFile' => $bannerFixtureFile,
                'storagePath' => 'media/fixtures/vendor-cover.png',
                'size' => filesize($bannerFixtureFile) ?: 0,
                'checksum' => $checksums['banner'],
                'title' => 'Vendor cover image',
                'description' => 'Fixture cover image attachment for vendor profile owner.',
                'width' => 1200,
                'height' => 400,
            ],
            [
                'reference' => 'attachment.vendor.gallery.1',
                'type' => AttachmentType::Media,
                'documentKind' => null,
                'mediaKind' => AttachmentMediaKind::Image,
                'originalName' => 'sample-product.png',
                'storedName' => 'vendor-gallery-image.png',
                'mimeType' => 'image/png',
                'extension' => 'png',
                'sourceFile' => $productFixtureFile,
                'storagePath' => 'media/fixtures/vendor-gallery-image.png',
                'size' => filesize($productFixtureFile) ?: 0,
                'checksum' => $checksums['product'],
                'title' => 'Vendor gallery image',
                'description' => 'Fixture general image attachment for vendor gallery.',
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
                'checksum' => $checksums['category'],
                'title' => 'Category icon',
                'description' => 'Fixture category icon image attachment.',
                'width' => 320,
                'height' => 320,
            ],
            [
                'reference' => 'attachment.admin.identity.1',
                'type' => AttachmentType::Document,
                'documentKind' => AttachmentDocumentKind::Pdf,
                'mediaKind' => null,
                'originalName' => 'personal-identity-verification.pdf',
                'storedName' => 'admin-personal-identity.pdf',
                'mimeType' => 'application/pdf',
                'extension' => 'pdf',
                'sourceFile' => $verificationFixtureFile,
                'storagePath' => 'document/fixtures/admin-personal-identity.pdf',
                'size' => filesize($verificationFixtureFile) ?: 0,
                'checksum' => $checksums['verification'],
                'title' => 'Personal identity verification',
                'description' => 'Fixture PDF representing a personal identity verification document for the bootstrap administrator.',
                'pageCount' => 1,
            ],
            [
                'reference' => 'attachment.admin.verification.1',
                'type' => AttachmentType::Document,
                'documentKind' => AttachmentDocumentKind::Pdf,
                'mediaKind' => null,
                'originalName' => 'account-verification.pdf',
                'storedName' => 'admin-account-verification.pdf',
                'mimeType' => 'application/pdf',
                'extension' => 'pdf',
                'sourceFile' => $verificationFixtureFile,
                'storagePath' => 'document/fixtures/admin-account-verification.pdf',
                'size' => filesize($verificationFixtureFile) ?: 0,
                'checksum' => $checksums['verification'],
                'title' => 'Account verification',
                'description' => 'Fixture PDF representing a general account verification document for the bootstrap administrator.',
                'pageCount' => 1,
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
                pageCount: $fixture['pageCount'] ?? null,
            );

            $manager->persist($attachment);
            $this->addReference($fixture['reference'], $attachment);
        }

        $manager->flush();
    }
}
