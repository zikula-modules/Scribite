<?php
// File: $Id: admin.php,v 1.1 2006/10/21 20:54:26 hilope Exp $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2001 by the PostNuke Development Team.
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
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------

if (!defined('LOADED_AS_MODULE')) {
    die ('Access Denied');
}

$ModName = $module;

   if (!(pnSecAuthAction(0, 'Settings::', '::', ACCESS_ADMIN)))
   {
      include 'header.php';
      echo 'Access denied';
      include 'footer.php';
   }

   modules_get_language();
   modules_get_manual();

/*********************************************************/
/* Configuration Functions to Setup all the Variables    */
/*********************************************************/

   function settings_admin_main($var)
   {
      $pnconfig = $GLOBALS["pnconfig"];
      if (strlen(WHERE_IS_PERSO)>0)
        $pnconfig['tipath'] = str_replace(WHERE_IS_PERSO, '', pnConfigGetVar('tipath'));

    include 'header.php';
    if (!(pnSecAuthAction(0, 'Settings::', '::', ACCESS_ADMIN))) {
        echo _SETTINGSNOAUTH;
        include 'footer.php';
        return;
     }
    GraphicAdmin();
    OpenTable();
    print '<h1>'._SITECONFIG.'</h1>';
    CloseTable();

    // Set the current settings for select fields, radio buttons and checkboxes.
    // Much better then using if() statements all over the place :-)
    $sel_dynkeywords['0'] = '';
    $sel_dynkeywords['1'] = '';
    $sel_dynkeywords[pnConfigGetVar('dyn_keywords')] = ' checked="checked"';
    $sel_siteoff['0'] = '';
    $sel_siteoff['1'] = '';
    $sel_siteoff[pnConfigGetVar('siteoff')] = ' checked="checked"';
    $sel_storyhome['5'] = '';
    $sel_storyhome['10'] = '';
    $sel_storyhome['15'] = '';
    $sel_storyhome['20'] = '';
    $sel_storyhome['25'] = '';
    $sel_storyhome['30'] = '';
    $sel_storyhome[pnConfigGetVar('storyhome')] = ' selected="selected"';
    $sel_storyorder['0'] = '';
    $sel_storyorder['1'] = '';
    $sel_storyorder[pnConfigGetVar('storyorder')] = ' selected="selected"';
    $sel_defaulttheme[pnConfigGetVar('Default_Theme')] = ' selected="selected"';
    $sel_themechange['0'] = '';
    $sel_themechange['1'] = '';
    $sel_themechange[pnConfigGetVar('theme_change')] = ' checked="checked"';
    $sel_lang[pnConfigGetVar('language')] = ' selected="selected"';

    $sel_multilingual['0'] = '';
    $sel_multilingual['1'] = '';
    $sel_multilingual[pnConfigGetVar('multilingual')] = ' checked="checked"';
    $sel_useflags['0'] = '';
    $sel_useflags['1'] = '';
    $sel_useflags[pnConfigGetVar('useflags')] = ' checked="checked"';
    $sel_langdetect['0'] = '';
    $sel_langdetect['1'] = '';
    $sel_langdetect[pnConfigGetVar('language_detect')] = ' checked="checked"';
  
    $sel_tzoffset[pnConfigGetVar('timezone_offset')] = ' selected="selected"';
    $sel_backendlanguage[pnConfigGetVar('backend_language')] = ' selected="selected"';
    $sel_newspager['0'] = '';
    $sel_newspager['1'] = '';
    $sel_newspager[pnConfigGetVar('newspager')] = ' checked="checked"';
    $sel_admingraphic['0'] = '';
    $sel_admingraphic['1'] = '';
    $sel_admingraphic[pnConfigGetVar('admingraphic')] = ' checked="checked"';
    $sel_admart['10'] = '';
    $sel_admart['15'] = '';
    $sel_admart['20'] = '';
    $sel_admart['25'] = '';
    $sel_admart['30'] = '';
    $sel_admart['50'] = '';
    $sel_admart[pnConfigGetVar('admart')] = ' selected="selected"';
    $sel_reportlevel['0'] = '';
    $sel_reportlevel['1'] = '';
    $sel_reportlevel['2'] = '';
    $sel_reportlevel[pnConfigGetVar('reportlevel')] = ' checked="checked"';
    $sel_funtext['0'] = '';
    $sel_funtext['1'] = '';
    $sel_funtext[pnConfigGetVar('funtext')] = ' checked="checked"';
    $sel_pnAntiCracker['0'] = '';
    $sel_pnAntiCracker['1'] = '';
    $sel_pnAntiCracker[pnConfigGetVar('pnAntiCracker')] = ' checked="checked"';
    $sel_safehtml['0'] = '';
    $sel_safehtml['1'] = '';
    $sel_safehtml[pnConfigGetVar('safehtml')] = ' checked="checked"';
    $sel_loadlegacy['0'] = '';
    $sel_loadlegacy['1'] = '';
    $sel_loadlegacy[pnConfigGetVar('loadlegacy')] = ' checked="checked"';
    $sel_seclevel['High'] = '';
    $sel_seclevel['Medium'] = '';
    $sel_seclevel['Low'] = '';
    $sel_seclevel[pnConfigGetVar('seclevel')] = ' selected="selected"';
    $sel_htmlentities['0'] = '';
    $sel_htmlentities['1'] = '';
    $sel_htmlentities[pnConfigGetVar('htmlentities')] = ' checked="checked"';
    $sel_usecompression['0'] = '';
    $sel_usecompression['1'] = '';
    $sel_usecompression[pnConfigGetVar('UseCompression')] = ' selected="selected"';
    $sel_refereronprint['0'] = '';
    $sel_refereronprint['1'] = '';
    $sel_refereronprint[pnConfigGetVar('refereronprint')] = ' selected="selected"';
    $sel_anonsessions['0'] = '';
    $sel_anonsessions['1'] = '';
    $sel_anonsessions[pnConfigGetVar('anonymoussessions')] = ' checked="checked"';

    // done, now on to the form
    echo '<form action="admin.php" method="post"><div>';
    OpenTable();
    print '<h2>'._GENSITEINFO.'</h2>'
        // The next line was added by sgk on Oct 23, 2001.
        // This hidden value will be used in ConfigSave() function.
        .'<input type="hidden" name="_magic_quotes_gpc_test" value="&quot;" />'
        .'<table border="0"><tr><td>'
        ._SITENAME.":</td><td><input type=\"text\" name=\"xsitename\" value=\"".pnConfigGetVar('sitename')."\" size=\"50\" maxlength=\"100\"  />"
        .'</td></tr><tr><td>'
        ._SITELOGO.":</td><td><input type=\"text\" name=\"xsite_logo\" value=\"".pnConfigGetVar('site_logo')."\" size=\"50\" maxlength=\"100\"  />"
        .'</td></tr><tr><td>'
        ._SITESLOGAN.":</td><td><input type=\"text\" name=\"xslogan\" value=\"".pnConfigGetVar('slogan')."\" size=\"50\" maxlength=\"100\"  />"
        .'</td></tr><tr><td>'
        ._STARTDATE.":</td><td><input type=\"text\" name=\"xstartdate\" value=\"".pnConfigGetVar('startdate')."\" size=\"20\" maxlength=\"30\" />"
        .'</td></tr><tr><td>'
        ._ADMINEMAIL.":</td><td><input type=\"text\" name=\"xadminmail\" value=\"".pnConfigGetVar('adminmail')."\" size=\"30\" maxlength=\"100\" />"
        .'</td></tr><tr><td>'
        ._SITEOFF."</td><td>"
        ."<input type=\"radio\" name=\"xsiteoff\" value=\"1\"$sel_siteoff[1] />"._YES.' &nbsp;'
        ."<input type=\"radio\" name=\"xsiteoff\" value=\"0\"$sel_siteoff[0] />"._NO
        .'</td></tr><tr><td>'
        ._SITEOFFREASON."</td><td>"
        ."<textarea id=\"siteoffreason\" name=\"xsiteoffreason\" cols=\"80\" rows=\"5\">".pnVarPrepForDisplay(pnConfigGetVar('siteoffreason')).'</textarea>'
        ."</td></tr></table>";
   CloseTable();
   OpenTable();
   print '<h2>'._METATAGS.'</h2>'
        .'<table border="0"><tr><td>'
        ._METAKEYWORDS.':</td><td><textarea id="metakeywords" name="xmetakeywords" cols="80" rows="10">'.htmlspecialchars(pnConfigGetVar('metakeywords')).'</textarea>'
        .'</td></tr></table>';
   CloseTable();
   OpenTable();
   print '<h2>'._THEMES.'</h2>'
        .'<table border="0"><tr><td>'
        ._DEFAULTTHEME.':</td><td><select name="xDefault_Theme" size="1">';

    $themelist = pnThemeGetAllThemes();
    
    foreach ($themelist as $v) {
        if (!isset($sel_defaulttheme[$v])) $sel_defaulttheme[$v]='';
        print "<option value=\"$v\"$sel_defaulttheme[$v]>$v</option>\n";
    }
	if (pnModAvailable('Xanthia')) {
		$xanthiathemelink = '<a href="' . pnVarPrepForDisplay(pnModURL('Xanthia', 'admin', 'view')) . '">' . _INACTIVEXANTHIATHEMES . '</a>';
	} else {
		$xanthiathemelink = '';
	}		
		
    print '</select>&nbsp;'
	    . $xanthiathemelink
        .'</td></tr><tr><td>'
        ._THEMECHANGE.'</td><td>'
        ."<input type=\"radio\" name=\"xtheme_change\" value=\"0\" $sel_themechange[0] />"._YES.' &nbsp;'
        ."<input type=\"radio\" name=\"xtheme_change\" value=\"1\" $sel_themechange[1] />"._NO
        .'</td></tr></table>';
   CloseTable();
   OpenTable();
   print '<h2>'._MLSETTINGS.'</h2>'
        .'<table border="0"><tr><td>'
        ._SELLANGUAGE.":</td><td><select name=\"xlanguage\" size=\"1\">";
    $lang = languagelist();
    $lang = languagelist();
    $handle = opendir('language');
    foreach ($lang as $k=>$v) {
        $osk = pnVarPrepForOS($k);
        if (is_dir("language/$osk") && (!empty($v))) {
            echo '<option value="'.$k.'"';
            if (isset($sel_lang[$k])) {
                echo ' selected="selected"';
            }
            echo '>';
            echo "[$k] ";
            echo "$v";
            echo '</option>' . "\n";
        }
    }
    echo "</select>"
        ."</td></tr>"
    	.'<tr><td>'
        ._TIMEZONEOFFSET.':</td><td>';

    $tzoffset = pnConfigGetVar('timezone_offset');
    global $tzinfo;
    echo "<select name=\"xtimezone_offset\" size=\"1\">\n";
    foreach ($tzinfo as $tzindex => $tzdata) {
        echo "<option value=\"$tzindex\"";
        if ($tzoffset == $tzindex) {
            echo ' selected="selected"';
        }
        echo ">";
        echo pnVarPrepHTMLDisplay($tzdata);
        echo "</option>";
    }

    echo "</select>"
        ."</td></tr>"
        
	    .'<tr><td>'
	    ._ACTMULTILINGUAL.'</td><td>'
	    ."<input type=\"radio\" name=\"xmultilingual\" value=\"1\" ".$sel_multilingual['1']." />"._YES.' &nbsp;'
	    ."<input type=\"radio\" name=\"xmultilingual\" value=\"0\" ".$sel_multilingual['0']." />"._NO
	    .'</td></tr><tr><td>'
	    ._ACTUSEFLAGS.'</td><td>'
	    ."<input type=\"radio\" name=\"xuseflags\" value=\"1\" ".$sel_useflags['1']." />"._YES." &nbsp;"
	    ."<input type=\"radio\" name=\"xuseflags\" value=\"0\" ".$sel_useflags['0']." />"._NO
	    .'</td></tr><tr><td>'
	    ._ACTAUTODETECT.'</td><td>'
	    ."<input type=\"radio\" name=\"xlanguage_detect\" value=\"1\" ".$sel_langdetect['1']." />"._YES." &nbsp;"
	    ."<input type=\"radio\" name=\"xlanguage_detect\" value=\"0\" ".$sel_langdetect['0']." />"._NO
	    .'</td></tr></table>';
	    
   CloseTable();
   OpenTable();
   print '<h2>'._STARTPAGE.'</h2>'
        .'<table border="0"><tr><td>'
        ."</td></tr><tr><td>"
        ._STARTPAGE."</td><td>"
        ."<select name=\"xstartpage\" size=\"1\">\n";
    
    // better to use the API to display the correct mods / thx to jn
    $usermods = pnModGetUserMods();
    foreach($usermods as $usermod) {
        if (pnConfigGetVar('startpage') == $usermod['name']) {
           $sel_startpage = " selected=\"selected\"";
        } else {
            $sel_startpage = "";
        } 
        echo "<option value=\"$usermod[name]\"$sel_startpage>$usermod[name]</option>\n";
    }  
    
    echo "</select> "._STARTPAGEDESCR."\n"
        ."</td></tr>"
        ."<tr><td>"._STARTTYPE."</td><td><input type=\"text\" name=\"xstarttype\" value=\"".pnConfigGetVar('starttype')."\" size=\"20\" maxlength=\"40\"  /></td></tr>"
        ."<tr><td>"._STARTFUNC."</td><td><input type=\"text\" name=\"xstartfunc\" value=\"".pnConfigGetVar('startfunc')."\" size=\"20\" maxlength=\"40\"  /></td></tr>"
        ."<tr><td>"._STARTARGS."</td><td><input type=\"text\" name=\"xstartargs\" value=\"".pnConfigGetVar('startargs')."\" size=\"20\" maxlength=\"40\"  />"._STARTARGSCOMMASEP."</td></tr></table>";
   CloseTable();
   OpenTable();
   print '<h2>'._NEWSSETTINGS.'</h2>'
        .'<table border="0"><tr><td>'
        ._ARTINADMIN.":</td><td>"
        .'<select name="xadmart" size="1">'
        ."<option value=\"10\"".$sel_admart['10'].">10</option>\n"
        ."<option value=\"15\"".$sel_admart['15'].">15</option>\n"
        ."<option value=\"20\"".$sel_admart['20'].">20</option>\n"
        ."<option value=\"25\"".$sel_admart['25'].">25</option>\n"
        ."<option value=\"30\"".$sel_admart['30'].">30</option>\n"
        ."<option value=\"50\"".$sel_admart['50'].">50</option>\n"
        ."</select>"
        ."</td></tr><tr><td>"
        ._STORIESHOME.':</td><td>'
        .'<select name="xstoryhome" size="1">'
        ."<option value=\"5\"".$sel_storyhome['5'].">5</option>\n"
        ."<option value=\"10\"".$sel_storyhome['10'].">10</option>\n"
        ."<option value=\"15\"".$sel_storyhome['15'].">15</option>\n"
        ."<option value=\"20\"".$sel_storyhome['20'].">20</option>\n"
        ."<option value=\"25\"".$sel_storyhome['25'].">25</option>\n"
        ."<option value=\"30\"".$sel_storyhome['30'].">30</option>\n"
        ."</select>"
        ."</td></tr><tr><td>\n"
        ._STORIESORDER.":</td><td>"
        ."<select name=\"xstoryorder\" size=\"1\">"
        ."<option value=\"0\"".$sel_storyorder['0'].">" . _STORIESORDER0 . "</option>\n"
        ."<option value=\"1\"".$sel_storyorder['1'].">" . _STORIESORDER1 . "</option>\n"
        ."</select>"
        ."</td></tr><tr><td>"
        ._NEWSPAGER."</td><td>"
        ."<input type=\"radio\" name=\"xnewspager\" value=\"1\"".$sel_newspager['1']." />"._YES.' &nbsp;'
        ."<input type=\"radio\" name=\"xnewspager\" value=\"0\"".$sel_newspager['0']." />"._NO
        ."</td></tr></table>";
   CloseTable();
   OpenTable();
   print '<h2>'._ERRORREPORTING.'</h2>'
        .'<table border="0"><tr><td>'
        ._REPORTLEVEL."</td><td>"
        ."<input type=\"radio\" name=\"xreportlevel\" value=\"0\"".$sel_reportlevel['0']." />"._REPORTLEVEL0.' &nbsp;'
        ."<input type=\"radio\" name=\"xreportlevel\" value=\"1\"".$sel_reportlevel['1']." />"._REPORTLEVEL1.' &nbsp;'
        ."<input type=\"radio\" name=\"xreportlevel\" value=\"2\"".$sel_reportlevel['2']." />"._REPORTLEVEL2
        ."</td></tr><tr><td>"
        ._FUNTEXT."</td><td>"
        ."<input type=\"radio\" name=\"xfuntext\" value=\"1\"".$sel_funtext['1']." />"._YES.' &nbsp;'
        ."<input type=\"radio\" name=\"xfuntext\" value=\"0\"".$sel_funtext['0']." />"._NO
        ."</td></tr></table>";
   CloseTable();
   OpenTable();
   print '<h2>'._MISCELLANEOUS.'</h2>'
        .'<table border="0"><tr><td>'
        ._LOADLEGACY."</td><td>"
	      ."<input type=\"radio\" name=\"xloadlegacy\" value=\"1\"".$sel_loadlegacy['1']." />"._YES.' &nbsp;'
        ."<input type=\"radio\" name=\"xloadlegacy\" value=\"0\"".$sel_loadlegacy['0']." />"._NO
        ."</td></tr><tr><td>"._USECOMPRESSION."</td><td>"
    ."<select name=\"xUseCompression\">\n"
    ."<option value=\"0\"".$sel_usecompression['0'].">"._NO."</option>"
    ."<option value=\"1\"".$sel_usecompression['1'].">"._YES."</option>"
    ."</select>\n"
    ."</td></tr>"
    ."</table>";

    CloseTable();


    OpenTable();
    print '<h2>'._FOOTERMSG.'</h2>'
        ."<table border=\"0\"><tr><td>"
        ._FOOTERLINE.":</td><td><textarea id=\"foot1\" name=\"xfoot1\" cols=\"80\" rows=\"10\">".htmlspecialchars(pnConfigGetVar("foot1"))."</textarea>"
        ."</td></tr></table>";
    CloseTable();

    OpenTable();
    print '<h2>'._BACKENDCONF.'</h2>'
        .'<table border="0"><tr><td>'
        ._BACKENDTITLE.":</td><td><input type=\"text\" name=\"xbackend_title\" value=\"".pnConfigGetVar('backend_title')."\" size=\"50\" maxlength=\"100\"  />"
        .'</td></tr><tr><td>'
        ._BACKENDLANG.':</td><td><select name="xbackend_language" size="1">'
    ;
    $rsslang = rsslanguagelist();
    foreach ($rsslang as $k=>$v)
    {
    echo '<option value="'.$k.'"';
    if (isset($sel_backendlanguage[$k])) echo ' selected="selected"';
        echo '>';
        echo "[$k] ";
        echo "$v";
        echo '</option>' . "\n";
    }
    echo '</select>'
        .'</td></tr></table>';
    CloseTable();

    print '<br />';
    OpenTable();
    print '<h2>'._SECOPT.'</h2>'
        .'<table border="0"><tr><td>'
        ._SECLEVEL.':</td><td>'
        .'<select name="xseclevel" size="1">'
        ."<option value=\"High\" $sel_seclevel[High]>" . _SECHIGH ."</option>\n"
        ."<option value=\"Medium\" $sel_seclevel[Medium]>" . _SECMEDIUM . "</option>\n"
        ."<option value=\"Low\" $sel_seclevel[Low]>" . _SECLOW . "</option>\n"
        .'</select>'
        .'</td></tr><tr><td>'
        ._SECMEDLENGTH.":</td><td><input type=\"text\" name=\"xsecmeddays\" value=\"".pnConfigGetVar('secmeddays')."\" size=\"4\"  /> " .  _DAYS
        .'</td></tr><tr><td>'
        ._SECINACTIVELENGTH.":</td><td><input type=\"text\" name=\"xsecinactivemins\" value=\"".pnConfigGetVar('secinactivemins')."\" size=\"4\"  /> " .  _MINUTES
        ."</td></tr>"
        ."<tr><td>"
        ._REFERERONPRINT.'</td><td>'
        ."<select name=\"xrefereronprint\">\n"
        ."<option value=\"0\"".$sel_refereronprint['0'].">"._NO."</option>"
        ."<option value=\"1\"".$sel_refereronprint['1'].">"._YES."</option>"
        ."</select>\n"
        ."</td></tr><tr><td>"
        ._PNANTICRACKERTEXT.'</td><td>'
	      ."<input type=\"radio\" name=\"xpnAntiCracker\" value=\"1\"".$sel_pnAntiCracker['1']." />"._YES.' &nbsp;'
        ."<input type=\"radio\" name=\"xpnAntiCracker\" value=\"0\"".$sel_pnAntiCracker['0']." />"._NO
        ."</td></tr><tr><td>"
        ._ANONYMOUSSESSIONS.'</td><td>'
	      ."<input type=\"radio\" name=\"xanonymoussessions\" value=\"1\"".$sel_anonsessions['1']." />"._YES.' &nbsp;'
        ."<input type=\"radio\" name=\"xanonymoussessions\" value=\"0\"".$sel_anonsessions['0']." />"._NO
        ."</td></tr></table>\n";
    CloseTable();

    // Intranet configuration
//    OpenTable();
//    print '<br />';
//    print '<h2>'._INTRANETOPT.'</h2>';
//    print '<table border="0">';
//    print '<tr>';
//    print '<td>'._INTRANET.'</td><td>';
//    print "<input type=\"radio\" name=\"xintranet\" value=\"1\"".$sel_intranet['1']." />"._YES.' &nbsp;';
//    print "<input type=\"radio\" name=\"xintranet\" value=\"0\"".$sel_intranet['0']." />"._NO;
//    print '</td></tr>';
//    print '</table>';
//    print '<strong>' . _INTRANETWARNING. '</strong>';
//    CloseTable();

    // Allowed HTML
    OpenTable();
    print '<br />';
    print '<h2>'._HTMLOPT.'</h2>'
         .'<table border="0"><tr><td>'
         ._HTMLALLOWED.':</td></tr></table>';
    echo '<table border="2">';
    echo '<tr><th>' . _HTMLTAGNAME . '</th>'
        .'<th>' . _HTMLTAGNOTALLOWED . '</th>'
        .'<th>' . _HTMLTAGALLOWED . '</th>'
        .'<th>' . _HTMLTAGALLOWEDWITHPARAMS . '</th>'
        .'</tr>';
    $htmltags = settingsGetHTMLTags();
    $currenthtmltags = pnConfigGetVar('AllowableHTML');
    foreach ($htmltags as $htmltag) {
        $selected[0] = '';
        $selected[1] = '';
        $selected[2] = '';
        if (isset($currenthtmltags[$htmltag])) {
            $selected[$currenthtmltags[$htmltag]] = ' checked="checked"';
        } else {
            $selected[0] = ' checked="checked"';
        }

        echo '<tr>';
        echo '<td>&lt;' . pnVarPrepForDisplay($htmltag) . '&gt;</td>';
        echo '<td align="center"><input type="radio" value="0" name="htmlallow' . pnVarPrepForDisplay($htmltag) . 'tag" ' . $selected[0] . ' /></td>';
        echo '<td align="center"><input type="radio" value="1" name="htmlallow' . pnVarPrepForDisplay($htmltag) . 'tag" ' . $selected[1] . ' /></td>';
        echo '<td align="center"><input type="radio" value="2" name="htmlallow' . pnVarPrepForDisplay($htmltag) . 'tag" ' . $selected[2] . ' /></td>';
        echo '</tr>';
    }
    echo '</table>';
    CloseTable();
    echo '<table><tr><td><strong>' . _HTMLWARNING. '</strong>';
    echo '<br />';

    echo '<table><tr><td>'._HTMLALLOWENTITIES .'</td>'.
         '<td><input type="radio" name="xhtmlentities" value="1"' . $sel_htmlentities[1]. ' />' . _YES . ' &nbsp;' .
         '<input type="radio" name="xhtmlentities" value="0"' . $sel_htmlentities[0] . ' />' . _NO .'</td>';
    echo '</tr><tr>';

    echo '<td>'. _HTMLSAFEHTML .'</td>' .
         '<td><input type="radio" name="xsafehtml" value="1"' . $sel_safehtml[1]. ' />' . _YES . ' &nbsp;' .
         '<input type="radio" name="xsafehtml" value="0"' . $sel_safehtml[0] . ' />' . _NO .'</td>' .
         '</tr></table>';

    // Finish
    echo '<input type="hidden" name="op" value="generate" />'
        .'<input type="hidden" name="module" value="Settings" />'
        .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
        .'<div style="text-align:center"><input type="submit" value="'._SAVECHANGES.'" style="text-align:center" /></div>'
		.'</td></tr></table>'
        .'</div></form>';

    include 'footer.php';
}

function settings_admin_generate($vars) {

    if (!(pnSecAuthAction(0, 'Settings::', '::', ACCESS_ADMIN))) {
        include 'header.php';
        echo 'Access denied';
        include 'footer.php';
        return;
    }

    if (!pnSecConfirmAuthKey()) {
        include 'header.php';
        echo _BADAUTHKEY;
        include 'footer.php';
    }

    /*
     * Write the vars
     */
    // TODO - fix this so that it fetches each value manually, otherwise
    // this is a security hole
    foreach($vars as $name => $value) {
        if (substr($name, 0, 1) == 'x') {
            $var = pnVarCleanFromInput($name);
            pnConfigSetVar(substr($name, 1), $var);
        }
    }

    // Create
    $allowedhtml = array();
    $htmltags = settingsGetHTMLTags();
    foreach ($htmltags as $htmltag) {
        $tagval = pnVarCleanFromInput('htmlallow'.$htmltag.'tag');
        if (($tagval != 1) && ($tagval != 2)) {
            $tagval = 0;
        }
        $allowedhtml[$htmltag] = $tagval;
    }
    pnConfigSetVar('AllowableHTML', $allowedhtml);

    pnRedirect('admin.php');
}

// Local function to provide list of all possible HTML tags
function settingsGetHTMLTags() {
    // Possible allowed HTML tags
    return array('!--',
                  'a',
                  'abbr',
                  'acronym',
                  'address',
				  'applet',
				  'area',
                  'b',
				  'base',
				  'basefont',
				  'bdo',
                  'big',
                  'blockquote',
                  'br',
				  'button',
                  'caption',
                  'center',
                  'cite',
                  'code',
				  'col',
				  'colgroup',
				  'del',
                  'dfn',
				  'dir',
                  'div',
                  'dl',
                  'dd',
                  'dt',
                  'em',
                  'embed',
				  'fieldset',
                  'font',
				  'form',
                  'h1',
                  'h2',
                  'h3',
                  'h4',
                  'h5',
                  'h6',
                  'hr',
                  'i',
                  'iframe',
                  'img',
				  'input',
				  'ins',
				  'kbd',
				  'label',
				  'legend',
                  'li',
				  'map',
                  'marquee',
				  'menu',
				  'nobr',
                  'object',
                  'ol',
				  'optgroup',
				  'option',
                  'p',
                  'param',
                  'pre',
                  'q',
                  's',
                  'samp',
                  'script',
				  'select',
                  'small',
                  'span',
                  'strike',
                  'strong',
                  'sub',
                  'sup',
                  'table',
				  'tbody',
                  'td',
				  'textarea',
				  'tfoot',
                  'th',
				  'thead',
                  'tr',
				  'tt',
                  'u',
		  		  'ul',
		  		  'var');
}
?>
