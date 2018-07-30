<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Editor\Summernote\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('height', IntegerType::class, [
                'label' => $translator->__('Editor default height'),
                'input_group' => ['right' => 'px']
            ])
            ->add('minHeight', IntegerType::class, [
                'label' => $translator->__('Editor minimum height'),
                'input_group' => ['right' => 'px']
            ])
            ->add('maxHeight', IntegerType::class, [
                'label' => $translator->__('Editor maximum height'),
                'input_group' => ['right' => 'px']
            ])
            ->add('useCodeMirror', CheckboxType::class, [
                'label' => $translator->__('Use CodeMirror for code view'),
                'required' => false
            ])
            ->add('useEmoji', CheckboxType::class, [
                'label' => $translator->__('Use emoji from GitHub'),
                'required' => false
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
        return 'scribiteeditor_summernote';
    }
}
