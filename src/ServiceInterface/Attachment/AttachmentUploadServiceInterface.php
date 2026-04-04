<?php

declare(strict_types=1);

namespace App\ServiceInterface\Attachment;

use App\Dto\Attachment\Input\UploadAttachmentInput;
use App\Dto\Attachment\Output\AttachmentView;

interface AttachmentUploadServiceInterface
{
    public function upload(UploadAttachmentInput $input): AttachmentView;
}
