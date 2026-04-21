<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Contract\Attachment\AttachmentChecksumGeneratorInterface;

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
