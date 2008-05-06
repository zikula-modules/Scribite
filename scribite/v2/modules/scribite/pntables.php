<?php
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2002 by the PostNuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
//
// @package scribite!
// @license http://www.gnu.org/copyleft/gpl.html
//
// @author sven schomacker
// @version 2.1

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

