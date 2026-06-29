<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Contract\Attachment\AttachmentPathGeneratorInterface;
use App\Attaching\Enum\Attachment\AttachmentType;

final class AttachmentPathGenerator implements AttachmentPathGeneratorInterface
{
    public function generate(AttachmentType $type, string $checksum, ?string $extension = null): string
    {
        $now = new \DateTimeImmutable();
        $randomSuffix = bin2hex(random_bytes(8));
        $suffix = null !== $extension && '' !== $extension ? '.'.$extension : '';

        return sprintf(
            '%s/%s/%s/%s/%s-%s%s',
            $type->value,
            $now->format('Y'),
            $now->format('m'),
            $now->format('d'),
            $randomSuffix,
            substr($checksum, 0, 12),
            $suffix,
        );
    }
}
