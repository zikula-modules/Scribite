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

namespace Zikula\ScribiteModule\Editor\MarkItUp;

use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Editor\EditorInterface;
use Zikula\ScribiteModule\Editor\MarkItUp\Form\Type\ConfigType;

class MarkItUpEditor implements EditorInterface, ConfigurableEditorInterface
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
     * @return array meta data
     */
    public function getMeta()
    {
        return [
            'displayname' => $this->__('markItUp!'),
            'version' => '1.1.14',
            'url' => 'http://markitup.jaysalvat.com/home/',
            'license' => 'MIT, GPL'
        ];
    }

    public function getFormClass() {
        return ConfigType::class;
    }

    public function getTemplatePath() {
        return $this->getDirectory() . '/Resources/views/configure.html.twig';
    }

    public function getDirectory() {
        return __DIR__;
    }

    public function getVars() {
        $defaultVars = $this->getDefaults();
        $persistedVars = $this->variableApi->getAll('zikulascribitemodule.markitup');

        return array_merge($defaultVars, $persistedVars);
    }

    public function getDefaults()
    {
        return [
            'width' => '99%',
            'height' => '400px'
        ];
    }
}
