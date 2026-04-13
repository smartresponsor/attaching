<?php

declare(strict_types=1);

namespace App\Tests\Integration\Attachment;

use Symfony\Component\HttpFoundation\File\UploadedFile;

final class AttachmentHttpFlowTest extends DoctrineWebIntegrationTestCase
{
    public function testUploadListDownloadDeleteFlowOverHttp(): void
    {
        $client = $this->createAttachmentClient();
        $filePath = $this->getFixtureFilePath('sample-note.txt');

        $client->request('POST', '/attachments/upload', [
            'ownerType' => 'message',
            'ownerId' => 'msg-http-1',
            'context' => 'message',
            'slot' => 'attachment',
            'isPrimary' => '1',
        ], [
            'file' => new UploadedFile($filePath, 'sample-note.txt', 'text/plain', test: true),
        ]);

        self::assertResponseStatusCodeSame(201);
        $uploadPayload = $this->decodeJson((string) $client->getResponse()->getContent());
        self::assertArrayHasKey('id', $uploadPayload);
        self::assertSame('document', $uploadPayload['type'] ?? null);

        $attachmentId = $uploadPayload['id'] ?? null;
        self::assertIsString($attachmentId);

        $client->request('GET', '/attachments', [
            'ownerType' => 'message',
            'ownerId' => 'msg-http-1',
            'context' => 'message',
            'slot' => 'attachment',
        ]);

        self::assertResponseIsSuccessful();
        $listPayload = $this->decodeJson((string) $client->getResponse()->getContent());
        $listItems = $this->getItems($listPayload);
        self::assertSame(1, $listPayload['count'] ?? null);
        self::assertSame($attachmentId, $listItems[0]['id'] ?? null);

        $client->request('GET', sprintf('/attachments/%s/download', $attachmentId));
        self::assertResponseIsSuccessful();
        self::assertStringContainsString('attachment;', (string) $client->getResponse()->headers->get('Content-Disposition'));

        $client->request('DELETE', sprintf('/attachments/%s', $attachmentId));
        self::assertResponseStatusCodeSame(204);

        $client->request('GET', '/attachments', [
            'ownerType' => 'message',
            'ownerId' => 'msg-http-1',
            'context' => 'message',
            'slot' => 'attachment',
        ]);

        self::assertResponseIsSuccessful();
        $afterDeletePayload = $this->decodeJson((string) $client->getResponse()->getContent());
        self::assertSame(0, $afterDeletePayload['count'] ?? null);
    }

    public function testAttachAndDetachExistingAttachmentOverHttp(): void
    {
        $client = $this->createAttachmentClient();
        $filePath = $this->getFixtureFilePath('sample-note.txt');

        $client->request('POST', '/attachments/upload', [
            'ownerType' => 'message',
            'ownerId' => 'msg-http-attach-source',
            'context' => 'message',
            'slot' => 'attachment',
        ], [
            'file' => new UploadedFile($filePath, 'sample-note.txt', 'text/plain', test: true),
        ]);

        self::assertResponseStatusCodeSame(201);
        $uploadPayload = $this->decodeJson((string) $client->getResponse()->getContent());
        $attachmentId = $uploadPayload['id'] ?? null;
        self::assertIsString($attachmentId);

        $client->request('POST', '/attachments/attach', [
            'attachmentId' => $attachmentId,
            'ownerType' => 'message',
            'ownerId' => 'msg-http-attach-target',
            'context' => 'message',
            'slot' => 'attachment',
            'position' => '0',
            'isPrimary' => '1',
        ]);

        self::assertResponseStatusCodeSame(201);

        $client->request('GET', '/attachments', [
            'ownerType' => 'message',
            'ownerId' => 'msg-http-attach-target',
            'context' => 'message',
            'slot' => 'attachment',
        ]);

        self::assertResponseIsSuccessful();
        $listPayload = $this->decodeJson((string) $client->getResponse()->getContent());
        $listItems = $this->getItems($listPayload);
        self::assertSame(1, $listPayload['count'] ?? null);
        self::assertSame($attachmentId, $listItems[0]['id'] ?? null);

        $client->request('POST', '/attachments/detach', [
            'attachmentId' => $attachmentId,
            'ownerType' => 'message',
            'ownerId' => 'msg-http-attach-target',
            'context' => 'message',
            'slot' => 'attachment',
        ]);

        self::assertResponseStatusCodeSame(204);

        $client->request('GET', '/attachments', [
            'ownerType' => 'message',
            'ownerId' => 'msg-http-attach-target',
            'context' => 'message',
            'slot' => 'attachment',
        ]);

        self::assertResponseIsSuccessful();
        $afterDetachPayload = $this->decodeJson((string) $client->getResponse()->getContent());
        self::assertSame(0, $afterDetachPayload['count'] ?? null);
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

    private function getFixtureFilePath(string $fileName): string
    {
        $projectDir = static::getContainer()->getParameter('kernel.project_dir');
        self::assertIsString($projectDir);

        return $projectDir.'/tests/Resources/files/'.$fileName;
    }

    /**
     * @param array<string, mixed> $payload
     *
     * @return list<array<string, mixed>>
     */
    private function getItems(array $payload): array
    {
        $items = $payload['items'] ?? null;
        self::assertIsArray($items);

        /** @var list<array<string, mixed>> $items */
        return $items;
    }
}
