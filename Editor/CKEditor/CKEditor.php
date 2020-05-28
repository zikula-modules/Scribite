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

namespace Zikula\ScribiteModule\Editor\CKEditor;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Zikula\Bundle\CoreBundle\Translation\TranslatorTrait;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Editor\CKEditor\Form\Type\ConfigType;
use Zikula\ScribiteModule\Editor\CKEditor\Helper\EditorHelper;
use Zikula\ScribiteModule\Editor\ConfigurableEditorInterface;
use Zikula\ScribiteModule\Editor\EditorHelperInterface;
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

    public function getId(): string
    {
        return 'CKEditor';
    }

    public function getMeta(): array
    {
        return [
            'displayname' => $this->trans('CKEditor'),
            'version' => '4.13.0',
            'url' => 'https://ckeditor.com',
            'license' => 'GPL-2.0+, LGPL-2.1+, MPL-1.1+',
            'logo' => 'logo.gif'
        ];
    }

    public function getVars(): array
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
        return $this->getDirectory() . '/Resources/views/configure.html.twig';
    }

    public function getHelperInstance(): EditorHelperInterface
    {
        return new EditorHelper($this->dispatcher);
    }
}
