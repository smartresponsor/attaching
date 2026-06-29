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
        $path = $generator->generate(AttachmentType::Media, str_repeat('a', 64), 'png');

        self::assertStringStartsWith('media/', $path);
        self::assertStringEndsWith('.png', $path);
        self::assertMatchesRegularExpression('#^media/\d{4}/\d{2}/\d{2}/[a-f0-9]{16}-a{12}\.png$#', $path);
    }
}
