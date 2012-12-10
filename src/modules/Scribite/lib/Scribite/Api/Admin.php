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

}
