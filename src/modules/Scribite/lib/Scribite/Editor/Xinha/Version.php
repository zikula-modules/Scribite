<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */

class Scribite_Editor_Xinha_Version
{
    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = $this->__('Xinha');
        return $meta;
    }

    public function getOptions()
    {
        return array(
            'xinha_langlist'   => self::getLangs(),
            'xinha_skinlist'   => self::getSkins(),
            'xinha_allplugins' => self::getPlugins(),
            'xinha_barmodes'   => self::getBarmodes()
        );

    }


// read plugin-folder from xinha and load names into array
    public function getPlugins()
    {
        $plugins = array();
        $pluginsdir = opendir('modules/Scribite/lib/Scribite/Editor/Xinha/xinha/plugins');
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
        $skinsdir = opendir('modules/Scribite/lib/Scribite/Editor/Xinha/xinha/skins');
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
        $langsdir = opendir('modules/Scribite/lib/Scribite/Editor/Xinha/xinha/lang');
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
