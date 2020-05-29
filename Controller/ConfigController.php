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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Zikula\Bundle\CoreBundle\Controller\AbstractController;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ExtensionsModule\Api\VariableApi;
use Zikula\PermissionsModule\Annotation\PermissionCheck;
use Zikula\ScribiteModule\Collector\EditorCollector;
use Zikula\ThemeModule\Engine\Annotation\Theme;

/**
 * @Route("/config")
 */
class ConfigController extends AbstractController
{
    /**
     * @Route("/settings")
     * @Template("@ZikulaScribiteModule/Config/settings.html.twig")
     * @Theme("admin")
     * @PermissionCheck("admin")
     */
    public function settingsAction(
        Request $request,
        EditorCollector $editorCollector
    ) {
        $form = $this->createSettingsForm($editorCollector);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('save')->isClicked()) {
                $formData = $form->getData();
                $this->setVars($formData);
                $this->addFlash('status', $this->trans('Done! Module configuration updated.'));
            }
            if ($form->get('cancel')->isClicked()) {
                $this->addFlash('status', $this->trans('Operation cancelled.'));
            }
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/allow-embedded-media")
     * @PermissionCheck("admin")
     * Update security settings (allowed html tags, html purifier configuration) to allow displaying embedded media.
     */
    public function allowEmbeddedMediaAction(VariableApiInterface $variableApi)
    {
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

        $this->addFlash('success', $this->trans('Done! Settings have been updated for allowing display of embedded media.'));

        return $this->redirectToRoute('zikulascribitemodule_config_settings');
    }

    private function createSettingsForm(EditorCollector $editorCollector)
    {
        return $this->createFormBuilder()
            ->add('DefaultEditor', ChoiceType::class, [
                'label' => $this->trans('Default Editor'),
                'choices' => $editorCollector->getEditorsChoiceList(),
                'data' => $this->getVar('DefaultEditor', 'CKEditor')
            ])
            ->add('save', SubmitType::class, [
                'label' => $this->trans('Save'),
                'icon' => 'fa-check',
                'attr' => [
                    'class' => 'btn btn-success',
                ]
            ])
            ->add('cancel', SubmitType::class, [
                'label' => $this->trans('Cancel'),
                'icon' => 'fa-times',
                'attr' => [
                    'class' => 'btn btn-default',
                ],
            ])
            ->getForm()
        ;
    }
}
