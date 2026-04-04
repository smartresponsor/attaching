<?php

declare(strict_types=1);

namespace App\ServiceInterface\Attachment;

use App\Dto\Attachment\Input\ListAttachmentInput;
use App\Dto\Attachment\Output\AttachmentListView;

interface AttachmentListServiceInterface
{
    public function list(ListAttachmentInput $input): AttachmentListView;
}
