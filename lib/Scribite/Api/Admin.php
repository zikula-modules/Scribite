<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @see       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Api_Admin extends Zikula_AbstractApi
{
    /**
     * Get available admin panel links.
     *
     * @param array $args
     * @return array
     */
    public function getLinks()
    {
        $links = [];

        $links[] = [
            'url' => ModUtil::url('Scribite', 'admin', 'modifyconfig'),
            'text' => $this->__('Settings'),
            'class' => 'z-icon-es-config'];
        $links[] = [
            'url' => ModUtil::url('Scribite', 'admin', 'modifyoverrides'),
            'text' => $this->__('Overrides'),
            'class' => 'z-icon-es-config'];
        $links[] = [
            'url' => ModUtil::url('Scribite', 'admin', 'editors'),
            'text' => $this->__('Editor list'),
            'class' => 'z-icon-es-view'];

        // return collected links
        return $links;
    }

    /**
     * Read editors folder and load names into array.
     *
     * @param array $args
     * @return type
     */
    public function getEditors($args)
    {
        $path = 'modules/Scribite/plugins';
        $plugins = FileUtil::getFiles($path, false, true, null, 'd');

        $editors = [];

        foreach ($plugins as $pluginName) {
            $className = 'ModulePlugin_Scribite_' . $pluginName . '_Plugin';
            $instance = PluginUtil::loadPlugin($className);
            $pluginstate = PluginUtil::getState($instance->getServiceId(), PluginUtil::getDefaultState());
            if ($pluginstate['state'] == PluginUtil::ENABLED) {
                if (isset($args['format']) && $args['format'] == 'formdropdownlist') {
                    $editors[] = [
                        'text' => $instance->getMetaDisplayName(),
                        'value' => $pluginName
                    ];
                } else {
                    $editors[$pluginName] = $instance->getMetaDisplayName();
                }
            }
        }

        return $editors;
    }

    /**
     * Find the editor title when provided with editorname
     *
     * @param array $args
     * @return string
     */
    public function getEditorTitle($args)
    {
        if (!PluginUtil::isAvailable('moduleplugin.scribite.' . strtolower($args['editorname']))) {
            return '';
        }

        $className = 'ModulePlugin_Scribite_' . $args['editorname'] . '_Plugin';
        $instance = PluginUtil::loadPlugin($className);

        return $instance->getMetaDisplayName();
    }
}
