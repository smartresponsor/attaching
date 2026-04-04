<?php

declare(strict_types=1);

namespace App\Service\Attachment;

use App\Contract\Attachment\AttachmentPathGeneratorInterface;
use App\Enum\Attachment\AttachmentType;

final class AttachmentPathGenerator implements AttachmentPathGeneratorInterface
{
    public function generate(AttachmentType $type, string $attachmentId, string $checksum, ?string $extension = null): string
    {
        $now = new \DateTimeImmutable();
        $suffix = null !== $extension && '' !== $extension ? '.'.$extension : '';

        return sprintf(
            '%s/%s/%s/%s/%s-%s%s',
            $type->value,
            $now->format('Y'),
            $now->format('m'),
            $now->format('d'),
            $attachmentId,
            substr($checksum, 0, 12),
            $suffix,
        );
    }
}
