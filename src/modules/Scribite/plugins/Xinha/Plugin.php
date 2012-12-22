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
class ModulePlugin_Scribite_Xinha_Plugin extends Scribite_PluginHandler_AbstractPlugin
{

    /**
     * Provide plugin meta data.
     *
     * @return array Meta data.
     */
    protected function getMeta()
    {
        return array('displayname' => $this->__('Xinha'),
            'description' => $this->__('Xinha editor.'),
            'version' => '0.96.1', // May 12, 2010
            'url' => 'http://trac.xinha.org',
            'license' => 'htmlArea based on BSD',
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
            'language' => 'en',
            'skin' => 'blue-look',
            'barmode' => 'reduced',
            'width' => 'auto',
            'height' => 'auto',
            'style' => 'modules/Scribite/Plugins/Xinha/style/editor.css',
            'style_dynamiccss' => 'modules/Scribite/Plugins/Xinha/style/DynamicCSS.css',
            'style_stylist' => 'modules/Scribite/Plugins/Xinha/style/stylist.css',
            'statusbar' => 1,
            'converturls' => 1,
            'showloading' => 1,
            'useEFM' => false,
            'activeplugins' => array('GetHtml', 'SmartReplace'),
        );
    }

    public static function getOptions()
    {
        return array(
            'skinlist' => self::getSkins(),
            'allplugins' => self::getPlugins(),
            'barmodes' => self::getBarmodes()
        );
    }

// read plugin-folder from xinha and load names into array
    public static function getPlugins()
    {
        $plugins = array();
        $pluginsdir = opendir('modules/Scribite/plugins/Xinha/vendor/xinha/plugins');
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

    // read skins-folder from xinha and load names into array
    public static function getSkins()
    {
        $skins = array();
        $skinsdir = opendir('modules/Scribite/plugins/Xinha/vendor/xinha/skins');
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

    // read lang-folder from xinha and load names into array
    public static function getLangs()
    {
        $langs = array();
        $langsdir = opendir('modules/Scribite/plugins/Xinha/vendor/xinha/lang');
        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && preg_match('/[.js]/', $f)) {
                $f = str_replace('.js', '', $f);
                $langs[] = array(
                    'text' => $f,
                    'value' => $f
                );
            }
        }
        closedir($langsdir);
        // Add english as default editor language - this not exists as file in xinha
        $langs[] = array(
            'text' => 'en',
            'value' => 'en'
        );
        // sort array
        asort($langs);

        return $langs;
    }

    public static function addParameters()
    {
        $useEFM = ModUtil::getVar('moduleplugin.scribite.xinha', 'useEFM');
        if ($useEFM) {
            return array('EFMConfig' => self::getEFMConfig());
        } else {
            return array('EFMConfig' => '');
        }
    }
    
    public static function getBarmodes()
    {
        return array(
            0 => array(
                'text' => 'reduced',
                'value' => 'reduced',
            ),
            1 => array(
                'text' => 'full',
                'value' => 'full',
            ),
            2 => array(
                'text' => 'mini',
                'value' => 'mini',
            )
        );
    }
    
    // load IM/EFM settings for Xinha and pass vars to session
    // not implemented yet ;)
    public static function getEFMConfig()
    {
        require_once 'modules/Scribite/plugins/Xinha/vendor/xinha/contrib/php-xinha.php';

        $zikulaBaseURI = rtrim(System::getBaseUri(), '/');
        $zikulaBaseURI = ltrim($zikulaBaseURI, '/');

        // define backend configuration for the plugin
        $IMConfig = array();
        $IMConfig['images_dir'] = '/files/';
        $IMConfig['images_url'] = 'files/';
        $IMConfig['files_dir'] = '/files/';
        $IMConfig['files_url'] = 'files';
        $IMConfig['thumbnail_prefix'] = 't_';
        $IMConfig['thumbnail_dir'] = 't';
        $IMConfig['resized_prefix'] = 'resized_';
        $IMConfig['resized_dir'] = '';
        $IMConfig['tmp_prefix'] = '_tmp';
        $IMConfig['max_filesize_kb_image'] = 2000;
        // maximum size for uploading files in 'insert image' mode (2000 kB here)

        $IMConfig['max_filesize_kb_link'] = 5000;
        // maximum size for uploading files in 'insert link' mode (5000 kB here)
        // Maximum upload folder size in Megabytes.
        // Use 0 to disable limit
        $IMConfig['max_foldersize_mb'] = 0;

        $IMConfig['allowed_image_extensions'] = array("jpg", "gif", "png");
        $IMConfig['allowed_link_extensions'] = array("jpg", "gif", "pdf", "ip", "txt",
                "psd", "png", "html", "swf", "xml", "xls");

        xinha_pass_to_php_backend($IMConfig);
        return $IMConfig;
    }
}
