<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit;

use App\Attaching\Enum\Attachment\AttachmentType;
use App\Attaching\Service\Attachment\AttachmentPathGenerator;
use PHPUnit\Framework\TestCase;

final class AttachmentPathGeneratorTest extends TestCase
{
    public function testItBuildsATypeScopedStoragePath(): void
    {
        $generator = new AttachmentPathGenerator();
        $path = $generator->generate(AttachmentType::Media, 'attachment-id', str_repeat('a', 64), 'png');

        self::assertStringStartsWith('media/', $path);
        self::assertStringEndsWith('.png', $path);
        self::assertStringContainsString('attachment-id-aaaaaaaaaaaa', $path);
    }
}
