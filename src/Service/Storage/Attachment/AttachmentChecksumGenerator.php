<?php

declare(strict_types=1);

namespace App\Attaching\Service\Storage\Attachment;

use App\Attaching\ServiceInterface\Storage\Attachment\AttachmentChecksumGeneratorInterface;

final class AttachmentChecksumGenerator implements AttachmentChecksumGeneratorInterface
{
    public function generate(string $path): string
    {
        $checksum = hash_file('sha256', $path);

        if (false === $checksum) {
            throw new \RuntimeException(sprintf('Unable to generate checksum for "%s".', $path));
        }

        return $checksum;
    }
}
