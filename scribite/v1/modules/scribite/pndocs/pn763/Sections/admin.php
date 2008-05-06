<?php
// File: $Id: admin.php 19414 2006-07-16 15:11:37Z markwest $
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

modules_get_language();
modules_get_manual();

/**
 * Sections Manager Functions
 */

function sections()
{
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $currentlang = pnUserGetLang();

    $admart = pnConfigGetVar('admart');

    include 'header.php';
    $msg = pnGetStatusMsg();
    if(!empty($msg)) {
        echo "<strong>$msg</strong>";
    }
    GraphicAdmin();
    OpenTable();
    echo '<h2>'._SECTIONSADMIN.'</h2>';
    CloseTable();

    $column = &$pntable['sections_column'];
    $result =& $dbconn->Execute("SELECT $column[secid], $column[secname]
                              FROM $pntable[sections] ORDER BY $column[secid]");
    if (!$result->EOF) {
        // Current sections
        if (pnSecAuthAction(0, 'Sections::Section', '::', ACCESS_EDIT)) {
            OpenTable();
            echo '<div style="text-align:center"><strong>'._ACTIVESECTIONS."</strong>&nbsp;"._CLICK2EDITSEC.'</div><br />'
                ."<table border=\"0\" width=\"100%\" cellpadding=\"1\"><tr><td align=\"center\">";

            while(list($secid, $secname) = $result->fields) {
                if (pnSecAuthAction(0, 'Sections::Section', "$secname::$secid", ACCESS_EDIT)) {
                    echo "<strong><big>&middot;</big></strong>&nbsp;&nbsp;<a href=\"admin.php?module=$GLOBALS[ModName]&amp;op=sectionedit&amp;secid=$secid\">".pnVarPrepForDisplay($secname)."</a><br />";
                }
                $result->MoveNext();
            }
            echo "</td></tr></table>";
            CloseTable();
        }

        // Add article
        if (pnSecAuthAction(0, 'Sections::Article', ":$secname:", ACCESS_ADD)) {

            OpenTable();
            echo '<h2>'._ADDSECARTICLE.'</h2>'
                .'<form action="admin.php" method="post"><div>'
                .'<strong>'._TITLE.":</strong>&nbsp;"
                ."<input type=\"text\" name=\"title\" size=\"60\" /><br />"
                .'<strong>'._SELSECTION.":</strong><br />";
            $column = &$pntable['sections_column'];
            $result =& $dbconn->Execute("SELECT $column[secid], $column[secname]
                                      FROM $pntable[sections] ORDER BY $column[secid]");

            if(count($result)==1) {
                $checked = "checked=\"checked\"";
            }
            
            while(list($secid, $secname) = $result->fields) {
                if (pnSecAuthAction(0, 'Sections::Section', "$secname::$secid", ACCESS_ADD)) {
                    echo "<input type=\"radio\" name=\"secid\" value=\"$secid\" $checked /> ".pnVarPrepForDisplay($secname).'<br />';
                }
                $result->MoveNext();
            }
            echo _DONTSELECT.'<br />';
            echo "<br /><strong>"._LANGUAGE.": </strong><select name=\"slanguage\">";

            $lang = languagelist();
            $sel_lang[$currentlang] = ' selected="selected"';
            print '<option value="">'._ALL.'</option>';
            $handle = opendir('language');
            while ($f = readdir($handle))
            {
                if (is_dir("language/$f") && (!empty($lang[$f])))
                {
                    $langlist[$f] = $lang[$f];
                }
            }
            asort($langlist);
            //  a bit ugly, but it works in E_ALL conditions (Andy Varganov)
            foreach ($langlist as $k=>$v){
	            echo '<option value="'.$k.'"';
    	        if (isset($sel_lang[$k])) echo ' selected="selected"';
    	    	echo '>'. $v . '</option>';
        	}
            echo '</select>';
            echo "<br /><strong>"._CONTENT.":</strong><br />"
                ."<textarea id=\"content\" name=\"content\" cols=\"80\" rows=\"10\"></textarea><br />"
                ._PAGEBREAK.'<br />'
                ."<input type=\"hidden\" name=\"op\" value=\"secarticleadd\" />"
                ."<input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\" />"
                .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
                ."<input type=\"submit\" value=\""._ADDARTICLE."\" />"
                ."</div></form>";
            CloseTable();
        }

        // Show current articles
        if (pnSecAuthAction(0, 'Sections::Article', '::', ACCESS_EDIT)) {
            OpenTable();
            echo '<h2>'._LAST." ".pnVarPrepForDisplay($admart)." "._ARTICLES.'</h2>';
            $column = &$pntable['seccont_column'];
            //$query = buildSimpleQuery ('seccont', array ('artid', 'secid', 'title', 'content', 'slanguage' ), '', "$column[artid] DESC", $admart);
            //$result =& $dbconn->Execute($query);
			$query = "SELECT $column[artid], $column[secid], $column[title], $column[content], $column[slanguage]
						FROM $pntable[seccont]
						ORDER BY $column[artid] DESC";
            $result =& $dbconn->SelectLimit($query,$admart);

            echo "<ul>";       /* ML added slanguage for display */
            while(list($artid, $secid, $title, $content, $slanguage) = $result->fields) {
                $column = &$pntable['sections_column'];
                $result2 =& $dbconn->Execute("SELECT $column[secid], $column[secname]
                                           FROM $pntable[sections]
                                           WHERE $column[secid]='".(int)pnVarPrepForStore($secid)."'");

                list($secid, $secname) = $result2->fields;
                if (pnSecAuthAction(0, 'Sections::Article', "$title:$secname:$artid", ACCESS_EDIT)) {
                    echo "<li>$title - ($slanguage) - ($secname) [ <a href=\"admin.php?module=$GLOBALS[ModName]&amp;op=secartedit&amp;artid=$artid&amp;authid=".pnSecGenAuthKey()."\">"._EDIT."</a> ";
                    if (pnSecAuthAction(0, 'Sections::Article', "$title:$secname:$artid", ACCESS_DELETE)) {
                        echo "| <a href=\"admin.php?module=$GLOBALS[ModName]&amp;op=secartdelete&amp;artid=$artid&amp;ok=0\">"._DELETE."</a> ";
                    }
                    echo "]</li>";
                }
                $result->MoveNext();
            }
            echo "</ul>";

            echo '<form action="admin.php" method="post"><div>'
                ._EDITARTID.": <input type=\"text\" name=\"artid\" size=\"10\" />&nbsp;&nbsp;"
                ."<input type=\"hidden\" name=\"op\" value=\"secartedit\" />"
                ."<input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\" />"
                .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
                ."<input type=\"submit\" value=\""._OK."\" />"
                ."</div></form>";
            CloseTable();
        }
    }

    // Add section
    if (pnSecAuthAction(0, 'Sections::Section', "::", ACCESS_ADD)) {
        OpenTable();
        echo '<h2>'._ADDSECTION."</h2><br />"
            .'<form action="admin.php" method="post"><div>'
            .'<strong>'._SECTIONNAME.":&nbsp;</strong>"
            ."<input type=\"text\" name=\"secname\" size=\"40\" maxlength=\"40\" /><br />"
            ."<span class=\"pn-sub\"><strong>"._SECTIONIMG."</strong></span><br />"
            ."<span class=\"pn-sub\">"._SECIMGEXAMPLE."</span><br />"
            ."<input type=\"text\" name=\"image\" size=\"40\" maxlength=\"50\" /><br />"
            ."<input type=\"hidden\" name=\"op\" value=\"sectionmake\" />"
            ."<input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\" />"
            .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
            ."<input type=\"submit\" value=\""._ADDSECTIONBUT."\" />"
            ."</div></form>";
        CloseTable();
    }
    include 'footer.php';
}

function secarticleadd()
{
    list($secid,
         $title,
         $content,
         $slanguage) = pnVarCleanFromInput('secid',
                                           'title',
                                           'content',
                                           'slanguage');

    // greg - this may not need to be here, I just moved it from
    // the switch function.
    if (!isset($secid) || !is_numeric($secid)){
        $secid = '';
    }
    if (!pnSecConfirmAuthKey()) {
        include 'header.php';
        echo _BADAUTHKEY;
        include 'footer.php';
        exit;
    }

    if(empty($title)) {
        pnSessionSetVar( 'errormsg', _ARTICLEMISSINGTITLE);
        pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
        return true;
    }
    if(empty($content)) {
        pnSessionSetVar( 'errormsg', _ARTICLEMISSINGCONTENT);
        pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
        return true;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $column = &$pntable['sections_column'];
    $result =& $dbconn->Execute("SELECT $column[secname]
                              FROM $pntable[sections] WHERE $column[secid]='".(int)pnVarPrepForStore($secid)."'");

    list($secname) = $result->fields;
    if (!pnSecAuthAction(0, 'Sections::Article', "$title:$secname:", ACCESS_ADD)) {
        include 'header.php';
        echo _SECTIONSADDARTICLENOAUTH;
        include 'footer.php';
        return;
    }

    $column = &$pntable['seccont_column'];
    $nextid = $dbconn->GenId($pntable['seccont']);
    $dbconn->Execute("INSERT INTO $pntable[seccont] ($column[artid],
                      $column[secid], $column[title], $column[content],
                      $column[counter], $column[slanguage])
                    VALUES ($nextid,'".pnVarPrepForStore($secid)."','".pnVarPrepForStore($title)."','".pnVarPrepForStore($content)."','0', '$slanguage')");

    // Let any hooks know that we have created a new link
    pnModCallHooks('item', 'create', $nextid, 'artid');

    pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
}

function secartedit()
{
    $artid = pnVarCleanFromInput('artid');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $currentlang = pnUserGetLang();

    include 'header.php';
    $msg = pnGetStatusMsg();
    if(isset($msg)) {
        echo "<strong>$msg</strong>";
    }

    GraphicAdmin();
    OpenTable();
    $che = "";
    echo '<h2>'._SECTIONSADMIN.'</h2>';
    CloseTable();

    $column = &$pntable['seccont_column'];
    $result =& $dbconn->Execute("SELECT $column[artid], $column[secid], $column[title],
                                $column[content], $column[slanguage]
                              FROM $pntable[seccont]
                              WHERE $column[artid]='".(int)pnVarPrepForStore($artid)."'");
    if($result->EOF) {
        echo _SECTIONSEDITARTICLENOTEXIST;
        echo '<br />'._GOBACK;
        include 'footer.php';
        return;
    }
    list($artid, $secid, $title, $content, $slanguage) = $result->fields;

    $column = &$pntable['sections_column'];
    $result =& $dbconn->Execute("SELECT $column[secname]
                              FROM $pntable[sections] WHERE $column[secid]='".(int)pnVarPrepForStore($secid)."'");

    list($secname) = $result->fields;
    if (!pnSecAuthAction(0, 'Sections::Article', "$title:$secname:$artid", ACCESS_EDIT)) {
        echo _SECTIONSEDITARTICLENOAUTH;
        include 'footer.php';
        return;
    }

    OpenTable();
    echo '<h2>'._EDITARTICLE.'</h2>'
        .'<form action="admin.php" method="post"><div>'
        .'<strong>'._TITLE.":</strong><br />"
        ."<input type=\"text\" name=\"title\" size=\"60\" value=\"$title\" /><br />"
        .'<strong>'._SELSECTION.":</strong><br />";
    $column = &$pntable['sections_column'];
    $result2 =& $dbconn->Execute("SELECT $column[secid], $column[secname]
                               FROM $pntable[sections] ORDER BY $column[secname]");

    while(list($secid2, $secname) = $result2->fields) {
        if ($secid2==$secid) {
            $che = 'checked="checked"';
        }
        echo "<input type=\"radio\" name=\"secid\" value=\"$secid2\" $che />".pnVarPrepForDisplay($secname).'<br />';
        $che = "";
        $result2->MoveNext();
    }
    echo "<br /><strong>"._LANGUAGE.": </strong>" /* ML added dropdown , currentlang is pre-selected */
                ."<select name=\"slanguage\">";
    $lang = languagelist();
    $sel_lang[$slanguage] = ' selected="checked"';

    echo '<option value="">'._ALL.'</option>';
    $handle = opendir('language');
    while ($f = readdir($handle))
    {
        if (is_dir("language/$f") && (!empty($lang[$f])))
        {
            $langlist[$f] = $lang[$f];
        }
    }
    asort($langlist);
	//  a bit ugly, but it works in E_ALL conditions (Andy Varganov)
	foreach ($langlist as $k=>$v){
        echo '<option value="'.$k.'"';
        //if  (!isset($sel_lang[$k]) || !is_numeric($sel_lang[$k])) echo ' selected';
      	if (isset($sel_lang[$k])) echo ' selected="selected"';
        echo '>'. $v . "</option>\n";
        }
        echo '</select>';
        echo "<br /><strong>"._CONTENT.":</strong><br />"
        ."<textarea id=\"content\" name=\"content\" cols=\"80\" rows=\"10\">".pnVarPrepForDisplay($content)."</textarea><br />"
        ."<input type=\"hidden\" name=\"artid\" value=\"$artid\" />"
        ."<input type=\"hidden\" name=\"op\" value=\"secartchange\" />"
        ."<input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\" />"
        .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
        ."<input type=\"submit\" value=\""._SAVECHANGES."\" />";
        if (pnSecAuthAction(0, 'Sections::Article', "$secname:$secid:$artid", ACCESS_DELETE)) {
            echo " [ <a href=\"admin.php?module=$GLOBALS[ModName]&amp;op=secartdelete&amp;artid=$artid&amp;ok=0\">"._DELETE."</a> ]";
        }
        echo "</div></form>";
    CloseTable();
    include 'footer.php';
}

function sectionmake()
{

    list($secname,
         $image) = pnVarCleanFromInput('secname',
                                       'image');

    if (!pnSecConfirmAuthKey()) {
        include 'header.php';
        echo _BADAUTHKEY;
        include 'footer.php';
        exit;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    if (!pnSecAuthAction(0, 'Sections::Section', "$secname::", ACCESS_ADD)) {
        include 'header.php';
        echo _SECTIONSADDNOAUTH;
        include 'footer.php';
        return;
    }

    $secname = trim($secname);
    if (empty($secname)) {
        pnSessionSetVar( 'errormsg', _SECTIONMISSINGNAME);
        pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
        return true;
    }

    if ($image == '' || $image == 'none') {
        $image = 'transparent.gif';
    }

    $column = &$pntable['sections_column'];
    $nextid = $dbconn->GenId($pntable['sections']);
    $dbconn->Execute("INSERT INTO $pntable[sections] ($column[secid],
                      $column[secname], $column[image])
                    VALUES ($nextid,'".pnVarPrepForStore($secname)."', '".pnVarPrepForStore($image)."')");
    pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
}

function sectionedit()
{
    $secid = pnVarCleanFromInput('secid');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    include 'header.php';

    GraphicAdmin();

    OpenTable();
    echo '<h2>'._SECTIONSADMIN.'</h2>';
    CloseTable();

    $column = &$pntable['sections_column'];
    $result =& $dbconn->Execute("SELECT $column[secname], $column[image]
                              FROM $pntable[sections]
                              WHERE $column[secid]='".(int)pnVarPrepForStore($secid)."'");

    list($secname, $image) = $result->fields;
    $result->Close();

    if (!pnSecAuthAction(0, 'Sections::Section', "$secname::$secid", ACCESS_EDIT)) {
        echo _SECTIONSEDITNOAUTH;
        include 'footer.php';
        return;
    }

    $column = &$pntable['seccont_column'];
    $result2 =& $dbconn->Execute("SELECT COUNT(*)
                               FROM $pntable[seccont]
                               WHERE $column[secid]='".(int)pnVarPrepForStore($secid)."'");
    $number = $result2->fields[0];
    $result2->Close();

    OpenTable();
    echo "<img src=\"images/sections/$image\" alt=\"\" /><br />"
        .'<h2>'._EDITSECTION.": ".pnVarPrepForDisplay($secname).'</h2>'
        ."<br />("._SECTIONHAS." $number "._ARTICLESATTACH.")"
        .'<br />'
        .'<form action="admin.php" method="post"><div>'
    	."<select name=\"artid\">";
    $column = &$pntable['seccont_column'];
    $result =& $dbconn->Execute("SELECT $column[artid], $column[title]
                              FROM $pntable[seccont]
                              WHERE $column[secid]='".(int)pnVarPrepForStore($secid)."' ORDER BY $column[artid]");

    while(list($artid, $title) = $result->fields) {

        $result->MoveNext();
        if (pnSecAuthAction(0, 'Sections::Article', "$title:$secname:$artid", ACCESS_EDIT)) {
            echo "<option value=\"$artid\">".pnVarPrepForDisplay($title)."</option>";
        }
    }
    $result->Close();
    echo "</select>&nbsp;&nbsp;"
        ."<input type=\"hidden\" name=\"op\" value=\"secartedit\" />"
        ."<input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\" />"
        ."<input type=\"submit\" value=\""._OK."\" />"
        ."</div></form><br />"
        .'<form action="admin.php" method="post"><div>'
        .'<strong>'._SECTIONNAME."</strong><br /><span class=\"pn-sub\">"._40CHARSMAX."</span><br />"
        ."<input type=\"text\" name=\"secname\" size=\"40\" maxlength=\"40\" value=\"$secname\" /><br />"
        .'<strong>'._SECTIONIMG."</strong><br /><span class=\"pn-sub\">"._SECIMGEXAMPLE."</span><br />"
        ."<input type=\"text\" name=\"image\" size=\"40\" maxlength=\"50\" value=\"$image\" /><br />"
        ."<input type=\"hidden\" name=\"secid\" value=\"$secid\" />"
        ."<input type=\"hidden\" name=\"op\" value=\"sectionchange\" />"
        ."<input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\" />"
        .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
        ."<input type=\"submit\" value=\""._SAVECHANGES."\" />";
    if (pnSecAuthAction(0, 'Sections::Section', "$secname::$secid", ACCESS_DELETE)) {
        echo " [ <a href=\"admin.php?module=$GLOBALS[ModName]&amp;op=sectiondelete&amp;secid=$secid&amp;ok=0\">"._DELETE."</a> ]";
    }
    echo "</div></form>";
    CloseTable();

    include 'footer.php';
}

function sectionchange()
{
    list($secid,
         $secname,
         $image) = pnVarCleanFromInput('secid',
                                       'secname',
                                       'image');

    if (!pnSecConfirmAuthKey()) {
        include 'header.php';
        echo _BADAUTHKEY;
        include 'footer.php';
        exit;
    }

    if(empty($secname)) {
        pnSessionSetVar( 'errormsg', _SECTIONMISSINGNAME);
        pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
        return true;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    if (!pnSecAuthAction(0, 'Sections::Section', "$secname::$secid", ACCESS_EDIT)) {
        include 'header.php';
        echo _SECTIONSEDITNOAUTH;
        include 'footer.php';
        return;
    }

    if ( ($image == "") or ($image== "none") ) {
          $image = "transparent.gif";
    }

    $column = &$pntable['sections_column'];
    $dbconn->Execute("UPDATE $pntable[sections]
                    SET $column[secname]='".pnVarPrepForStore($secname)."', $column[image]='".pnVarPrepForStore($image)."'
                    WHERE $column[secid]='".(int)pnVarPrepForStore($secid)."'");

    pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
}

function secartchange()
{
    list($artid,
         $secid,
         $title,
         $content,
         $slanguage) = pnVarCleanFromInput('artid',
                                           'secid',
                                           'title',
                                           'content',
                                           'slanguage');
    if (!pnSecConfirmAuthKey()) {
        include 'header.php';
        echo _BADAUTHKEY;
        include 'footer.php';
        exit;
    }

    $redirurl = 'admin.php?module='.$GLOBALS['module'].'&op=secartedit&artid='.$artid.'&authid='.pnSecGenAuthKey();
    if(empty($title)) {
        pnSessionSetVar( 'errormsg', _ARTICLEMISSINGTITLE);
        pnRedirect($redirurl);
        return true;
    }
    if(empty($content)) {
        pnSessionSetVar( 'errormsg', _ARTICLEMISSINGCONTENT);
        pnRedirect($redirurl);
        return true;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    // Have to get old title/sectionname
    $column = &$pntable['sections_column'];
    $contcolumn = &$pntable['seccont_column'];

    $result =& $dbconn->Execute("SELECT $column[secname], $contcolumn[title]
                              FROM $pntable[sections], $pntable[seccont]
                              WHERE $contcolumn[artid]='".(int)pnVarPrepForStore($artid)."'
                              AND $column[secid] = '".(int)pnVarPrepForStore($secid)."'");

    list($secname, $orig_title) = $result->fields;
    $result->Close();
    if (!pnSecAuthAction(0, 'Sections::Article', "$title:$secname:$artid", ACCESS_EDIT)) {
        include 'header.php';
        echo _SECTIONSEDITARTICLENOAUTH;
        include 'footer.php';
        return;
    }

    $column = &$pntable['seccont_column'];
    $dbconn->Execute("UPDATE $pntable[seccont]
                    SET $column[secid]='".pnVarPrepForStore($secid)."', $column[title]='".pnVarPrepForStore($title)."',
                      $column[content]='".pnVarPrepForStore($content)."',
                      $column[slanguage]='".pnVarPrepForStore($slanguage)."'
                    WHERE $column[artid]='".(int)pnVarPrepForStore($artid)."'");
    pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
}

function sectiondelete()
{
    list($secid,
         $ok) = pnVarCleanFromInput('secid',
                                    'ok');

    if(!isset($ok)) {
        $ok = 0;
    }
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $column = &$pntable['sections_column'];
    $result =& $dbconn->Execute("SELECT $column[secname]
                              FROM $pntable[sections]
                              WHERE $column[secid]='".(int)pnVarPrepForStore($secid)."'");

    list($secname) = $result->fields;
    $result->Close();
    if (!pnSecAuthAction(0, 'Sections::Section', "$secname::$secid", ACCESS_DELETE)) {
        include 'header.php';
        echo _SECTIONSDELNOAUTH;
        include 'footer.php';
        return;
    }

    if($ok==1) {

        if (!pnSecConfirmAuthKey()) {
            include 'header.php';
            echo _BADAUTHKEY;
            include 'footer.php';
            exit;
        }
        $dbconn->Execute("DELETE FROM $pntable[seccont]
                        WHERE ".$pntable['seccont_column']['secid']."='".(int)pnVarPrepForStore($secid)."'");
        $dbconn->Execute("DELETE FROM $pntable[sections]
                        WHERE ".$pntable['sections_column']['secid']."='".(int)pnVarPrepForStore($secid)."'");
        pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
    } else {
        include 'header.php';

        GraphicAdmin();

        OpenTable();
        echo '<h2>'._SECTIONSADMIN.'</h2>';
        CloseTable();

        $column = &$pntable['sections_column'];
        $result=& $dbconn->Execute("SELECT $column[secname]
                                 FROM $pntable[sections]
                                 WHERE $column[secid]='".pnVarPrepForStore($secid)."'");

        list($secname) = $result->fields;
        OpenTable();
        echo '<div style="text-align:center"><strong>'._DELSECTION.": $secname</strong><br />\n";
        echo "<table><tr><td>\n";
        echo "<form action=\"admin.php?module=".$GLOBALS['module']."&amp;op=sections"."\" method=\"post\"><div>\n";
        echo "<input type=\"submit\" value=\"".pnVarPrepForDisplay(_NO)."\" />\n";
        echo "<input type=\"hidden\" name=\"postnuke\" value=\"postnuke\" /></div></form>\n";
//        echo my_Text_Form("admin.php?module=".$GLOBALS['module']."&amp;op=sections", _NO);
        echo "</td><td>\n";
        echo "<form action=\"admin.php?module=".$GLOBALS['module']."&amp;op=sectiondelete&amp;secid=$secid&amp;ok=1&amp;authid=".pnSecGenAuthKey()."\" method=\"post\"><div>\n";
        echo "<input type=\"submit\" value=\"".pnVarPrepForDisplay(_YES)."\" />\n";
        echo "<input type=\"hidden\" name=\"postnuke\" value=\"postnuke\" /></div></form>\n";
//        echo my_Text_Form("admin.php?module=".$GLOBALS['module']."&amp;op=sectiondelete&amp;secid=$secid&amp;ok=1&amp;authid=".pnSecGenAuthKey()."", _YES);
        echo "</td></tr></table>\n";
        echo "</div>\n";
        CloseTable();
        include 'footer.php';
    }
}

function secartdelete()
{
    list($artid,
         $ok) = pnVarCleanFromInput('artid',
                                    'ok');

    if(!isset($ok)) {
        $ok = 0;
    }
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $column = &$pntable['sections_column'];
    $contcolumn = &$pntable['seccont_column'];
    $result =& $dbconn->Execute("SELECT $column[secname], $contcolumn[title]
                              FROM $pntable[sections], $pntable[seccont]
                              WHERE $contcolumn[artid]='".(int)pnVarPrepForStore($artid)."'
                              AND $column[secid] = $contcolumn[secid]");

    list($secname, $title) = $result->fields;
    $result->Close();
    if (!pnSecAuthAction(0, 'Sections::Article', "$title:$secname:$artid", ACCESS_DELETE)) {
        include 'header.php';
        echo _SECTIONSDELARTICLENOAUTH;
        include 'footer.php';
        return;
    }

    if($ok == 1) {
        if (!pnSecConfirmAuthKey()) {
            include 'header.php';
            echo _BADAUTHKEY;
            include 'footer.php';
            exit;
        }
        $dbconn->Execute("DELETE FROM $pntable[seccont]
                        WHERE {$pntable['seccont_column']['artid']}='".(int)pnVarPrepForStore($artid)."'");
		// Let any hooks know that we have deleted an item
		pnModCallHooks('item', 'delete', $artid, '');
        pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=sections');
    } else {
        include 'header.php';
        GraphicAdmin();
        OpenTable();
        echo '<h2>'._SECTIONSADMIN.'</h2>';
        CloseTable();

        $column = &$pntable['seccont_column'];
        $result =& $dbconn->Execute("SELECT $column[title]
                                  FROM $pntable[seccont]
                                  WHERE $column[artid]='".(int)pnVarPrepForStore($artid)."'");

        list($title) = $result->fields;
        OpenTable();
        echo '<div style="text-align:center"><strong>'._DELARTICLE.": ".pnVarPrepForDisplay($title)."</span></strong><br />\n";
        echo "<table><tr><td>\n";
        echo "<form action=\"admin.php?module=".$GLOBALS['module']."&amp;op=sections\" method=\"post\"><div>\n";
        echo "<input type=\"submit\" value=\"".pnVarPrepForDisplay(_NO)."\" style=\"text-align:center\" />\n";
        echo "<input type=\"hidden\" name=\"postnuke\" value=\"postnuke\" /></div></form>\n";
//        echo my_Text_Form("admin.php?module=".$GLOBALS['module']."&amp;op=sections", _NO);
        echo "</td><td>\n";
        echo "<form action=\"admin.php?module=".$GLOBALS['module']."&amp;op=secartdelete&amp;artid=$artid&amp;ok=1&amp;authid=".pnSecGenAuthKey()."\" method=\"post\"><div>\n";
        echo "<input type=\"submit\" value=\"".pnVarPrepForDisplay(_YES)."\" style=\"text-align:center\" />\n";
        echo "<input type=\"hidden\" name=\"postnuke\" value=\"postnuke\" /></div></form>\n";
//        echo my_Text_Form("admin.php?module=".$GLOBALS['module']."&amp;op=secartdelete&amp;artid=$artid&amp;ok=1&amp;authid=".pnSecGenAuthKey()."", _YES);
        echo "</td></tr></table>\n";
        echo "</div>\n";
        CloseTable();
        include 'footer.php';
    }
}

function sections_admin_main($var)
{
   $op = pnVarCleanFromInput('op');
   extract($var);

   if ((!pnSecAuthAction(0, 'Sections::Section', '::', ACCESS_EDIT)) &&
       (!pnSecAuthAction(0, 'Sections::Article', '::', ACCESS_EDIT))) {
       include 'header.php';
       echo _SECTIONSNOAUTH;
       include 'footer.php';
   } else {

    switch ($op)
    {
        case "sections":
            sections();
            break;

        case "sectionedit":
            sectionedit();
            break;

        case "sectionmake":
            sectionmake();
            break;

        case "sectiondelete":
            sectiondelete();
            break;

        case "sectionchange":
            sectionchange();
            break;

        case "secarticleadd":
            secarticleadd();
            break;

        case "secartedit":
            secartedit();
            break;

        case "secartchange":
            secartchange();
            break;

        case "secartdelete":
            secartdelete();
            break;

        default:
            sections();
            break;
       }
   }
}
?>
