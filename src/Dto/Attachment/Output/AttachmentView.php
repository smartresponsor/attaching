<?php

declare(strict_types=1);

namespace App\Attaching\Dto\Attachment\Output;

use App\Attaching\Enum\Attachment\AttachmentDocumentKind;
use App\Attaching\Enum\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Attachment\AttachmentType;
use App\Attaching\Enum\Attachment\AttachmentVisibility;

final readonly class AttachmentView
{
    public function __construct(
        public string $id,
        public AttachmentType $type,
        public ?AttachmentMediaKind $mediaKind,
        public ?AttachmentDocumentKind $documentKind,
        public string $originalName,
        public string $mimeType,
        public ?string $extension,
        public int $size,
        public string $checksum,
        public AttachmentVisibility $visibility,
        public ?string $title,
        public ?string $description,
        public ?string $altText,
        public ?int $width,
        public ?int $height,
        public ?int $durationMs,
        public ?int $pageCount,
        public ?string $downloadUrl,
        public \DateTimeImmutable $createdAt,
    ) {
    }
}
