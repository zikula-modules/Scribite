<?php

declare(strict_types=1);

namespace Zikula\ScribiteModule;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Zikula\ExtensionsModule\AbstractModule;
use Zikula\ScribiteModule\DependencyInjection\Compiler\EditorCollectorPass;

class ZikulaScribiteModule extends AbstractModule
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new EditorCollectorPass());
    }
}
