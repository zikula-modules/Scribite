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
            return LogUtil::registerError($e->getMessage());
        }

        // create hook
        HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        // create the default data for the module
        $this->defaultdata();

        $classes = PluginUtil::loadAllModulePlugins();
        foreach ($classes as $class) {
            if (strpos($class, 'Scribite') !== false) {
                try {
                    PluginUtil::install($class);
                } catch (Exception $e) {
                    LogUtil::registerStatus($e->getMessage());
                }
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
                // just in case
                EventUtil::unregisterPersistentModuleHandlers('Scribite');
                $this->install();
            case '4.4.0':
            // future upgrade
        }

        return true;
    }

    public function uninstall()
    {
        // Delete editor plugins
        $classes = PluginUtil::loadAllModulePlugins();
        foreach ($classes as $class) {
            if (strpos($class, 'Scribite') !== false) {
                try {
                    PluginUtil::uninstall($class);
                } catch (Exception $e) {
                    LogUtil::registerError($e->getMessage());
                }
            }
        }

        // drop tables
        DoctrineHelper::dropSchema($this->entityManager, array(
            'Scribite_Entity_Scribite'
        ));

        // Delete any module variables
        $this->delVars();

        // remove hook
        HookUtil::unregisterProviderBundles($this->version->getHookProviderBundles());

        // Deletion successful
        return true;
    }

    protected function defaultdata()
    {
        // Set editor defaults
        $this->setVar('DefaultEditor', 'YUI');
        $this->setVar('upload_path', 'userdata/Scribite');
        $this->setVar('image_upload', false);
    }

}
