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

// not used, so redirect to index
function scribite_user_main()
{
    return pnRedirect('index.php');
}

function scribite_user_editorheader()
{
    $editor_main = pnModGetVar('scribite', 'editor');

    if ($editor_main != '-') {
      $modname = pnModGetName();
      if (!pnSecAuthAction(0, 'scribite::', "$modname::", ACCESS_COMMENT)) {
          return;
      }

      // get module settings
      $modconfig = pnModAPIFunc('scribite', 'user', 'getModConfig', $modname);
      $modareas = $modconfig[$modname]['areas'];
      $modfuncs = $modconfig[$modname]['funcs'];
      
      // get current module function
      $actfunc = pnVarCleanFromInput('func');

      // get active modules
      $editor_activemodules = unserialize(pnModGetVar('scribite', 'editor_activemodules'));
      
      if (in_array($modname, $editor_activemodules) && in_array($actfunc, $modfuncs)) {
         
          // set some parameters
         $postnukeBaseURL = rtrim(pnGetBaseURL(),'/');
         $postnukeThemeBaseURL  = "$postnukeBaseURL/themes/" . pnVarPrepForOS(pnUserGetTheme());
         $postnukeBaseURI = rtrim(pnGetBaseURI(),'/');
         $postnukeBaseURI = ltrim($postnukeBaseURI,'/');
         $postnukeRoot = rtrim($_SERVER['DOCUMENT_ROOT'],'/');

         // check for allowed html
         $AllowableHTML = pnConfigGetVar('AllowableHTML');
         $disallowedhtml = array();
         while (list($key, $access) = each($AllowableHTML)) {
             if ($access == 0) {
                $disallowedhtml[] = pnVarPrepForDisplay($key);
             }
         }
         
         // editors config
         
         if ($editor_main == "xinha") { // get xinha as main editor
                     
            // get plugins for xinha
            $xinha_listplugins = pnModGetVar('scribite', 'xinha_activeplugins');
            if ($xinha_listplugins != '') {
               $xinha_listplugins = unserialize($xinha_listplugins);
               $xinha_listplugins = '\'' . pnVarPrepForDisplay(implode('\', \'', $xinha_listplugins)) . '\'';
            }
            // get module areas for xinha
            if (!is_int($modareas)) {
                $modareas = '\'' . pnVarPrepForDisplay(implode('\', \'', $modareas)) . '\'';
            }
            // set parameters
            $pnRender = new pnRender('scribite', false);
            $pnRender->caching = false;
            $pnRender->assign(pnModGetVar('scribite'));
            $pnRender->assign('postnukeBaseURL', $postnukeBaseURL);
            $pnRender->assign('postnukeBaseURI', $postnukeBaseURI);
            $pnRender->assign('postnukeRoot', $postnukeRoot);
            $pnRender->assign('modname', $modname);
            $pnRender->assign('modareas', $modareas);
            $pnRender->assign('xinha_listplugins', $xinha_listplugins);
            $output = $pnRender->fetch('scribite_xinha_editorheader.htm');
          } 
          
          elseif ($editor_main == "tiny_mce") { // for tiny_mce as main editor
           
            // get plugins for tiny_mce
            $tinymce_listplugins = pnModGetVar('scribite', 'tinymce_activeplugins');
            if ($tinymce_listplugins != '') {
               $tinymce_listplugins = unserialize($tinymce_listplugins);
               $tinymce_listplugins = pnVarPrepForDisplay(implode(',', $tinymce_listplugins));
            }
            // get module areas for tiny_mce
            if (!is_int($modareas)) {
                $modareas = pnVarPrepForDisplay(implode(',', $modareas));
            }
            // pass disallowed html
            $disallowedhtml = implode(',', $disallowedhtml);
            // set parameters
            $pnRender = new pnRender('scribite', false);
            $pnRender->caching = false;
            $pnRender->assign(pnModGetVar('scribite'));
            $pnRender->assign('postnukeBaseURL', $postnukeBaseURL);
            $pnRender->assign('postnukeBaseURI', $postnukeBaseURI);
            $pnRender->assign('postnukeRoot', $postnukeRoot);
            $pnRender->assign('modname', $modname);
            $pnRender->assign('modareas', $modareas);
            $pnRender->assign('tinymce_listplugins', $tinymce_listplugins);
            $pnRender->assign('disallowedhtml', $disallowedhtml);
            $output = $pnRender->fetch('scribite_tinymce_editorheader.htm');
          }
          
          elseif ($editor_main == "fckeditor") { // for FCKEditor as main editor
           
            // set parameters
            $pnRender = new pnRender('scribite', false);
            $pnRender->caching = false;
            $pnRender->assign(pnModGetVar('scribite'));
            $pnRender->assign('postnukeBaseURL', $postnukeBaseURL);
            $pnRender->assign('postnukeBaseURI', $postnukeBaseURI);
            $pnRender->assign('postnukeRoot', $postnukeRoot);
            $pnRender->assign('modname', $modname);
            $pnRender->assign('modareas', $modareas);
            $pnRender->assign('disallowedhtml', $disallowedhtml);
            $output = $pnRender->fetch('scribite_fckeditor_editorheader.htm');
          }          

          
      }
    }
    return $output;
}


?>
