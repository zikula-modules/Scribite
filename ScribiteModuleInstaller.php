<?php

namespace Zikula\ScribiteModule;

use Zikula\Core\AbstractExtensionInstaller;

class ScribiteModuleInstaller extends AbstractExtensionInstaller
{
    public function install()
    {
        $this->setVar('DefaultEditor', 'CKEditor');

        return true;
    }

    public function upgrade($oldversion)
    {
        $variableApi = $this->container->get('zikula_extensions_module.api.variable');

        switch ($oldversion) {
            case '5.0.1':
                // remove obsolete editors
                $removedEditors = ['NicEdit', 'Xinha', 'YUI'];
                foreach ($removedEditors as $name) {
                    $variableApi->delAll('moduleplugin.scribite.' . strtolower($name));
                }

                // remove overrides if needed
                $overrides = $this->getVar('overrides', []);
                foreach ($overrides as $modName => $settings) {
                    if (in_array($settings['editor'], $removedEditors)) {
                        unset($overrides[$modName]);
                    }
                }
                $this->setVar('overrides', $overrides);

                // Update Wysihtml configuration
                $vars = $variableApi->getAll('moduleplugin.scribite.wysihtml5');
                $variableApi->setAll('moduleplugin.scribite.wysihtml', $vars);
                $variableApi->delAll('moduleplugin.scribite.wysihtml5');

                // reset default editor if needed
                $defaultEditor = $this->getVar('DefaultEditor', 'CKEditor');
                if (in_array($defaultEditor, $removedEditors)) {
                    $this->setVar('DefaultEditor', 'CKEditor');
                }

                // add CodeMirror plugin
                // $class = 'ModulePlugin_Scribite_CodeMirror_Plugin';
                // PluginUtil::install($class);
            case '5.0.2':
            case '5.0.3':
            case '5.0.99':
                // change modvar module name from Scribite to ZikulaScribiteModule
                $modVars = $variableApi->getAll('Scribite');
                $this->setVars($modVars);
                $variableApi->delAll('Scribite');

                // change e.g. modvar moduleplugin.scribite.ckeditor to zikulascribitemodule.ckeditor (use declared id - not service id)
                $map = ['ckeditor', 'codemirror', 'tinymce'];
                foreach ($map as $name) {
                    $vars = $variableApi->getAll('moduleplugin.scribite.' . $name);
                    $variableApi->setAll('zikulascribitemodule.' . $name, $vars);
                    $variableApi->delAll('moduleplugin.scribite.' . $name);
                }

                // remove obsolete editors
                $removedEditors = ['MarkItUp', 'Wymeditor', 'Wysihtml'];
                foreach ($removedEditors as $name) {
                    $variableApi->delAll('moduleplugin.scribite.' . strtolower($name));
                }

                // remove overrides if needed
                $overrides = $this->getVar('overrides', []);
                foreach ($overrides as $modName => $settings) {
                    if (in_array($settings['editor'], $removedEditors)) {
                        unset($overrides[$modName]);
                    }
                }
                $this->setVar('overrides', $overrides);

                // reset default editor if needed
                $defaultEditor = $this->getVar('DefaultEditor', 'CKEditor');
                if (in_array($defaultEditor, $removedEditors)) {
                    $this->setVar('DefaultEditor', 'CKEditor');
                }
        }

        return true;
    }

    public function uninstall()
    {
        return true;
    }
}
