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


interface EditorInterface
{
    /**
     * @return array
     */
    public function getMeta();

    /**
     * @return string
     */
    public function getDirectory();

    /**
     * @return array
     */
    public function getVars();
}
