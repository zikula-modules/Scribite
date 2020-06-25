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

namespace Zikula\ScribiteModule\Editor;

interface EditorPluginCollectionInterface
{
    /**
     * Add a plugin to the stack.
     * Array structure depends on the editor's requirements.
     */
    public function add(array $plugin): void;

    /**
     * Gets the plugins stack.
     */
    public function getPlugins(): array;
}
