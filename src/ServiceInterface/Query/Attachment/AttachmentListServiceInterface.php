<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Query\Attachment;

use App\Attaching\DTO\Input\Attachment\AttachmentListInputDTO;
use App\Attaching\DTO\Output\Attachment\AttachmentListViewDTO;

interface AttachmentListServiceInterface
{
    public function list(AttachmentListInputDTO $input): AttachmentListViewDTO;
}
