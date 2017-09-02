<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @see       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

namespace Zikula\ScribiteModule\Editor\TinyMce\Collection;

class PluginCollection
{
    /**
     * This class is used as the subject of the event 'moduleplugin.tinymce.externalplugins'
     * @see http://www.tinymce.com/wiki.php/Configuration:plugins
     */

    /**
     * stack of plugins
     * @var array
     */
    private $plugins;

    /**
     * constructor
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
