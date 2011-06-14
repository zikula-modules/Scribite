<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

/**
 * Listeners class.
 */
class Scribite_Listeners
{
    /**
     * Event listener for 'core.postinit' event.
     * 
     * @param Zikula_Event $event
     *
     * @return void
     */
    public static function coreinit(Zikula_Event $event)
    {
        // get the module name
        $args = array();
        $args['modulename'] = ModUtil::getName();
        $module = $args['modulename'];

        // exit if Content module active - to avoid double loadings if user has given ids and functions
        if ($args['modulename'] == 'content') {
            return;
        }

        // Security check if user has COMMENT permission for scribite
        if (!SecurityUtil::checkPermission('Scribite::', "$module::", ACCESS_COMMENT)) {
            return;
        }

        // get passed func
        $func = FormUtil::getPassedValue('func', isset($args['func']) ? $args['func'] : null, 'GET');

        // get config for current module
        $modconfig = array();
        $modconfig = ModUtil::apiFunc('Scribite', 'user', 'getModuleConfig', array('modulename' => $args['modulename']));

        // return if module is not supported or editor is not set
        if (!$modconfig['mid'] || $modconfig['modeditor'] == '-') {
            return;
        }

        // check if current func is fine for editors or funcs is empty (or all funcs)
        if (is_array($modconfig['modfuncs']) && (in_array($func, $modconfig['modfuncs']) || $modconfig['modfuncs'][0] == 'all')) {
            $args['areas'] = $modconfig['modareas'];
            $args['editor'] = $modconfig['modeditor'];

            $scribite = ModUtil::apiFunc('Scribite', 'user', 'loader', array('modulename' => $args['modulename'],
                            'editor' => $args['editor'],
                            'areas' => $args['areas']));

            // add the scripts to page header
            if ($scribite) {
                PageUtil::AddVar('header', $scribite);
            }
        }
    }
}
