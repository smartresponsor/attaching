<?php

declare(strict_types=1);

namespace App\Tests\Unit\Attachment;

use App\Entity\Attachment\Attachment;
use App\Enum\Attachment\AttachmentStorageKind;
use App\Enum\Attachment\AttachmentType;
use App\Enum\Attachment\AttachmentVisibility;
use App\Security\Attachment\Voter\AttachmentVoter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

final class AttachmentVoterTest extends TestCase
{
    public function testActiveAttachmentIsGrantedForView(): void
    {
        $attachment = new Attachment(
            id: 'att-1',
            type: AttachmentType::Document,
            storageKind: AttachmentStorageKind::Local,
            visibility: AttachmentVisibility::Private,
            originalName: 'note.txt',
            storedName: 'stored-note.txt',
            mimeType: 'text/plain',
            size: 10,
            checksum: 'abc123',
            storagePath: 'document/2026/04/04/att-1-abc123.txt',
        );

        $token = $this->createMock(TokenInterface::class);
        $voter = new AttachmentVoter();

        self::assertSame(1, $voter->vote($token, $attachment, [AttachmentVoter::VIEW]));
    }

    public function testDeletedAttachmentIsDeniedForView(): void
    {
        $attachment = new Attachment(
            id: 'att-2',
            type: AttachmentType::Document,
            storageKind: AttachmentStorageKind::Local,
            visibility: AttachmentVisibility::Private,
            originalName: 'note.txt',
            storedName: 'stored-note.txt',
            mimeType: 'text/plain',
            size: 10,
            checksum: 'abc123',
            storagePath: 'document/2026/04/04/att-2-abc123.txt',
        );
        $attachment->markDeleted();

        $token = $this->createMock(TokenInterface::class);
        $voter = new AttachmentVoter();

        self::assertSame(-1, $voter->vote($token, $attachment, [AttachmentVoter::VIEW]));
    }
}
