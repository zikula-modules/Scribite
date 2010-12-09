<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @version    $Id$
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 * @category   Zikula_Extension
 * @package    Utilities
 * @subpackage scribite!
 */
function scribite_tables()
{
    // Initialise table array
    $table = array();

    // Get the name for the table.
    $scribite = DBUtil::getLimitedTablename('scribite');
    $table['scribite'] = $scribite;
    $table['scribite_column'] = array(
            'mid' => 'z_mid',
            'modname' => 'z_modname',
            'modfuncs' => 'z_modfuncs',
            'modareas' => 'z_modareas',
            'modeditor' => 'z_modeditor');
    $table['scribite_column_def'] = array(
            'mid' => 'I PRIMARY AUTO',
            'modname' => "C(64) NOTNULL DEFAULT ''",
            'modfuncs' => "XL NOTNULL",
            'modareas' => "XL NOTNULL",
            'modeditor' => "C(20) NOTNULL DEFAULT 0");

    // Return the table information
    return $table;
}

