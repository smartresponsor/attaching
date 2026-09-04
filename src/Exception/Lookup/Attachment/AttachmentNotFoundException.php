<?php

declare(strict_types=1);

namespace App\Attaching\Exception\Lookup\Attachment;

use App\Attaching\Exception\Common\Attachment\AttachmentException;

final class AttachmentNotFoundException extends AttachmentException
{
    public static function forAttachmentId(int $attachmentId): self
    {
        return new self(sprintf('Attachment "%d" was not found.', $attachmentId));
    }
}
