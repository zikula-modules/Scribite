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

    public function add(EditorInterface $editor): void
    {
        $id = $editor->getId();
        if (isset($this->editors[$id])) {
            throw new \InvalidArgumentException(sprintf('Attempting to register a duplicate Scribite Editor Id \'%s\'', $id));
        }
        $this->editors[$id] = $editor;
    }

    public function get(string $id): ?EditorInterface
    {
        return isset($this->editors[$id]) ? $this->editors[$id] : null;
    }

    /**
     * Get all the editors in the collection.
     * @return EditorInterface[]
     */
    public function getEditors(): array
    {
        return $this->editors;
    }

    public function getEditorsChoiceList(): array
    {
        $choices = [];
        foreach ($this->editors as $editorId => $editor) {
            $choices[$editor->getMeta()['displayname']] = $editorId;
        }
        ksort($choices);

        return $choices;
    }
}
