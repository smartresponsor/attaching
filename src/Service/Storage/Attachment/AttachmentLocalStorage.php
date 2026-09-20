<?php

declare(strict_types=1);

namespace App\Attaching\Service\Storage\Attachment;

use App\Attaching\Exception\Storage\Attachment\AttachmentStorageException;
use App\Attaching\ServiceInterface\Storage\Attachment\AttachmentStorageInterface;
use Symfony\Component\Filesystem\Filesystem;

final readonly class AttachmentLocalStorage implements AttachmentStorageInterface
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
        $stream = \fopen($this->resolveAbsolutePath($path), 'r');

        if (false === $stream) {
            throw new \RuntimeException(sprintf('Unable to open attachment path "%s".', $path));
        }

        return $stream;
    }

    public function resolveAbsolutePath(string $path): string
    {
        return rtrim($this->rootPath, '/\\').DIRECTORY_SEPARATOR.$this->normalizeRelativePath($path);
    }

    private function normalizeRelativePath(string $path): string
    {
        if ('' === $path || str_contains($path, "\0")) {
            throw new AttachmentStorageException('Attachment storage path must be a non-empty relative path.');
        }

        $normalizedPath = str_replace('\\', '/', $path);

        if (str_starts_with($normalizedPath, '/') || 1 === preg_match('/^[A-Za-z]:\//', $normalizedPath)) {
            throw new AttachmentStorageException('Absolute attachment storage paths are not allowed.');
        }

        $segments = explode('/', $normalizedPath);

        foreach ($segments as $segment) {
            if ('' === $segment || '.' === $segment || '..' === $segment) {
                throw new AttachmentStorageException('Attachment storage path contains an unsafe path segment.');
            }
        }

        return implode(DIRECTORY_SEPARATOR, $segments);
    }
}
