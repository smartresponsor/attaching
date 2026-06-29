<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Integration\Attachment;

use App\Attaching\DataFixtures\AttachmentFixture;
use App\Attaching\DataFixtures\AttachmentLinkFixture;
use App\Attaching\Entity\Attachment\Attachment;

final class AttachmentFixtureHttpReadTest extends DoctrineWebIntegrationTestCase
{
    public function testFixtureBackedOwnerListingOverHttp(): void
    {
        $this->loadFixtures([
            AttachmentFixture::class,
            AttachmentLinkFixture::class,
        ]);

        $client = $this->createAttachmentClient();
        $client->request('GET', '/attachments', [
            'ownerType' => 'product',
            'ownerId' => 'prod-fixture-1',
            'context' => 'gallery',
            'slot' => 'image',
        ]);

        self::assertResponseIsSuccessful();
        $json = $client->getResponse()->getContent();
        self::assertIsString($json);
        $payload = $this->decodeJson($json);
        self::assertArrayHasKey('items', $payload);
        self::assertIsArray($payload['items']);
        self::assertArrayHasKey(0, $payload['items']);
        self::assertIsArray($payload['items'][0]);

        self::assertSame('product', $payload['ownerType']);
        self::assertSame('prod-fixture-1', $payload['ownerId']);
        self::assertSame(1, $payload['count']);
        self::assertIsInt($payload['items'][0]['id']);
        self::assertSame('media', $payload['items'][0]['type']);
    }

    public function testFixtureBackedDownloadOverHttp(): void
    {
        $this->loadFixtures([
            AttachmentFixture::class,
            AttachmentLinkFixture::class,
        ]);

        $client = $this->createAttachmentClient();
        $attachment = $this->entityManager->getRepository(Attachment::class)->findOneBy(['originalName' => 'sample-note.txt']);
        self::assertInstanceOf(Attachment::class, $attachment);

        $client->request('GET', sprintf('/attachments/%d/download', $attachment->getId()));

        self::assertResponseIsSuccessful();
        self::assertStringContainsString('sample-note.txt', (string) $client->getResponse()->headers->get('Content-Disposition'));
    }

    /**
     * @return array<string, mixed>
     */
    private function decodeJson(string $json): array
    {
        /** @var array<string, mixed> $decoded */
        $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return $decoded;
    }
}
