<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Editor\CKEditor\Helper;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Zikula\Core\Event\GenericEvent;
use Zikula\ScribiteModule\Editor\CKEditor\Collection\PluginCollection;
use Zikula\ScribiteModule\Editor\EditorHelperInterface;

class EditorHelper implements EditorHelperInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(array $parameters = [])
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalPlugins()
    {
        if (null === $this->dispatcher) {
            throw new \RuntimeException('Dispatcher has not been set.');
        }
        $event = new GenericEvent(new PluginCollection());
        $plugins = $this->dispatcher->dispatch('moduleplugin.ckeditor.externalplugins', $event)->getSubject()->getPlugins();

        return $plugins;
    }
}
