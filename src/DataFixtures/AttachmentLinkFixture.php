<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Attachment\Attachment;
use App\Entity\Attachment\AttachmentLink;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class AttachmentLinkFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $faker->seed(41002);
        $ownerTypes = ['product', 'message', 'vendor', 'billing_document'];
        $slots = ['attachment', 'gallery', 'invoice', 'manual'];

        for ($index = 0; $index < 8; ++$index) {
            /** @var Attachment $attachment */
            $attachment = $this->getReference(sprintf('attachment.%d', $index), Attachment::class);

            $manager->persist(new AttachmentLink(
                id: $this->generateIdentifier(),
                attachment: $attachment,
                ownerType: $ownerTypes[$index % count($ownerTypes)],
                ownerId: (string) $faker->numberBetween(1000, 9999),
                context: $index % 2 === 0 ? 'primary' : 'document',
                slot: $slots[$index % count($slots)],
                position: $index,
                isPrimary: $index % 3 === 0,
            ));
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [AttachmentFixture::class];
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
