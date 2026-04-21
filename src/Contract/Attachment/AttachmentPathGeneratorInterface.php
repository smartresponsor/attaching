<?php

declare(strict_types=1);

namespace App\Attaching\Contract\Attachment;

use App\Attaching\Enum\Attachment\AttachmentType;

interface AttachmentPathGeneratorInterface
{
    public function generate(AttachmentType $type, string $attachmentId, string $checksum, ?string $extension = null): string;
}
