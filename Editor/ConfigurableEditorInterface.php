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
     * @return string
     */
    public function getFormClass();

    /**
     * The full path to the template for the config form.
     *     e.g. return $this->getDirectory() . '/Resources/views/configure.html.twig';
     * @return string
     */
    public function getTemplatePath();
}
