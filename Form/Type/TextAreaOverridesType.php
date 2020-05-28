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

namespace Zikula\ScribiteModule\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextAreaOverridesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('overrides', CollectionType::class, [
                'entry_type' => TextAreaOverrideType::class,
                'entry_options' => [
                    'modules' => $options['modules'],
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
                            $data[$fields['module']][$fields['textarea']]['disabled'] = $fields['disabled'];
                            if (!empty($fields['params'])) {
                                $data[$fields['module']][$fields['textarea']]['params'] = $this->explodeParams($fields['params']);
                            }
                        }
                        $dataFromForm = $data;
                    }

                    return $dataFromForm;
                }
            ))
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                // this listener transforms the stored array to proper data for the form. The ModelTransformer cannot do it properly.
                $data = $event->getData();
                $result = [];
                if ($data) {
                    foreach ($data as $module => $params) {
                        foreach ($params as $textarea => $config) {
                            if ('editor' === $textarea) {
                                continue;
                            }
                            $result[] = [
                                'module' => $module,
                                'textarea' => $textarea,
                                'disabled' => $config['disabled'],
                                'params' => !empty($config['params']) ? $this->implodeParams($config['params']) : ''
                            ];
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
        ]);
    }

    private function explodeParams($params)
    {
        $paramsArray = [];
        // convert the name/value pair string to an array
        if (!empty($params)) {
            $params = explode(',', $params);
            foreach ($params as $param) {
                if (mb_strpos($param, ':')) {
                    list($k, $v) = explode(':', trim($param));
                    $paramsArray[trim($k)] = trim($v);
                } else {
                    break;
                }
            }
        }

        return $paramsArray;
    }

    private function implodeParams(array $params)
    {
        $pairedArray = [];
        foreach ($params as $key => $value) {
            $pairedArray[] = "${key}:${value}";
        }

        return implode(',', $pairedArray);
    }
}
