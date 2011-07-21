<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Api_User extends Zikula_AbstractApi
{
    // load module config from db into array or list all modules with config
    public function getModuleConfig($args)
    {
        if (!isset($args['modulename'])) {
            $args['modulename'] = ModUtil::getName();
        }

        $modconfig = array();
        if ($args['modulename'] == 'list') {
            $modconfig = DBUtil::selectObjectArray('scribite', '', 'modname');
        } else {
            $dbtables = DBUtil::getTables();
            $scribitecolumn = $dbtables['scribite_column'];
            $where = "$scribitecolumn[modname] = '" . $args['modulename'] . "'";
            $item = DBUtil::selectObjectArray('scribite', $where);

            if ($item == false) {
                return;
            }

            $modconfig['mid'] = $item[0]['mid'];
            $modconfig['modulename'] = $item[0]['modname'];
            if (!is_int($item[0]['modfuncs'])) {
                $modconfig['modfuncs'] = unserialize($item[0]['modfuncs']);
            }
            if (!is_int($item[0]['modareas'])) {
                $modconfig['modareas'] = unserialize($item[0]['modareas']);
            }
            $modconfig['modeditor'] = $item[0]['modeditor'];
        }
        return $modconfig;
    }

    // read editors folder and load names into array
    // has to be changed with args!!
    public function getEditors($args)
    {
        $editorname = $args['editorname'];
        $editors = array();
        $path = rtrim($this->getVar('editors_path'), '/');
        $editorsdir = opendir($path);
        while (false !== ($f = readdir($editorsdir))) {
            if ($f != '.' && $f != '..' && $f != 'CVS' && !preg_match('/\./', $f)) {
                $editors[$f] = $f;
            }
        }
        closedir($editorsdir);
        // Add "-" as default for no editor
        $editors['-'] = '-';
        // Add YUI as editor - files are loaded from Yahoo server, so no check is needed
        $editors['yui'] = 'yui';
        asort($editors);

        // list will give a full list of installed editors
        if ($editorname == 'list') {
            return $editors;
        } else { // check if given editorname is available
            if (in_array($editorname, $editors)) {
                $editor_active = 1;
            } else {
                $editor_active = 0;
            }
            return $editor_active;
        }
    }

    // load IM/EFM settings for Xinha and pass vars to session
    // not implemented yet ;)
    public function getEFMConfig($args)
    {
        // get editors path and load xinha scripts
        $editors_path = $this->getVar('editors_path');
        require_once $editors_path . '/xinha/contrib/php-xinha.php';

        $zikulaBaseURI = rtrim(System::getBaseUri(), '/');
        $zikulaBaseURI = ltrim($zikulaBaseURI, '/');
        $zikulaRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

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
                "psd", "png", "html", "swf",
                "xml", "xls");

        xinha_pass_to_php_backend($IMConfig);
        return $IMConfig;
    }

    /**
     * Initialise scribite for requested areas.
     *
     * @param array $args Text area: 'area', Module name: 'modulename'.
     *
     * @return string
     */
    public static function loader($args)
    {
        $dom = ZLanguage::getModuleDomain('Scribite');
        // Argument checks
        if (!isset($args['areas'])) {
            return LogUtil::registerError(__('Error! Scribite_Api_User::loader() "area" argument was empty.', $dom));
        }
        if (!isset($args['modulename'])) {
            $args['modulename'] = ModUtil::getName();
        }

        $module = $args['modulename'];

        // Security check if user has COMMENT permission for scribite and module
        if (!SecurityUtil::checkPermission('Scribite::', "$module::", ACCESS_COMMENT)) {
            return;
        }

        // check for editor argument, if none given the default editor will be used
        if (!isset($args['editor']) || empty($args['editor'])) {
            // get default editor from config
            $defaulteditor = ModUtil::getVar('Scribite', 'DefaultEditor');
            if ($defaulteditor == '-') {
                return; // return if no default is set and no arg is given
                // id given editor doesn't exist use default editor
            } else {
                $args['editor'] = $defaulteditor;
            }
        }

        // check if editor argument exists, load default if not given
        if (ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => $args['editor']))) {

            // set some general parameters
            $zBaseUrl = rtrim(System::getBaseUrl(), '/');
            $zikulaThemeBaseURL = "$zBaseUrl/themes/" . DataUtil::formatForOS(UserUtil::getTheme());
            $zikulaBaseURI = rtrim(System::getBaseUri(), '/');
            $zikulaBaseURI = ltrim($zikulaBaseURI, '/');
            $zikulaRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

            // prepare view instance
            $view = Zikula_View::getInstance('Scribite');
            $view->setCaching(false);
            $view->assign(ModUtil::getVar('Scribite'));
            $view->assign('modname', $args['modulename']);
            $view->assign('zBaseUrl', $zBaseUrl);
            $view->assign('zikulaBaseURI', $zikulaBaseURI);
            $view->assign('zikulaRoot', $zikulaRoot);
            $view->assign('editor_dir', $args['editor']);
            $view->assign('zlang', ZLanguage::getLanguageCode());

            // check for modules installed providing plugins and load specific javascripts
            if (ModUtil::available('photoshare')) {
                PageUtil::AddVar('javascript', 'modules/photoshare/javascript/findimage.js');
            }
            if (ModUtil::available('mediashare')) {
                PageUtil::AddVar('javascript', 'modules/mediashare/javascript/finditem.js');
            }
            if (ModUtil::available('pagesetter')) {
                PageUtil::AddVar('javascript', 'modules/pagesetter/javascript/findpub.js');
            }
            if (ModUtil::available('folder')) {
                PageUtil::AddVar('javascript', 'modules/folder/javascript/selector.js');
            }
            if (ModUtil::available('MediaAttach')) {
                PageUtil::AddVar('javascript', 'modules/MediaAttach/javascript/finditem.js');
            }
            if (ModUtil::available('Files')) {
                PageUtil::AddVar('javascript', 'modules/Files/javascript/getFiles.js');
            }

            // main switch for choosen editor
            switch ($args['editor']) {

                case 'xinha':

                    // get xinha config if editor is active
                    // get plugins for xinha
                    $xinha_listplugins = ModUtil::getVar('Scribite', 'xinha_activeplugins');
                    if ($xinha_listplugins != '') {
                        $xinha_listplugins = unserialize($xinha_listplugins);
                        /* if (in_array('ExtendedFileManager', $xinha_listplugins)) {
                          $view->assign('EFMConfig', true);
                          } else { */
                        $view->assign('EFMConfig', false);
                        //}
                        $xinha_listplugins = '\'' . DataUtil::formatForDisplay(implode('\', \'', $xinha_listplugins)) . '\'';
                    }

                    // prepare areas for xinha
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } elseif ($args['areas'][0] == "PagEd") {
                        $modareas = 'PagEd';
                    } else {
                        $modareas = '\'' . DataUtil::formatForDisplay(implode('\', \'', $args['areas'])) . '\'';
                    }

                    // load Prototype
                    PageUtil::AddVar('javascript', 'prototype');

                    // set parameters
                    $view->assign('modareas', $modareas);
                    $view->assign('xinha_listplugins', $xinha_listplugins);

                    // end xinha
                    break;

// openwysiwyg deprecated @4.3.0
//                case 'openwysiwyg':
//                    // get openwysiwyg config if editor is active
//                    // prepare areas for openwysiwyg
//                    if ($args['areas'][0] == "all") {
//                        $modareas = 'all';
//                    } else {
//                        $modareas = $args['areas'];
//                    }
//
//                    // set parameters
//                    $view->assign('modareas', $modareas);
//
//                    // end openwysiwyg
//                    break;

                case 'nicedit':
                    // get nicEditor config if editor is active
                    // prepare areas for nicEditor
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } else {
                        $modareas = $args['areas'];
                    }

                    // set parameters
                    $view->assign('modareas', $modareas);

                    // end nicEditor
                    break;

                case 'yui':
                    // set body class for YUI Editor
                    PageUtil::SetVar('body', 'class="yui-skin-sam"');

                    // get YUI mode from config
                    $yui_type = ModUtil::getVar('Scribite', 'yui_type');

                    // type switch
                    if ($yui_type == 'Simple') {
                        // load scripts for YUI simple mode
                        PageUtil::AddVar('stylesheet', 'http://yui.yahooapis.com/2.9.0/build/assets/skins/sam/skin.css');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/element/element-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/container/container_core-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/editor/simpleeditor-min.js');
                    } else {
                        // load scripts for YUI Editor full mode
                        PageUtil::AddVar('stylesheet', 'http://yui.yahooapis.com/2.9.0/build/assets/skins/sam/skin.css');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/element/element-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/container/container_core-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/menu/menu-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/button/button-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.9.0/build/editor/editor-min.js');
                    }

                    // prepare areas for YUI
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } else {
                        $modareas = $args['areas'];
                    }

                    // set parameters
                    $view->assign('modareas', $modareas);

                    // end yui
                    break;

                case 'ckeditor':
                    // get CKEditor config if editor is active
                    // prepare areas
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } else {
                        $modareas = $args['areas'];
                    }

                    // check for allowed html
                    $AllowableHTML = System::getVar('AllowableHTML');
                    $disallowedhtml = array();
                    while (list($key, $access) = each($AllowableHTML)) {
                        if ($access == 0) {
                            $disallowedhtml[] = DataUtil::formatForDisplay($key);
                        }
                    }

                    // load Prototype
                    PageUtil::AddVar('javascript', 'javascript/ajax/prototype.js');

                    // set parameters
                    $view->assign('modareas', $modareas);
                    $view->assign('disallowedhtml', $disallowedhtml);

                    // end ckeditor
                    break;
					case 'markitup':
                    // get markitup config if editor is active
                    // prepare areas
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } else {
                        $modareas = $args['areas'];
                    }

                    // check for allowed html
                    $AllowableHTML = System::getVar('AllowableHTML');
                    $disallowedhtml = array();
                    while (list($key, $access) = each($AllowableHTML)) {
                        if ($access == 0) {
                            $disallowedhtml[] = DataUtil::formatForDisplay($key);
                        }
                    }

					// set parameters
                    $view->assign('modareas', $modareas);
                    $view->assign('disallowedhtml', $disallowedhtml);

                    // end markitup
                    break;
            }

            // view output
            // 1. check if special template is required (from direct module call)
            if (isset($args['tpl']) && $view->template_exists($args['tpl'])) {
                $templatefile = $args['tpl'];
                // 2. check if a module specific template exists
            } elseif ($view->template_exists('editorheaders/' . $args['editor'] . '_' . $args['modulename'] . '.tpl')) {
                $templatefile = 'editorheaders/' . $args['editor'] . '_' . $args['modulename'] . '.tpl';
                // 3. if none of the above load default template
            } else {
                $templatefile = 'editorheaders/' . $args['editor'] . '.tpl';
            }
            $output = $view->fetch($templatefile);
            // end main switch

            return $output;
        }
    }
}