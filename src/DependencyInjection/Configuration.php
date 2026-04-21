<?php

declare(strict_types=1);

namespace App\Attaching\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @noinspection PhpPossiblePolymorphicInvocationInspection Symfony config nodes intentionally use a fluent builder API.
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('attachment');
        $rootNode = $treeBuilder->getRootNode();

        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        $rootNode
            ->children()
                ->arrayNode('storage')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default')->defaultValue('local')->end()
                        ->arrayNode('local')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('root_path')->defaultValue('%kernel.project_dir%/var/storage/attachment')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('upload')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('max_size')->defaultValue(33554432)->end()
                        ->arrayNode('allowed_media_mime_types')
                            ->scalarPrototype()->end()
                            ->defaultValue([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/gif',
                                'audio/mpeg',
                                'video/mp4',
                            ])
                        ->end()
                        ->arrayNode('allowed_document_mime_types')
                            ->scalarPrototype()->end()
                            ->defaultValue([
                                'application/pdf',
                                'text/plain',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-powerpoint',
                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            ])
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
