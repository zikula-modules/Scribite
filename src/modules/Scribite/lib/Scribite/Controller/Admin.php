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

    // modify Scribite configuration
    public function modifyconfig($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // load all editors
        $this->view->assign('editor_list', ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => 'list')));

        return $this->view->fetch('admin/modifyconfig.tpl');
    }

    // display modules
    public function modules($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->view->assign('editor_list', ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => 'list')));
        $modules = ModUtil::apiFunc('Scribite', 'user', 'getModuleConfig', array('modulename' => "list"));
        foreach ($modules as $key => $module) {
            $modules[$key]['modfunclist'] = implode(", ", unserialize($module['modfuncs']));
            $modules[$key]['modarealist'] = implode(", ", unserialize($module['modareas']));
            $modules[$key]['modeditortitle'] = ModUtil::apiFunc('Scribite', 'user', 'getEditorTitle', array('editorname' => $modules[$key]['modeditor']));
        }
        $this->view->assign('modconfig', $modules);

        return $this->view->fetch('admin/modules.tpl');
    }

    public function updateconfig($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        $vars['editors_path'] = FormUtil::getPassedValue('editors_path', 'modules/Scribite/pnincludes', 'POST');
        $vars['DefaultEditor'] = FormUtil::getPassedValue('DefaultEditor', '-', 'POST');

        if (!$this->setVars($vars)) {
            LogUtil::registerError($this->__('Error: Configuration not updated'));
        } else {
            LogUtil::registerStatus($this->__('Done! Module configuration updated.'));
        }
        $this->redirect(ModUtil::url('Scribite', 'admin', 'modifyconfig'));
    }

    // add new module config to Scribite
    public function newmodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get all editors
        $this->view->assign('editor_list', ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => 'list')));
        return $this->view->fetch('admin/addmodule.tpl');
    }

    // add new module to database
    public function addmodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        // get args from template
        $modulename = FormUtil::getPassedValue('modulename', null, 'POST');
        $modfuncs = FormUtil::getPassedValue('modfuncs', null, 'POST');
        $modareas = FormUtil::getPassedValue('modareas', null, 'POST');
        $modeditor = FormUtil::getPassedValue('modeditor', null, 'POST');

        // create new module in db
        $mid = ModUtil::apiFunc('Scribite', 'admin', 'addmodule', array('modulename' => $modulename,
                    'modfuncs' => $modfuncs,
                    'modareas' => $modareas,
                    'modeditor' => $modeditor));

        // Error tracking
        if ($mid != false) {
            // Success
            LogUtil::registerStatus($this->__('Done! Module configuration added.'));
        } else {
            // Error
            LogUtil::registerError($this->__('Error: Module configuration not added'));
        }

        // return to main form
        $this->redirect(ModUtil::url('Scribite', 'admin', 'modules'));
    }

    // edit module config
    public function modifymodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get passed args
        $mid = FormUtil::getPassedValue('mid', null, 'GET');

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

        return $this->view->fetch('admin/modifymodule.tpl');
    }

    // update module config in database
    public function updatemodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        // get passed args and store to array
        $modconfig['mid'] = FormUtil::getPassedValue('mid', null, 'POST');
        $modconfig['modulename'] = FormUtil::getPassedValue('modulename', null, 'POST');
        $modconfig['modfuncs'] = FormUtil::getPassedValue('modfuncs', null, 'POST');
        $modconfig['modareas'] = FormUtil::getPassedValue('modareas', null, 'POST');
        $modconfig['modeditor'] = FormUtil::getPassedValue('modeditor', null, 'POST');

        $mod = ModUtil::apiFunc('Scribite', 'admin', 'editmodule', $modconfig);

        // error tracking
        if ($mod != false) {
            // Success
            LogUtil::registerStatus($this->__('Done! Module configuration updated.'));
        } else {
            // Error
            LogUtil::registerStatus($this->__('Configuration not updated'));
        }

        $this->redirect(ModUtil::url('Scribite', 'admin', 'modules'));
    }

    public function delmodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // get module id
        $mid = FormUtil::getPassedValue('mid', null, 'GET');

        // get module config and name from id
        $modconfig = ModUtil::apiFunc('Scribite', 'admin', 'getModuleConfigfromID', array('mid' => $mid));

        // create smarty instance
        $this->view->assign('mid', $mid);
        $this->view->assign('modulename', $modconfig['modname']);
        return $this->view->fetch('admin/delmodule.tpl');
    }

    // del module config in database
    public function removemodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->checkCsrfToken();

        // get passed args
        $args['mid'] = FormUtil::getPassedValue('mid', null, 'POST');

        // remove module entry from Scribite table
        $mod = ModUtil::apiFunc('Scribite', 'admin', 'delmodule', array('mid' => $args['mid']));

        if ($mod != false) {
            // Success
            LogUtil::registerStatus($this->__('Done! Module configuration updated.'));
        }

        // return to main page
        $this->redirect(ModUtil::url('Scribite', 'admin', 'main'));
    }
    

    
    public function modifyeditor($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'Scribite::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }
        
        $editor = FormUtil::getPassedValue('editor', null, 'GET');
        // Editor check
        if (is_null($editor)) {
            return LogUtil::registerArgsError();
        }
        
        
        // Create form 
        $form = FormUtil::newForm('Scribite', $this);
        return $form->execute('admin/modify'.strtolower($editor).'.tpl', new Scribite_Handler_ModifyEditor());
    }
    
    // main function
    public function configimageupload()
    {

        // Security check
        if (!SecurityUtil::checkPermission( 'Scribite::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }
        // Create output object
        $form = FormUtil::newForm('Scribite', $this);

        // Return the output that has been generated by this function
        return $form->execute('admin/configimageupload.tpl', new Scribite_Handler_ConfigImageUpload());
    }

    
}
