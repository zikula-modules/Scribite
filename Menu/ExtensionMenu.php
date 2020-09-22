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

namespace Zikula\ScribiteModule\Menu;

use Knp\Menu\ItemInterface;
use Zikula\MenuModule\ExtensionMenu\AbstractExtensionMenu;

class ExtensionMenu extends AbstractExtensionMenu
{
    protected function getAdmin(): ?ItemInterface
    {
        $menu = $this->factory->createItem('scribiteAdminMenu');
        if ($this->permissionApi->hasPermission($this->getBundleName() . '::', '::', ACCESS_ADMIN)) {
            $menu->addChild('Modify Config', [
                'route' => 'zikulascribitemodule_config_settings',
            ])->setAttribute('icon', 'fas fa-wrench');

            $menu->addChild('Module Overrides', [
                'route' => 'zikulascribitemodule_override_module',
            ])->setAttribute('icon', 'fas fa-edit');

            $menu->addChild('Textarea Overrides', [
                'route' => 'zikulascribitemodule_override_textarea',
            ])->setAttribute('icon', 'fas fa-file-alt');

            $menu->addChild('Editor list', [
                'route' => 'zikulascribitemodule_editor_listeditors',
            ])->setAttribute('icon', 'fas fa-list');
        }

        return 0 === $menu->count() ? null : $menu;
    }

    public function getBundleName(): string
    {
        return 'ZikulaScribiteModule';
    }
}
