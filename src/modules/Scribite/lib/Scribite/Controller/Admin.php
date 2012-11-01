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
        // Create form
        $form = FormUtil::newForm('Scribite', $this);
        return $form->execute('admin/modifyconfig.tpl', new Scribite_Handler_ModifyConfig());
    }

    // display modules
    public function modules($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        $this->view->assign('editor_list', ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => 'list')));
        $modules = ModUtil::apiFunc('Scribite', 'user', 'getModuleConfig', array('modulename' => "list"));

        /*foreach ($modules as $key => $module) {
            $modconfig[$key] = array();
            $modconfig[$key]['modfunclist'] = implode(", ", $module->getModfuncs());
            $modconfig[$key]['modarealist'] = implode(", ", $module['modareas']);
            $modconfig[$key]['modeditortitle'] = ModUtil::apiFunc('Scribite', 'user', 'getEditorTitle', array('editorname' => $modules[$key]['modeditor']));
        }*/
        $this->view->assign('modconfigs', $modules);

        return $this->view->fetch('admin/modules.tpl');
    }

    // edit module config
    public function modifymodule($args)
    {
        // Create form
        $form = FormUtil::newForm('Scribite', $this);
        return $form->execute('admin/modifymodule.tpl', new Scribite_Handler_ModifyModule());
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
    
    // display editors
    public function editors($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // check for all supported editors and generate links
        $editors = ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => "list"));
        unset($editors['-']);
        $this->view->assign('editors', $editors);
        $this->view->assign(defaulteditor, ModUtil::getVar('Scribite', 'DefaultEditor'));

        return $this->view->fetch('admin/editors.tpl');
    }

    // modify editor settings
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
