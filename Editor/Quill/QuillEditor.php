<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Editor\Quill;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Editor\EditorHelperProviderInterface;
use Zikula\ScribiteModule\Editor\EditorInterface;
use Zikula\ScribiteModule\Editor\Quill\Form\Type\ConfigType;
use Zikula\ScribiteModule\Editor\Quill\Helper\EditorHelper;

class QuillEditor implements EditorInterface, EditorHelperProviderInterface, ConfigurableEditorInterface
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
            'displayname' => $this->__('Quill'),
            'version' => '1.3.6',
            'url' => 'https://quilljs.com',
            'license' => 'MIT',
            'logo' => 'logo.png'
        ];
    }

    public function getVars()
    {
        $defaultVars = $this->getDefaults();
        $persistedVars = $this->variableApi->getAll('zikulascribitemodule.quill');

        return array_merge($defaultVars, $persistedVars);
    }

    private function getDefaults()
    {
        return [
            'theme' => 'snow'
        ];
    }

    public function getDirectory()
    {
        return __DIR__;
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
        return new EditorHelper($this->dispatcher);
    }
}
