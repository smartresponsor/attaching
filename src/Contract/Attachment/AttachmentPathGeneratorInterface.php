<?php

declare(strict_types=1);

namespace App\Contract\Attachment;

use App\Enum\Attachment\AttachmentType;

interface AttachmentPathGeneratorInterface
{
    public function generate(AttachmentType $type, string $attachmentId, string $checksum, ?string $extension = null): string;
}
