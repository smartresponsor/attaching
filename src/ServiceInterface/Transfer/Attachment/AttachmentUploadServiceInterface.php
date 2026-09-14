<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Transfer\Attachment;

use App\Attaching\DTO\Input\Attachment\AttachmentUploadInputDTO;
use App\Attaching\DTO\Output\Attachment\AttachmentViewDTO;

interface AttachmentUploadServiceInterface
{
    public function upload(AttachmentUploadInputDTO $input): AttachmentViewDTO;
}
