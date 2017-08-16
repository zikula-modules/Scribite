<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Editor;


interface ConfigurableEditorInterface
{
    /**
     * @return string
     */
    public function getFormClass();

    /**
     * @return string
     */
    public function getTemplatePath();
}
