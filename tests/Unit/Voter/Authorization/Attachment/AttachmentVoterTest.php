<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\Voter\Authorization\Attachment;

use App\Attaching\Entity\Persistence\Attachment\Attachment;
use App\Attaching\Enum\Classification\Attachment\AttachmentStorageKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentType;
use App\Attaching\Enum\Classification\Attachment\AttachmentVisibility;
use App\Attaching\Voter\Authorization\Attachment\AttachmentVoter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

final class AttachmentVoterTest extends TestCase
{
    public function testActiveAttachmentIsGrantedForView(): void
    {
        $attachment = new Attachment(
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
