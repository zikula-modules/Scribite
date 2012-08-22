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
class ModulePlugin_Scribite_Xinha_Plugin extends Zikula_AbstractPlugin implements Zikula_Plugin_ConfigurableInterface
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
                     'version'     => '1.1.1'
                    );
    }

    /**
     * Controller configuration getter.
     *
     * @return ModulePlugin_Scribite_Example_Controller
     */
    public function getConfigurationController()
    {
        return System::redirect(ModUtil::url('Scribite', 'admin', 'modifyeditor', array('editor' => 'xinha')));
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


    public function getDefaults()
    {
        return array(
            'language'         => 'en',
            'skin'             => 'blue-look',
            'barmode'          => 'reduced',
            'width'            => 'auto',
            'height'           => 'auto',
            'style'            => 'modules/Scribite/Plugins/Xinha/style/editor.css',
            'style_dynamiccss' => 'modules/Scribite/Plugins/Xinha/style/DynamicCSS.css',
            'style_stylist'    => 'modules/Scribite/Plugins/Xinha/style/stylist.css',
            'statusbar'        => 1,
            'converturls'      => 1,
            'showloading'      => 1,
            'activeplugins'    => 'a:2:{i:0;s:7:"GetHtml";i:1;s:12:"SmartReplace";}'
        );
    }


    public function getOptions()
    {
        return array(
            'langlist'   => self::getLangs(),
            'skinlist'   => self::getSkins(),
            'allplugins' => self::getPlugins(),
            'barmodes'   => self::getBarmodes()
        );

    }


// read plugin-folder from xinha and load names into array
    public function getPlugins()
    {
        $plugins = array();
        $pluginsdir = opendir('modules/Scribite/plugins/Xinha/javascript/xinha/plugins');
        while (false !== ($f = readdir($pluginsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $plugins[] = array(
                    'text'  => $f,
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
    public function getSkins()
    {
        $skins = array();
        $skinsdir = opendir('modules/Scribite/plugins/Xinha/javascript/xinha/skins');
        while (false !== ($f = readdir($skinsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $skins[] = array(
                    'text'  => $f,
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
    public function getLangs()
    {
        $langs = array();
        $langsdir = opendir('modules/Scribite/plugins/Xinha/javascript/xinha/lang');
        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && preg_match('/[.js]/', $f)) {
                $f = str_replace('.js', '', $f);
                $langs[] = array(
                    'text'  => $f,
                    'value' => $f
                );
            }
        }
        closedir($langsdir);
        // Add english as default editor language - this not exists as file in xinha
        $langs[] = array(
            'text'  => 'en',
            'value' => 'en'
        );
        // sort array
        asort($langs);

        return $langs;
    }



    public function getBarmodes()
    {
        return array(
            0 => array(
                'text'  => 'reduced',
                'value' => 'reduced',
            ),
            1 => array(
                'text'  => 'full',
                'value' => 'full',
            ),
            2 => array(
                'text'  => 'mini',
                'value' => 'mini',
            )
        );
    }
    
}
