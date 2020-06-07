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

namespace Zikula\ScribiteModule\Editor\Summernote\Helper;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Zikula\Bundle\CoreBundle\Event\GenericEvent;
use Zikula\ScribiteModule\Editor\EditorHelperInterface;
use Zikula\ScribiteModule\Editor\Summernote\Collection\PluginCollection;

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
    public function getParameters(array $parameters = []): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalPlugins(): array
    {
        if (null === $this->dispatcher) {
            throw new \RuntimeException('Dispatcher has not been set.');
        }
        $event = new GenericEvent(new PluginCollection());
        $plugins = $this->dispatcher->dispatch($event, 'moduleplugin.summernote.externalplugins')->getSubject()->getPlugins();

        return $plugins;
    }
}
