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
use Faker\Factory;

final class AttachmentFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $faker->seed(41001);

        for ($index = 0; $index < 8; ++$index) {
            $isMedia = $index % 2 === 0;
            $attachment = new Attachment(
                id: $this->generateIdentifier(),
                type: $isMedia ? AttachmentType::Media : AttachmentType::Document,
                storageKind: AttachmentStorageKind::Local,
                visibility: AttachmentVisibility::Private,
                originalName: $isMedia ? $faker->lexify('image-????.png') : $faker->lexify('document-????.pdf'),
                storedName: $faker->uuid().($isMedia ? '.png' : '.pdf'),
                mimeType: $isMedia ? 'image/png' : 'application/pdf',
                size: $faker->numberBetween(1024, 5000000),
                checksum: hash('sha256', $faker->uuid()),
                storagePath: sprintf('%s/%s', $isMedia ? 'media' : 'document', $faker->uuid()),
                extension: $isMedia ? 'png' : 'pdf',
                mediaKind: $isMedia ? AttachmentMediaKind::Image : null,
                documentKind: $isMedia ? null : AttachmentDocumentKind::Pdf,
                title: $faker->sentence(3),
                description: $faker->sentence(8),
                altText: $isMedia ? $faker->sentence(4) : null,
                width: $isMedia ? $faker->numberBetween(640, 2400) : null,
                height: $isMedia ? $faker->numberBetween(480, 1800) : null,
            );

            $manager->persist($attachment);
            $this->addReference(sprintf('attachment.%d', $index), $attachment);
        }

        $manager->flush();
    }

    private function generateIdentifier(): string
    {
        $hex = bin2hex(random_bytes(16));

        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12),
        );
    }
}
