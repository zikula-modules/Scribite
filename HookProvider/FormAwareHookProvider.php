<?php

declare(strict_types=1);
/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\HookProvider;

use Symfony\Contracts\Translation\TranslatorInterface;
use Zikula\Bundle\HookBundle\Category\FormAwareCategory;
use Zikula\Bundle\HookBundle\FormAwareHook\FormAwareHook;
use Zikula\Bundle\HookBundle\HookProviderInterface;
use Zikula\PermissionsModule\Api\ApiInterface\PermissionApiInterface;
use Zikula\ScribiteModule\Editor\Factory;

class FormAwareHookProvider implements HookProviderInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var PermissionApiInterface
     */
    private $permissionApi;

    /**
     * @var Factory
     */
    private $editorFactory;

    public function __construct(
        TranslatorInterface $translator,
        PermissionApiInterface $permissionApi,
        Factory $editorFactory
    ) {
        $this->translator = $translator;
        $this->permissionApi = $permissionApi;
        $this->editorFactory = $editorFactory;
    }

    public function getOwner(): string
    {
        return 'ZikulaScribiteModule';
    }

    public function getCategory(): string
    {
        return FormAwareCategory::NAME;
    }

    public function getTitle(): string
    {
        return $this->translator->trans('Scribite FormAware Provider');
    }

    public function getProviderTypes(): array
    {
        return [
            FormAwareCategory::TYPE_EDIT => 'edit',
        ];
    }

    public function edit(FormAwareHook $hook)
    {
        // get the module name
        $moduleName = $hook->getCaller();

        // Security check if user has COMMENT permission for scribite
        if (!$this->permissionApi->hasPermission('Scribite::', "${moduleName}::", ACCESS_COMMENT)) {
            return;
        }

        // load the editor
        $this->editorFactory->load($moduleName);

        $hook->addTemplate('@ZikulaScribiteModule/Hook/scribite.html.twig');
    }

    public function getAreaName(): string
    {
        return 'provider.zikulascribitemodule.form_aware_hooks.editor';
    }
}
