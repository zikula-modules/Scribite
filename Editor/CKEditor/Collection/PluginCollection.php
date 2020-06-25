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

namespace Zikula\ScribiteModule\Editor\CKEditor\Collection;

use Zikula\ScribiteModule\Editor\EditorPluginCollectionInterface;

/**
 * This class is used by the `Zikula\ScribiteModule\Editor\CKEditor\LoadExternalPluginsEvent`.
 * Any extension that needs to add *external* editor plugins can use an event listener to automatically load their
 * helper every time a Scribite editor is loaded.
 * @see http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.resourceManager.html#addExternal
 * @see http://ckeditor.com/comment/47922#comment-47922
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
     * $plugin must have array keys [name, path, file, img] set.
     */
    public function add(array $plugin): void
    {
        if (isset($plugin['name'], $plugin['path'], $plugin['file'], $plugin['img'])) {
            $plugin['path'] = rtrim($plugin['path'], '/') . '/'; // ensure there is a trailing slash
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
