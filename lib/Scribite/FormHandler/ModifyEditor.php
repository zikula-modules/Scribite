<?php

/**
 * Copyright Scribite Team 2011
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @see https://github.com/zikula-modules/Scribite
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */
class Scribite_FormHandler_ModifyEditor extends Zikula_Form_AbstractHandler
{
    /**
     * The name of the editor plugin (not the full classname)
     * @var string
     */
    private $editor;

    /**
     * Prefix for module variables of the editor.
     */
    private $modVarGroup = '';

    /**
     * Editor plugin class.
     */
    private $pluginClass = '';

    public function initialize(Zikula_Form_View $view)
    {
        $this->editor = $view->getPluginName();
        $this->modVarGroup = 'moduleplugin.scribite.' . strtolower($this->editor);
        $this->pluginClass = 'ModulePlugin_Scribite_' . $this->editor . '_Plugin';

        $view->addPluginDir('system/Admin/Resources/views/plugins'); // for Core 1.3.6+
        $view->addPluginDir('system/Admin/templates/plugins'); // for Core 1.3.5

        if (method_exists($this->pluginClass, 'getOptions')) {
            $pluginClass = $this->pluginClass;
            $options = $pluginClass::getOptions();
            if (!empty($options)) {
                $view->assign($options);
            }
        }

        $view->assign(ModUtil::getVar($this->modVarGroup));

        return true;
    }

    public function handleCommand(Zikula_Form_View $view, &$args)
    {
        if ($args['commandName'] == 'cancel') {
            $url = ModUtil::url('Scribite', 'admin', 'main');

            return $view->redirect($url);
        }

        if ($args['commandName'] == 'restore') {
            if (method_exists($this->pluginClass, 'getDefaults')) {
                $pluginClass = $this->pluginClass;
                $defaults = $pluginClass::getDefaults();
                if (!empty($defaults)) {
                    ModUtil::setVars($this->modVarGroup, $defaults);
                    LogUtil::registerStatus($this->__('Defaults succesfully restored.'));
                }
            }

            return true;
        }

        // check for valid form
        if (!$view->isValid()) {
            return false;
        }

        $data = $view->getValues();
        ModUtil::setVars($this->modVarGroup, $data);

        LogUtil::registerStatus($this->__('Done! Module configuration updated.'));

        return true;
    }
}
