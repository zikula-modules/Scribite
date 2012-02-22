<?php

/**
 * Copyright Scribite Team 2011
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package EasyUpload
 * @link https://github.com/zikula-modules/Scribite
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

class Scribite_Handler_ConfigImageUpload extends Zikula_Form_AbstractHandler
{

    function initialize(Zikula_Form_View $view)
    {
        $view->assign($this->getVars());
        return true;
    }


    function handleCommand(Zikula_Form_View $view, &$args)
    {
        // check for valid form
        if (!$view->isValid()) {
            return false;
        }
        
        $data = $view->getValues();

        $this->setVars($data);
        return true;


    }

}
