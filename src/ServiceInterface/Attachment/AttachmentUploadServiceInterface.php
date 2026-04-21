<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Attachment;

use App\Attaching\Dto\Attachment\Input\UploadAttachmentInput;
use App\Attaching\Dto\Attachment\Output\AttachmentView;

interface AttachmentUploadServiceInterface
{
    public function upload(UploadAttachmentInput $input): AttachmentView;
}
