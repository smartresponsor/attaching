<?php

declare(strict_types=1);

namespace App\Attaching\DataFixtures\Demo\Attachment;

use App\Attaching\Entity\Attachment\AttachmentEntity as Attachment;
use App\Attaching\Enum\Classification\Attachment\AttachmentDocumentKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentStorageKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentType;
use App\Attaching\Enum\Classification\Attachment\AttachmentVisibility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @phpstan-type FixtureSpec array{
 *     reference: string,
 *     type: AttachmentType,
 *     documentKind: AttachmentDocumentKind|null,
 *     mediaKind: AttachmentMediaKind|null,
 *     file: string,
 *     originalName: string,
 *     storedName: string,
 *     mimeType: string,
 *     extension: string,
 *     storagePath: string,
 *     sizeFallback: int,
 *     title: string,
 *     description: string,
 *     width?: int,
 *     height?: int,
 *     pageCount?: int
 * }
 */
final class AttachmentFixture extends Fixture
{
    /** @var list<FixtureSpec> */
    private const array FIXTURES = [
        ['reference' => 'attachment.message.1', 'type' => AttachmentType::Document, 'documentKind' => AttachmentDocumentKind::Text, 'mediaKind' => null, 'file' => 'note', 'originalName' => 'sample-note.txt', 'storedName' => 'message-note.txt', 'mimeType' => 'text/plain', 'extension' => 'txt', 'storagePath' => 'document/fixtures/message-note.txt', 'sizeFallback' => 44, 'title' => 'Message note', 'description' => 'Fixture text attachment for message owner.'],
        ['reference' => 'attachment.product.1', 'type' => AttachmentType::Media, 'documentKind' => null, 'mediaKind' => AttachmentMediaKind::Image, 'file' => 'gif', 'originalName' => 'sample-pixel.gif', 'storedName' => 'product-image.gif', 'mimeType' => 'image/gif', 'extension' => 'gif', 'storagePath' => 'media/fixtures/product-image.gif', 'sizeFallback' => 34, 'title' => 'Product image', 'description' => 'Fixture image attachment for product owner.', 'width' => 1, 'height' => 1],
        ['reference' => 'attachment.vendor.avatar.1', 'type' => AttachmentType::Media, 'documentKind' => null, 'mediaKind' => AttachmentMediaKind::Image, 'file' => 'avatar', 'originalName' => 'sample-avatar.png', 'storedName' => 'vendor-avatar.png', 'mimeType' => 'image/png', 'extension' => 'png', 'storagePath' => 'media/fixtures/vendor-avatar.png', 'sizeFallback' => 0, 'title' => 'Vendor avatar', 'description' => 'Fixture avatar image attachment for vendor profile owner.', 'width' => 256, 'height' => 256],
        ['reference' => 'attachment.vendor.cover.1', 'type' => AttachmentType::Media, 'documentKind' => null, 'mediaKind' => AttachmentMediaKind::Image, 'file' => 'banner', 'originalName' => 'sample-banner.png', 'storedName' => 'vendor-cover.png', 'mimeType' => 'image/png', 'extension' => 'png', 'storagePath' => 'media/fixtures/vendor-cover.png', 'sizeFallback' => 0, 'title' => 'Vendor cover image', 'description' => 'Fixture cover image attachment for vendor profile owner.', 'width' => 1200, 'height' => 400],
        ['reference' => 'attachment.vendor.gallery.1', 'type' => AttachmentType::Media, 'documentKind' => null, 'mediaKind' => AttachmentMediaKind::Image, 'file' => 'product', 'originalName' => 'sample-product.png', 'storedName' => 'vendor-gallery-image.png', 'mimeType' => 'image/png', 'extension' => 'png', 'storagePath' => 'media/fixtures/vendor-gallery-image.png', 'sizeFallback' => 0, 'title' => 'Vendor gallery image', 'description' => 'Fixture general image attachment for vendor gallery.', 'width' => 640, 'height' => 480],
        ['reference' => 'attachment.category.icon.1', 'type' => AttachmentType::Media, 'documentKind' => null, 'mediaKind' => AttachmentMediaKind::Image, 'file' => 'category', 'originalName' => 'sample-category.png', 'storedName' => 'category-icon.png', 'mimeType' => 'image/png', 'extension' => 'png', 'storagePath' => 'media/fixtures/category-icon.png', 'sizeFallback' => 0, 'title' => 'Category icon', 'description' => 'Fixture category icon image attachment.', 'width' => 320, 'height' => 320],
        ['reference' => 'attachment.admin.identity.1', 'type' => AttachmentType::Document, 'documentKind' => AttachmentDocumentKind::Pdf, 'mediaKind' => null, 'file' => 'verification', 'originalName' => 'personal-identity-verification.pdf', 'storedName' => 'admin-personal-identity.pdf', 'mimeType' => 'application/pdf', 'extension' => 'pdf', 'storagePath' => 'document/fixtures/admin-personal-identity.pdf', 'sizeFallback' => 0, 'title' => 'Personal identity verification', 'description' => 'Fixture PDF representing a personal identity verification document for the bootstrap administrator.', 'pageCount' => 1],
        ['reference' => 'attachment.admin.verification.1', 'type' => AttachmentType::Document, 'documentKind' => AttachmentDocumentKind::Pdf, 'mediaKind' => null, 'file' => 'verification', 'originalName' => 'account-verification.pdf', 'storedName' => 'admin-account-verification.pdf', 'mimeType' => 'application/pdf', 'extension' => 'pdf', 'storagePath' => 'document/fixtures/admin-account-verification.pdf', 'sizeFallback' => 0, 'title' => 'Account verification', 'description' => 'Fixture PDF representing a general account verification document for the bootstrap administrator.', 'pageCount' => 1],
    ];

    public function __construct(
        private readonly Filesystem $filesystem = new Filesystem(),
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $componentDir = \dirname(__DIR__, 4);
        $storageRoot = $componentDir.'/var/storage/attachment';
        $this->filesystem->mkdir($storageRoot);

        $files = $this->fixtureFiles($componentDir);
        $checksums = $this->fixtureChecksums($files);

        foreach (self::FIXTURES as $fixture) {
            $this->persistFixture($manager, $storageRoot, $fixture, $files, $checksums);
        }

        $manager->flush();
    }

    /** @return array<string, string> */
    private function fixtureFiles(string $componentDir): array
    {
        $base = $componentDir.'/tests/Resources/files/';

        return [
            'note' => $base.'sample-note.txt',
            'gif' => $base.'sample-pixel.gif',
            'avatar' => $base.'sample-avatar.png',
            'product' => $base.'sample-product.png',
            'category' => $base.'sample-category.png',
            'banner' => $base.'sample-banner.png',
            'verification' => $base.'sample-verification.pdf',
        ];
    }

    /**
     * @param array<string, string> $files
     *
     * @return array<string, string>
     */
    private function fixtureChecksums(array $files): array
    {
        $checksums = [];
        foreach ($files as $key => $path) {
            $checksum = hash_file('sha256', $path);
            if (false === $checksum) {
                throw new \RuntimeException(sprintf('Fixture checksum generation failed for "%s".', $path));
            }
            $checksums[$key] = $checksum;
        }

        return $checksums;
    }

    /**
     * @param FixtureSpec           $fixture
     * @param array<string, string> $files
     * @param array<string, string> $checksums
     */
    private function persistFixture(ObjectManager $manager, string $storageRoot, array $fixture, array $files, array $checksums): void
    {
        $fileKey = $fixture['file'];
        $sourceFile = $files[$fileKey];
        $absoluteTargetPath = $storageRoot.'/'.str_replace('/', DIRECTORY_SEPARATOR, $fixture['storagePath']);
        $this->filesystem->mkdir(dirname($absoluteTargetPath));
        $this->filesystem->copy($sourceFile, $absoluteTargetPath, true);

        $attachment = new Attachment(
            type: $fixture['type'],
            storageKind: AttachmentStorageKind::Local,
            visibility: AttachmentVisibility::Private,
            originalName: $fixture['originalName'],
            storedName: $fixture['storedName'],
            mimeType: $fixture['mimeType'],
            size: filesize($sourceFile) ?: $fixture['sizeFallback'],
            checksum: $checksums[$fileKey],
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
}
