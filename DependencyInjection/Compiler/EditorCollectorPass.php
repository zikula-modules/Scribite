<?php

declare(strict_types=1);

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Zikula\ScribiteModule\Collector\EditorCollector;

class EditorCollectorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(EditorCollector::class)) {
            return;
        }

        $editorCollectorDefinition = $container->getDefinition(EditorCollector::class);

        foreach ($container->findTaggedServiceIds('scribite.editor') as $id => $tagParameters) {
            $editorCollectorDefinition->addMethodCall('add', [new Reference($id)]);
        }
    }
}
