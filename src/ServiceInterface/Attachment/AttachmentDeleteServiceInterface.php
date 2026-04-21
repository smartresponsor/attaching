<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Attachment;

interface AttachmentDeleteServiceInterface
{
    public function delete(string $attachmentId): void;
}
