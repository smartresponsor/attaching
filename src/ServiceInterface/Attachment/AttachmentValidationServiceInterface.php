<?php

declare(strict_types=1);

namespace App\ServiceInterface\Attachment;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface AttachmentValidationServiceInterface
{
    public function validateUploadedFile(UploadedFile $uploadedFile): void;
}
