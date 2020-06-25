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

    public function __construct(HelperCollection $helpers, string $editor)
    {
        $this->helperCollection = $helpers;
        $this->editor = $editor;
    }

    public function getHelperCollection(): HelperCollection
    {
        return $this->helperCollection;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }
}
