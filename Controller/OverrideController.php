<?php

declare(strict_types=1);

namespace Zikula\ScribiteModule\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zikula\Core\Controller\AbstractController;
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
     *
     * @param Request $request
     * @return array|RedirectResponse
     */
    public function moduleAction(Request $request)
    {
        if (!$this->hasPermission('ZikulaScribiteModule::', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(ModuleOverridesType::class, $this->getVars(), [
            'modules' => $this->getModuleChoices(),
            'editors' => $this->get('zikula_scribite_module.collector.editor_collector')->getEditorsChoiceList()
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
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
     *
     * @param Request $request
     * @return array|RedirectResponse
     */
    public function textareaAction(Request $request)
    {
        if (!$this->hasPermission('ZikulaScribiteModule::', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(TextAreaOverridesType::class, $this->getVars(), [
            'modules' => $this->getModuleChoices()
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $overrides = array_merge($this->getVar('overrides', []), $form->get('overrides')->getData());
                if ('deleteTextareaOverride' === $request->request->get('action', '')) {
                    $rowid = $request->request->get('rowid');
                    list($modName, $textarea) = explode('/', $rowid);
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

    private function getModuleChoices()
    {
        $hookSubscribers = $this->get('zikula_hook_bundle.collector.hook_collector')->getOwnersCapableOf();
        $modules = [];
        foreach ($hookSubscribers as $module) {
            $moduleEntity = $this->getDoctrine()->getRepository('ZikulaExtensionsModule:ExtensionEntity')->findOneBy(['name' => $module]);
            $modules[$moduleEntity->getDisplayname()] = $module;
        }

        return $modules;
    }
}
