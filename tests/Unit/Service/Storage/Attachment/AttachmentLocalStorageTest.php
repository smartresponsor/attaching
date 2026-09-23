<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Unit\Service\Storage\Attachment;

use App\Attaching\Exception\Storage\Attachment\AttachmentStorageException;
use App\Attaching\Service\Storage\Attachment\AttachmentLocalStorage;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AttachmentLocalStorageTest extends TestCase
{
    public function testItResolvesAComponentGeneratedRelativePathInsideTheStorageRoot(): void
    {
        $storage = new AttachmentLocalStorage('C:\\storage\\attachment');

        self::assertSame(
            'C:\\storage\\attachment'.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'2026'.DIRECTORY_SEPARATOR.'09'.DIRECTORY_SEPARATOR.'file.png',
            $storage->resolveAbsolutePath('media/2026/09/file.png'),
        );
    }

    #[DataProvider('unsafePathProvider')]
    public function testItRejectsPathsThatCanEscapeOrBypassTheStorageRoot(string $path): void
    {
        $storage = new AttachmentLocalStorage('C:\\storage\\attachment');

        $this->expectException(AttachmentStorageException::class);
        $storage->resolveAbsolutePath($path);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function unsafePathProvider(): iterable
    {
        yield 'parent traversal with slash' => ['../outside.txt'];
        yield 'nested parent traversal' => ['media/../../outside.txt'];
        yield 'parent traversal with backslash' => ['media\\..\\outside.txt'];
        yield 'unix absolute path' => ['/etc/passwd'];
        yield 'windows absolute path' => ['C:\\outside.txt'];
        yield 'empty segment' => ['media//file.png'];
        yield 'current directory segment' => ['media/./file.png'];
        yield 'null byte' => ["media/file.png\0.txt"];
        yield 'empty path' => [''];
    }
}
