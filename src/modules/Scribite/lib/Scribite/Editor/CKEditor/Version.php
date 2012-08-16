<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */

class Scribite_Editor_CKEditor_Version
{
    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = $this->__('CKEditor');
        return $meta;
    }


    public function getDefaults()
    {
        return array(
            'ckeditor_language'     => 'en',
            'ckeditor_barmode'      => 'Full',
            'ckeditor_maxheight'    => '400px',
            'ckeditor_style_editor' => 'modules/Scribite/style/ckeditor/content.css',
            'ckeditor_skin'         => 'kama'
        );
    }

    public function getOptions()
    {
        return array(
            'ckeditor_barmodelist' => self::getBarmodes(),
            'ckeditor_langlist'    => self::getLangs(),
            'ckeditor_skinlist'    => self::getSkins()
        );

    }


    // read langs-folder from ckeditor and load names into array
    public function getLangs()
    {
        $langs = array();
        $langs[] = ' '; // @nmpetkov for selecting default language
        $langsdir = opendir('modules/Scribite/lib/Scribite/Editor/CKEditor/ckeditor/lang');

        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[_]/', $f) && preg_match('/[.js]/', $f)) {
                $f = str_replace('.js', '', $f);
                $langs[] = array(
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

    // read skins-folder from ckeditor and load names into array
    public function getSkins()
    {

        $skins = array();
        $skinsdir = opendir('modules/Scribite/lib/Scribite/Editor/CKEditor/ckeditor/skins');

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

    // read plugins from ckeditor and load names into array
    public function getPlugins()
    {
        $plugins = array();
        $pluginsdir = opendir('modules/Scribite/lib/Scribite/Editor/CKEditor/ckeditor/plugins');

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

    // load names into array
    public function getBarmodes()
    {
        return array(
            0 => array(
                    'text'  => 'Full',
                    'value' => 'Full'
                ),
            1 => array(
                    'text'  => 'Basic',
                    'value' => 'Basic'
            ),
            2 => array(
                'text'  => 'adminbar',
                'value' => 'adminbar'
            ), // @nmpetkov: have to be defined in custconfig.js (same for bars below)
            3 => array(
                'text'  => 'userbar1',
                'value' => 'userbar1'
            ), // @nmpetkov: have to be defined in custconfig.js (same for bars below)
            4 => array(
                'text'  => 'userbar2',
                'value' => 'userbar2'
            ), // @nmpetkov: have to be defined in custconfig.js (same for bars below)
            5 => array(
                'text'  => 'userbar3',
                'value' => 'userbar3'
            ), // @nmpetkov: have to be defined in custconfig.js (same for bars below)
        );

    }


}
