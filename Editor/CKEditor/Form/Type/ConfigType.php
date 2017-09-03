<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Editor\CKEditor\Form\Type;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zikula\Common\Translator\IdentityTranslator;
use Zikula\Common\Translator\TranslatorInterface;

class ConfigType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = $options['translator'];
        $builder
            ->add('skin', ChoiceType::class, [
                'choices' => $this->getSkinChoices(),
                'choices_as_values' => true,
                'label' => $translator->__('Skin')
            ])
            ->add('uicolor', TextType::class, [
                'label' => $translator->__('Editor UI color'),
                'help' => $translator->__('Any hexadecimal color can be used. Include the hash symbol (#).')
            ])
            ->add('langmode', ChoiceType::class, [
                'choices' => [
                    $translator->__('Use Zikula language definition') => 'zklang',
                    $translator->__('Let CKEditor match language automatically') => 'cklang'
                ],
                'choices_as_values' => true,
                'label' => $translator->__('Editor UI language')
            ])
            ->add('barmode', ChoiceType::class, [
                'choices' => [
                    $translator->__('Basic') => 'Basic',
                    $translator->__('Simple') => 'Simple',
                    $translator->__('Standard') => 'Standard',
                    $translator->__('Extended') => 'Extended',
                    $translator->__('Full') => 'Full',
                    $translator->__('Special1') => 'Special1',
                    $translator->__('Special2') => 'Special2',
                ],
                'choices_as_values' => true,
                'label' => $translator->__('Toolbar'),
                'help' => $translator->__('Special1 and Special2 must be manually configured in custconfig.js. You have to refresh your browser-cache to see the changes!')
            ])
            ->add('height', TextType::class, [
                'label' => $translator->__('Editor default height in px'),
                'input_group' => ['right' => 'px']
            ])
            ->add('resizemode', ChoiceType::class, [
                'choices' => [
                    $translator->__('Use resize') => 'resize',
                    $translator->__('Use autogrow') => 'autogrow',
                    $translator->__('No resizing') => 'noresize'
                ],
                'choices_as_values' => true,
                'label' => $translator->__('Editor resizing mode to use')
            ])
            ->add('resizeminheight', TextType::class, [
                'label' => $translator->__('Editor minimum height in px for \'resize\' plugin'),
                'input_group' => ['right' => 'px']
            ])
            ->add('resizemaxheight', TextType::class, [
                'label' => $translator->__('Editor maximum height in px for \'resize\' plugin'),
                'input_group' => ['right' => 'px']
            ])
            ->add('growminheight', TextType::class, [
                'label' => $translator->__('Editor minimum height in px for \'autogrow\' plugin'),
                'input_group' => ['right' => 'px']
            ])
            ->add('growmaxheight', TextType::class, [
                'label' => $translator->__('Editor maximum height in px for \'autogrow\' plugin'),
                'input_group' => ['right' => 'px']
            ])
            ->add('entermode', ChoiceType::class, [
                'choices' => $this->getEnterModes($translator),
                'choices_as_values' => true,
                'label' => $translator->__('Editor Enter mode'),
                'help' => $translator->__('Note: It is recommended to use the [p] setting because of its semantic value and correctness. The editor is optimized for this setting.')
            ])
            ->add('shiftentermode', ChoiceType::class, [
                'choices' => $this->getEnterModes($translator),
                'choices_as_values' => true,
                'label' => $translator->__('Editor Shift-Enter mode'),
                'help' => $translator->__('Note: It is recommended to use the [p] setting because of its semantic value and correctness. The editor is optimized for this setting.')
            ])
            ->add('extraplugins', TextType::class, [
                'required' => false,
                'label' => $translator->__('Editor extra plugins'),
                'help' => [
                    $translator->__('Example: stylesheetparser,zikulapagebreak,simplemedia'),
                    $translator->__('(Note: don\'t use spaces)'),
                ]
            ])
            ->add('style_editor', TextType::class, [
                'required' => false,
                'label' => $translator->__('Editor stylesheet'),
                'help' => [
                    $translator->__('You can try to enter your theme stylesheet here if you want. In most cases, the editor fits to the theme then (relative to the \'web\' directory.'),
                    $translator->__('Example: themes/zikulabootstrap/css/style.css'),
                ]
            ])
            ->add('filemanagerpath', TextType::class, [
                'required' => false,
                'label' => $translator->__('Path to filemanager'),
                'help' => [
                    $translator->__('Used to upload and select images or other files. Supported: CKFinder and KCFinder.'),
                    $translator->__('Example paths: utils/ckfinder or utils/kcfinder (rights to execute php)'), // @todo
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translator' => new IdentityTranslator(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'scribiteeditor_ckeditor';
    }

    private function getSkinChoices()
    {
        $finder = new Finder();
        $finder->directories()
            ->in('web/editors/ckeditor/ckeditor/skins')
            ->depth(0)
            ->sortByName();
        $skins = [];
        foreach ($finder as $splFileInfo) {
            $skins[$splFileInfo->getFilename()] = $splFileInfo->getFilename();
        }

        return $skins;
    }

    private function getEnterModes(TranslatorInterface $translator)
    {
        return [
            $translator->__('Create new <p> paragraphs') => 'CKEDITOR.ENTER_P',
            $translator->__('Break lines with <br> element') => 'CKEDITOR.ENTER_BR',
            $translator->__('Create new <div> bocks') => 'CKEDITOR.ENTER_DIV',
        ];
    }
}
