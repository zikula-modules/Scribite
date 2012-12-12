<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Installer extends Zikula_AbstractInstaller
{

    public function install()
    {
        // create table
        try {
            DoctrineHelper::createSchema($this->entityManager, array(
                'Scribite_Entity_Scribite'
            ));
        } catch (Exception $e) {
            LogUtil::registerStatus($e->getMessage());
            return false;
        }

        // create hook
        HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        // create the default data for the module
        $this->defaultdata();

        // Install editor plugins
        $path = 'modules/Scribite/plugins';
        $plugins = FileUtil::getFiles($path, false, true, null, 'd');
        foreach ($plugins as $pluginName) {
            $className = 'ModulePlugin_Scribite_'.$pluginName.'_Plugin';
            $instance = PluginUtil::loadPlugin($className);
            $pluginstate = PluginUtil::getState($instance->getServiceId(), PluginUtil::getDefaultState());
            if ($pluginstate['state'] == PluginUtil::NOTINSTALLED) {
                PluginUtil::install($className);
            }

        }

        // Initialisation successful
        return true;
    }

    public function upgrade($oldversion)
    {
        switch ($oldversion) {
            case '4.3.0':
                // true 'upgrades' from earlier versions are not supported but 
                // not required either - just uninstall and install the new version
                $this->uninstall();
                $this->install();
            case '4.4.0':
                // future upgrade
        }

        return true;
    }

    public function uninstall()
    {
        // Delete editor plugins
        $path = 'modules/Scribite/plugins';
        $plugins = FileUtil::getFiles($path, false, true, null, 'd');
        PluginUtil::loadAllPlugins();
        foreach ($plugins as $pluginName) {
            $className = 'ModulePlugin_Scribite_'.$pluginName.'_Plugin';
            PluginUtil::uninstall($className);
        }

        // drop tables
        DoctrineHelper::dropSchema($this->entityManager, array(
            'Scribite_Entity_Scribite'
        ));

        // Delete any module variables
        $this->delVars();

        // just in case
        EventUtil::unregisterPersistentModuleHandlers('Scribite');
        
        // remove hook
        HookUtil::unregisterProviderBundles($this->version->getHookProviderBundles());

        // Deletion successful
        return true;
    }

    protected function defaultdata()
    {
        // Set editor defaults
        $this->setVar('DefaultEditor', '-');
        $this->setVar('upload_path', 'userdata/Scribite');
        $this->setVar('image_upload', false);
    }

}
