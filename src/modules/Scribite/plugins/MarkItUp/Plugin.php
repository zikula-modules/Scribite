<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license MIT
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

/**
 * Plugin definition class.
 */
class ModulePlugin_Scribite_MarkItUp_Plugin extends Zikula_AbstractPlugin implements Zikula_Plugin_ConfigurableInterface
{
    /**
     * Provide plugin meta data.
     *
     * @return array Meta data.
     */
    protected function getMeta()
    {
        return array('displayname' => $this->__('MarkItUp'),
                     'description' => $this->__('MarkItUp editor.'),
                     'version'     => '1.1.1'
                    );
    }
    
    
    


    /**
     * Controller configuration getter.
     *
     * @return ModulePlugin_Scribite_Example_Controller
     */
    public function getConfigurationController()
    {
        return System::redirect(ModUtil::url('Scribite', 'admin', 'modifyeditor', array('editor' => 'markitup')));
    }
    
    
    public function install()
    {
        ModUtil::setVars($this->serviceId, $this->getDefaults());
        return true;
    }

    public function uninstall()
    {
        ModUtil::delVar($this->serviceId);
        return true;
    }


    public function getDefaults()
    {
        return array(
            'width'  => '65%',
            'height' => '400px'
        );
    }
    
}
