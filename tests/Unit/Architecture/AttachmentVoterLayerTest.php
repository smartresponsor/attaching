<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\Architecture;

use App\Attaching\Voter\Attachment\AttachmentVoter;
use PHPUnit\Framework\TestCase;

final class AttachmentVoterLayerTest extends TestCase
{
    public function testAttachmentVoterUsesTypeLayerNamespace(): void
    {
        $reflection = new \ReflectionClass(AttachmentVoter::class);

        self::assertSame('App\\Attaching\\Voter\\Attachment', $reflection->getNamespaceName());
        self::assertStringContainsString('/src/Voter/Attachment/AttachmentVoter.php', str_replace('\\', '/', $reflection->getFileName() ?: ''));
    }
}
