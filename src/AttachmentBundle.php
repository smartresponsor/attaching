<?php

declare(strict_types=1);

namespace App;

use App\DependencyInjection\AttachmentExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AttachmentBundle extends Bundle
{
    public function getContainerExtension(): AttachmentExtension
    {
        return new AttachmentExtension();
    }
}
