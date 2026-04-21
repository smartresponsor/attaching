<?php

declare(strict_types=1);

namespace App\Attaching\DataFixtures;

use App\Attaching\Entity\Attachment\Attachment;
use App\Attaching\Entity\Attachment\AttachmentLink;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class AttachmentLinkFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $links = [
            [
                'id' => 'aaaaaaa1-aaaa-aaaa-aaaa-aaaaaaaaaaa1',
                'reference' => 'attachment.message.1',
                'ownerType' => 'message',
                'ownerId' => 'msg-fixture-1',
                'context' => 'message',
                'slot' => 'attachment',
                'position' => 0,
                'isPrimary' => true,
            ],
            [
                'id' => 'bbbbbbb2-bbbb-bbbb-bbbb-bbbbbbbbbbb2',
                'reference' => 'attachment.product.1',
                'ownerType' => 'product',
                'ownerId' => 'prod-fixture-1',
                'context' => 'gallery',
                'slot' => 'image',
                'position' => 0,
                'isPrimary' => true,
            ],
            [
                'id' => 'ccccccc3-cccc-cccc-cccc-ccccccccccc3',
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
                id: $fixture['id'],
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
