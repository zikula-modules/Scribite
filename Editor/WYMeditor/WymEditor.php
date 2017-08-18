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

namespace Zikula\ScribiteModule\Editor\WYMeditor;

class WymEditor
{
    /**
     * Provide plugin meta data.
     *
     * @return array meta data
     */
    protected function getMeta()
    {
        return [
            'displayname' => $this->__('WYMeditor'),
            'description' => $this->__('WYMeditor editor.'),
            'version' => '1.1.1',
            'url' => 'http://www.wymeditor.org/',
            'license' => 'MIT',
            'dependencies' => 'jQuery',
        ];
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
        return [
            'skinlist' => self::getSkins(),
            'allplugins' => self::getPlugins()
        ];
    }

    // read skins-folder from wymeditor and load names into array
    private static function getSkins()
    {
        $skins = [];
        $skinsDirectory = opendir('modules/Scribite/plugins/WYMeditor/vendor/wymeditor/skins');

        while (false !== ($f = readdir($skinsDirectory))) {
            if (in_array($f, ['.', '..']) || preg_match('/[.]/', $f)) {
                continue;
            }
            $skins[] = [
                'text' => $f,
                'value' => $f
            ];
        }

        closedir($skinsDirectory);
        usort($skins, function ($a, $b) {
            return strcmp(strtolower($a['text']), strtolower($b['text']));
        });

        return $skins;
    }

    // read plugins from wymeditor and load names into array
    private static function getPlugins()
    {
        $plugins = [];
        $pluginsdir = opendir('modules/Scribite/plugins/WYMeditor/vendor/wymeditor/plugins');

        while (false !== ($f = readdir($pluginsdir))) {
            if (in_array($f, ['.', '..']) || preg_match('/[.]/', $f)) {
                continue;
            }
            $plugins[] = [
                'text' => $f,
                'value' => $f
            ];
        }

        closedir($pluginsdir);
        usort($plugins, function ($a, $b) {
            return strcmp(strtolower($a['text']), strtolower($b['text']));
        });

        return $plugins;
    }

    public static function getDefaults()
    {
        return [
            'style' => 'modules/Scribite/plugins/WYMeditor/style/style.css',
            'skin' => 'default',
            'activeplugins' => [
                'embed',
                'fullscreen',
                'hovertools',
                'list',
                'rdfa',
                'resizable',
                'structured_headings',
                'table',
                'tidy'
            ]
        ];
    }
}
