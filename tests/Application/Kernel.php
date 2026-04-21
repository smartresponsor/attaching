<?php

declare(strict_types=1);

namespace App\Attaching\Tests\Application;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return dirname(__DIR__, 2);
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir().'/var/cache/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return $this->getProjectDir().'/var/log';
    }

    private function getTestConfigDir(): string
    {
        return $this->getProjectDir().'/tests/Application/config';
    }

    public function registerBundles(): iterable
    {
        $bundles = require $this->getTestConfigDir().'/bundles.php';

        foreach ($bundles as $class => $envs) {
            if (($envs[$this->environment] ?? $envs['all'] ?? false) === true) {
                yield new $class();
            }
        }
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $configDir = $this->getTestConfigDir();

        $container->import($configDir.'/packages/*.yaml');
        $container->import($configDir.'/packages/'.$this->environment.'/*.yaml');

        if (is_file($configDir.'/services.yaml')) {
            $container->import($configDir.'/services.yaml');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $configDir = $this->getTestConfigDir();

        if (is_file($configDir.'/routes/attributes.yaml')) {
            $routes->import($configDir.'/routes/attributes.yaml');
        }
    }
}
