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

interface EditorInterface
{
    /**
     * a unique id
     */
    public function getId(): string;

    /**
     * Editor meta info.
     * Required keys:
     *    displayname - the name the editor is known by
     *    version - the version of the editor vendor
     *    url - the url to the vendor
     *    license - the license the vendor is distributed under
     *    logo - the name of the logo file within `Resources/public/images/` (e.g. `logo.png`)
     */
    public function getMeta(): array;

    /**
     * The directory of this file (e.g. return __DIR__; )
     */
    public function getDirectory(): string;

    /**
     * An array of variables retrieved from persistence with proper default values.
     */
    public function getVars(): array;
}
