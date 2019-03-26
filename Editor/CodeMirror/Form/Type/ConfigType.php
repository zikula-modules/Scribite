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

namespace Zikula\ScribiteModule\Editor\CodeMirror\Form\Type;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zikula\Common\Translator\IdentityTranslator;

class ConfigType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = $options['translator'];
        $builder
            ->add('showLineNumbers', CheckboxType::class, [
                'label' => $translator->__('Show line numbers')
            ])
            ->add('lineWrapping', CheckboxType::class, [
                'label' => $translator->__('Wrap long lines (instead of scrolling)'),
            ])
            ->add('editorMode', ChoiceType::class, [
                'choices' => $this->getFileNames('mode'),
                'choices_as_values' => true,
                'label' => $translator->__('Modes')
            ])
            ->add('themes', ChoiceType::class, [
                'choices' => $this->getFileNames('theme', 'files'),
                'choices_as_values' => true,
                'multiple' => true,
                'required' => false,
                'attr' => ['style' => 'height:15em'],
                'label' => $translator->__('Themes'),
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
        return 'scribiteeditor_codemirror';
    }

    private function getFileNames($vendorDir, $type = 'directories')
    {
        $finder = new Finder();
        $finder->{$type}()
            ->in('web/editors/codemirror/CodeMirror/' . $vendorDir)
            ->depth(0)
            ->sortByName();
        $fileNames = [];
        foreach ($finder as $splFileInfo) {
            $fileName = 'theme' === $vendorDir ? $splFileInfo->getBasename('.css') : $splFileInfo->getFilename();
            $fileNames[$fileName] = $fileName;
        }

        return $fileNames;
    }
}
