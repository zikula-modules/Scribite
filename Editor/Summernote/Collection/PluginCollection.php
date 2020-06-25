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

namespace Zikula\ScribiteModule\Editor\Summernote\Collection;

use Zikula\ScribiteModule\Editor\EditorPluginCollectionInterface;

/**
 * This class is used by the `Zikula\ScribiteModule\Editor\Summernote\LoadExternalPluginsEvent`.
 * Any extension that needs to add *external* editor plugins can use an event listener to automatically load their
 * helper every time a Scribite editor is loaded.
 * @see http://summernote.org/deep-dive/#module-system
 */
class PluginCollection implements EditorPluginCollectionInterface
{
    /**
     * Stack of plugins.
     */
    private $plugins = [];

    /**
     * Adds a plugin to the stack.
     *
     * $plugin must have array keys [name, path] set.
     */
    public function add(array $plugin): void
    {
        if (isset($plugin['name'], $plugin['path'])) {
            $this->plugins[] = $plugin;
        }
    }

    /**
     * Gets the plugins stack.
     */
    public function getPlugins(): array
    {
        return $this->plugins;
    }
}
