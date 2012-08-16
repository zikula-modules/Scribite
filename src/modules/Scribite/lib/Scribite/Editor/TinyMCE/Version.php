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


    public function addParameters()
    {
        // get plugins for tiny_mce
        $tinymce_listplugins = ModUtil::getVar('Scribite', 'tinymce_activeplugins');
        $tinymce_buttonmap = array('paste'           => 'pastetext,pasteword,selectall',
            'insertdatetime'  => 'insertdate,inserttime',
            'table'           => 'tablecontrols,table,row_props,cell_props,delete_col,delete_row,col_after,col_before,row_after,row_before,split_cells,merge_cells',
            'directionality'  => 'ltr,rtl',
            'layer'           => 'moveforward,movebackward,absolute,insertlayer',
            'save'            => 'save,cancel',
            'style'           => 'styleprops',
            'xhtmlxtras'      => 'cite,abbr,acronym,ins,del,attribs',
            'searchreplace'   => 'search,replace');



        if (is_array($tinymce_listplugins)) {

            // Buttons/controls: http://www.tinymce.com/wiki.php/Buttons/controls
            // We have some plugins with the button name same as plugin name
            // and a few plugins with custom button names, so we have to check the mapping array.
            $tinymce_buttons =  array();
            foreach ($tinymce_listplugins as $key => $tinymce_button) {
                if (array_key_exists($tinymce_button, $tinymce_buttonmap)) {
                    $tinymce_buttons = array_merge($tinymce_buttons, explode(",",$tinymce_buttonmap[$tinymce_button]));
                } else {
                    $tinymce_buttons[] = $tinymce_button;
                }
            }

            // TODO: I really would like to split this into multiple row, but I do not know how
            //    $tinymce_buttons_splitted = array_chunk($tinymce_buttons, 20);
            //    foreach ($tinymce_buttons_splitted as $key => $tinymce_buttonsrow) {
            //        $tinymce_buttonsrows[] = DataUtil::formatForDisplay(implode(',', $tinymce_buttonsrow));
            //    }

            $tinymce_buttons = DataUtil::formatForDisplay(implode(',', $tinymce_buttons));

            return array('tinymce_buttons' => $tinymce_buttons);
        }

        return array();

    }


    public function getDefaults()
    {
        return array(
            'tinymce_language'      => 'en',
            'tinymce_style'         => 'modules/Scribite/style/tinymce/style.css',
            'tinymce_theme'         => 'advanced',
            'tinymce_width'         => '65%',
            'tinymce_height'        => '400px',
            'tinymce_dateformat'    => '%Y-%m-%d',
            'tinymce_timeformat'    => '%H:%M:%S',
            'tinymce_activeplugins' => ''
        );
    }

}
