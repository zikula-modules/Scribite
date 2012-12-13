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

    /**
     * get available admin panel links
     * 
     * @param array $args
     * @return array 
     */
    public function getlinks()
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

    /**
     * load module config from db into array or list all modules with config
     * 
     * @param array $args
     * @return mixed array/boolean 
     */
    public function getModuleConfig($args)
    {
        if (!isset($args['modulename'])) {
            $args['modulename'] = ModUtil::getName();
        }

        $modconfig = array();
        if ($args['modulename'] == 'list') {
            $modconfig = $this->entityManager->getRepository('Scribite_Entity_Scribite')->findAll();
        } else {
            $modconfig = $this->entityManager->getRepository('Scribite_Entity_Scribite')
                    ->findOneBy(array('modname' => $args['modulename']));

            if ($modconfig == false) {
                return;
            } else {
                $modconfig = $modconfig->toArray();
            }
        }
        return $modconfig;
    }

    /**
     * read editors folder and load names into array
     * 
     * @param array $args
     * @return type 
     */
    public function getEditors($args)
    {
        $path = 'modules/Scribite/plugins';
        $plugins = FileUtil::getFiles($path, false, true, null, 'd');


        $editors = array();

        foreach ($plugins as $pluginName) {
            $className = 'ModulePlugin_Scribite_' . $pluginName . '_Plugin';
            $instance = PluginUtil::loadPlugin($className);
            $pluginstate = PluginUtil::getState($instance->getServiceId(), PluginUtil::getDefaultState());
            if ($pluginstate['state'] == PluginUtil::ENABLED) {
                if (isset($args['format']) && $args['format'] == 'formdropdownlist') {
                    $editors[] = array(
                        'text' => $instance->getMetaDisplayName(),
                        'value' => $pluginName
                    );
                } else {
                    $editors[$pluginName] = $instance->getMetaDisplayName();
                }
            }
        }

        return $editors;
    }

    /**
     * Find the editor title when provided with editorname
     * 
     * @param array $args
     * @return string 
     */
    public function getEditorTitle($args)
    {
        if (!PluginUtil::isAvailable('moduleplugin.scribite.' . strtolower($args['editorname']))) {
            return '';
        }

        $className = 'ModulePlugin_Scribite_' . $args['editorname'] . '_Plugin';
        $instance = PluginUtil::loadPlugin($className);
        return $instance->getMetaDisplayName();
    }

}
