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

namespace Zikula\ScribiteModule\Editor\CKEditor\Form\Type;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Translation\Extractor\Annotation\Ignore;
use Translation\Extractor\Annotation\Translate;

class ConfigType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('skin', ChoiceType::class, [
                'choices' => /** @Ignore */$this->getSkinChoices(),
                'label' => 'Skin'
            ])
            ->add('uicolor', TextType::class, [
                'label' => 'Editor UI color',
                'help' => 'Any hexadecimal color can be used. Include the hash symbol (#).'
            ])
            ->add('langmode', ChoiceType::class, [
                'choices' => [
                    'Use Zikula language definition' => 'zklang',
                    'Let CKEditor match language automatically' => 'cklang'
                ],
                'label' => 'Editor UI language'
            ])
            ->add('barmode', ChoiceType::class, [
                'choices' => [
                    'Basic' => 'Basic',
                    'Simple' => 'Simple',
                    'Standard' => 'Standard',
                    'Extended' => 'Extended',
                    'Full' => 'Full',
                    'Special1' => 'Special1',
                    'Special2' => 'Special2',
                ],
                'label' => 'Toolbar',
                'help' => 'Special1 and Special2 must be manually configured in custconfig.js. You have to refresh your browser-cache to see the changes!'
            ])
            ->add('height', IntegerType::class, [
                'label' => 'Editor default height',
                'input_group' => ['right' => /** @Translate */'px']
            ])
            ->add('resizemode', ChoiceType::class, [
                'choices' => [
                    'Use resize' => 'resize',
                    'Use autogrow' => 'autogrow',
                    'No resizing' => 'noresize'
                ],
                'label' => 'Editor resizing mode to use'
            ])
            ->add('resizeminheight', IntegerType::class, [
                'label' => 'Editor minimum height for \'resize\' plugin',
                'input_group' => ['right' => /** @Translate */'px']
            ])
            ->add('resizemaxheight', IntegerType::class, [
                'label' => 'Editor maximum height for \'resize\' plugin',
                'input_group' => ['right' => /** @Translate */'px']
            ])
            ->add('growminheight', IntegerType::class, [
                'label' => 'Editor minimum height for \'autogrow\' plugin',
                'input_group' => ['right' => /** @Translate */'px']
            ])
            ->add('growmaxheight', IntegerType::class, [
                'label' => 'Editor maximum height for \'autogrow\' plugin',
                'input_group' => ['right' => /** @Translate */'px']
            ])
            ->add('entermode', ChoiceType::class, [
                'choices' => /** @Ignore */$this->getEnterModes(),
                'label' => 'Editor Enter mode',
                'help' => 'Note: It is recommended to use the [p] setting because of its semantic value and correctness. The editor is optimized for this setting.'
            ])
            ->add('shiftentermode', ChoiceType::class, [
                'choices' => /** @Ignore */$this->getEnterModes(),
                'label' => 'Editor Shift-Enter mode',
                'help' => 'Note: It is recommended to use the [p] setting because of its semantic value and correctness. The editor is optimized for this setting.'
            ])
            ->add('extraplugins', TextType::class, [
                'required' => false,
                'label' => 'Editor extra plugins',
                /** @Ignore */
                'help' => [
                    /** @Translate */'Example: <code>stylesheetparser,zikulapagebreak,simplemedia</code>',
                    /** @Translate */'(Note: don\'t use spaces)',
                ],
                'help_html' => true
            ])
            ->add('style_editor', TextType::class, [
                'required' => false,
                'label' => 'Editor stylesheet',
                /** @Ignore */
                'help' => [
                    /** @Translate */
                    'You can try to enter your theme stylesheet here if you want. In most cases, the editor fits to the theme then (relative to the \'public\' directory.',
                    /** @Translate */
                    'Example: <code>themes/zikulabootstrap/css/style.css</code>',
                ],
                'help_html' => true
            ])
            ->add('filemanagerpath', TextType::class, [
                'required' => false,
                'label' => 'Path to filemanager',
                /** @Ignore */
                'help' => [
                    /** @Translate */
                    'Used to upload and select images or other files. Supported: CKFinder and KCFinder.',
                    /** @Translate */
                    'Example paths: <code>utils/ckfinder</code> or <code>utils/kcfinder</code> (rights to execute php)', // @todo
                ],
                'help_html' => true
            ])
        ;
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
            ->followLinks()
            ->in('editors/ckeditor/ckeditor/skins')
            ->depth(0)
            ->sortByName();
        $skins = [];
        foreach ($finder as $splFileInfo) {
            $skins[$splFileInfo->getFilename()] = $splFileInfo->getFilename();
        }

        return $skins;
    }

    private function getEnterModes()
    {
        return [
            'Create new <p> paragraphs' => 'CKEDITOR.ENTER_P',
            'Break lines with <br> element' => 'CKEDITOR.ENTER_BR',
            'Create new <div> bocks' => 'CKEDITOR.ENTER_DIV',
        ];
    }
}
