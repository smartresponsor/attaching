<?php

declare(strict_types=1);

namespace App\Attaching;

use App\Attaching\DependencyInjection\AttachmentExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/** Registers the attachment component in standalone and host Symfony kernels. */
final class AttachingBundle extends Bundle
{
    public function getContainerExtension(): AttachmentExtension
    {
        return new AttachmentExtension();
    }
}
