<?php

/**
 * Copyright Scribite Team 2011
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package cribite
 * @link https://github.com/zikula-modules/Scribite
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

class Scribite_Controller_Ajax extends Zikula_AbstractController
{

    /**
    * Show images
    *
    * @param array $args POST/REQUEST vars
    * @return The render var
    */   
    
    public function showImages()
    {
        return new Zikula_Response_Ajax(array('data' => ModUtil::apiFunc('Scribite','user','showImages')));
    }

}