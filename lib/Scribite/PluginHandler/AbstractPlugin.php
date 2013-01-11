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

abstract class Scribite_PluginHandler_AbstractPlugin extends Zikula_AbstractPlugin implements Zikula_Plugin_ConfigurableInterface
{
    /**
     * Controller configuration getter.
     *
     * @return Scribite_PluginHandler_Controller
     */
    public function getConfigurationController()
    {
        return new Scribite_PluginHandler_Controller($this->serviceManager, $this);
    }
    
    /**
     * Implement if additional parameters are to be passed to the editorheader.tpl
     * 
     * Should return an array of values to use in the template.
     */
    public static function addParameters()
    {
        return array();
    }
    
    /**
     * Implement if editor can load external plugins (from a non-Scribite directory)
     * 
     * Plugin should notify event with name like `moduleplugin.<editorname>.externalplugins`
     * Subject of event should be an object craeted within the ModulePlugin to
     * enforce a contract to provide specified parameters as an array needed for
     * implementation in the template.
     */
    public static function addExternalPlugins()
    {
        return array();
    }
    
    /**
     * Implement to set values in the configure.tpl tempalte for configuration of
     * the plugin
     */
    public static function getOptions()
    {
        return array();
    }
    
    /**
     * Implement to set defalut value in the configuration of the plugin
     */
    public static function getDefaults()
    {
        return array();
    }
}