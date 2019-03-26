<?php

declare(strict_types=1);

namespace Zikula\ScribiteModule\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zikula\Core\Controller\AbstractController;
use Zikula\ExtensionsModule\Api\VariableApi;
use Zikula\ThemeModule\Engine\Annotation\Theme;

/**
 * @Route("/config")
 */
class ConfigController extends AbstractController
{
    /**
     * @Route("/settings")
     * @Theme("admin")
     * @Template("ZikulaScribiteModule:Config:settings.html.twig")
     */
    public function settingsAction(Request $request)
    {
        if (!$this->hasPermission('ZikulaScribiteModule::', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        $form = $this->createSettingsForm();
        if ($form->handleRequest($request)->isValid()) {
            if ($form->get('save')->isClicked()) {
                $formData = $form->getData();
                $this->setVars($formData);
                $this->addFlash('status', $this->__('Done! Module configuration updated.'));
            }
            if ($form->get('cancel')->isClicked()) {
                $this->addFlash('status', $this->__('Operation cancelled.'));
            }
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/allow-embedded-media")
     * Update security settings (allowed html tags, html purifier configuration) to allow displaying embedded media.
     */
    public function allowEmbeddedMediaAction()
    {
        if (!$this->hasPermission('ZikulaScribiteModule::', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        $variableApi = $this->get('zikula_extensions_module.api.variable');
        // step 1 - update allowed html tags
        $allowedHtml = $variableApi->getSystemVar('AllowableHTML');
        foreach (['div', 'iframe', 'blockquote', 'script'] as $tagName) {
            $allowedHtml[$tagName] = 2; // allow with attributes
        }
        $variableApi->set(VariableApi::CONFIG, 'AllowableHTML', $allowedHtml);

        // step 2 - update html purifier configuration
        $config = $variableApi->get('ZikulaSecurityCenterModule', 'htmlpurifierConfig', '');
        $config = '' !== $config ? unserialize($config) : [];
        $config['HTML']['SafeIframe'] = true;
        $config['URI']['SafeIframeRegexp'] = '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%'; //allow YouTube and Vimeo
        $config['HTML']['AllowedElements'] = ['iframe'];

        $variableApi->set('ZikulaSecurityCenterModule', 'htmlpurifierConfig', serialize($config));

        $this->addFlash('success', $this->__('Done! Settings have been updated for allowing display of embedded media.'));

        return $this->redirectToRoute('zikulascribitemodule_config_settings');
    }

    private function createSettingsForm()
    {
        return $this->createFormBuilder()
            ->add('DefaultEditor', ChoiceType::class, [
                'label' => $this->__('Default Editor'),
                'choices' => $this->get('zikula_scribite_module.collector.editor_collector')->getEditorsChoiceList(),
                'choices_as_values' => true,
                'data' => $this->getVar('DefaultEditor', 'CKEditor')
            ])
            ->add('save', SubmitType::class, [
                'label' => $this->__('Save'),
                'icon' => 'fa-check',
                'attr' => [
                    'class' => 'btn btn-success',
                ]
            ])
            ->add('cancel', SubmitType::class, [
                'label' => $this->__('Cancel'),
                'icon' => 'fa-times',
                'attr' => [
                    'class' => 'btn btn-default',
                ],
            ])
            ->getForm()
        ;
    }
}
