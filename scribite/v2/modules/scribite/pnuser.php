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

/*
//  scribite! not offers a user interface - so redirect to index.php
*/
function scribite_user_main()
{
    return pnRedirect('index.php');
}

/*
//  Load scribite! from into head of page
//  based on scribite! configuration from plugin
*/
function scribite_user_editorheader($args)
{

  $args['modname'] = pnModGetName();
  $module = $args['modname'];
  
  // Security check if user has COMMENT permission for scribite
  if (!SecurityUtil::checkPermission('scribite::', '$module::', ACCESS_COMMENT)) {
      return;
  }
   
  // get passed func
  $func = FormUtil::getPassedValue('func', isset($args['func']) ? $args['func'] : null, 'GET');
  
  // get config for current module    
  $modconfig = array();
  $modconfig = pnModAPIFunc('scribite', 'user', 'getModuleConfig', $args['modname']);

  // return if module is not supported or editor is not set
  if (!$modconfig['mid'] || $modconfig['modeditor'] == '-') {
    return;
  }

  // check if current func is fine for editors or funcs is empty (or all funcs)
  if (in_array($func, $modconfig['modfuncs']) || $modconfig['modfuncs'][0] == 'all') {
    $args['areas']  = $modconfig['modareas'];
    $args['editor'] = $modconfig['modeditor'];
       
    $scribite = pnModFunc('scribite','user','loader', array('modname' => $args['modname'],
                                                            'editor'  => $args['editor'],
                                                            'areas'   => $args['areas']));
    
    // add the scripts to page header                                                            
    PageUtil::AddVar('rawtext', $scribite);

  }    
}


/*
//  scribite! loader
//  used for direct calls from modules - see dev-docs for use
*/
function scribite_user_loader($args)
{

    // Argument checks
    if (!isset($args['areas'])) {
        return LogUtil::registerError (_MODARGSERROR);
    }
    if (!isset($args['modname'])) {
        $args['modname'] = pnModGetName();
    }

    $module = $args['modname'];
    
    // Security check if user has COMMENT permission for scribite and module
    if (!SecurityUtil::checkPermission('scribite::', '$module::', ACCESS_COMMENT)) {
        return;
    }

    // check for editor argument, if none given the default editor will be used
    if (!$args['editor']) {
        // get default editor from config
        $defaulteditor = pnModGetVar('scribite', 'DefaultEditor');
        if ($defaulteditor == '-') {
          return; // return if no default is set and no arg is given
          // id given editor doesn't exist use default editor
        } elseif (!pnModAPIFunc('scribite', 'user', 'getEditors', $args['editor'])) {
          $args['editor'] = $defaulteditor;
        }
    }

    // check if editor argument exists, load default if not given
    if (pnModAPIFunc('scribite', 'user', 'getEditors', $args['editor'])) {

      // set some general parameters
      $postnukeBaseURL        = rtrim(pnGetBaseURL(),'/');
      $postnukeThemeBaseURL   = "$postnukeBaseURL/themes/" . DataUtil::formatForOS(pnUserGetTheme());
      $postnukeBaseURI        = rtrim(pnGetBaseURI(),'/');
      $postnukeBaseURI        = ltrim($postnukeBaseURI,'/');
      $postnukeRoot           = rtrim($_SERVER['DOCUMENT_ROOT'],'/');
      
      $pnRender = pnRender::getInstance('scribite', false);
      $pnRender->assign(pnModGetVar('scribite'));
      $pnRender->assign('modname', $args['modname']);
      $pnRender->assign('postnukeBaseURL', $postnukeBaseURL);
      $pnRender->assign('postnukeBaseURI', $postnukeBaseURI);
      $pnRender->assign('postnukeRoot', $postnukeRoot);
      
      // check for modules installed providing plugins
      $pnRender->assign('photoshareInstalled', pnModAvailable('photoshare'));
      $pnRender->assign('mediashareInstalled', pnModAvailable('mediashare'));
      $pnRender->assign('pagesetterInstalled', pnModAvailable('pagesetter'));
      $pnRender->assign('folderInstalled', pnModAvailable('folder'));
      $pnRender->assign('cotypeInstalled', pnModAvailable('cotype'));
      $pnRender->assign('mediaAttachInstalled', pnModAvailable('MediaAttach'));
      $pnRender->assign('editor_dir', $args['editor']);
      
      // main switch for choosen editor
      switch ($args['editor']) {
          
        case 'xinha':

          // get xinha config if editor is active
               
          // get plugins for xinha
          $xinha_listplugins = pnModGetVar('scribite', 'xinha_activeplugins');
          if ($xinha_listplugins != '') {
            $xinha_listplugins = unserialize($xinha_listplugins);  
            if (in_array('ExtendedFileManager', $xinha_listplugins)) {
              $pnRender->assign('EFMConfig', true);
            } else {
              $pnRender->assign('EFMConfig', false);
            }
            $xinha_listplugins = '\'' . DataUtil::formatForDisplay(implode('\', \'', $xinha_listplugins)) . '\'';
          }

          // prepare areas for xinha     
          if ($args['areas'][0] == "all") {
              $modareas = 'all';
          } elseif ($args['areas'][0] == "PagEd") {
              $modareas = 'PagEd';
          } else {
              $modareas = '\'' . DataUtil::formatForDisplay(implode('\', \'', $args['areas'])) . '\'';
          } 
    
          // load Prototype
          PageUtil::AddVar('javascript', 'javascript/ajax/prototype.js');
    
          // set parameters
          $pnRender->assign('modareas', $modareas);
          $pnRender->assign('xinha_listplugins', $xinha_listplugins);

          // end xinha
          break;
                  
        case 'tiny_mce':
          // get TinyMCE config if editor is active
    
          // get plugins for tiny_mce
          $tinymce_listplugins = pnModGetVar('scribite', 'tinymce_activeplugins');
          if ($tinymce_listplugins != '') {
             $tinymce_listplugins = unserialize($tinymce_listplugins);
             $tinymce_listplugins = DataUtil::formatForDisplay(implode(',', $tinymce_listplugins));
          }
          // prepare areas for tiny_mce      
          if ($args['areas'][0] == "all") {
              $modareas = 'all';
          } elseif ($args['areas'][0] == "PagEd") {
              $modareas = 'PagEd';
          } else {
              $modareas = DataUtil::formatForDisplay(implode(',', $args['areas']));      
          } 

          // check for allowed html
          $AllowableHTML = pnConfigGetVar('AllowableHTML');
          $disallowedhtml = array();
          while (list($key, $access) = each($AllowableHTML)) {
             if ($access == 0) {
                $disallowedhtml[] = DataUtil::formatForDisplay($key);
             }
          }
          
          // pass disallowed html
          $disallowedhtml = implode(',', $disallowedhtml);
    
          // set parameters
          $pnRender->assign('modareas', $modareas);
          $pnRender->assign('tinymce_listplugins', $tinymce_listplugins);
          $pnRender->assign('disallowedhtml', $disallowedhtml);
          
          // end tiny_mce
          break;
                
        case 'fckeditor':
          // get FCKeditor config if editor is active
    
          // prepare areas for xinha     
          if ($args['areas'][0] == "all") {
              $modareas = 'all';
          } elseif ($args['areas'][0] == "PagEd") {
              $modareas = 'PagEd';
          } else {
              $modareas = $args['areas'];
          }

          // check for allowed html
          $AllowableHTML = pnConfigGetVar('AllowableHTML');
          $disallowedhtml = array();
          while (list($key, $access) = each($AllowableHTML)) {
             if ($access == 0) {
                $disallowedhtml[] = DataUtil::formatForDisplay($key);
             }
          }
                    
          // load Prototype
          PageUtil::AddVar('javascript', 'javascript/ajax/prototype.js');
    
          // set parameters
          $pnRender->assign('modareas', $modareas);
          $pnRender->assign('disallowedhtml', $disallowedhtml);
          
          // end fckeditor
          break;

        case 'openwysiwyg':
          // get openwysiwyg config if editor is active
               
          // prepare areas for openwysiwyg     
          if ($args['areas'][0] == "all") {
              $modareas = 'all';
          } else {
              $modareas = $args['areas'];
          } 
    
          // set parameters
          $pnRender->assign('modareas', $modareas);
    
          // end openwysiwyg
          break;          
          
        case 'nicedit':
          // get nicEditor config if editor is active
               
          // prepare areas for nicEditor     
          if ($args['areas'][0] == "all") {
              $modareas = 'all';
          } else {
              $modareas = $args['areas'];
          } 
            
          // set parameters
          $pnRender->assign('modareas', $modareas);
    
          // end nicEditor
          break;
      }
      
      // pnRender output
      // 1. check if special template is required
      // 2. check if a module specific template exists
      // 3. if none of the above load default template
      if (isset($args['tpl']) && $pnRender->template_exists($args['tpl'])) {
        $templatefile = $args['tpl'];
      } elseif ($pnRender->template_exists('scribite_'.$args['editor'].'_'.$args['modname'].'.htm')) {  
        $templatefile = 'scribite_'.$args['editor'].'_'.$args['modname'].'.htm';
      } else {
        $templatefile = 'scribite_'.$args['editor'].'_editorheader.htm';
      }
      $output = $pnRender->fetch($templatefile); 
      // end main switch
      
      return $output;    
    
    }

}
