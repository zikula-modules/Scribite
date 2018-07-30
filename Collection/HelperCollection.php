<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Collection;

/**
 * This class is used as the subject of the event 'module.scribite.editorhelpers'
 * Any module that needs to add page assets (javascript, css) can use an event listener to automatically load their
 * helper every time a Scribite editor is loaded.
 */
class HelperCollection
{
    /**
     * stack of helpers
     * @var array
     */
    private $helpers;

    public function __construct()
    {
        $this->helpers = [];
    }

    /**
     * add a helper to the stack
     * @param array $helper
     * $helper must have array keys [module, type, path] set
     */
    public function add(array $helper)
    {
        if (isset($helper['module']) && isset($helper['type']) && isset($helper['path'])) {
            $this->helpers[] = $helper;
        }
    }

    /**
     * get the helper stack
     * @return array
     */
    public function getHelpers()
    {
        return $this->helpers;
    }
}
