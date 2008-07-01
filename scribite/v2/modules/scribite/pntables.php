<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) 2001, Zikula Development Team
 * @link http://www.zikula.org
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 *
 * @package scribite!
 * @license http://www.gnu.org/copyleft/gpl.html
 *
 * @author sven schomacker
 * @version 2.1
 */

function scribite_pntables()
{
    // Initialise table array
    $pntable = array();

    // Get the name for the table.
    $scribite = DBUtil::getLimitedTablename('scribite');
    $pntable['scribite'] = $scribite;
    $pntable['scribite_column'] = array('mid'       => 'pn_mid',
                                        'modname'   => 'pn_modname',
                                        'modfuncs'  => 'pn_modfunc',
                                        'modareas'  => 'pn_modareas',
                                        'modeditor' => 'pn_modeditor');
    $pntable['scribite_column_def'] = array('mid'       => 'I PRIMARY AUTO',
                                            'modname'   => "C(64) NOTNULL DEFAULT ''",
                                            'modfuncs'  => "XL NOTNULL",
                                            'modareas'  => "XL NOTNULL",
                                            'modeditor' => "C(20) NOTNULL DEFAULT 0");
    
    // Return the table information
    return $pntable;
}

