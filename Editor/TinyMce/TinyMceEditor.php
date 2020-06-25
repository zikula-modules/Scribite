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

namespace Zikula\ScribiteModule\Editor\TinyMce;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Zikula\Bundle\CoreBundle\Translation\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Editor\EditorHelperInterface;
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

    public function getId(): string
    {
        return 'TinyMce';
    }

    public function getMeta(): array
    {
        return [
            'displayname' => $this->trans('TinyMCE'),
            'version' => '5.3.2',
            'url' => 'https://www.tiny.cloud',
            'license' => 'LGPL-2.1',
            'logo' => 'logo.png'
        ];
    }

    public function getVars(): array
    {
        $defaultVars = $this->getDefaults();
        $persistedVars = $this->variableApi->getAll('zikulascribitemodule.tinymce');

        return array_merge($defaultVars, $persistedVars);
    }

    public static function getDefaults()
    {
        return [
            'style' => 'editors/tinymce/css/style.css',
            'skin' => 'silver',
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
        return '@Scribite.TinyMceEditor/configure.html.twig';
    }

    public function getHelperInstance(): EditorHelperInterface
    {
        return new EditorHelper($this->dispatcher, $this->getVars());
    }
}
