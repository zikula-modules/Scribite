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

namespace Zikula\ScribiteModule\Editor\TinyMce\Form\Type;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('theme', ChoiceType::class, [
                'choices' => /** @Ignore */ $this->getFilenames('themes'),
                'label' => 'Theme'
            ])
            ->add('dateformat', TextType::class, [
                'label' => 'Date format',
            ])
            ->add('timeformat', TextType::class, [
                'label' => 'Time format',
            ])
            ->add('width', TextType::class, [
                'label' => 'Editor width',
                'input_group' => ['right' => /** @Translate */ 'px/(%)']
            ])
            ->add('height', TextType::class, [
                'label' => 'Editor height',
                'input_group' => ['right' => /** @Translate */ 'px/(%)']
            ])
            ->add('style', TextType::class, [
                'required' => false,
                'label' => 'Editor stylesheet',
                'help' => 'relative to the \'public\' directory. Example: editors/tinymce/css/style.css'
            ])
            ->add('activeplugins', ChoiceType::class, [
                'choices' => /** @Ignore */ $this->getFilenames('plugins'),
                'multiple' => true,
                'label' => 'Active Plugins'
            ])
        ;
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
            ->followLinks()
            ->in('editors/tinymce/tinymce/' . $vendorDir)
            ->depth(0)
            ->sortByName();
        $filenames = [];
        foreach ($finder as $splFileInfo) {
            $filenames[$splFileInfo->getFilename()] = $splFileInfo->getFilename();
        }

        return $filenames;
    }
}
