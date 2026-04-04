<?php

declare(strict_types=1);

namespace App\Tests\Integration\Attachment;

use Symfony\Component\HttpFoundation\File\UploadedFile;

final class AttachmentHttpFlowTest extends DoctrineWebIntegrationTestCase
{
    public function testUploadListDownloadDeleteFlowOverHttp(): void
    {
        $client = $this->createAttachmentClient();
        $filePath = self::getContainer()->getParameter('kernel.project_dir').'/tests/Resources/files/sample-note.txt';

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
        $uploadPayload = $this->decodeJson($client->getResponse()->getContent());
        self::assertArrayHasKey('id', $uploadPayload);
        self::assertSame('document', $uploadPayload['type']);

        $attachmentId = $uploadPayload['id'];

        $client->request('GET', '/attachments', [
            'ownerType' => 'message',
            'ownerId' => 'msg-http-1',
            'context' => 'message',
            'slot' => 'attachment',
        ]);

        self::assertResponseIsSuccessful();
        $listPayload = $this->decodeJson($client->getResponse()->getContent());
        self::assertSame(1, $listPayload['count']);
        self::assertSame($attachmentId, $listPayload['items'][0]['id']);

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
        $afterDeletePayload = $this->decodeJson($client->getResponse()->getContent());
        self::assertSame(0, $afterDeletePayload['count']);
    }

    public function testAttachAndDetachExistingAttachmentOverHttp(): void
    {
        $client = $this->createAttachmentClient();
        $filePath = self::getContainer()->getParameter('kernel.project_dir').'/tests/Resources/files/sample-note.txt';

        $client->request('POST', '/attachments/upload', [
            'ownerType' => 'message',
            'ownerId' => 'msg-http-attach-source',
            'context' => 'message',
            'slot' => 'attachment',
        ], [
            'file' => new UploadedFile($filePath, 'sample-note.txt', 'text/plain', test: true),
        ]);

        self::assertResponseStatusCodeSame(201);
        $uploadPayload = $this->decodeJson($client->getResponse()->getContent());
        $attachmentId = $uploadPayload['id'];

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
        $listPayload = $this->decodeJson($client->getResponse()->getContent());
        self::assertSame(1, $listPayload['count']);
        self::assertSame($attachmentId, $listPayload['items'][0]['id']);

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
        $afterDetachPayload = $this->decodeJson($client->getResponse()->getContent());
        self::assertSame(0, $afterDetachPayload['count']);
    }

    /**
     * @return array<string, mixed>
     */
    private function decodeJson(?string $json): array
    {
        self::assertNotNull($json);

        /** @var array<string, mixed> $decoded */
        $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return $decoded;
    }
}
