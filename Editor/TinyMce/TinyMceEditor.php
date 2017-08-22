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

namespace Zikula\ScribiteModule\Editor\TinyMce;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Editor\EditorHelperProviderInterface;
use Zikula\ScribiteModule\Editor\EditorInterface;
use Zikula\ScribiteModule\Editor\TinyMce\Form\Type\ConfigType;
use Zikula\ScribiteModule\Editor\TinyMce\Helper\EditorHelper;

class TinyMceEditor implements EditorInterface, EditorHelperProviderInterface, ConfigurableEditorInterface
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
            'displayname' => $this->__('TinyMCE'),
            'version' => '4.4.1',
            'url' => 'http://www.tinymce.com/',
            'license' => 'LGPL-2.1',
            'logo' => 'logo.png'
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

    public function getHelperInstance()
    {
        return new EditorHelper($this->dispatcher, $this->getVars());
    }

    public function getDirectory()
    {
        return __DIR__;
    }

    public function getVars()
    {
        $defaultVars = $this->getDefaults();
        $persistedVars = $this->variableApi->getAll('zikulascribitemodule.tinymce');

        return array_merge($defaultVars, $persistedVars);
    }

    public static function getDefaults()
    {
        return [
            'style' => 'editors/tinymce/css/style.css',
            'skin' => 'modern',
            'width' => '100%',
            'height' => '400px',
            'dateformat' => '%Y-%m-%d',
            'timeformat' => '%H:%M:%S',
            'activeplugins' => [
                'autoresize',
                'code',
                'fullscreen',
                'insertdatetime',
                'link',
                'preview',
                'print',
                'wordcount'
            ]
        ];
    }
}
