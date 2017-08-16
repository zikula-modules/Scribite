<?php

/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license MIT
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

namespace Zikula\ScribiteModule\Editor\CKEditor\Helper;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Zikula\Core\Event\GenericEvent;
use Zikula\ScribiteModule\Editor\CKEditor\Collection\PluginCollection;
use Zikula\ScribiteModule\Editor\DispatcherAwareInterface;
use Zikula\ScribiteModule\Editor\EditorHelperInterface;

class EditorHelper implements EditorHelperInterface, DispatcherAwareInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * {@inheritdoc}
     */
    public function setDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
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
