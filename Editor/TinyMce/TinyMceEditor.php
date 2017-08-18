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

namespace Zikula\ScribiteModule\Editor\TinyMce;

class TinyMceEditor
{
    /**
     * Provide plugin meta data.
     *
     * @return array meta data
     */
    protected function getMeta()
    {
        return [
            'displayname' => $this->__('TinyMCE'),
            'description' => $this->__('TinyMCE has the ability to convert HTML <textarea> fields and other HTML elements to editor instances.'),
            'version' => '4.4.1',
            'url' => 'http://www.tinymce.com/',
            'license' => 'LGPL-2.1',
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
            'langlist' => self::getLanguages(),
            'themelist' => self::getThemes(),
            'allplugins' => self::getPlugins()
        ];
    }

    private static function getLanguages()
    {
        $languages = [
            // default language
            [
                'text' => 'en',
                'value' => 'en'
            ]
        ];
        $languagesDirectory = opendir('modules/Scribite/plugins/TinyMce/vendor/tinymce/langs');

        while (false !== ($f = readdir($languagesDirectory))) {
            if (in_array($f, ['.', '..']) || !preg_match('/[.]/', $f)) {
                continue;
            }
            $f = str_replace('.js', '', $f);
            $languages[] = [
                'text' => $f,
                'value' => $f
            ];
        }

        closedir($languagesDirectory);
        usort($languages, function ($a, $b) {
            return strcmp(strtolower($a['text']), strtolower($b['text']));
        });

        return $languages;
    }

    // read themes-folder from tinymce and load names into array
    private static function getThemes()
    {
        $themes = [];
        $themesDirectory = opendir('modules/Scribite/plugins/TinyMce/vendor/tinymce/themes');

        while (false !== ($f = readdir($themesDirectory))) {
            if (in_array($f, ['.', '..']) || preg_match('/[.]/', $f)) {
                continue;
            }
            $themes[] = [
                'text' => $f,
                'value' => $f
            ];
        }

        closedir($themesDirectory);
        usort($themes, function ($a, $b) {
            return strcmp(strtolower($a['text']), strtolower($b['text']));
        });

        return $themes;
    }

    // read plugins from tinymce and load names into array
    private static function getPlugins()
    {
        $plugins = [];
        $pluginsDirectory = opendir('modules/Scribite/plugins/TinyMce/vendor/tinymce/plugins');

        while (false !== ($f = readdir($pluginsDirectory))) {
            if (in_array($f, ['.', '..', 'template']) || preg_match('/[.]/', $f)) {
                continue;
            }
            $plugins[] = [
                'text' => $f,
                'value' => $f
            ];
        }

        closedir($pluginsDirectory);
        usort($plugins, function ($a, $b) {
            return strcmp(strtolower($a['text']), strtolower($b['text']));
        });

        return $plugins;
    }

    public static function getDefaults()
    {
        return [
            'language' => 'en',
            'style' => 'modules/Scribite/plugins/TinyMce/style/style.css',
            'skin' => 'modern',
            'width' => '100%',
            'height' => '400px',
            'dateformat' => '%Y-%m-%d',
            'timeformat' => '%H:%M:%S',
            'activeplugins' => [
                'autoresize',
                'code',
                'fullscreen',
                'insertdatetime',
                'link',
                'preview',
                'print',
                'wordcount'
            ]
        ];
    }
}
