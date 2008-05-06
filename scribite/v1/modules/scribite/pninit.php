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
// @original author Andreas Krapohl
// @author sven schomacker
// @version 1.21 (.764)
//

function scribite_init()
{

    // Set editor defaults
    pnModSetVar('scribite', 'editor', '-');
    pnModSetVar('scribite', 'editors_path', 'javascript/scribite_editors');

    $editor_activemodules = array ();
    if (pnModAvailable('AddStory')) {
          $editor_activemodules[] = 'AddStory';
    }
    if (pnModAvailable('Admin_Messages')) {
          $editor_activemodules[] = 'Admin_Messages';
    }
    if (pnModAvailable('Submit_News')) {
          $editor_activemodules[] = 'Submit_News';
    } 
    $editor_activemodules = serialize($editor_activemodules);
    pnModSetVar('scribite', 'editor_activemodules', $editor_activemodules);

  // Initialisation successful
  return true;
}

function scribite_upgrade($oldversion)
{

      switch($oldversion) {

      // specific update
      case '1.0':
          return scribite_upgrade(1.1);
          break;
      case '1.1':
          // delete old paths
          pnModDelVar('scribite', 'xinha_path');
          pnModDelVar('scribite', 'tinymce_path');
          // set new path
          pnModSetVar('scribite', 'editors_path', 'javascript/scribite_editors');
          return scribite_upgrade(1.2);
          break;          
      case '1.2':
          break;                      
      // end updates
	  }
   	$smarty =& new Smarty;
   	$smarty->compile_dir = pnConfigGetVar('temp') . '/pnRender_compiled';
   	$smarty->cache_dir = pnConfigGetVar('temp') . '/pnRender_cache';
   	$smarty->use_sub_dirs = false;
   	$smarty->clear_compiled_tpl();
   	$smarty->clear_all_cache();
	  
	return true;
}

function scribite_delete()
{

    // Delete any module variables
    pnModDelVar('scribite');

    // Deletion successful
    return true;
}

?>
