<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @see       https://ziku.la
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

namespace Zikula\ScribiteModule\Editor\Summernote\Collection;

/**
 * This class is used as the subject of the event 'moduleplugin.summernote.externalplugins'.
 * Any module that needs to add *external* editor plugins can use an event listener to automatically load their
 * helper every time a Scribite editor is loaded.
 * @see http://summernote.org/deep-dive/#module-system
 */
class PluginCollection
{
    /**
     * stack of plugins
     * @var array
     */
    private $plugins;

    /**
     * PluginCollection constructor.
     */
    public function __construct()
    {
        $this->plugins = [];
    }

    /**
     * add a plugin to the stack
     * @param array $plugin
     * $helper must have array keys [name, path] set
     */
    public function add(array $plugin)
    {
        if (isset($plugin['name']) && isset($plugin['path'])) {
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
