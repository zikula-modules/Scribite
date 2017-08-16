<?php

namespace Zikula\ScribiteModule\Container;

use Symfony\Component\Routing\RouterInterface;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Core\LinkContainer\LinkContainerInterface;
use Zikula\PermissionsModule\Api\ApiInterface\PermissionApiInterface;

/**
 * This is the class that manages your module links
 */
class LinkContainer implements LinkContainerInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var PermissionApiInterface
     */
    private $permissionApi;

    /**
     * LinkContainer constructor.
     * @param TranslatorInterface $translator
     * @param RouterInterface $router
     * @param PermissionApiInterface $permissionApi
     */
    public function __construct(
        TranslatorInterface $translator,
        RouterInterface $router,
        PermissionApiInterface $permissionApi
    ) {
        $this->translator = $translator;
        $this->router = $router;
        $this->permissionApi = $permissionApi;
    }

    public function getLinks($type = LinkContainerInterface::TYPE_ADMIN)
    {
        $links = [];
        if (LinkContainerInterface::TYPE_ADMIN == $type) {
            if ($this->permissionApi->hasPermission('ZikulaScribiteModule::', '::', ACCESS_ADMIN)) {
                $links[] = [
                    'url' => $this->router->generate('zikulascribitemodule_config_settings'),
                    'text' => $this->translator->__('Modify Config'),
                    'icon' => 'wrench'
                ];
                $links[] = [
                    'url' => $this->router->generate('zikulascribitemodule_override_module'),
                    'text' => $this->translator->__('Module Overrides'),
                    'icon' => 'pencil-square-o'
                ];
                $links[] = [
                    'url' => $this->router->generate('zikulascribitemodule_override_textarea'),
                    'text' => $this->translator->__('Textarea Overrides'),
                    'icon' => 'file-text-o'
                ];
                $links[] = [
                    'url' => $this->router->generate('zikulascribitemodule_editor_list'),
                    'text' => $this->translator->__('Editor list'),
                    'icon' => 'list'
                ];
            }
        }

        return $links;
    }

    public function getBundleName()
    {
        return 'ZikulaScribiteModule';
    }
}
