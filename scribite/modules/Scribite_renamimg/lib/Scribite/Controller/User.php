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

class Scribite_Controller_User extends Zikula_Controller
{
//  scribite! not offers a user interface - so redirect to index.php
    public function main()
    {
        return System::redirect('index.php');
    }

//  deprecated since Zikula 1.1.x supports systemhooks
    public function editorheader($args)
    {
        return;
    }

//  Load scribite! from systemhook
    public function run($args)
    {

        // get the module name
        $args['modulename'] = ModUtil::getName();
        $module = $args['modulename'];

        // exit if Content module active - to avoid double loadings if user has given ids and functions
        if ($args['modulename'] == 'content') {
            return;
        }

        // Security check if user has COMMENT permission for scribite
        if (!SecurityUtil::checkPermission('scribite::', '$module::', ACCESS_COMMENT)) {
            return;
        }

        // get passed func
        $func = FormUtil::getPassedValue('func', isset($args['func']) ? $args['func'] : null, 'GET');

        // get config for current module
        $modconfig = array();
        $modconfig = ModUtil::apiFunc('Scribite', 'user', 'getModuleConfig', array('modulename' => $args['modulename']));

        // return if module is not supported or editor is not set
        if (!$modconfig['mid'] || $modconfig['modeditor'] == '-') {
            return;
        }

        // check if current func is fine for editors or funcs is empty (or all funcs)
        if (in_array($func, $modconfig['modfuncs']) || $modconfig['modfuncs'][0] == 'all') {
            $args['areas']  = $modconfig['modareas'];
            $args['editor'] = $modconfig['modeditor'];

            $scribite = ModUtil::func('scribite','user','loader', array('modulename' => $args['modulename'],
                    'editor'     => $args['editor'],
                    'areas'      => $args['areas']));

            // add the scripts to page header
            PageUtil::AddVar('rawtext', $scribite);

        }
    }

//  scribite! loader
//  used for direct calls from modules - see dev-docs for use
    public function loader($args)
    {
        // Argument checks
        if (!isset($args['areas'])) {
            return LogUtil::registerError($this->__('Error! Could not do what you wanted. Please check your input.'));
        }
        if (!isset($args['modulename'])) {
            $args['modulename'] = ModUtil::getName();
        }

        $module = $args['modulename'];

        // Security check if user has COMMENT permission for scribite and module
        if (!SecurityUtil::checkPermission('scribite::', '$module::', ACCESS_COMMENT)) {
            return;
        }

        // check for editor argument, if none given the default editor will be used
        if (!$args['editor']) {
            // get default editor from config
            $defaulteditor = $this->getVar('DefaultEditor');
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
            $zBaseUrl        = rtrim(System::getBaseUrl(),'/');
            $zikulaThemeBaseURL   = "$zBaseUrl/themes/" . DataUtil::formatForOS(UserUtil::getTheme());
            $zikulaBaseURI        = rtrim(System::getBaseUri(),'/');
            $zikulaBaseURI        = ltrim($zikulaBaseURI,'/');
            $zikulaRoot           = rtrim($_SERVER['DOCUMENT_ROOT'],'/');

            // prepare view instance
            $this->view->setCaching(false);
            $this->view->assign($this->getVars());
            $this->view->assign('modname', $args['modulename']);
            $this->view->assign('zBaseUrl', $zBaseUrl);
            $this->view->assign('zikulaBaseURI', $zikulaBaseURI);
            $this->view->assign('zikulaRoot', $zikulaRoot);
            $this->view->assign('editor_dir', $args['editor']);
            $this->view->assign('zlang', ZLanguage::getLanguageCode());

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
                    $xinha_listplugins = $this->getVar('xinha_activeplugins');
                    if ($xinha_listplugins != '') {
                        $xinha_listplugins = unserialize($xinha_listplugins);
                        /* if (in_array('ExtendedFileManager', $xinha_listplugins)) {
                        $this->view->assign('EFMConfig', true);
                    } else { */
                        $this->view->assign('EFMConfig', false);
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
                    $this->view->assign('modareas', $modareas);
                    $this->view->assign('xinha_listplugins', $xinha_listplugins);

                    // end xinha
                    break;

                case 'tiny_mce':
                // get TinyMCE config if editor is active

                // get plugins for tiny_mce
                    $tinymce_listplugins = $this->getVar('tinymce_activeplugins');
                    if ($tinymce_listplugins != '') {
                        $tinymce_listplugins = unserialize($tinymce_listplugins);
                        $tinymce_listplugins = DataUtil::formatForDisplay(implode(',', $tinymce_listplugins));
                    }
                    // prepare areas for tiny_mce
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } elseif ($args['areas'][0] == "PagEd") {
                        $modareas = 'PagEd';
                    } else {
                        $modareas = DataUtil::formatForDisplay(implode(',', $args['areas']));
                    }

                    // check for allowed html
                    $AllowableHTML = System::getVar('AllowableHTML');
                    $disallowedhtml = array();
                    while (list($key, $access) = each($AllowableHTML)) {
                        if ($access == 0) {
                            $disallowedhtml[] = DataUtil::formatForDisplay($key);
                        }
                    }

                    // pass disallowed html
                    $disallowedhtml = implode(',', $disallowedhtml);

                    // set parameters
                    $this->view->assign('modareas', $modareas);
                    $this->view->assign('tinymce_listplugins', $tinymce_listplugins);
                    $this->view->assign('disallowedhtml', $disallowedhtml);

                    // end tiny_mce
                    break;

                case 'fckeditor':
                // get FCKeditor config if editor is active

                // prepare areas for xinha
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } elseif ($args['areas'][0] == "PagEd") {
                        $modareas = 'PagEd';
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
                    $this->view->assign('modareas', $modareas);
                    $this->view->assign('disallowedhtml', $disallowedhtml);

                    // end fckeditor
                    break;

                case 'openwysiwyg':
                // get openwysiwyg config if editor is active

                // prepare areas for openwysiwyg
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } else {
                        $modareas = $args['areas'];
                    }

                    // set parameters
                    $this->view->assign('modareas', $modareas);

                    // end openwysiwyg
                    break;

                case 'nicedit':
                // get nicEditor config if editor is active

                // prepare areas for nicEditor
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } else {
                        $modareas = $args['areas'];
                    }

                    // set parameters
                    $this->view->assign('modareas', $modareas);

                    // end nicEditor
                    break;

                case 'yui':
                // set body class for YUI Editor
                    PageUtil::SetVar('body', 'class="yui-skin-sam"');

                    // get YUI mode from config
                    $yui_type = $this->getVar('yui_type');

                    // type switch
                    if ($yui_type == 'Simple') {
                        // load scripts for YUI simple mode
                        PageUtil::AddVar('stylesheet', 'http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/element/element-beta-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/container/container_core-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/editor/simpleeditor-min.js');
                    } else {
                        // load scripts for YUI Editor full mode
                        PageUtil::AddVar('stylesheet', 'http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/element/element-beta-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/container/container_core-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/menu/menu-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/button/button-min.js');
                        PageUtil::AddVar('javascript', 'http://yui.yahooapis.com/2.6.0/build/editor/editor-min.js');
                    }

                    // prepare areas for YUI
                    if ($args['areas'][0] == "all") {
                        $modareas = 'all';
                    } else {
                        $modareas = $args['areas'];
                    }

                    // set parameters
                    $this->view->assign('modareas', $modareas);

                    // end yui
                    break;

            }

            // view output
            // 1. check if special template is required (from direct module call)
            if (isset($args['tpl']) && $this->view->template_exists($args['tpl'])) {
                $templatefile = $args['tpl'];
                // 2. check if a module specific template exists
            } elseif ($this->view->template_exists('scribite_'.$args['editor'].'_'.$args['modulename'].'.htm')) {
                $templatefile = 'scribite_'.$args['editor'].'_'.$args['modulename'].'.htm';
                // 3. if none of the above load default template
            } else {
                $templatefile = 'scribite_'.$args['editor'].'_editorheader.htm';
            }
            $output = $this->view->fetch($templatefile);
            // end main switch

            return $output;
        }
    }
}