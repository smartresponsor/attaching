<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

use App\Attaching\Dto\Input\Attachment\DetachAttachmentInput;

interface AttachmentDetachServiceInterface
{
    public function detach(DetachAttachmentInput $input): void;
}
