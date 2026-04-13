<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

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

        $container->setParameter('attachment.storage.local.root_path', $config['storage']['local']['root_path']);
        $container->setParameter('attachment.upload.max_size', $config['upload']['max_size']);
        $container->setParameter('attachment.upload.allowed_media_mime_types', $config['upload']['allowed_media_mime_types']);
        $container->setParameter('attachment.upload.allowed_document_mime_types', $config['upload']['allowed_document_mime_types']);
    }
}
