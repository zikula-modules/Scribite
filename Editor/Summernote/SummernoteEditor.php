<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Editor\Summernote;

use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\EditorInterface;

class SummernoteEditor implements EditorInterface
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

    public function getMeta()
    {
        return [
            'displayname' => $this->__('Summernote'),
            'version' => '0.8.7',
            'url' => 'http://summernote.org',
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
        $persistedVars = $this->variableApi->getAll('zikulascribitemodule.summernote');

        return array_merge($defaultVars, $persistedVars);
    }

    private function getDefaults()
    {
        return [
        ];
    }
}
