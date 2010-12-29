<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @version    $Id$
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 * @category   Zikula_Extension
 * @package    Utilities
 * @subpackage scribite!
 */

class Scribite_Api_Admin extends Zikula_Api
{
// get available admin panel links
    public function getlinks($args)
    {
        $links = array();
        $links[] = array('url' => ModUtil::url('Scribite', 'admin', 'modifyconfig'), 'text' => $this->__('Settings'), 'class' => 'z-icon-es-config');

        // check for all supported editors and generate links
        if (ModUtil::apiFunc('scribite', 'user', 'getEditors', array('editorname' => 'xinha'))) {
            $links[] = array('url' => ModUtil::url('scribite', 'admin', 'modifyxinha'), 'text' => $this->__('Xinha'), 'class' => 'z-icon-es-editor');
        }
        if (ModUtil::apiFunc('scribite', 'user', 'getEditors', array('editorname' => 'tiny_mce'))) {
            $links[] = array('url' => ModUtil::url('scribite', 'admin', 'modifytinymce'), 'text' => $this->__('TinyMCE'), 'class' => 'z-icon-es-editor');
        }
        if (ModUtil::apiFunc('scribite', 'user', 'getEditors', array('editorname' => 'fckeditor'))) {
            $links[] = array('url' => ModUtil::url('scribite', 'admin', 'modifyfckeditor'), 'text' => $this->__('FCKeditor'), 'class' => 'z-icon-es-editor');
        }
        if (ModUtil::apiFunc('scribite', 'user', 'getEditors', array('editorname' => 'ckeditor'))) {
            $links[] = array('url' => ModUtil::url('scribite', 'admin', 'modifyckeditor'), 'text' => $this->__('CKEditor'), 'class' => 'z-icon-es-editor');
        }
        if (ModUtil::apiFunc('scribite', 'user', 'getEditors', array('editorname' => 'openwysiwyg'))) {
            $links[] = array('url' => ModUtil::url('scribite', 'admin', 'modifyopenwysiwyg'), 'text' => $this->__('openWYSIWYG'), 'class' => 'z-icon-es-editor');
        }
        if (ModUtil::apiFunc('scribite', 'user', 'getEditors', array('editorname' => 'nicedit'))) {
            $links[] = array('url' => ModUtil::url('scribite', 'admin', 'modifynicedit'), 'text' => $this->__('NicEdit'), 'class' => 'z-icon-es-editor');
        }
        // add YUI page
        $links[] = array('url' => ModUtil::url('scribite', 'admin', 'modifyyui'), 'text' => $this->__('YUI Editor'), 'class' => 'z-icon-es-editor');
        // return output
        return $links;

    }

// update module editor
    public function editmoduledirect($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'Scribite::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        // Argument check
        if (!isset($args)) {
            return LogUtil::registerError ($this->__('Error! Could not do what you wanted. Please check your input.'));
        }

        if (!DBUtil::updateObject($args, 'scribite', '', 'mid')) {
            return LogUtil::registerError ($this->__('Configuration not updated'));
        }
        return true;

    }

// add module config
    public function addmodule($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'Scribite::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }
        // Argument check
        if (!isset($args['modulename']) || !isset($args['modfuncs']) || !isset($args['modareas']) || !isset($args['modeditor'])) {
            return LogUtil::registerError ($this->__('Error! Could not do what you wanted. Please check your input.'));
        }

        // add item
        $additem =   array('modname'   => $args['modulename'],
                'modfuncs'  => serialize(explode(',', $args['modfuncs'])),
                'modareas'  => serialize(explode(',', $args['modareas'])),
                'modeditor' => $args['modeditor']);

        if (!DBUtil::insertObject($additem, 'scribite', 'mid', false)) {
            return LogUtil::registerError ($this->__('Configuration not updated'));
        }
        return true;

    }

// update module config
    public function editmodule($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'Scribite::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        // Argument check
        if (!isset($args['mid']) || !isset($args['modulename']) || !isset($args['modfuncs']) || !isset($args['modareas'])  || !isset($args['modeditor'])) {
            return LogUtil::registerError ($this->__('Error! Could not do what you wanted. Please check your input.'));
        }

        // update item
        $updateitem = array('mid'       => $args['mid'],
                'modname'   => $args['modulename'],
                'modfuncs'  => serialize(explode(',', $args['modfuncs'])),
                'modareas'  => serialize(explode(',', $args['modareas'])),
                'modeditor' => $args['modeditor']);

        if (!DBUtil::updateObject($updateitem, 'scribite', '', 'mid')) {
            return LogUtil::registerError ($this->__('Configuration not updated'));
        }
        return true;

    }


// delete module config
    public function delmodule($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'Scribite::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }
        // Argument check
        if (!isset($args['mid'])) {
            return LogUtil::registerError ($this->__('Error! Could not do what you wanted. Please check your input.'));
        }

        // check for existing module
        if (!DBUtil::deleteObjectById('scribite', $args['mid'], 'mid')) {
            return LogUtil::registerError ($this->__('Configuration not updated'));
        }
        return true;

    }

// get module name from id
    public function getModuleConfigfromID($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'Scribite::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }
        // Argument check
        if (!isset($args['mid'])) {
            return LogUtil::registerError ($this->__('Error! Could not do what you wanted. Please check your input.'));
        }

        $item = DBUtil::selectObjectByID('scribite', $args['mid'], 'mid');

        return $item;

    }

// read plugin-folder from xinha and load names into array
    public function getxinhaPlugins($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $plugins = array();
        $pluginsdir = opendir($path . '/xinha/plugins');
        while (false !== ($f = readdir($pluginsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $plugins[$f] = $f;
            }
        }
        closedir($pluginsdir);
        // sort array
        asort($plugins);

        return $plugins;

    }

// read skins-folder from xinha and load names into array
    public function getxinhaSkins($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $skins = array();
        $skinsdir = opendir($path . '/xinha/skins');
        while (false !== ($f = readdir($skinsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $skins[$f] = $f;
            }
        }
        closedir($skinsdir);
        // sort array
        asort($skins);

        return $skins;

    }

// read lang-folder from xinha and load names into array
    public function getxinhaLangs($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $langs = array();
        $langsdir = opendir($path . '/xinha/lang');
        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && preg_match('/[.js]/', $f)) {
                $f = str_replace('.js', '', $f);
                $langs[$f] = $f;
            }
        }
        closedir($langsdir);
        // Add english as default editor language - this not exists as file in xinha
        $langs['en'] = 'en';
        // sort array
        asort($langs);

        return $langs;

    }

// read langs-folder from tiny_mce and load names into array
    public function gettinymceLangs($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $langs = array();
        $langsdir = opendir($path . '/tiny_mce/langs');
        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && preg_match('/[.js]/', $f)) {
                $f = str_replace('.js', '', $f);
                $langs[$f] = $f;
            }
        }
        closedir($langsdir);
        // sort array
        asort($langs);

        return $langs;

    }
// read themes-folder from tiny_mce and load names into array
    public function gettinymceThemes($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $themes = array();
        $themesdir = opendir($path . '/tiny_mce/themes');
        while (false !== ($f = readdir($themesdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $themes[$f] = $f;
            }
        }
        closedir($themesdir);
        // sort array
        asort($themes);

        return $themes;

    }
// read plugins from tiny_mce and load names into array
    public function gettinymcePlugins($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $plugins = array();
        $pluginsdir = opendir($path . '/tiny_mce/plugins');
        while (false !== ($f = readdir($pluginsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && $f != '_template' && !preg_match('/[.]/', $f))     {
                $plugins[$f] = $f;
            }
        }
        closedir($pluginsdir);
        // sort array
        asort($plugins);

        return $plugins;

    }
// read langs-folder from fckeditor and load names into array
    public function getfckeditorLangs($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $langs = array();
        $langsdir = opendir($path . '/fckeditor/editor/lang');
        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[_]/', $f)  && preg_match('/[.js]/', $f))     {
                $f = str_replace('.js', '', $f);
                $langs[$f] = $f;
            }
        }
        closedir($langsdir);
        // sort array
        asort($langs);

        return $langs;

    }
// read skins-folder from fckeditor and load names into array
    public function getfckeditorSkins($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $skins = array();
        $skinsdir = opendir($path . '/fckeditor/editor/skins');
        while (false !== ($f = readdir($skinsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $skins[$f] = $f;
            }
        }
        closedir($skinsdir);
        // sort array
        asort($skins);

        return $skins;

    }
// read plugins from fckeditor and load names into array
    public function getfckeditorPlugins($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');
        $plugins = array();
        $pluginsdir = opendir($path . '/fckeditor/editor/plugins');
        while (false !== ($f = readdir($pluginsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $plugins[$f] = $f;
            }
        }
        closedir($pluginsdir);
        // sort array
        asort($plugins);

        return $plugins;

    }
// load names into array
    public function getfckeditorBarmodes($args)
    {
        $barmodes = array();
        $barmodes['Default'] = 'Default';
        $barmodes['Basic']   = 'Basic';

        return $barmodes;

    }

// load names into array
    public function getyuitypes($args)
    {
        $types = array();
        $types['Simple'] = 'Simple';
        $types['Full']   = 'Full';

        return $types;

    }

    // read langs-folder from ckeditor and load names into array
    public function getckeditorLangs($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');

        $langs = array();
        $langsdir = opendir($path . '/ckeditor/lang');

        while (false !== ($f = readdir($langsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[_]/', $f)  && preg_match('/[.js]/', $f))     {
                $f = str_replace('.js', '', $f);
                $langs[$f] = $f;
            }
        }
        
        closedir($langsdir);

        // sort array
        asort($langs);

        return $langs;
    }

    // read skins-folder from ckeditor and load names into array
    public function getckeditorSkins($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');

        $skins = array();
        $skinsdir = opendir($path . '/ckeditor/skins');

        while (false !== ($f = readdir($skinsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $skins[$f] = $f;
            }
        }

        closedir($skinsdir);

        // sort array
        asort($skins);

        return $skins;
    }

    // read plugins from ckeditor and load names into array
    public function getckeditorPlugins($args)
    {
        $path = rtrim($this->getVar('editors_path'),'/');

        $plugins = array();
        $pluginsdir = opendir($path . '/ckeditor/plugins');

        while (false !== ($f = readdir($pluginsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/[.]/', $f)) {
                $plugins[$f] = $f;
            }
        }

        closedir($pluginsdir);

        // sort array
        asort($plugins);

        return $plugins;
    }

    // load names into array
    public function getckeditorBarmodes($args)
    {
        $barmodes = array();
        $barmodes['Full'] = 'Full';
        $barmodes['Basic']   = 'Basic';

        return $barmodes;

    }
}
