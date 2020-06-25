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

namespace Zikula\ScribiteModule\Editor\Quill\Helper;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Zikula\ScribiteModule\Editor\EditorHelperInterface;
use Zikula\ScribiteModule\Editor\EditorPluginCollectionInterface;
use Zikula\ScribiteModule\Editor\Quill\Collection\PluginCollection;

class EditorHelper implements EditorHelperInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

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
    public function getPluginCollection(): EditorPluginCollectionInterface
    {
        return new PluginCollection();
    }
}
