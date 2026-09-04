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
                if ('Attachment' === $segment && $index < 2) {
                    $violations[] = $relativePath;
                    break;
                }
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
}
