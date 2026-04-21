<?php

declare(strict_types=1);

namespace App\Attaching\Contract\Attachment;

interface AttachmentChecksumGeneratorInterface
{
    public function generate(string $path): string;
}
