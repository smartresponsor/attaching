<?php

declare(strict_types=1);

namespace App\ServiceInterface\Attachment;

use App\Dto\Attachment\Input\DetachAttachmentInput;

interface AttachmentDetachServiceInterface
{
    public function detach(DetachAttachmentInput $input): void;
}
