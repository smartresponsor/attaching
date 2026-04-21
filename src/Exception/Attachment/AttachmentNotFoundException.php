<?php

declare(strict_types=1);

namespace App\Attaching\Exception\Attachment;

final class AttachmentNotFoundException extends AttachmentException
{
    public static function forAttachmentId(string $attachmentId): self
    {
        return new self(sprintf('Attachment "%s" was not found.', $attachmentId));
    }
}
