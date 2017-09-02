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

namespace Zikula\ScribiteModule\Editor\CodeMirror;

use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\CodeMirror\Form\Type\ConfigType;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Editor\EditorInterface;

class CodeMirrorEditor implements EditorInterface, ConfigurableEditorInterface
{
    use TranslatorTrait;

    /**
     * @var VariableApiInterface
     */
    private $variableApi;

    /**
     * @param TranslatorInterface $translator
     * @param VariableApiInterface $variableApi
     */
    public function __construct(
        TranslatorInterface $translator,
        VariableApiInterface $variableApi
    ) {
        $this->setTranslator($translator);
        $this->variableApi = $variableApi;
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
            'displayname' => $this->__('CodeMirror'),
            'version' => '5.29.0',
            'url' => 'http://codemirror.net/',
            'license' => 'MIT',
            'logo' => 'logo.png'
        ];
    }

    public function getDirectory()
    {
        return __DIR__;
    }

    public function getVars()
    {
        $defaultVars = $this->getDefaults();
        $persistedVars = $this->variableApi->getAll('zikulascribitemodule.codemirror');

        return array_merge($defaultVars, $persistedVars);
    }

    public static function getDefaults()
    {
        return [
            'showLineNumbers' => true,
            'lineWrapping' => true,
            'editorMode' => 'htmlmixed',
            'themes' => ['default']
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
