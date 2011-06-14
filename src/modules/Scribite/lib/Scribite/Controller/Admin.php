<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Controller_Admin extends Zikula_AbstractController
{

    public function postInitialize()
    {
        PageUtil::AddVar('javascript', 'prototype');
        //PageUtil::AddVar('javascript', 'javascript/ajax/scriptaculous.js');
        $this->view->setCaching(false);
    }

    // main function
    public function main()
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->redirect(ModUtil::url('Scribite', 'admin', 'modules'));
    }

    // modify scribite! configuration
    public function modifyconfig($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // load all editors
        $this->view->assign('editor_list', ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => 'list')));

        return $this->view->fetch('scribite_admin_modifyconfig.tpl');
    }

    // display modules
    public function modules($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->view->assign('editor_list', ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => 'list')));
        $this->view->assign('modconfig', ModUtil::apiFunc('Scribite', 'user', 'getModuleConfig', array('modulename' => "list")));

        return $this->view->fetch('scribite_admin_modules.tpl');
    }

    public function updateconfig($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        // modify editors in db
        $modconfig = FormUtil::getPassedValue('modconfig', null, 'REQUEST');
        foreach ($modconfig as $mod) {
            ModUtil::apiFunc('Scribite', 'admin', 'editmoduledirect', $mod);
        }

        // modify editors path in db
        $editors_path = FormUtil::getPassedValue('editors_path', 'javascript/scribite_editors', 'REQUEST');
        if (!$this->setVar('editors_path', $editors_path)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        // modify default editor
        $DefaultEditor = FormUtil::getPassedValue('DefaultEditor', '-', 'REQUEST');
        if (!$this->setVar('DefaultEditor', $DefaultEditor)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }

        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));
        return System::redirect(ModUtil::url('scribite', 'admin', 'main'));
    }

    // add new module config to scribite
    public function newmodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get all editors
        $this->view->assign('editor_list', ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => 'list')));
        return $this->view->fetch('scribite_admin_addmodule.tpl');
    }

    // add new module to database
    public function addmodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        // get args from template
        $modulename = FormUtil::getPassedValue('modulename', null, 'REQUEST');
        $modfuncs = FormUtil::getPassedValue('modfuncs', null, 'REQUEST');
        $modareas = FormUtil::getPassedValue('modareas', null, 'REQUEST');
        $modeditor = FormUtil::getPassedValue('modeditor', null, 'REQUEST');

        // create new module in db
        $mid = ModUtil::apiFunc('Scribite', 'admin', 'addmodule', array('modulename' => $modulename,
                    'modfuncs' => $modfuncs,
                    'modareas' => $modareas,
                    'modeditor' => $modeditor));

        // Error tracking
        if ($mid != false) {
            // Success
            LogUtil::registerStatus($this->__('Done! Module configuration updated.'));
        } else {
            // Error
            LogUtil::registerStatus($this->__('Configuration not updated'));
        }

        // return to main form
        return System::redirect(ModUtil::url('scribite', 'admin', 'modules'));
    }

    // edit module config
    public function modifymodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $mid = FormUtil::getPassedValue('mid', null, 'REQUEST');

        // get config for current module
        $modconfig = ModUtil::apiFunc('Scribite', 'admin', 'getModuleConfigfromID', array('mid' => $mid));

        $modules = ModUtil::getAllMods();

        // get all editors
        $this->view->assign('editor_list', ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => 'list')));
        $this->view->assign('mid', $modconfig['mid']);
        $this->view->assign('modulename', $modconfig['modname']);
        $this->view->assign('modfuncs', implode(',', unserialize($modconfig['modfuncs'])));
        $this->view->assign('modareas', implode(',', unserialize($modconfig['modareas'])));
        $this->view->assign('modeditor', $modconfig['modeditor']);

        return $this->view->fetch('scribite_admin_modifymodule.tpl');
    }

    // update module config in database
    public function updatemodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        // get passed args and store to array
        $modconfig['mid'] = FormUtil::getPassedValue('mid', null, 'REQUEST');
        $modconfig['modulename'] = FormUtil::getPassedValue('modulename', null, 'REQUEST');
        $modconfig['modfuncs'] = FormUtil::getPassedValue('modfuncs', null, 'REQUEST');
        $modconfig['modareas'] = FormUtil::getPassedValue('modareas', null, 'REQUEST');
        $modconfig['modeditor'] = FormUtil::getPassedValue('modeditor', null, 'REQUEST');

        $mod = ModUtil::apiFunc('Scribite', 'admin', 'editmodule', $modconfig);

        // error tracking
        if ($mod != false) {
            // Success
            LogUtil::registerStatus($this->__('Done! Module configuration updated.'));
        } else {
            // Error
            LogUtil::registerStatus($this->__('Configuration not updated'));
        }

        $this->redirect(ModUtil::url('scribite', 'admin', 'modules'));
    }

    public function delmodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get module id
        $mid = FormUtil::getPassedValue('mid', null, 'REQUEST');

        // get module config and name from id
        $modconfig = ModUtil::apiFunc('Scribite', 'admin', 'getModuleConfigfromID', array('mid' => $mid));

        // create smarty instance
        $this->view->assign('mid', $mid);
        $this->view->assign('modulename', $modconfig['modname']);
        return $this->view->fetch('scribite_admin_delmodule.tpl');
    }

    // del module config in database
    public function removemodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        // get passed args
        $args['mid'] = FormUtil::getPassedValue('mid', null, 'REQUEST');

        // remove module entry from scribite! table
        $mod = ModUtil::apiFunc('Scribite', 'admin', 'delmodule', array('mid' => $args['mid']));

        if ($mod != false) {
            // Success
            LogUtil::registerStatus($this->__('Done! Module configuration updated.'));
        }

        // return to main page
        return System::redirect(ModUtil::url('scribite', 'admin', 'main'));
    }

    public function modifyxinha($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // create smarty instance
        $this->view->assign($this->getVars());
        $this->view->assign('xinha_langlist', ModUtil::apiFunc('Scribite', 'admin', 'getxinhaLangs'));
        $this->view->assign('xinha_skinlist', ModUtil::apiFunc('Scribite', 'admin', 'getxinhaSkins'));
        $this->view->assign('xinha_allplugins', ModUtil::apiFunc('Scribite', 'admin', 'getxinhaPlugins'));
        return $this->view->fetch('scribite_admin_modifyxinha.tpl');
    }

    public function updatexinha($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $xinha_language = FormUtil::getPassedValue('xinha_language', 'en', 'REQUEST');
        $xinha_skin = FormUtil::getPassedValue('xinha_skin', 'blue-look', 'REQUEST');
        $xinha_barmode = FormUtil::getPassedValue('xinha_barmode', 'reduced', 'REQUEST');
        $xinha_width = FormUtil::getPassedValue('xinha_width', 'auto', 'REQUEST');
        $xinha_height = FormUtil::getPassedValue('xinha_height', 'auto', 'REQUEST');
        $xinha_style = FormUtil::getPassedValue('xinha_style', 'modules/Scribite/config/xinha/editor.css', 'REQUEST');
        $xinha_converturls = FormUtil::getPassedValue('xinha_converturls', '0', 'REQUEST');
        $xinha_showloading = FormUtil::getPassedValue('xinha_showloading', '0', 'REQUEST');
        $xinha_statusbar = FormUtil::getPassedValue('xinha_statusbar', 1, 'REQUEST');
        $xinha_activeplugins = FormUtil::getPassedValue('xinha_activeplugins', null, 'REQUEST');

        $this->checkCsrfToken();

        if (!$this->setVar('xinha_language', $xinha_language)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('xinha_skin', $xinha_skin)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('xinha_barmode', $xinha_barmode)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $xinha_width = rtrim($xinha_width, 'px');
        if (!$this->setVar('xinha_width', $xinha_width)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $xinha_height = rtrim($xinha_height, 'px');
        if (!$this->setVar('xinha_height', $xinha_height)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $xinha_style = ltrim($xinha_style, '/');
        if (!$this->setVar('xinha_style', $xinha_style)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('xinha_converturls', $xinha_converturls)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('xinha_showloading', $xinha_showloading)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('xinha_statusbar', $xinha_statusbar)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!empty($xinha_activeplugins)) {
            $xinha_activeplugins = serialize($xinha_activeplugins);
        }
        if (!$this->setVar('xinha_activeplugins', $xinha_activeplugins)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }

        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));
        return System::redirect(ModUtil::url('scribite', 'admin', 'modifyxinha'));
    }

    public function modifyopenwysiwyg($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // create smarty instance
        $this->view->assign($this->getVars());

        return $this->view->fetch('scribite_admin_modifyopenwysiwyg.tpl');
    }

    public function updateopenwysiwyg($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $openwysiwyg_barmode = FormUtil::getPassedValue('openwysiwyg_barmode', 'small', 'REQUEST');
        $openwysiwyg_width = FormUtil::getPassedValue('openwysiwyg_width', '500px', 'REQUEST');
        $openwysiwyg_height = FormUtil::getPassedValue('openwysiwyg_height', '300px', 'REQUEST');

        $this->checkCsrfToken();

        if (!$this->setVar('openwysiwyg_barmode', $openwysiwyg_barmode)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $openwysiwyg_width = rtrim($openwysiwyg_width, 'px');
        if (!$this->setVar('openwysiwyg_width', $openwysiwyg_width)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $openwysiwyg_height = rtrim($openwysiwyg_height, 'px');
        if (!$this->setVar('openwysiwyg_height', $openwysiwyg_height)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }

        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return System::redirect(ModUtil::url('scribite', 'admin', 'modifyopenwysiwyg'));
    }

    // TinyMCE is deprecated - function deprecated
    public function modifytinymce($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // create smarty instance
        $this->view->assign($this->getVars());
        $this->view->assign('tinymce_langlist', ModUtil::apiFunc('Scribite', 'admin', 'gettinymceLangs'));
        $this->view->assign('tinymce_themelist', ModUtil::apiFunc('Scribite', 'admin', 'gettinymceThemes'));
        $this->view->assign('tinymce_allplugins', ModUtil::apiFunc('Scribite', 'admin', 'gettinymcePlugins'));

        return $this->view->fetch('scribite_admin_modifytinymce.tpl');
    }

    // TinyMCE is deprecated - function deprecated
    public function updatetinymce($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $tinymce_language = FormUtil::getPassedValue('tinymce_language', 'en', 'REQUEST');
        $tinymce_style = FormUtil::getPassedValue('tinymce_style', 'modules/Scribite/config/tiny_mce/editor.css', 'REQUEST');
        $tinymce_theme = FormUtil::getPassedValue('tinymce_theme', 'advanced', 'REQUEST');
        $tinymce_width = FormUtil::getPassedValue('tinymce_width', '75%', 'REQUEST');
        $tinymce_height = FormUtil::getPassedValue('tinymce_height', '400', 'REQUEST');
        $tinymce_activeplugins = FormUtil::getPassedValue('tinymce_activeplugins', 'en', 'REQUEST');
        $tinymce_dateformat = FormUtil::getPassedValue('tinymce_dateformat', '%Y-%m-%d', 'REQUEST');
        $tinymce_timeformat = FormUtil::getPassedValue('tinymce_timeformat', '%H:%M:%S', 'REQUEST');

        $this->checkCsrfToken();

        if (!$this->setVar('tinymce_language', $tinymce_language)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $tinymce_style = ltrim($tinymce_style, '/');
        if (!$this->setVar('tinymce_style', $tinymce_style)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('tinymce_theme', $tinymce_theme)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $tinymce_width = rtrim($tinymce_width, 'px');
        if (!$this->setVar('tinymce_width', $tinymce_width)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $tinymce_height = rtrim($tinymce_height, 'px');
        if (!$this->setVar('tinymce_height', $tinymce_height)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!empty($tinymce_activeplugins)) {
            $tinymce_activeplugins = serialize($tinymce_activeplugins);
        }
        if (!$this->setVar('tinymce_activeplugins', $tinymce_activeplugins)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('tinymce_dateformat', $tinymce_dateformat)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('tinymce_timeformat', $tinymce_timeformat)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }

        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return System::redirect(ModUtil::url('scribite', 'admin', 'modifytinymce'));
    }

    // FCKeditor is deprecated - function deprecated
    public function modifyfckeditor($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $this->view->assign($this->getVars());
        $this->view->assign('fckeditor_barmodelist', ModUtil::apiFunc('Scribite', 'admin', 'getfckeditorBarmodes'));
        $this->view->assign('fckeditor_langlist', ModUtil::apiFunc('Scribite', 'admin', 'getfckeditorLangs'));

        return $this->view->fetch('scribite_admin_modifyfckeditor.tpl');
    }

    // FCKeditor is deprecated - function deprecated
    public function updatefckeditor($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $fckeditor_language = FormUtil::getPassedValue('fckeditor_language', 'en', 'REQUEST');
        $fckeditor_barmode = FormUtil::getPassedValue('fckeditor_barmode', 'Default', 'REQUEST');
        $fckeditor_width = FormUtil::getPassedValue('fckeditor_width', '500', 'REQUEST');
        $fckeditor_height = FormUtil::getPassedValue('fckeditor_height', '400', 'REQUEST');
        $fckeditor_autolang = FormUtil::getPassedValue('fckeditor_autolang', 0, 'REQUEST');

        $this->checkCsrfToken();

        if (!$this->setVar('fckeditor_language', $fckeditor_language)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('fckeditor_barmode', $fckeditor_barmode)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $fckeditor_width = rtrim($fckeditor_width, 'px');
        if (!$this->setVar('fckeditor_width', $fckeditor_width)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $fckeditor_height = rtrim($fckeditor_height, 'px');
        if (!$this->setVar('fckeditor_height', $fckeditor_height)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('fckeditor_autolang', $fckeditor_autolang)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }

        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return System::redirect(ModUtil::url('scribite', 'admin', 'modifyfckeditor'));
    }

    public function modifynicedit($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // create smarty instance
        $this->view->assign($this->getVars());

        return $this->view->fetch('scribite_admin_modifynicedit.tpl');
    }

    public function updatenicedit($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $nicedit_fullpanel = FormUtil::getPassedValue('nicedit_fullpanel', 0, 'REQUEST');
        $nicedit_xhtml = FormUtil::getPassedValue('nicedit_xhtml', 0, 'REQUEST');

        $this->checkCsrfToken();

        if (!$this->setVar('nicedit_fullpanel', $nicedit_fullpanel)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('nicedit_xhtml', $nicedit_xhtml)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }

        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return System::redirect(ModUtil::url('scribite', 'admin', 'modifynicedit'));
    }

    public function modifyyui($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // create smarty instance
        $this->view->assign($this->getVars());

        // Get yui types
        $this->view->assign('yui_types', ModUtil::apiFunc('Scribite', 'admin', 'getyuitypes'));

        return $this->view->fetch('scribite_admin_modifyyui.tpl');
    }

    public function updateyui($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $yui_type = FormUtil::getPassedValue('yui_type', 'Simple', 'REQUEST');
        $yui_width = FormUtil::getPassedValue('yui_width', 'auto', 'REQUEST');
        $yui_height = FormUtil::getPassedValue('yui_height', 'auto', 'REQUEST');
        $yui_dombar = FormUtil::getPassedValue('yui_dombar', false, 'REQUEST');
        $yui_animate = FormUtil::getPassedValue('yui_animate', false, 'REQUEST');
        $yui_collapse = FormUtil::getPassedValue('yui_collapse', false, 'REQUEST');

        $this->checkCsrfToken();

        if (!$this->setVar('yui_type', $yui_type)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('yui_width', $yui_width)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('yui_height', $yui_height)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('yui_dombar', $yui_dombar)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('yui_animate', $yui_animate)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('yui_collapse', $yui_collapse)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return System::redirect(ModUtil::url('scribite', 'admin', 'modifyyui'));
    }

    // CKEditor
    public function modifyckeditor($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $this->view->assign($this->getVars());
        $this->view->assign('ckeditor_barmodelist', ModUtil::apiFunc('Scribite', 'admin', 'getckeditorBarmodes'));
        $this->view->assign('ckeditor_langlist', ModUtil::apiFunc('Scribite', 'admin', 'getckeditorLangs'));

        return $this->view->fetch('scribite_admin_modifyckeditor.tpl');
    }

    public function updateckeditor($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $ckeditor_language = FormUtil::getPassedValue('ckeditor_language', 'en', 'REQUEST');
        $ckeditor_barmode = FormUtil::getPassedValue('ckeditor_barmode', 'Full', 'REQUEST');
        $ckeditor_width = FormUtil::getPassedValue('ckeditor_width', '"100%"', 'REQUEST');
        $ckeditor_height = FormUtil::getPassedValue('ckeditor_height', '400', 'REQUEST');

        $this->checkCsrfToken();

        if (!$this->setVar('ckeditor_language', $ckeditor_language)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        if (!$this->setVar('ckeditor_barmode', $ckeditor_barmode)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $ckeditor_width = rtrim($ckeditor_width, 'px');
        if (!$this->setVar('ckeditor_width', $ckeditor_width)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }
        $ckeditor_height = rtrim($ckeditor_height, 'px');
        if (!$this->setVar('ckeditor_height', $ckeditor_height)) {
            LogUtil::registerStatus($this->__('Configuration not updated'));
            return false;
        }

        // the module configuration has been updated successfuly
        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return System::redirect(ModUtil::url('scribite', 'admin', 'modifyckeditor'));
    }

}
