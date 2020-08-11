<?php

declare(strict_types=1);

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule;

use Zikula\ExtensionsModule\Installer\AbstractExtensionInstaller;

class ScribiteModuleInstaller extends AbstractExtensionInstaller
{
    public function install(): bool
    {
        $this->setVar('DefaultEditor', 'CKEditor');

        return true;
    }

    public function upgrade($oldversion): bool
    {
        switch ($oldversion) {
            case '5.0.1':
                // remove obsolete editors
                $removedEditors = ['NicEdit', 'Xinha', 'YUI'];
                foreach ($removedEditors as $name) {
                    $this->getVariableApi()->delAll('moduleplugin.scribite.' . mb_strtolower($name));
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
                $vars = $this->getVariableApi()->getAll('moduleplugin.scribite.wysihtml5');
                $this->getVariableApi()->setAll('moduleplugin.scribite.wysihtml', $vars);
                $this->getVariableApi()->delAll('moduleplugin.scribite.wysihtml5');

                // reset default editor if needed
                $defaultEditor = $this->getVar('DefaultEditor', 'CKEditor');
                if (in_array($defaultEditor, $removedEditors)) {
                    $this->setVar('DefaultEditor', 'CKEditor');
                }

                // add CodeMirror plugin
                // $class = 'ModulePlugin_Scribite_CodeMirror_Plugin';
                // PluginUtil::install($class);
                // no break
            case '5.0.2':
            case '5.0.3':
            case '5.0.99':
                // change modvar module name from Scribite to ZikulaScribiteModule
                $modVars = $this->getVariableApi()->getAll('Scribite');
                $this->setVars($modVars);
                $this->getVariableApi()->delAll('Scribite');

                // change e.g. modvar moduleplugin.scribite.ckeditor to zikulascribitemodule.ckeditor (use declared id - not service id)
                $map = ['ckeditor', 'codemirror', 'tinymce'];
                foreach ($map as $name) {
                    $vars = $this->getVariableApi()->getAll('moduleplugin.scribite.' . $name);
                    $this->getVariableApi()->setAll('zikulascribitemodule.' . $name, $vars);
                    $this->getVariableApi()->delAll('moduleplugin.scribite.' . $name);
                }

                // remove obsolete editors
                $removedEditors = ['MarkItUp', 'Wymeditor', 'Wysihtml'];
                foreach ($removedEditors as $name) {
                    $this->getVariableApi()->delAll('moduleplugin.scribite.' . mb_strtolower($name));
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
                // no break
            case '6.0.0':
                // nothing to do
            case '6.0.1':
                // nothing to do
            case '6.0.2':
                $this->getVariableApi()->set('zikulascribitemodule.tinymce', 'skin', 'silver');
        }

        return true;
    }

    public function uninstall(): bool
    {
        return true;
    }
}
