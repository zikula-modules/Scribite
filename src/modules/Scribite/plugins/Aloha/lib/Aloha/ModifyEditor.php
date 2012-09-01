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

class ModulePlugin_Scribite_Aloha_ModifyEditor extends Zikula_Form_AbstractHandler
{

    private $editor = '';

    function initialize(Zikula_Form_View $view)
    {

        $editor = FormUtil::getPassedValue('editor', null, 'GET');
        $classname = 'ModulePlugin_Scribite_'.$editor.'_Plugin';

        if (method_exists($classname,'getOptions')) {
            $options = $classname::getOptions();
            $view->assign($options);
        }

        $view->assign(ModUtil::getVar("moduleplugin.scribite.".strtolower($editor)));

        $this->editor = $editor;

        return true;
    }


    function handleCommand(Zikula_Form_View $view, &$args)
    {
        $editor = $this->editor;

        if ($args['commandName'] == 'cancel') {
            $url = ModUtil::url('Scribite', 'admin', 'main' );
            return $view->redirect($url);
        } else if($args['commandName'] == 'restore') {
            $classname = 'ModulePlugin_Scribite_'.$editor.'_Plugin';
            if (method_exists($classname,'getDefaults')) {
                $defaults = $classname::getDefaults();
                ModUtil::setVars("moduleplugin.scribite.".strtolower($editor), $data);
                LogUtil::registerStatus('Defaults succesful restored.');
            }
            $url = ModUtil::url('Scribite', 'admin', 'modifyeditor', array('editor' => $editor) );
            return $view->redirect($url);
        }


        // check for valid form
        if (!$view->isValid()) {
            return false;
        }
        
        $data = $view->getValues();



        ModUtil::setVars("moduleplugin.scribite.".strtolower($editor), $data);

        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return true;


    }

}
