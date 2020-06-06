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

namespace Zikula\ScribiteModule\Editor;

interface ConfigurableEditorInterface
{
    /**
     * The FqCN of the form class (e.g. return ConfigType::class;)
     */
    public function getFormClass(): string;

    /**
     * The namespaced path to the template for the config form.
     *     e.g. return '@Scribite.CKEditor/configure.html.twig';
     *     the @Scribite. is required. The second part is the CLASSNAME of
     *     the Editor class, then the template name.
     */
    public function getTemplatePath(): string;
}
