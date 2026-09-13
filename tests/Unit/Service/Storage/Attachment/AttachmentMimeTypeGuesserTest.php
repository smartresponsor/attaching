<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\Service\Storage\Attachment;

use App\Attaching\Enum\Classification\Attachment\AttachmentDocumentKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Classification\Attachment\AttachmentType;
use App\Attaching\Service\Storage\Attachment\AttachmentMimeTypeGuesser;
use PHPUnit\Framework\TestCase;

final class AttachmentMimeTypeGuesserTest extends TestCase
{
    public function testImageMimeTypeIsClassifiedAsMediaImage(): void
    {
        $result = (new AttachmentMimeTypeGuesser())->classify('image/png');

        self::assertSame(AttachmentType::Media, $result['type']);
        self::assertSame(AttachmentMediaKind::Image, $result['mediaKind']);
        self::assertNull($result['documentKind']);
    }

    public function testPdfMimeTypeIsClassifiedAsPdfDocument(): void
    {
        $result = (new AttachmentMimeTypeGuesser())->classify('application/pdf');

        self::assertSame(AttachmentType::Document, $result['type']);
        self::assertNull($result['mediaKind']);
        self::assertSame(AttachmentDocumentKind::Pdf, $result['documentKind']);
    }
}
