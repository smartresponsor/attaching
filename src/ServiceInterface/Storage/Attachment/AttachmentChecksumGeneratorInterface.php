<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Storage\Attachment;

interface AttachmentChecksumGeneratorInterface
{
    public function generate(string $path): string;
}
