<?php

declare(strict_types=1);

namespace App\Attaching\Exception\Attachment;

final class AttachmentNotFoundException extends AttachmentException
{
    public static function forAttachmentId(int $attachmentId): self
    {
        return new self(sprintf('Attachment "%d" was not found.', $attachmentId));
    }
}
