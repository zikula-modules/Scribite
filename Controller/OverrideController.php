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

namespace Zikula\ScribiteModule\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Zikula\Bundle\CoreBundle\Controller\AbstractController;
use Zikula\Bundle\HookBundle\Collector\HookCollectorInterface;
use Zikula\ExtensionsModule\Entity\ExtensionEntity;
use Zikula\PermissionsModule\Annotation\PermissionCheck;
use Zikula\ScribiteModule\Collector\EditorCollector;
use Zikula\ScribiteModule\Form\Type\ModuleOverridesType;
use Zikula\ScribiteModule\Form\Type\TextAreaOverridesType;
use Zikula\ThemeModule\Engine\Annotation\Theme;

/**
 * @Route("/override")
 */
class OverrideController extends AbstractController
{
    /**
     * @Route("/module")
     * @Template("@ZikulaScribiteModule/Override/module.html.twig")
     * @Theme("admin")
     * @PermissionCheck("admin")
     */
    public function moduleAction(
        Request $request,
        EditorCollector $editorCollector,
        HookCollectorInterface $hookCollector
    ) {
        $form = $this->createForm(ModuleOverridesType::class, $this->getVars(), [
            'modules' => $this->getModuleChoices($hookCollector),
            'editors' => $editorCollector->getEditorsChoiceList()
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $overrides = array_merge($this->getVar('overrides', []), $form->get('overrides')->getData());
            if ('deleteModuleOverride' === $request->request->get('action', '')) {
                $modName = $request->request->get('modname');
                unset($overrides[$modName]['editor']);
                if (empty($overrides[$modName])) {
                    unset($overrides[$modName]);
                }
            }
            $this->setVar('overrides', $overrides);

            return $this->redirectToRoute('zikulascribitemodule_override_module');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/textarea")
     * @Template("@ZikulaScribiteModule/Override/textarea.html.twig")
     * @Theme("admin")
     * @PermissionCheck("admin")
     */
    public function textareaAction(
        Request $request,
        HookCollectorInterface $hookCollector
    ) {
        $form = $this->createForm(TextAreaOverridesType::class, $this->getVars(), [
            'modules' => $this->getModuleChoices($hookCollector)
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $overrides = array_merge($this->getVar('overrides', []), $form->get('overrides')->getData());
                if ('deleteTextareaOverride' === $request->request->get('action', '')) {
                    $rowid = $request->request->get('rowid');
                    [$modName, $textarea] = explode('/', $rowid);
                    unset($overrides[$modName][$textarea]);
                    if (empty($overrides[$modName])) {
                        unset($overrides[$modName]);
                    }
                }
                $this->setVar('overrides', $overrides);
            }
            // @todo invalid forms simply remove all invalid data and refresh. It would be nice to redraw with errors noted.

            return $this->redirectToRoute('zikulascribitemodule_override_textarea');
        }

        return [
            'form' => $form->createView()
        ];
    }

    private function getModuleChoices(HookCollectorInterface $hookCollector)
    {
        $hookSubscribers = $hookCollector->getOwnersCapableOf();
        $modules = [];
        foreach ($hookSubscribers as $module) {
            $moduleEntity = $this->getDoctrine()->getRepository(ExtensionEntity::class)->findOneBy(['name' => $module]);
            $modules[$moduleEntity->getDisplayname()] = $module;
        }

        return $modules;
    }
}
