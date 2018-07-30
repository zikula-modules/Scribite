<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleOverridesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('overrides', CollectionType::class, [
                'entry_type' => ModuleOverrideType::class,
                'entry_options' => [
                    'modules' => $options['modules'],
                    'editors' => $options['editors'],
                ],
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ;
        $builder->get('overrides')
            ->addModelTransformer(new CallbackTransformer(
                function ($dataFromStorage) {
                    return $dataFromStorage; // This is handled by the Event Listener below instead (a quirk of Symfony).
                },
                function ($dataFromForm) {
                    if (!empty($dataFromForm)) {
                        $data = [];
                        foreach ($dataFromForm as $fields) {
                            $data[$fields['module']] = ['editor' => $fields['editor']];
                        }
                        $dataFromForm = $data;
                    }

                    return $dataFromForm;
                }
            ))
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                // this listener transforms the key/value pair to proper data for the form. The ModelTransformer cannot do it properly.
                $data = $event->getData();
                $result = [];
                if ($data) {
                    foreach ($data as $module => $params) {
                        if (isset($params['editor'])) {
                            $result[] = ['module' => $module, 'editor' => $params['editor']];
                        }
                    }
                }
                $event->setData($result);
            }, 1)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'modules' => [],
            'editors' => []
        ]);
    }
}
