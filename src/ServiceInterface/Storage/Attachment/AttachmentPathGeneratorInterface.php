<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Storage\Attachment;

use App\Attaching\Enum\Classification\Attachment\AttachmentType;

interface AttachmentPathGeneratorInterface
{
    public function generate(AttachmentType $type, string $checksum, ?string $extension = null): string;
}
