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
// @version 1.21 (.764)

// read editors folder and load names into array
function scribite_adminapi_getEditors($editorname)
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
// read plugin-folder from xinha and load names into array
function scribite_adminapi_getxinhaPlugins($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $plugins = array();
    $pluginsdir = opendir($path . '/xinha/plugins');
    while (false !== ($f = readdir($pluginsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && !ereg('[.]', $f)) {
            $plugins[$f] = $f;
        }
    }
    closedir($pluginsdir);
    asort($plugins);
    return $plugins;
}

// read skins-folder from xinha and load names into array
function scribite_adminapi_getxinhaSkins($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $skins = array();
    $skinsdir = opendir($path . '/xinha/skins');
    while (false !== ($f = readdir($skinsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && !ereg('[.]', $f)) {
            $skins[$f] = $f;
        }
    }
    closedir($skinsdir);
    asort($skins);
    return $skins;
}

// read lang-folder from xinha and load names into array
function scribite_adminapi_getxinhaLangs($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $langs = array();
    $langsdir = opendir($path . '/xinha/lang');
    while (false !== ($f = readdir($langsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && ereg('[.js]', $f)) {
            $f = str_replace('.js', '', $f);
            $langs[$f] = $f;
        }
    }
    closedir($langsdir);
    // Add english as default editor language - this not exists as file in xinha
    $langs['en'] = 'en';
    asort($langs);
    return $langs;
}

// read langs-folder from tiny_mce and load names into array
function scribite_adminapi_gettinymceLangs($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $langs = array();
    $langsdir = opendir($path . '/tiny_mce/langs');
    while (false !== ($f = readdir($langsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && ereg('[.js]', $f)) {
            $f = str_replace('.js', '', $f);
            $langs[$f] = $f;
        }
    }
    closedir($langsdir);
    asort($langs);
    return $langs;
}
// read themes-folder from tiny_mce and load names into array
function scribite_adminapi_gettinymceThemes($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $themes = array();
    $themesdir = opendir($path . '/tiny_mce/themes');
    while (false !== ($f = readdir($themesdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && !ereg('[.]', $f)) {
            $themes[$f] = $f;
        }
    }
    closedir($themesdir);
    asort($themes);
    return $themes;
}
// read plugins from tiny_mce and load names into array
function scribite_adminapi_gettinymcePlugins($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $plugins = array();
    $pluginsdir = opendir($path . '/tiny_mce/plugins');
    while (false !== ($f = readdir($pluginsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && $f != '_template' && !ereg('[.]', $f)) {
            $plugins[$f] = $f;
        }
    }
    closedir($pluginsdir);
    asort($plugins);
    return $plugins;
}
// read langs-folder from fckeditor and load names into array
function scribite_adminapi_getfckeditorLangs($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $langs = array();
    $langsdir = opendir($path . '/fckeditor/editor/lang');
    while (false !== ($f = readdir($langsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && ereg('[.js]', $f)) {
            $f = str_replace('.js', '', $f);
            $langs[$f] = $f;
        }
    }
    closedir($langsdir);
    asort($langs);
    return $langs;
}
// read skins-folder from fckeditor and load names into array
function scribite_adminapi_getfckeditorSkins($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $skins = array();
    $skinsdir = opendir($path . '/fckeditor/editor/skins');
    while (false !== ($f = readdir($skinsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && !ereg('[.]', $f)) {
            $skins[$f] = $f;
        }
    }
    closedir($skinsdir);
    asort($skins);
    return $skins;
}
// read plugins from fckeditor and load names into array
function scribite_adminapi_getfckeditorPlugins($path)
{
    $path = rtrim(pnModGetVar('scribite', 'editors_path'),'/');
    $plugins = array();
    $pluginsdir = opendir($path . '/fckeditor/editor/plugins');
    while (false !== ($f = readdir($pluginsdir))) {
        if ($f != '.' && $f != '..' && $f != 'CVS' && !ereg('[.]', $f)) {
            $plugins[$f] = $f;
        }
    }
    closedir($pluginsdir);
    asort($plugins);
    return $plugins;
}
// read plugins from fckeditor and load names into array
function scribite_adminapi_getfckeditorBarmodes($path)
{
    $barmodes = array();
    $barmodes['Default'] = 'Default';
    $barmodes['Basic'] = 'Basic';
    return $barmodes;
}



?>
