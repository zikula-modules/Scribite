<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Collector;

use Zikula\ScribiteModule\Editor\EditorInterface;

class EditorCollector
{
    /**
     * @var array ['service.id' => ServiceObject]
     */
    private $editors;

    public function __construct()
    {
        $this->editors = [];
    }

    /**
     * Add an editor to the collection.
     * @param $id
     * @param EditorInterface $editor
     */
    public function add($id, EditorInterface $editor)
    {
        if (isset($this->editors[$id])) {
            throw new \InvalidArgumentException(sprintf('Attempting to register a duplicate Scribite Editor Id \'%s\'', $id));
        }
        $this->editors[$id] = $editor;
    }

    /**
     * Get an editor from the collection by service.id.
     * @param $id
     * @return EditorInterface
     */
    public function get($id)
    {
        return isset($this->editors[$id]) ? $this->editors[$id] : null;
    }

    /**
     * Get all the editors in the collection.
     * @return EditorInterface[]
     */
    public function getEditors()
    {
        return $this->editors;
    }

    /**
     * @return array
     */
    public function getEditorsChoiceList()
    {
        $choices = [];
        foreach ($this->editors as $editorId => $editor) {
            $choices[$editor->getMeta()['displayname']] = $editorId;
        }
        ksort($choices);

        return $choices;
    }
}
