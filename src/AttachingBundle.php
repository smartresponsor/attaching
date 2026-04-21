<?php

declare(strict_types=1);

namespace App;

use App\DependencyInjection\AttachingExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AttachingBundle extends Bundle
{
    public function getContainerExtension(): AttachingExtension
    {
        return new AttachingExtension();
    }
}
