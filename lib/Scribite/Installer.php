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
    private $defaultEditor = 'CKEditor';

    public function install()
    {
        // create hook
        HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        // set all modvars
        $this->setVar('DefaultEditor', $this->defaultEditor);

        $classes = PluginUtil::loadAllModulePlugins();
        foreach ($classes as $class) {
            if (false === strpos($class, 'Scribite')) {
                continue;
            }

            try {
                PluginUtil::install($class);
            } catch (Exception $e) {
                LogUtil::registerStatus($e->getMessage());
            }
        }

        // initialisation successful
        return true;
    }

    public function upgrade($oldVersion)
    {
        switch ($oldVersion) {
            case '4.3.0':
                // drop the old unused table
                $connection = $this->entityManager->getConnection();
                $prefix = System::getVar('prefix');
                $prefix = (empty($prefix)) ? '' : $prefix . "_";
                $sql = 'DROP TABLE ' . $prefix . 'scribite';
                $stmt = $connection->prepare($sql);
                try {
                    $stmt->execute();
                } catch (Exception $e) {
                    LogUtil::registerError($e->getMessage());
                }
                // standard 'upgrades' from earlier versions are not supported but 
                // not required either - just uninstall and install the new version
                $this->uninstall();
                // remove old persistent handlers
                EventUtil::unregisterPersistentModuleHandlers('Scribite');
                $this->install();
            case '5.0.0':
            case '5.0.1':
                // remove inactive/obsolete editors
                $removedEditors = array('NicEdit', 'Xinha', 'YUI');
                $removedVarNames = '\'moduleplugin.scribite.nicedit\', \'moduleplugin.scribite.xinha\', \'moduleplugin.scribite.yui\'';
                $connection = $this->entityManager->getConnection();
                $sql = '
                    DELETE FROM `module_vars`
                    WHERE `modname` IN (' . $removedVarNames . ')
                    OR `name` IN (' . $removedVarNames . ')
                ';
                $stmt = $connection->prepare($sql);
                try {
                    $stmt->execute();
                } catch (Exception $e) {
                    LogUtil::registerError($e->getMessage());
                }
                // change default editor if needed
                $defaultEditor = $this->getVar('DefaultEditor', $this->defaultEditor);
                if (in_array($defaultEditor, $removedEditors)) {
                    $this->setVar('DefaultEditor', $this->defaultEditor);
                }
                // remove overrides if needed
                $overrides = $this->getVar('overrides', array());
                foreach ($overrides as $modName => $settings) {
                    if (in_array($settings['editor'], $removedEditors)) {
                        unset($overrides[$modName]);
                    }
                }
                $this->setVar('overrides', $overrides);
                // Update Wysihtml configuration
                $sql = '
                    UPDATE `module_vars`
                    SET `name` = \'moduleplugin.scribite.wysihtml\'
                    WHERE `name` = \'moduleplugin.scribite.wysihtml5\'
                ';
                $stmt = $connection->prepare($sql);
                try {
                    $stmt->execute();
                } catch (Exception $e) {
                    LogUtil::registerError($e->getMessage());
                }
                // add CodeMirror plugin
                $class = 'ModulePlugin_Scribite_CodeMirror_Plugin';
                PluginUtil::install($class);
            case '5.0.2':
                // current version
            case '5.0.3':
                // future upgrades
        }

        return true;
    }

    public function uninstall()
    {
        // delete editor plugins
        $classes = PluginUtil::loadAllModulePlugins();
        foreach ($classes as $class) {
            if (false === strpos($class, 'Scribite')) {
                continue;
            }

            try {
                PluginUtil::uninstall($class);
            } catch (Exception $e) {
                LogUtil::registerError($e->getMessage());
            }
        }

        // delete module variables
        $this->delVars();

        // remove hook
        HookUtil::unregisterProviderBundles($this->version->getHookProviderBundles());

        // deletion successful
        return true;
    }
}
