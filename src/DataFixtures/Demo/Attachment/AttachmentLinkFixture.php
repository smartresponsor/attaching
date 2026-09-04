<?php

declare(strict_types=1);

namespace App\Attaching\DataFixtures\Demo\Attachment;

use App\Attaching\Entity\Persistence\Attachment\Attachment;
use App\Attaching\Entity\Persistence\Attachment\AttachmentLink;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class AttachmentLinkFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $links = [
            [
                'reference' => 'attachment.message.1',
                'ownerType' => 'message',
                'ownerId' => 'msg-fixture-1',
                'context' => 'message',
                'slot' => 'attachment',
                'position' => 0,
                'isPrimary' => true,
            ],
            [
                'reference' => 'attachment.product.1',
                'ownerType' => 'product',
                'ownerId' => 'prod-fixture-1',
                'context' => 'gallery',
                'slot' => 'image',
                'position' => 0,
                'isPrimary' => true,
            ],
            [
                'reference' => 'attachment.vendor.avatar.1',
                'ownerType' => 'vendor',
                'ownerId' => 'vendor-fixture-1',
                'context' => 'profile',
                'slot' => 'avatar',
                'position' => 0,
                'isPrimary' => true,
            ],
            [
                'reference' => 'attachment.product.banner.1',
                'ownerType' => 'product',
                'ownerId' => 'prod-fixture-1',
                'context' => 'gallery',
                'slot' => 'banner',
                'position' => 1,
                'isPrimary' => false,
            ],
            [
                'reference' => 'attachment.category.icon.1',
                'ownerType' => 'category',
                'ownerId' => 'catalog-fixture-1',
                'context' => 'catalog',
                'slot' => 'icon',
                'position' => 0,
                'isPrimary' => true,
            ],
            [
                'reference' => 'attachment.vendor.1',
                'ownerType' => 'vendor',
                'ownerId' => 'vendor-fixture-1',
                'context' => 'document',
                'slot' => 'manual',
                'position' => 0,
                'isPrimary' => false,
            ],
        ];

        foreach ($links as $fixture) {
            /** @var Attachment $attachment */
            $attachment = $this->getReference($fixture['reference'], Attachment::class);

            $manager->persist(new AttachmentLink(
                attachment: $attachment,
                ownerType: $fixture['ownerType'],
                ownerId: $fixture['ownerId'],
                context: $fixture['context'],
                slot: $fixture['slot'],
                position: $fixture['position'],
                isPrimary: $fixture['isPrimary'],
            ));
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [AttachmentFixture::class];
    }
}
