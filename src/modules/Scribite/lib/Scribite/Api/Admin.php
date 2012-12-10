<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Api_Admin extends Zikula_AbstractApi
{

// get available admin panel links
    public function getlinks($args)
    {
        $links = array();
        $links[] = array(
            'url' => ModUtil::url('Scribite', 'admin', 'modifyconfig'),
            'text' => $this->__('Settings'),
            'class' => 'z-icon-es-config');
        $links[] = array(
            'url' => ModUtil::url('Scribite', 'admin', 'modules'),
            'text' => $this->__('Module list'),
            'class' => 'z-icon-es-view');
        $links[] = array(
            'url' => ModUtil::url('Scribite', 'admin', 'modifymodule'),
            'text' => $this->__('Add module'),
            'class' => 'z-icon-es-new');
        $links[] = array(
            'url' => ModUtil::url('Scribite', 'admin', 'configimageupload'),
            'text' => $this->__('Image Upload'),
            'class' => 'z-icon-es-display');
        $links[] = array(
            'url' => ModUtil::url('Scribite', 'admin', 'editors'),
            'text' => $this->__('Editors'),
            'class' => 'z-icon-es-view');
        
        // return output
        return $links;
    }

    // update module config
    public function editmodule($args)
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // Argument check
        if (!isset($args['mid']) || !isset($args['modulename']) || !isset($args['modfuncs']) || !isset($args['modareas']) || !isset($args['modeditor'])) {
            return LogUtil::registerError($this->__('Error! Could not do what you wanted. Please check your input.'));
        }

        // update item
        $updateitem = array('mid' => $args['mid'],
            'modname' => $args['modulename'],
            'modfuncs' => serialize(explode(',', $args['modfuncs'])),
            'modareas' => serialize(explode(',', $args['modareas'])),
            'modeditor' => $args['modeditor']);


        $module = $this->entityManager->find('Scribite_Entity_Scribite', $args['mid']);
        $module->merge($updateitem);
        $this->entityManager->persist($module);
        $this->entityManager->flush();

        return LogUtil::registerError($this->__('Configuration not updated'));
    }

    // delete module config
    public function delmodule($args)
    {
        $this->throwForbiddenUnless(
            SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN),
            LogUtil::getErrorMsgPermission()
        );

        // Argument check
        if (!isset($args['mid'])) {
            return LogUtil::registerError($this->__('Error! Could not do what you wanted. Please check your input.'));
        }

        // check for existing module
        $modconfig = $this->entityManager->find('Scribite_Entity_Scribite', $args['mid']);
        $this->entityManager->remove($modconfig);
        $this->entityManager->flush();


        return LogUtil::registerError($this->__('Configuration removed'));
    }

    // get module name from id
    public function getModuleConfigfromID($args)
    {
        $this->throwForbiddenUnless(
            SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN),
            LogUtil::getErrorMsgPermission()
        );

        // Argument check
        if (!isset($args['mid'])) {
            return LogUtil::registerError($this->__('Error! Could not do what you wanted. Please check your input.'));
        }

        return $this->entityManager->find('Scribite_Entity_Scribite', $args['mid']);
    }
}
