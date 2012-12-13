<?php

/**
 * Copyright Scribite Team 2011
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package EasyUpload
 * @link https://github.com/zikula-modules/Scribite
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */
class Scribite_Handler_ModifyModule extends Zikula_Form_AbstractHandler
{

    private $_modconfig;

    function initialize(Zikula_Form_View $view)
    {
        if (!SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        // get passed args
        $mid = FormUtil::getPassedValue('mid', null, 'GET');

        if ($mid) {
            $view->assign('templatetitle', $this->__('Modify category'));
            // get config for current module
            $this->_modconfig = $this->entityManager->find('Scribite_Entity_Scribite', $mid);
            if ($this->_modconfig) {
                $modconfig = $this->_modconfig->toArray();
                $view->assign('mid', $modconfig['mid']);
                $view->assign('modname', $modconfig['modname']);
                $view->assign('modfuncs', implode(',', $modconfig['modfuncs']));
                $view->assign('modareas', implode(',', $modconfig['modareas']));
                $view->assign('modeditor', $modconfig['modeditor']);
            } else {
                return LogUtil::registerError($this->__f('Category with id %s not found', $id));
            }
        } else {
            $allModules = ModUtil::getAllMods();
            $allModulesAsDropdownList = array();
            foreach ($allModules as $module) {
                $allModulesAsDropdownList[] = array(
                    'value' => $module['name'],
                    'text' => $module['displayname']
                );
            }
            $view->assign('allModules', $allModulesAsDropdownList);
            $this->_modconfig = new Scribite_Entity_Scribite();
        }


        // get all editors
        $editorList = ModUtil::apiFunc('Scribite', 'admin', 'getEditors', array('format' => 'formdropdownlist', 'default' => true));
        $view->assign('editor_list', $editorList);


        return true;
    }

    function handleCommand(Zikula_Form_View $view, &$args)
    {

        $url = ModUtil::url('Scribite', 'admin', 'main');
        if ($args['commandName'] == 'cancel') {
            return $view->redirect($url);
        }


        // check for valid form
        if (!$view->isValid()) {
            return false;
        }

        // get passed args and store to array
        $data = $view->getValues();


        $this->_modconfig->merge($data);
        $this->entityManager->persist($this->_modconfig);
        $this->entityManager->flush();


        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return $view->redirect($url);
    }

}
