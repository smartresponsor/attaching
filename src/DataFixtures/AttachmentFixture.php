<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Attachment\Attachment;
use App\Enum\Attachment\AttachmentDocumentKind;
use App\Enum\Attachment\AttachmentMediaKind;
use App\Enum\Attachment\AttachmentStorageKind;
use App\Enum\Attachment\AttachmentType;
use App\Enum\Attachment\AttachmentVisibility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Filesystem\Filesystem;

final class AttachmentFixture extends Fixture
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private readonly string $projectDir,
        private readonly Filesystem $filesystem = new Filesystem(),
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $storageRoot = $this->projectDir.'/var/storage/attachment';
        $this->filesystem->mkdir($storageRoot);

        $fixtures = [
            [
                'reference' => 'attachment.message.1',
                'id' => '11111111-1111-1111-1111-111111111111',
                'type' => AttachmentType::Document,
                'documentKind' => AttachmentDocumentKind::Text,
                'mediaKind' => null,
                'originalName' => 'sample-note.txt',
                'storedName' => 'message-note.txt',
                'mimeType' => 'text/plain',
                'extension' => 'txt',
                'sourceFile' => $this->projectDir.'/tests/Resources/files/sample-note.txt',
                'storagePath' => 'document/fixtures/message-note.txt',
                'size' => filesize($this->projectDir.'/tests/Resources/files/sample-note.txt') ?: 44,
                'checksum' => hash_file('sha256', $this->projectDir.'/tests/Resources/files/sample-note.txt'),
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
                'id' => '22222222-2222-2222-2222-222222222222',
                'type' => AttachmentType::Media,
                'documentKind' => null,
                'mediaKind' => AttachmentMediaKind::Image,
                'originalName' => 'sample-pixel.gif',
                'storedName' => 'product-image.gif',
                'mimeType' => 'image/gif',
                'extension' => 'gif',
                'sourceFile' => $this->projectDir.'/tests/Resources/files/sample-pixel.gif',
                'storagePath' => 'media/fixtures/product-image.gif',
                'size' => filesize($this->projectDir.'/tests/Resources/files/sample-pixel.gif') ?: 34,
                'checksum' => hash_file('sha256', $this->projectDir.'/tests/Resources/files/sample-pixel.gif'),
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
                'reference' => 'attachment.vendor.1',
                'id' => '33333333-3333-3333-3333-333333333333',
                'type' => AttachmentType::Document,
                'documentKind' => AttachmentDocumentKind::Pdf,
                'mediaKind' => null,
                'originalName' => 'vendor-policy.pdf',
                'storedName' => 'vendor-policy.pdf',
                'mimeType' => 'application/pdf',
                'extension' => 'pdf',
                'sourceFile' => $this->projectDir.'/tests/Resources/files/sample-note.txt',
                'storagePath' => 'document/fixtures/vendor-policy.pdf',
                'size' => filesize($this->projectDir.'/tests/Resources/files/sample-note.txt') ?: 44,
                'checksum' => hash_file('sha256', $this->projectDir.'/tests/Resources/files/sample-note.txt'),
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
                id: $fixture['id'],
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
