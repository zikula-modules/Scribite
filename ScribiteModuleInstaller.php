<?php

namespace Zikula\ScribiteModule;

use Zikula\Core\AbstractExtensionInstaller;

class ScribiteModuleInstaller extends AbstractExtensionInstaller
{
    public function install()
    {
        return true;
    }

    public function upgrade($oldversion)
    {
        // @todo
        // change modvar module name from Scribite to ZikulaScribiteModule
        // change modvar moduleplugin.scribite.ckeditor to zikulascribitemodule.ckeditor (use declared id - not service id)
        return true;
    }

    public function uninstall()
    {
        return true;
    }
}
