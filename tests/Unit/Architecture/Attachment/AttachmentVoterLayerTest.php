<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\Architecture\Attachment;

use App\Attaching\Voter\Authorization\Attachment\AttachmentVoter;
use PHPUnit\Framework\TestCase;

final class AttachmentVoterLayerTest extends TestCase
{
    public function testAttachmentVoterUsesAuthorizationDirectionNamespace(): void
    {
        $reflection = new \ReflectionClass(AttachmentVoter::class);

        self::assertSame('App\\Attaching\\Voter\\Authorization\\Attachment', $reflection->getNamespaceName());
        self::assertStringContainsString('/src/Voter/Authorization/Attachment/AttachmentVoter.php', str_replace('\\', '/', $reflection->getFileName() ?: ''));
    }
}
