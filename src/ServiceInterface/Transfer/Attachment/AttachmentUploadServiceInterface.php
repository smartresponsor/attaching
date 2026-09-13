<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Transfer\Attachment;

use App\Attaching\Dto\Input\Attachment\UploadAttachmentInput;
use App\Attaching\Dto\Output\Attachment\AttachmentView;

interface AttachmentUploadServiceInterface
{
    public function upload(UploadAttachmentInput $input): AttachmentView;
}
