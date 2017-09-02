<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @see       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

namespace Zikula\ScribiteModule\Editor\CKEditor\Collection;

/**
 * This class is used as the subject of the event 'moduleplugin.ckeditor.externalplugins'
 * Any module that needs to add *external* editor plugins can use an event listener to automatically load their
 * helper every time a Scribite editor is loaded.
 * @see http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.resourceManager.html#addExternal
 * @see http://ckeditor.com/comment/47922#comment-47922
 */
class PluginCollection
{
    /**
     * stack of plugins
     * @var array
     */
    private $plugins;

    public function __construct()
    {
        $this->plugins = [];
    }

    /**
     * add a plugin to the stack
     * @param array $plugin
     * $helper must have array keys [name, path, file, img] set
     */
    public function add(array $plugin)
    {
        if (isset($plugin['name']) && isset($plugin['path']) && isset($plugin['file']) && isset($plugin['img'])) {
            $plugin['path'] = rtrim($plugin['path'], '/') . '/'; // ensure there is a trailing slash
            $this->plugins[] = $plugin;
        }
    }

    /**
     * get the helper stack
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }
}
