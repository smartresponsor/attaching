<?php

declare(strict_types=1);

namespace App\Attaching\Service\Attachment;

use App\Attaching\Contract\Attachment\AttachmentMimeTypeGuesserInterface;
use App\Attaching\Enum\Attachment\AttachmentDocumentKind;
use App\Attaching\Enum\Attachment\AttachmentMediaKind;
use App\Attaching\Enum\Attachment\AttachmentType;

final class AttachmentMimeTypeGuesser implements AttachmentMimeTypeGuesserInterface
{
    public function classify(string $mimeType): array
    {
        return match (true) {
            str_starts_with($mimeType, 'image/') => [
                'type' => AttachmentType::Media,
                'mediaKind' => AttachmentMediaKind::Image,
                'documentKind' => null,
            ],
            str_starts_with($mimeType, 'audio/') => [
                'type' => AttachmentType::Media,
                'mediaKind' => AttachmentMediaKind::Audio,
                'documentKind' => null,
            ],
            str_starts_with($mimeType, 'video/') => [
                'type' => AttachmentType::Media,
                'mediaKind' => AttachmentMediaKind::Video,
                'documentKind' => null,
            ],
            'application/pdf' === $mimeType => [
                'type' => AttachmentType::Document,
                'mediaKind' => null,
                'documentKind' => AttachmentDocumentKind::Pdf,
            ],
            'text/plain' === $mimeType => [
                'type' => AttachmentType::Document,
                'mediaKind' => null,
                'documentKind' => AttachmentDocumentKind::Text,
            ],
            default => [
                'type' => AttachmentType::Document,
                'mediaKind' => null,
                'documentKind' => AttachmentDocumentKind::Other,
            ],
        };
    }
}
