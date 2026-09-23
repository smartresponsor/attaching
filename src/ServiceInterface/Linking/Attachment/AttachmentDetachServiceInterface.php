<?php

declare(strict_types=1);

namespace App\Attaching\ServiceInterface\Linking\Attachment;

use App\Attaching\DTO\Input\Attachment\AttachmentDetachInputDTO;

interface AttachmentDetachServiceInterface
{
    public function detach(AttachmentDetachInputDTO $input): void;
}
