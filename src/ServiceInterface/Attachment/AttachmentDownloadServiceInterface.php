<?php

declare(strict_types=1);

namespace App\ServiceInterface\Attachment;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface AttachmentDownloadServiceInterface
{
    public function download(string $attachmentId): BinaryFileResponse|StreamedResponse;
}
