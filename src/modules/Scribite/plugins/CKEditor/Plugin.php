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
class ModulePlugin_Scribite_CKEditor_Plugin extends Scribite_PluginHandler_AbstractPlugin
{

    /**
     * Provide plugin meta data.
     *
     * @return array Meta data.
     */
    protected function getMeta()
    {
        return array('displayname' => $this->__('CKEditor'),
            'description' => $this->__('CKEditor is a ready-for-use HTML text editor designed to simplify web content creation.'),
            'version' => '4.0.0',
            'url' => 'http://ckeditor.com',
            'license' => 'GPL-2.0+, LGPL-2.1+, MPL-1.1+',
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

    public static function getDefaults()
    {
        return array(
            'barmode' => 'Full',
            'maxheight' => '400px',
            'style_editor' => 'modules/Scribite/plugins/CKEditor/style/contents.css',
            'skin' => 'moono',
            'uicolor' => '#D3D3D3',
            'customconfigfile' => '',
            'extraplugins' => '',
            'filemanagerpath' => '',
        );
    }

    public static function getOptions()
    {
        return array(
            'barmodelist' => self::getBarmodes(),
            'skinlist' => self::getSkins()
        );
    }

    // read langs-folder from ckeditor and load names into array
    public static function getLangs()
    {
        $langs = array();
        $langs[] = ' '; // @nmpetkov for selecting default language
        $langsdir = opendir('modules/Scribite/plugins/CKEditor/vendor/ckeditor/lang');

        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[_]/', $f) && preg_match('/[.js]/', $f)) {
                $f = str_replace('.js', '', $f);
                $langs[] = array(
                    'text' => $f,
                    'value' => $f
                );
            }
        }

        closedir($langsdir);
        // sort array
        asort($langs);

        return $langs;
    }

    // read skins-folder from ckeditor and load names into array
    public static function getSkins()
    {

        $skins = array();
        $skinsdir = opendir('modules/Scribite/plugins/CKEditor/vendor/ckeditor/skins');

        while (false !== ($f = readdir($skinsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $skins[] = array(
                    'text' => $f,
                    'value' => $f
                );
            }
        }

        closedir($skinsdir);
        // sort array
        asort($skins);

        return $skins;
    }

    // read plugins from ckeditor and load names into array
    public static function getPlugins()
    {
        $plugins = array();
        $pluginsdir = opendir('modules/Scribite/plugins/CKEditor/vendor/ckeditor/plugins');

        while (false !== ($f = readdir($pluginsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $plugins[] = array(
                    'text' => $f,
                    'value' => $f
                );
            }
        }

        closedir($pluginsdir);
        // sort array
        asort($plugins);

        return $plugins;
    }

    // load names into array
    public static function getBarmodes()
    {
        return array(
            0 => array(
                'text' => 'Full',
                'value' => 'Full'
            ),
            1 => array(
                'text' => 'Basic',
                'value' => 'Basic'
            ),
            2 => array(
                'text' => 'adminbar',
                'value' => 'adminbar'
            ), // @nmpetkov: have to be defined in custconfig.js (same for bars below)
            3 => array(
                'text' => 'userbar1',
                'value' => 'userbar1'
            ), // @nmpetkov: have to be defined in custconfig.js (same for bars below)
            4 => array(
                'text' => 'userbar2',
                'value' => 'userbar2'
            ), // @nmpetkov: have to be defined in custconfig.js (same for bars below)
            5 => array(
                'text' => 'userbar3',
                'value' => 'userbar3'
            ), // @nmpetkov: have to be defined in custconfig.js (same for bars below)
        );
    }

}
