<?php

declare(strict_types=1);

namespace App\Attaching\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

final class AttachmentExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();

        /**
         * @var array{
         *     storage: array{local: array{root_path: string}},
         *     upload: array{
         *         max_size: int,
         *         allowed_media_mime_types: list<string>,
         *         allowed_document_mime_types: list<string>
         *     }
         * } $config
         */
        $config = $this->processConfiguration($configuration, $configs);

        $runtimeFile = __DIR__.'/../../config/component/runtime.yaml';
        if (is_file($runtimeFile)) {
            $runtime = Yaml::parseFile($runtimeFile);
            if (is_array($runtime)) {
                $this->applyRuntimeParameters($container, $runtime);
            }
        }

        $container->setParameter('attachment.storage.local.root_path', $config['storage']['local']['root_path']);
        $container->setParameter('attachment.upload.max_size', $config['upload']['max_size']);
        $container->setParameter('attachment.upload.allowed_media_mime_types', $config['upload']['allowed_media_mime_types']);
        $container->setParameter('attachment.upload.allowed_document_mime_types', $config['upload']['allowed_document_mime_types']);

        $configDirectory = __DIR__.'/../../config/component';
        $servicesFile = $configDirectory.'/services.yaml';

        if (!is_file($servicesFile)) {
            return;
        }

        $loader = new YamlFileLoader($container, new FileLocator($configDirectory));
        $loader->load('services.yaml');
    }

    /**
     * @param array<string, mixed> $runtime
     */
    private function applyRuntimeParameters(ContainerBuilder $container, array $runtime): void
    {
        $map = [
            'attachment.storage.local.root_path' => 'attaching_storage_local_root_path',
            'attachment.upload.max_size' => 'attaching_upload_max_size',
            'attachment.upload.allowed_media_mime_types' => 'attaching_upload_allowed_media_mime_types',
            'attachment.upload.allowed_document_mime_types' => 'attaching_upload_allowed_document_mime_types',
        ];

        foreach ($map as $parameterName => $runtimeKey) {
            if (!array_key_exists($runtimeKey, $runtime)) {
                continue;
            }

            $value = $runtime[$runtimeKey];
            if (is_scalar($value) || is_array($value) || null === $value) {
                $container->setParameter($parameterName, $value);
            }
        }
    }
}
