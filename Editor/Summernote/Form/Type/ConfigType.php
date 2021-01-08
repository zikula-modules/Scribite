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

namespace Zikula\ScribiteModule\Editor\Summernote\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Translation\Extractor\Annotation\Translate;

class ConfigType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('height', IntegerType::class, [
                'label' => 'Editor default height',
                'input_group' => ['right' => /** @Translate */ 'px']
            ])
            ->add('minHeight', IntegerType::class, [
                'label' => 'Editor minimum height',
                'input_group' => ['right' => /** @Translate */ 'px']
            ])
            ->add('maxHeight', IntegerType::class, [
                'label' => 'Editor maximum height',
                'input_group' => ['right' => /** @Translate */ 'px']
            ])
            ->add('useCodeMirror', CheckboxType::class, [
                'label' => 'Use CodeMirror for code view',
                'required' => false
            ])
            ->add('useEmoji', CheckboxType::class, [
                'label' => 'Use emoji from GitHub',
                'required' => false
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'scribiteeditor_summernote';
    }
}
