<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class TextAreaOverrideType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('module', ChoiceType::class, [
                'choices' => $options['modules']
            ])
            ->add('textarea', TextType::class, [
                'input_group' => ['left' => '<i class="fa fa-hashtag"></i>'],
                'constraints' => [
                    new Regex([
                        'pattern' => '/,/',
                        'match' => false,
                        'message' => 'The textarea may not contain a comma'
                    ]
                )]
            ])
            ->add('disabled', CheckboxType::class, [
                'required' => false
            ])
            ->add('params', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/((?:"[^"\n]*"|[^:,\n])*):((?:"[^"\n]*"|[^,\n])*)/',
                        // https://stackoverflow.com/a/38058896/2600812
                        'message' => 'The params must be in the format `foo:bar, fee:bee`'
                    ])
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
            'modules' => [],
        ]);
    }
}
