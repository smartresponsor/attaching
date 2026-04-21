<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Attachment;

use App\Attaching\Dto\Attachment\Input\ListAttachmentInput;
use App\Attaching\Dto\Attachment\Output\AttachmentListView;

interface AttachmentListServiceInterface
{
    public function list(ListAttachmentInput $input): AttachmentListView;
}
