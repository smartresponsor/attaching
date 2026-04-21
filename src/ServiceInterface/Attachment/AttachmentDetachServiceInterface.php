<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Attachment;

use App\Attaching\Dto\Attachment\Input\DetachAttachmentInput;

interface AttachmentDetachServiceInterface
{
    public function detach(DetachAttachmentInput $input): void;
}
