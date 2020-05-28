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

interface EditorHelperInterface
{
    /**
     * An array of parameters which will be added to the template within the
     * property `editorParameters`
     */
    public function getParameters(): array;

    /**
     * An array of parameters which will be added to the template within the
     * property `externalEditorPlugins`
     */
    public function getExternalPlugins(): array;
}
