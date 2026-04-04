<?php

declare(strict_types=1);

namespace App\Service\Storage;

use App\Contract\Attachment\AttachmentStorageInterface;
use Symfony\Component\Filesystem\Filesystem;

final readonly class LocalAttachmentStorage implements AttachmentStorageInterface
{
    public function __construct(
        private string $rootPath,
        private Filesystem $filesystem = new Filesystem(),
    ) {
    }

    public function store(string $sourcePath, string $targetPath): void
    {
        $absolutePath = $this->resolveAbsolutePath($targetPath);
        $this->filesystem->mkdir(\dirname($absolutePath));
        $this->filesystem->copy($sourcePath, $absolutePath, true);
    }

    public function delete(string $path): void
    {
        $absolutePath = $this->resolveAbsolutePath($path);

        if ($this->filesystem->exists($absolutePath)) {
            $this->filesystem->remove($absolutePath);
        }
    }

    public function exists(string $path): bool
    {
        return $this->filesystem->exists($this->resolveAbsolutePath($path));
    }

    public function readStream(string $path)
    {
        $stream = \fopen($this->resolveAbsolutePath($path), 'rb');

        if (false === $stream) {
            throw new \RuntimeException(sprintf('Unable to open attachment path "%s".', $path));
        }

        return $stream;
    }

    public function resolveAbsolutePath(string $path): string
    {
        return rtrim($this->rootPath, '/\\').DIRECTORY_SEPARATOR.ltrim($path, '/\\');
    }
}
