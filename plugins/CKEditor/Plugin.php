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
     * @return array meta data
     */
    protected function getMeta()
    {
        return [
            'displayname' => $this->__('CKEditor'),
            'description' => $this->__('CKEditor is a ready-for-use HTML text editor designed to simplify web content creation.'),
            'version' => '4.6.0',
            'url' => 'http://ckeditor.com',
            'license' => 'GPL-2.0+, LGPL-2.1+, MPL-1.1+',
        ];
    }

    public function install()
    {
        ModUtil::setVars($this->serviceId, $this->getDefaults());

        return true;
    }

    public function upgrade($oldVersion)
    {
        if (version_compare($oldVersion, '4.6.0', '<')) {
            ModUtil::setVar($this->serviceId, 'skin', 'moono-lisa');
        }

        return true;
    }

    public function uninstall()
    {
        ModUtil::delVar($this->serviceId);

        return true;
    }

    public static function getDefaults()
    {
        return [
            'barmode' => 'Standard',
            'height' => '200',
            'resizemode' => 'resize',
            'resizeminheight' => '250',
            'resizemaxheight' => '3000',
            'growminheight' => '200',
            'growmaxheight' => '400',
            'style_editor' => 'modules/Scribite/plugins/CKEditor/style/contents.css',
            'skin' => 'moono-lisa',
            'uicolor' => '#D3D3D3',
            'langmode' => 'zklang',
            'entermode' => 'CKEDITOR.ENTER_P',
            'shiftentermode' => 'CKEDITOR.ENTER_BR',
            'extraplugins' => '',
            'filemanagerpath' => '',
        ];
    }

    public static function getOptions()
    {
        return [
            'barmodelist' => self::getBarModes(),
            'skinlist' => self::getSkins(),
            'langmodelist' => self::getLanguageModes(),
            'resizemodelist' => self::getResizeModes(),
            'entermodelist' => self::getEnterModes(),
            'shiftentermodelist' => self::getEnterModes()
        ];
    }

    // read skins-folder from ckeditor and load names into array
    private static function getSkins()
    {
        $skins = [];
        $skinsDirectory = opendir('modules/Scribite/plugins/CKEditor/vendor/ckeditor/skins');

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

    /*
        // read plugins from ckeditor and load names into array
        private static function getPlugins()
        {
            $plugins = array();
            $pluginsDirectory = opendir('modules/Scribite/plugins/CKEditor/vendor/ckeditor/plugins');
    
            while (false !== ($f = readdir($pluginsDirectory))) {
                if (in_array($f, array('.', '..')) || preg_match('/[.]/', $f)) {
                    continue;
                }
                $plugins[] = array(
                    'text' => $f,
                    'value' => $f
                );
            }
    
            closedir($pluginsDirectory);
            usort($plugins, function ($a, $b) {
                return strcmp(strtolower($a['text']), strtolower($b['text']));
            });
    
            return $plugins;
        }
    */
    // load names into array
    private static function getBarModes()
    {
        // Toolbars have to be defined in custconfig.js in order to work
        return [
            0 => [
                'text' => 'Basic',
                'value' => 'Basic'
            ],
            1 => [
                'text' => 'Simple',
                'value' => 'Simple'
            ],
            2 => [
                'text' => 'Standard',
                'value' => 'Standard'
            ],
            3 => [
                'text' => 'Extended',
                'value' => 'Extended'
            ],
            4 => [
                'text' => 'Full',
                'value' => 'Full'
            ],
            5 => [
                'text' => 'Special1',
                'value' => 'Special1'
            ],
            6 => [
                'text' => 'Special2',
                'value' => 'Special2'
            ],
        ];
    }

    // load names into array
    private static function getLanguageModes()
    {
        return [
            0 => [
                'text' => 'Use Zikula language definition',
                'value' => 'zklang'
            ],
            1 => [
                'text' => 'Let CKEditor match language automatically',
                'value' => 'cklang'
            ]
        ];
    }

    // load names into array
    private static function getResizeModes()
    {
        return [
            0 => [
                'text' => 'Use resize',
                'value' => 'resize'
            ],
            1 => [
                'text' => 'Use autogrow',
                'value' => 'autogrow'
            ],
            2 => [
                'text' => 'No resizing',
                'value' => 'noresize'
            ]
        ];
    }

    // load names into array
    private static function getEnterModes()
    {
        return [
            0 => [
                'text' => 'Create new <p> paragraphs',
                'value' => 'CKEDITOR.ENTER_P'
            ],
            1 => [
                'text' => 'Break lines with <br> element',
                'value' => 'CKEDITOR.ENTER_BR'
            ],
            2 => [
                'text' => 'Create new <div> bocks',
                'value' => 'CKEDITOR.ENTER_DIV'
            ]
        ];
    }
}
