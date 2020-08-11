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

namespace Zikula\ScribiteModule\Editor\CodeMirror;

use Symfony\Contracts\Translation\TranslatorInterface;
use Zikula\Bundle\CoreBundle\Translation\TranslatorTrait;
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

    public function __construct(
        TranslatorInterface $translator,
        VariableApiInterface $variableApi
    ) {
        $this->setTranslator($translator);
        $this->variableApi = $variableApi;
    }

    public function getId(): string
    {
        return 'CodeMirror';
    }

    public function getMeta(): array
    {
        return [
            'displayname' => $this->trans('CodeMirror'),
            'version' => '5.55.0',
            'url' => 'https://codemirror.net',
            'license' => 'MIT',
            'logo' => 'logo.png'
        ];
    }

    public function getVars(): array
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
            'themes' => []
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
        return '@Scribite.CodeMirrorEditor/configure.html.twig';
    }
}
