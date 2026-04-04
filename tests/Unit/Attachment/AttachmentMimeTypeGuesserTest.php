<?php

declare(strict_types=1);

namespace App\Tests\Unit\Attachment;

use App\Enum\Attachment\AttachmentDocumentKind;
use App\Enum\Attachment\AttachmentMediaKind;
use App\Enum\Attachment\AttachmentType;
use App\Service\Attachment\AttachmentMimeTypeGuesser;
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
