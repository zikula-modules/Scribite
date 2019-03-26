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

class EditorCollectorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('zikula_scribite_module.collector.editor_collector')) {
            return;
        }

        $editorCollectorDefinition = $container->getDefinition('zikula_scribite_module.collector.editor_collector');

        foreach ($container->findTaggedServiceIds('scribite.editor') as $id => $tagParameters) {
            foreach ($tagParameters as $tagParameter) {
                if (!isset($tagParameter['id'])) {
                    throw new \InvalidArgumentException(sprintf('Service "%s" must define the "id" attribute on "scribite.editor" tags.', $id));
                }
                $editorId = $tagParameter['id'];
            }
            $editorCollectorDefinition->addMethodCall('add', [$editorId, new Reference($id)]);
        }
    }
}
