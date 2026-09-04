<?php

declare(strict_types=1);

namespace App\Attaching\Service\Storage\Attachment;

use App\Attaching\Enum\Classification\Attachment\AttachmentType;
use App\Attaching\ServiceInterface\Storage\Attachment\AttachmentPathGeneratorInterface;

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
