<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

use App\Attaching\DTO\Input\Attachment\AttachmentAttachInputDTO;
use App\Attaching\DTO\Output\Attachment\AttachmentLinkViewDTO;

interface AttachmentAttachServiceInterface
{
    public function attach(AttachmentAttachInputDTO $input): AttachmentLinkViewDTO;
}
