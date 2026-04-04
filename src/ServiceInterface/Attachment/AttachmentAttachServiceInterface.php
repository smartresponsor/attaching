<?php

declare(strict_types=1);

namespace App\ServiceInterface\Attachment;

use App\Dto\Attachment\Input\AttachAttachmentInput;
use App\Dto\Attachment\Output\AttachmentLinkView;

interface AttachmentAttachServiceInterface
{
    public function attach(AttachAttachmentInput $input): AttachmentLinkView;
}
