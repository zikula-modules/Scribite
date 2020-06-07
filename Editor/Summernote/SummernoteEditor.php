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

namespace Zikula\ScribiteModule\Editor\Summernote;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Zikula\Bundle\CoreBundle\Translation\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Editor\EditorHelperInterface;
use Zikula\ScribiteModule\Editor\EditorHelperProviderInterface;
use Zikula\ScribiteModule\Editor\EditorInterface;
use Zikula\ScribiteModule\Editor\Summernote\Form\Type\ConfigType;
use Zikula\ScribiteModule\Editor\Summernote\Helper\EditorHelper;

class SummernoteEditor implements EditorInterface, EditorHelperProviderInterface, ConfigurableEditorInterface
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

    public function getId(): string
    {
        return 'Summernote';
    }

    public function getMeta(): array
    {
        return [
            'displayname' => $this->trans('Summernote'),
            'version' => '0.8.18',
            'url' => 'https://summernote.org',
            'license' => 'MIT',
            'logo' => 'logo.png'
        ];
    }

    public function getVars(): array
    {
        $defaultVars = $this->getDefaults();
        $persistedVars = $this->variableApi->getAll('zikulascribitemodule.summernote');

        return array_merge($defaultVars, $persistedVars);
    }

    private function getDefaults()
    {
        return [
            'height' => 300,
            'minHeight' => 100,
            'maxHeight' => 3000,
            'useCodeMirror' => false,
            'useEmoji' => false
        ];
    }

    public function getDirectory(): string
    {
        return __DIR__;
    }

    public function getFormClass(): string
    {
        return ConfigType::class;
    }

    public function getTemplatePath(): string
    {
        return '@Scribite.SummernoteEditor/configure.html.twig';
    }

    public function getHelperInstance(): EditorHelperInterface
    {
        return new EditorHelper($this->dispatcher);
    }
}
