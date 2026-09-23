<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\Architecture\Attachment;

use PHPUnit\Framework\TestCase;

final class AttachmentTreeLayerTest extends TestCase
{
    public function testAttachmentDirectoryTokenDoesNotAppearBeforeFourthTreeLevel(): void
    {
        $sourceDirectory = realpath(__DIR__.'/../../../../src');
        self::assertNotFalse($sourceDirectory);
        $violations = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($sourceDirectory, \FilesystemIterator::SKIP_DOTS));

        foreach ($iterator as $fileInfo) {
            /** @var \SplFileInfo $fileInfo */
            if (!$fileInfo->isFile() || 'php' !== $fileInfo->getExtension()) {
                continue;
            }

            $relativePath = str_replace('\\', '/', substr($fileInfo->getPathname(), strlen($sourceDirectory) + 1));
            $directorySegments = explode('/', dirname($relativePath));
            foreach ($directorySegments as $index => $segment) {
                if ('Attachment' === $segment && $index < 2 && !('Entity' === $directorySegments[0] && 1 === $index)) {
                    $violations[] = $relativePath;
                    break;
                }
            }

            if ('Entity' === $directorySegments[0] && count($directorySegments) > 2) {
                $violations[] = $relativePath;
            }
        }

        self::assertSame([], $violations, 'Attachment directory token must appear no earlier than src/<type>/<direction>/Attachment.');
    }

    public function testLegacyContractAndDuplicateSecurityVoterTreesAreAbsent(): void
    {
        self::assertDirectoryDoesNotExist(__DIR__.'/../../../../src/Contract');
        self::assertDirectoryDoesNotExist(__DIR__.'/../../../../src/Service/Management');
        self::assertDirectoryDoesNotExist(__DIR__.'/../../../../src/ServiceInterface/Management');
        self::assertDirectoryDoesNotExist(__DIR__.'/../../../../src/Entity/Model');
        self::assertDirectoryDoesNotExist(__DIR__.'/../../../../src/Enum/Model');
        self::assertDirectoryDoesNotExist(__DIR__.'/../../../../src/Exception/Runtime');
        self::assertFileDoesNotExist(__DIR__.'/../../../../src/Security/Attachment/Voter/AttachmentVoter.php');
    }

    public function testIdentifierMigrationUsesCanonicalSnakeCasePhysicalColumnNames(): void
    {
        $commandFile = __DIR__.'/../../../../src/Command/Maintenance/Attachment/AttachmentMigrateIdentifiersCommand.php';
        $contents = file_get_contents($commandFile);

        self::assertNotFalse($contents);
        self::assertStringNotContainsString('object_uuid', $contents);
        self::assertStringNotContainsString('object_status', $contents);
        self::assertStringNotContainsString('object_created_at', $contents);
        self::assertStringContainsString('uuid bytea NOT NULL', $contents);
        self::assertStringContainsString('CREATE UNIQUE INDEX uniq_attachment_uuid ON attachment (uuid)', $contents);
        self::assertStringContainsString('status varchar(64) DEFAULT NULL', $contents);
        self::assertStringContainsString('media_kind varchar(255) DEFAULT NULL', $contents);
        self::assertStringContainsString('deleted_at timestamp(0) without time zone DEFAULT NULL', $contents);
        self::assertStringContainsString('created_at timestamp(0) without time zone NOT NULL', $contents);
        self::assertStringNotContainsString('"mediaKind"', $contents);
        self::assertStringNotContainsString('"deletedAt"', $contents);
    }
}
