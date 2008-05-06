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

// load modules into array
function scribite_userapi_getModules()
{
    $modules = array();
    // get installed modules
    $mods = pnModAPIFunc('scribite', 'user', 'getModConfig');
    foreach ($mods as $k => $v) {
        if ($v[installed] == 1) {
          $modules[] = $k;
        }    
    }
    return $modules;
}
function scribite_userapi_getModConfig()
{
    $modconfig = array ();
    $modconfig['AddStory']['installed'] = pnModAvailable('AddStory');
    $modconfig['AddStory']['areas'] = array ('articletext', 'extendedtext');
    $modconfig['AddStory']['funcs'] = array ('');
    $modconfig['Admin_Messages']['installed'] = pnModAvailable('Admin_Messages');
    $modconfig['Admin_Messages']['areas'] = array ('admin_messages_content');
    $modconfig['Admin_Messages']['funcs'] = array ('new', 'modify');    
    $modconfig['ContentExpress']['installed'] = pnModAvailable('ContentExpress');
    $modconfig['ContentExpress']['areas'] = array ('text');
    $modconfig['ContentExpress']['funcs'] = array ('','newcontent','editcontent');
    $modconfig['element']['installed'] = pnModAvailable('element');
    $modconfig['element']['areas'] = array ('comm');    
    $modconfig['element']['funcs'] = array ('start_topic','add_topic','view_topic','edit_topic');
    $modconfig['FAQ']['installed'] = pnModAvailable('FAQ');
    $modconfig['FAQ']['areas'] = array ('answer');
    $modconfig['FAQ']['funcs'] = array ('');    
    $modconfig['htmlpages']['installed'] = pnModAvailable('htmlpages');
    $modconfig['htmlpages']['areas'] = array ('htmlpages_content');
    $modconfig['htmlpages']['funcs'] = array ('new', 'modify');    
    $modconfig['Mailer']['installed'] = pnModAvailable('Mailer');
    $modconfig['Mailer']['areas'] = array ('mailer_body');
    $modconfig['Mailer']['funcs'] = array ('testconfig');
    $modconfig['PagEd']['installed'] = pnModAvailable('PagEd');
    $modconfig['PagEd']['areas'] = 2; // use for all teaxtareas except ingress and links
    $modconfig['PagEd']['funcs'] = array ('');
    $modconfig['pagesetter']['installed'] = pnModAvailable('pagesetter');
    $modconfig['pagesetter']['areas'] = 1; // use for all teaxtareas with ids
    $modconfig['pagesetter']['funcs'] = array ('pubedit');
    $modconfig['pncommerce']['installed'] = pnModAvailable('pncommerce');
    $modconfig['pncommerce']['areas'] = array ('ItemDescription');
    $modconfig['pncommerce']['funcs'] = array ('itemedit');
    $modconfig['pnForum']['installed'] = pnModAvailable('pnForum');
    $modconfig['pnForum']['areas'] = array ('message');
    $modconfig['pnForum']['funcs'] = array ('viewtopic', 'newtopic', 'editpost', 'reply');
    $modconfig['pnMessages']['installed'] = pnModAvailable('pnMessages');
    $modconfig['pnMessages']['areas'] = array ('message');
    $modconfig['pnMessages']['funcs'] = array('newpm', 'replyinbox');
    $modconfig['pnWebLog']['installed'] = pnModAvailable('pnWebLog');
    $modconfig['pnWebLog']['areas'] = array ('xinhatext');
    $modconfig['pnWebLog']['funcs'] = array ('addposting', 'addpage');
    $modconfig['PostCalendar']['installed'] = pnModAvailable('PostCalendar');
    $modconfig['PostCalendar']['areas'] = array ('description');
    $modconfig['PostCalendar']['funcs'] = array ('submit');    
    $modconfig['Reviews']['installed'] = pnModAvailable('Reviews');
    $modconfig['Reviews']['areas'] = array ('reviewtext');
    $modconfig['Reviews']['funcs'] = array ('');    
    $modconfig['Sections']['installed'] = pnModAvailable('Sections');
    $modconfig['Sections']['areas'] = array ('content');
    $modconfig['Sections']['funcs'] = array ('');    
    $modconfig['Settings']['installed'] = pnModAvailable('Settings');
    $modconfig['Settings']['areas'] = array ('foot1');
    $modconfig['Settings']['funcs'] = array ('');    
    $modconfig['Submit_News']['installed'] = pnModAvailable('Submit_News');
    $modconfig['Submit_News']['areas'] = array ('articletext', 'extendedtext');
    $modconfig['Submit_News']['funcs'] = array ('');    
    $modconfig['tFAQ']['installed'] = pnModAvailable('tFAQ');
    $modconfig['tFAQ']['areas'] = array ('tfanswer');
    $modconfig['tFAQ']['funcs'] = array ('view','modify');  

	  return $modconfig;
}

?>
