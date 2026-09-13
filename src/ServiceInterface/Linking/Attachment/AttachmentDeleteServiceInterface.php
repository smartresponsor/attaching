<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

interface AttachmentDeleteServiceInterface
{
    public function delete(int $attachmentId): void;
}
