<?php

/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license MIT
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

namespace Zikula\ScribiteModule\Editor\CKEditor;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\CKEditor\Form\Type\ConfigType;
use Zikula\ScribiteModule\Editor\CKEditor\Helper\EditorHelper;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Editor\EditorHelperProviderInterface;
use Zikula\ScribiteModule\Editor\EditorInterface;

class CKEditor implements EditorInterface, EditorHelperProviderInterface, ConfigurableEditorInterface
{
    use TranslatorTrait;

    /**
     * @var VariableApiInterface
     */
    private $variableApi;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param TranslatorInterface $translator
     * @param VariableApiInterface $variableApi
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        TranslatorInterface $translator,
        VariableApiInterface $variableApi,
        EventDispatcherInterface $dispatcher
    ) {
        $this->setTranslator($translator);
        $this->variableApi = $variableApi;
        $this->dispatcher = $dispatcher;
    }

    public function setTranslator($translator)
    {
        $this->translator = $translator;
    }

    /**
     * Provide plugin meta data.
     *
     * @return array meta data
     */
    public function getMeta()
    {
        return [
            'displayname' => $this->__('CKEditor'),
            'version' => '4.6.2',
            'url' => 'http://ckeditor.com',
            'license' => 'GPL-2.0+, LGPL-2.1+, MPL-1.1+',
            'logo' => 'logo.gif'
        ];
    }

    public function getDirectory()
    {
        return __DIR__;
    }

    public function getHelperInstance()
    {
        return new EditorHelper($this->dispatcher);
    }

    public function getVars()
    {
        $defaultVars = $this->getDefaults();
        $persistedVars = $this->variableApi->getAll('zikulascribitemodule.ckeditor');

        return array_merge($defaultVars, $persistedVars);
    }

    private function getDefaults()
    {
        return [
            'barmode' => 'Standard',
            'height' => '200',
            'resizemode' => 'resize',
            'resizeminheight' => '250',
            'resizemaxheight' => '3000',
            'growminheight' => '200',
            'growmaxheight' => '400',
            'style_editor' => 'editors/ckeditor/css/contents.css',
            'skin' => 'moono-lisa',
            'uicolor' => '#D3D3D3',
            'langmode' => 'zklang',
            'entermode' => 'CKEDITOR.ENTER_P',
            'shiftentermode' => 'CKEDITOR.ENTER_BR',
            'extraplugins' => '',
            'filemanagerpath' => '',
        ];
    }

    public function getFormClass()
    {
        return ConfigType::class;
    }

    public function getTemplatePath()
    {
        return $this->getDirectory() . '/Resources/views/configure.html.twig';
    }
}
