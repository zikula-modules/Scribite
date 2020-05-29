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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zikula\Bundle\CoreBundle\Controller\AbstractController;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\PermissionsModule\Annotation\PermissionCheck;
use Zikula\ScribiteModule\Collector\EditorCollector;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Helper\AssetHelper;
use Zikula\ThemeModule\Engine\Annotation\Theme;

class EditorController extends AbstractController
{
    /**
     * @Route("/editors")
     * @Template("@ZikulaScribiteModule/Editor/list.html.twig")
     * @Theme("admin")
     * @PermissionCheck("admin")
     */
    public function listAction(
        EditorCollector $editorCollector,
        AssetHelper $assetHelper
    ) {
        $editors = $editorCollector->getEditors();
        ksort($editors);
        foreach ($editors as $editorId => $editor) {
            $assetHelper->install($editorId, $editor);
        }

        return [
            'editors' => $editors
        ];
    }

    /**
     * @Route("/configure/{editorId}")
     * @Template("@ZikulaScribiteModule/Editor/configure.html.twig")
     * @Theme("admin")
     */
    public function configureAction(
        Request $request,
        $editorId,
        EditorCollector $editorCollector,
        AssetHelper $assetHelper,
        VariableApiInterface $variableApi
    ) {
        if (!$this->hasPermission('ZikulaScribiteModule::' . $editorId, '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }
        $editor = $editorCollector->get($editorId);
        $assetHelper->install($editorId, $editor);
        if (!($editor instanceof ConfigurableEditorInterface)) {
            $this->addFlash('info', $this->trans('%editor% is not a configurable editor.', ['%editor%' => $editor->getMeta()['displayname']]));

            return $this->redirectToRoute('zikulascribitemodule_editor_list');
        }
        $form = $this->createForm($editor->getFormClass(), $editor->getVars(), [
            'translator' => $this->getTranslator()
        ]);
        $this->correctForm($form);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('save')->isClicked()) {
                $formData = $form->getData();
                $variableApi->setAll('zikulascribitemodule.' . mb_strtolower($editorId), $formData);
                $this->addFlash('status', $this->trans('Done! Editor configuration updated.'));
            }
        }

        return [
            'editor' => $editor,
            'form' => $form->createView()
        ];
    }

    private function correctForm(FormInterface $form)
    {
        if ($form->has('save')) {
            $form->remove('save');
        }
        if ($form->has('cancel')) {
            $form->remove('cancel');
        }
        $form->add('save', SubmitType::class, [
            'label' => $this->trans('Save'),
            'icon' => 'fa-check',
            'attr' => [
                'class' => 'btn btn-success',
            ]
        ]);
    }
}
