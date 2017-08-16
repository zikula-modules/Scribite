<?php

namespace Zikula\ScribiteModule\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zikula\Core\Controller\AbstractController;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ThemeModule\Engine\Annotation\Theme;

class EditorController extends AbstractController
{
    /**
     * @Route("/editors")
     * @Theme("admin")
     * @Template
     */
    public function listAction()
    {
        if (!$this->hasPermission('ZikulaScribiteModule::', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }
        $editors = $this->get('zikula_scribite_module.collector.editor_collector')->getEditors();
        foreach ($editors as $editorId => $editor) {
            $this->get('zikula_scribite_module.helper.asset_helper')->install($editorId, $editor);
        }

        return [
            'editors' => $editors
        ];
    }

    /**
     * @Route("/configure/{editorId}")
     * @Theme("admin")
     * @Template
     * @param $editorId
     * @return Response|array
     */
    public function configureAction(Request $request, $editorId)
    {
        if (!$this->hasPermission('ZikulaScribiteModule::' . $editorId, '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }
        $editor = $this->get('zikula_scribite_module.collector.editor_collector')->get($editorId);
        $this->get('zikula_scribite_module.helper.asset_helper')->install($editorId, $editor);
        if (!($editor instanceof ConfigurableEditorInterface)) {
            $this->addFlash('info', $this->__f('%ed is not a configurable editor.', ['%s' => $editor->getMeta()['displayname']]));

            return $this->redirectToRoute('zikulascribitemodule_editor_list');
        }
        $variableApi = $this->get('zikula_extensions_module.api.variable');
        $form = $this->createForm($editor->getFormClass(), $editor->getVars(), [
            'translator' => $this->getTranslator()
        ]);
        $this->correctForm($form);

        if ($form->handleRequest($request)->isValid()) {
            if ($form->get('save')->isClicked()) {
                $formData = $form->getData();
                $variableApi->setAll('zikulascribitemodule.' . strtolower($editorId), $formData);
                $this->addFlash('status', $this->__('Done! Editor configuration updated.'));
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
        $form
            ->add('save', SubmitType::class, [
                'label' => $this->__('Save'),
                'icon' => 'fa-check',
                'attr' => [
                    'class' => 'btn btn-success',
                ]
            ]);
    }
}
