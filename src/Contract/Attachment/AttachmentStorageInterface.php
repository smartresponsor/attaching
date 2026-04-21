<?php

declare(strict_types=1);

namespace App\Attaching\Contract\Attachment;

interface AttachmentStorageInterface
{
    public function store(string $sourcePath, string $targetPath): void;

    public function delete(string $path): void;

    public function exists(string $path): bool;

    /**
     * @return resource
     */
    public function readStream(string $path);

    public function resolveAbsolutePath(string $path): string;
}
