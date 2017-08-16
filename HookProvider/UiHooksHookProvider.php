<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\HookProvider;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Zikula\Bundle\HookBundle\Category\UiHooksCategory;
use Zikula\Bundle\HookBundle\Hook\DisplayHook;
use Zikula\Bundle\HookBundle\Hook\DisplayHookResponse;
use Zikula\Bundle\HookBundle\HookProviderInterface;
use Zikula\Bundle\HookBundle\ServiceIdTrait;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\PermissionsModule\Api\ApiInterface\PermissionApiInterface;
use Zikula\ScribiteModule\Editor\Factory;

class UiHooksHookProvider implements HookProviderInterface
{
    use ServiceIdTrait;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var PermissionApiInterface
     */
    private $permissionApi;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var Factory
     */
    private $editorFactory;

    public function __construct(
        TranslatorInterface $translator,
        PermissionApiInterface $permissionApi,
        EngineInterface $templating,
        Factory $factory
    ) {
        $this->translator = $translator;
        $this->permissionApi = $permissionApi;
        $this->templating = $templating;
        $this->editorFactory = $factory;
    }

    public function getOwner()
    {
        return 'ZikulaScribiteModule';
    }

    public function getCategory()
    {
        return UiHooksCategory::NAME;
    }

    public function getTitle()
    {
        return $this->translator->__('Scribite UiHooks Provider');
    }

    public function getProviderTypes()
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
        if (!$this->permissionApi->hasPermission('Scribite::', "$moduleName::", ACCESS_COMMENT)) {
            return;
        }

        // load the editor
        $this->editorFactory->load($moduleName);

        $response = new DisplayHookResponse($this->getServiceId(), $this->templating->render('@ZikulaScribiteModule/Hook/scribite.html.twig'));
        $hook->setResponse($response);
    }
}
