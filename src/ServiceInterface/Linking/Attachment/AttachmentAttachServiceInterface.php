<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

use App\Attaching\Dto\Input\Attachment\AttachAttachmentInput;
use App\Attaching\Dto\Output\Attachment\AttachmentLinkView;

interface AttachmentAttachServiceInterface
{
    public function attach(AttachAttachmentInput $input): AttachmentLinkView;
}
