<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */

class Scribite_Editor_TinyMCE_Version
{
    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = $this->__('TinyMCE');
        return $meta;
    }


    public function getOptions()
    {
        return array(
            'tinymce_langlist'   => self::getLangs(),
            'tinymce_themelist'  => self::getThemes(),
            'tinymce_allplugins' => self::getPlugins()
        );

    }




    public function getLangs()
    {
        $langs = array();
        $langsdir = opendir('modules/Scribite/lib/Scribite/Editor/TinyMCE/tinymce/langs');

        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && preg_match('/[.js]/', $f)) {
                $f = str_replace('.js', '', $f);
                $langs[]= array(
                    'text'  => $f,
                    'value' => $f
                );
            }
        }

        closedir($langsdir);
        // sort array
        asort($langs);

        return $langs;
    }

// read themes-folder from tiny_mce and load names into array

    public function getThemes()
    {
        $themes = array();
        $themesdir = opendir('modules/Scribite/lib/Scribite/Editor/TinyMCE/tinymce/themes');
        while (false !== ($f = readdir($themesdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $themes[] = array(
                    'text'  => $f,
                    'value' => $f
                );
            }
        }

        closedir($themesdir);
        // sort array
        asort($themes);

        return $themes;
    }


// read plugins from tiny_mce and load names into array

    public function getPlugins()
    {

        $plugins = array();

        $pluginsdir = opendir('modules/Scribite/lib/Scribite/Editor/TinyMCE/tinymce/plugins');
        while (false !== ($f = readdir($pluginsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && $f != '_template' && !preg_match('/[.]/', $f)) {
                $plugins[] = array(
                    'text'  => $f,
                    'value' => $f
                );
            }
        }
        closedir($pluginsdir);
        asort($plugins);

        return $plugins;
    }

}
