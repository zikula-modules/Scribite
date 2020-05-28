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
use Twig\Environment;
use Zikula\Bundle\HookBundle\Category\UiHooksCategory;
use Zikula\Bundle\HookBundle\Hook\DisplayHook;
use Zikula\Bundle\HookBundle\Hook\DisplayHookResponse;
use Zikula\Bundle\HookBundle\HookProviderInterface;
use Zikula\PermissionsModule\Api\ApiInterface\PermissionApiInterface;
use Zikula\ScribiteModule\Editor\Factory;

class UiHooksHookProvider implements HookProviderInterface
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
     * @var Environment
     */
    private $twig;

    /**
     * @var Factory
     */
    private $editorFactory;

    public function __construct(
        TranslatorInterface $translator,
        PermissionApiInterface $permissionApi,
        Environment $twig,
        Factory $factory
    ) {
        $this->translator = $translator;
        $this->permissionApi = $permissionApi;
        $this->twig = $twig;
        $this->editorFactory = $factory;
    }

    public function getOwner(): string
    {
        return 'ZikulaScribiteModule';
    }

    public function getCategory(): string
    {
        return UiHooksCategory::NAME;
    }

    public function getTitle(): string
    {
        return $this->translator->trans('Scribite UiHooks Provider');
    }

    public function getProviderTypes(): array
    {
        return [
            UiHooksCategory::TYPE_FORM_EDIT=> 'edit',
        ];
    }

    /**
     * @param DisplayHook $hook
     */
    public function edit(DisplayHook $hook)
    {
        // get the module name
        $moduleName = $hook->getCaller();

        // Security check if user has COMMENT permission for scribite
        if (!$this->permissionApi->hasPermission('Scribite::', "${moduleName}::", ACCESS_COMMENT)) {
            return;
        }

        // load the editor
        $this->editorFactory->load($moduleName);

        $response = new DisplayHookResponse($this->getAreaName(), $this->twig->render('@ZikulaScribiteModule/Hook/scribite.html.twig'));
        $hook->setResponse($response);
    }

    public function getAreaName(): string
    {
        return 'provider.zikulascribitemodule.ui_hooks.editor';
    }
}
