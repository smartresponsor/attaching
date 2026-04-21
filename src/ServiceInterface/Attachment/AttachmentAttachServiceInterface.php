<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Attachment;

use App\Attaching\Dto\Attachment\Input\AttachAttachmentInput;
use App\Attaching\Dto\Attachment\Output\AttachmentLinkView;

interface AttachmentAttachServiceInterface
{
    public function attach(AttachAttachmentInput $input): AttachmentLinkView;
}
