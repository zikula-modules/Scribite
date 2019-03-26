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

namespace Zikula\ScribiteModule\Editor\TinyMce\Helper;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Zikula\Core\Event\GenericEvent;
use Zikula\ScribiteModule\Editor\EditorHelperInterface;
use Zikula\ScribiteModule\Editor\TinyMce\Collection\PluginCollection;

class EditorHelper implements EditorHelperInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @param EventDispatcherInterface $dispatcher
     * @param array $parameters
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        array $parameters
    ) {
        $this->dispatcher = $dispatcher;
        $this->parameters = $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        // get plugins for tinymce
        $tinymce_listplugins = $this->parameters['activeplugins'];
        $tinymce_buttonmap = [
            'paste' => 'pastetext,pasteword,selectall',
            'insertdatetime' => 'insertdate,inserttime',
            'table' => 'tablecontrols,table,row_props,cell_props,delete_col,delete_row,col_after,col_before,row_after,row_before,split_cells,merge_cells',
            'directionality' => 'ltr,rtl',
            'layer' => 'moveforward,movebackward,absolute,insertlayer',
            'save' => 'save,cancel',
            'style' => 'styleprops',
            'xhtmlxtras' => 'cite,abbr,acronym,ins,del,attribs',
            'searchreplace' => 'search,replace'
        ];

        if (is_array($tinymce_listplugins)) {
            // Buttons/controls: http://www.tinymce.com/wiki.php/Buttons/controls
            // We have some plugins with the button name same as plugin name
            // and a few plugins with custom button names, so we have to check the mapping array.
            $tinymce_buttons = [];
            foreach ($tinymce_listplugins as $tinymce_button) {
                if (array_key_exists($tinymce_button, $tinymce_buttonmap)) {
                    $tinymce_buttons = array_merge($tinymce_buttons, explode(",", $tinymce_buttonmap[$tinymce_button]));
                } else {
                    $tinymce_buttons[] = $tinymce_button;
                }
            }

            // TODO: I really would like to split this into multiple row, but I do not know how
            //    $tinymce_buttons_splitted = array_chunk($tinymce_buttons, 20);
            //    foreach ($tinymce_buttons_splitted as $key => $tinymce_buttonsrow) {
            //        $tinymce_buttonsrows[] = DataUtil::formatForDisplay(implode(',', $tinymce_buttonsrow));
            //    }

            $tinymce_buttons = implode(',', $tinymce_buttons);

            return [
                'buttons' => $tinymce_buttons
            ];
        }

        return [
            'buttons' => ''
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalPlugins()
    {
        if (null === $this->dispatcher) {
            throw new \RuntimeException('Dispatcher has not been set.');
        }
        $event = new GenericEvent(new PluginCollection());
        $plugins = $this->dispatcher->dispatch('moduleplugin.tinymce.externalplugins', $event)->getSubject()->getPlugins();

        return $plugins;
    }
}
