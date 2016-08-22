<?php

/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license MIT
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

/**
 * Plugin definition class.
 */
class ModulePlugin_Scribite_Aloha_Plugin extends Scribite_PluginHandler_AbstractPlugin
{
    /**
     * Provide plugin meta data.
     *
     * @return array Meta data.
     */
    protected function getMeta()
    {
        return array(
            'displayname' => $this->__('Aloha'),
            'description' => $this->__('Aloha editor.'),
            'version' => '1.4.9',
            'url' => 'http://aloha-editor.org/',
            'license' => 'GPL-2.0+',
            'dependencies' => 'jQuery',
        );
    }

    public function install()
    {
        ModUtil::setVars($this->serviceId, $this->getDefaults());

        return true;
    }

    public function uninstall()
    {
        ModUtil::delVar($this->serviceId);

        return true;
    }

    public static function getOptions()
    {
        $plugins = self::getPlugins();

        return array(
            'commonPluginsItems' => $plugins['common'],
            'extraPluginsItems' => $plugins['extra']
        );
    }

    // read plugins from tinymce and load names into array
    public static function getPlugins()
    {
        $plugins = array();
        $pluginTypes = array('common', 'extra');

        foreach ($pluginTypes as $pluginType) {
            $plugins[$pluginType] = array();
            $pluginsdir = opendir('modules/Scribite/plugins/Aloha/vendor/aloha/plugins/' . $pluginType);
            while (false !== ($f = readdir($pluginsdir))) {
                // ui plugin is always loaded
                if (in_array($f, array('.', '..', 'ui')) || preg_match('/[.]/', $f)) {
                    continue;
                }
                $plugins[$pluginType][] = array(
                    'text' => $f,
                    'value' => $f
                );
            }

            closedir($pluginsdir);
            usort($plugins[$pluginType], function ($a, $b) {
                return strcmp(strtolower($a['text']), strtolower($b['text']));
            });
        }

        return $plugins;
    }
    
    public static function getDefaults()
    {
        return array(
            'commonPlugins' => array(
                'align',
                'format',
                'highlighteditables',
                'image',
                'link',
                'list',
                'undo'
            ),
            'extraPlugins' => array(
            )
        );
    }
}

