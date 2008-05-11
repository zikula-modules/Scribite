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
//


// load module config from db into array or list all modules with config
function scribite_userapi_getModuleConfig($modname)
{
    if (!isset($modname)) {
        $modname = pnModGetName();
    }

    $modconfig = array();
    if ($modname == 'list') {
      $modconfig = DBUtil::selectObjectArray('scribite');
    }
    else {
      $pntable = pnDBGetTables();
      $scribitecolumn = $pntable['scribite_column'];
      $where = "$scribitecolumn[modname] = '$modname'";            
      $item = DBUtil::selectObjectArray('scribite', $where);

      if ($item == false) {
        return;
      }
  
      $modconfig['mid'] = $item[0]['mid'];
      $modconfig['modname'] = $item[0]['modname'];
      if (!is_int($item[0]['modfuncs'])) {
          $modconfig['modfuncs'] = unserialize($item[0]['modfuncs']);
      }
      if (!is_int($item[0]['modareas'])) {
          $modconfig['modareas'] = unserialize($item[0]['modareas']);
      }    
      $modconfig['modeditor'] = $item[0]['modeditor'];
    }
    return $modconfig;
}    

// read editors folder and load names into array
function scribite_userapi_getEditors($editorname)
{

    $editors = array();
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $editorsdir = opendir($path);
    while (false !== ($f = readdir($editorsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && !ereg('[.]', $f)) {
            $editors[$f] = $f;
        }
    }
    closedir($editorsdir);
    // Add "-" as default for no editor
    $editors['-'] = '-';
    asort($editors);
    
    if ($editorname == 'list') {
      return $editors;
    } else {
      if (in_array($editorname, $editors)) {
        $editor_active = 1;
      } else {
        $editor_active = 0;
      }
      return $editor_active;
    }
    
}

// load IM/EFM settings for Xinha and pass vars to session
// not implemented yet ;)
function scribite_userapi_getEFMConfig()
{
    // get editors path and load xinha scripts
    $editors_path = pnModGetVar('scribite', 'editors_path');
    Loader::requireOnce($editors_path . '/xinha/contrib/php-xinha.php');

    $postnukeBaseURI = rtrim(pnGetBaseURI(),'/');
    $postnukeBaseURI = ltrim($postnukeBaseURI,'/');
    $postnukeRoot = rtrim($_SERVER['DOCUMENT_ROOT'],'/');
    
    // define backend configuration for the plugin
    $IMConfig = array();
    $IMConfig['images_dir'] = '/files/';
    $IMConfig['images_url'] = 'files/';
    $IMConfig['files_dir'] = '/files/';
    $IMConfig['files_url'] = 'files';
    $IMConfig['thumbnail_prefix'] = 't_';
    $IMConfig['thumbnail_dir'] = 't';
    $IMConfig['resized_prefix'] = 'resized_';
    $IMConfig['resized_dir'] = '';
    $IMConfig['tmp_prefix'] = '_tmp';
    $IMConfig['max_filesize_kb_image'] = 2000;
    // maximum size for uploading files in 'insert image' mode (2000 kB here)

    $IMConfig['max_filesize_kb_link'] = 5000;
    // maximum size for uploading files in 'insert link' mode (5000 kB here)

    // Maximum upload folder size in Megabytes.
    // Use 0 to disable limit
    $IMConfig['max_foldersize_mb'] = 0;
    
    $IMConfig['allowed_image_extensions'] = array("jpg","gif","png");
    $IMConfig['allowed_link_extensions'] = array("jpg","gif","pdf","ip","txt",
                                                 "psd","png","html","swf",
                                                 "xml","xls");

    xinha_pass_to_php_backend($IMConfig);            
} 