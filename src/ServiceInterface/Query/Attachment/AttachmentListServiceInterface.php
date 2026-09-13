<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Query\Attachment;

use App\Attaching\Dto\Input\Attachment\ListAttachmentInput;
use App\Attaching\Dto\Output\Attachment\AttachmentListView;

interface AttachmentListServiceInterface
{
    public function list(ListAttachmentInput $input): AttachmentListView;
}
