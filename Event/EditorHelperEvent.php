<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Event;

use Symfony\Component\EventDispatcher\Event;
use Zikula\ScribiteModule\Collection\HelperCollection;

class EditorHelperEvent extends Event
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
