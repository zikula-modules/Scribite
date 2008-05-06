<?php
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2002 by the PostNuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// Based on:
// PHP-NUKE Web Portal System - http://phpnuke.org/
// Thatware - http://thatware.org/
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
//
// @package scribite!
// @license http://www.gnu.org/copyleft/gpl.html
//
// @author sven schomacker
// @version 2.0
//
// This plugin checks current version for scribite (func="version") or will
// check if a newer version is available for download.

function smarty_function_versioncheck() 
{
    // check module version
    // some code based on work from Axel Guckelsberger - thanks for this inspiration
    $currentversion = pnModGetInfo(pnModGetIDFromName('scribite'));
    $currentversion = trim($currentversion['version']);
    
    // current version           
    $output = $currentversion;
    
    // get newest version number
    require_once('Snoopy.class.php');
    $snoopy = new Snoopy;
    $snoopy->fetchtext("http://scribite.de/scribite_version.txt");
    //$snoopy->fetchtext("http://localhost/scribite_version.txt");

    $newestversion = $snoopy->results;
    $newestversion = trim($newestversion);   
    
    if (!$newestversion) { 
      // newest version check not possible, so return only current version number
      echo($output);
      return; 
    }  
    
    if ($currentversion < $newestversion) {
      // generate info link if new version is available
      $output .= " (<a id=\"versioncheck\" href=\"javascript:showInfo('http://scribite.de/scribite_verinfo.htm')\" style=\"color:red;\"><strong>".$newestversion." available</strong></a>)";
      //$output .= " (<a id=\"versioncheck\" href=\"javascript:showInfo('http://localhost/scribite_verinfo.htm')\" style=\"color:red;\"><strong>".$newestversion." available</strong></a>)";
    }   
    echo($output);
    return; 
}      

