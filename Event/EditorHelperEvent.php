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

namespace Zikula\ScribiteModule\Event;

use Zikula\ScribiteModule\Collection\HelperCollection;

/**
 * This event occurs when Scribite is loading the selected editor.
 * The subscribing extension should use the HelperCollection::add() method to add an array.
 * Please see the class docs for more.
 */
class EditorHelperEvent
{
    /**
     * @var HelperCollection
     */
    private $helperCollection;

    /**
     * @var string
     */
    private $editor;

    public function __construct($helpers, $editor)
    {
        $this->editor = $editor;
        $this->helperCollection = $helpers;
    }

    /**
     * @return HelperCollection
     */
    public function getHelperCollection()
    {
        return $this->helperCollection;
    }

    /**
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }
}
