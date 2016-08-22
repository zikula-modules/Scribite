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
class ModulePlugin_Scribite_WYMeditor_Plugin extends Scribite_PluginHandler_AbstractPlugin
{
    /**
     * Provide plugin meta data.
     *
     * @return array Meta data.
     */
    protected function getMeta()
    {
        return array(
            'displayname' => $this->__('WYMeditor'),
            'description' => $this->__('WYMeditor editor.'),
            'version' => '1.1.1',
            'url' => 'http://www.wymeditor.org/',
            'license' => 'MIT',
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
        return array(
            'skinlist' => self::getSkins(),
            'allplugins' => self::getPlugins()
        );
    }

    // read skins-folder from wymeditor and load names into array
    public static function getSkins()
    {
        $skins = array();
        $skinsdir = opendir('modules/Scribite/plugins/WYMeditor/vendor/wymeditor/skins');

        while (false !== ($f = readdir($skinsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $skins[] = array(
                    'text' => $f,
                    'value' => $f
                );
            }
        }

        closedir($skinsdir);
        usort($skins, function ($a, $b) {
            return strcmp(strtolower($a['text']), strtolower($b['text']));
        });

        return $skins;
    }

    // read plugins from tinymce and load names into array
    public static function getPlugins()
    {
        $plugins = array();
        $pluginsdir = opendir('modules/Scribite/plugins/WYMeditor/vendor/wymeditor/plugins');

        while (false !== ($f = readdir($pluginsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $plugins[] = array(
                    'text' => $f,
                    'value' => $f
                );
            }
        }

        closedir($pluginsdir);
        usort($plugins, function ($a, $b) {
            return strcmp(strtolower($a['text']), strtolower($b['text']));
        });

        return $plugins;
    }
    
    public static function getDefaults()
    {
        return array(
            'style' => 'modules/Scribite/plugins/WYMeditor/style/style.css',
            'skin' => 'default',
            'activeplugins' => array(
                'embed',
                'fullscreen',
                'hovertools',
                'list',
                'rdfa',
                'resizable',
                'structured_headings',
                'table',
                'tidy'
            )
        );
    }
}
