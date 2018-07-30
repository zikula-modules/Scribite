<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Editor\TinyMce\Form\Type;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('theme', ChoiceType::class, [
                'choices' => $this->getFilenames('themes'),
                'choices_as_values' => true,
                'label' => $translator->__('Theme')
            ])
            ->add('dateformat', TextType::class, [
                'label' => $translator->__('Date format'),
            ])
            ->add('timeformat', TextType::class, [
                'label' => $translator->__('Time format'),
            ])
            ->add('width', TextType::class, [
                'label' => $translator->__('Editor width'),
                'input_group' => ['right' => 'px/(%)']
            ])
            ->add('height', TextType::class, [
                'label' => $translator->__('Editor height'),
                'input_group' => ['right' => 'px/(%)']
            ])
            ->add('style', TextType::class, [
                'required' => false,
                'label' => $translator->__('Editor stylesheet'),
                'help' => [
                    $translator->__('relative to the \'web\' directory. Example: editors/tinymce/css/style.css'),
                ]
            ])
            ->add('activeplugins', ChoiceType::class, [
                'choices' => $this->getFilenames('plugins'),
                'choices_as_values' => true,
                'multiple' => true,
                'label' => $translator->__('Active Plugins'),
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
        return 'scribiteeditor_tinymceeditor';
    }

    private function getFilenames($vendorDir)
    {
        $finder = new Finder();
        $finder->directories()
            ->in('web/editors/tinymce/tinymce/' . $vendorDir)
            ->depth(0)
            ->sortByName();
        $filenames = [];
        foreach ($finder as $splFileInfo) {
            $filenames[$splFileInfo->getFilename()] = $splFileInfo->getFilename();
        }

        return $filenames;
    }
}
