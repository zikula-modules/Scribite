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

namespace Zikula\ScribiteModule\Editor\MarkItUp;

class MarkItUpEditor
{
    /**
     * Provide plugin meta data.
     *
     * @return array meta data
     */
    protected function getMeta()
    {
        return [
            'displayname' => $this->__('markItUp!'),
            'description' => $this->__('markItUp! editor.'),
            'version' => '1.1.14',
            'url' => 'http://markitup.jaysalvat.com/home/',
            'license' => 'MIT, GPL',
            'dependencies' => 'jQuery',
        ];
    }

    public function install()
    {
        ModUtil::setVars($this->serviceId, $this->getDefaults());

        return true;
    }

    public function uninstall()
    {
        ModUtil::delVar($this->serviceId);

        return true;
    }

    public static function getDefaults()
    {
        return [
            'width' => '99%',
            'height' => '400px'
        ];
    }
}
