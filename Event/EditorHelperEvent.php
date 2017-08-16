<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
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
    private $helper;

    /**
     * @var string
     */
    private $editor;

    public function __construct($helper, $editor)
    {
        $this->editor = $editor;
        $this->helper = $helper;
    }

    /**
     * @return HelperCollection
     */
    public function getHelper()
    {
        return $this->helper;
    }

    /**
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }
}
