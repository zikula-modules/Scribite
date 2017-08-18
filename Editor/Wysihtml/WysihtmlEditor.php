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

namespace Zikula\ScribiteModule\Editor\Wysihtml;

class WysihtmlEditor
{
    /**
     * Provide plugin meta data.
     *
     * @return array meta data
     */
    protected function getMeta()
    {
        return [
            'displayname' => $this->__('wysihtml'),
            'description' => $this->__('Wysihtml is an lightweight HTML5 WYSIWYG editor. It is provided under the MIT license.'),
            'version' => '0.6.0-beta1',
            'license' => 'MIT',
            'homepage' => 'http://wysihtml.com/',
        ];
    }
}
