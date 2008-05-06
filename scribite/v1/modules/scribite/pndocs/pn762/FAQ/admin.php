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
// Original Author of file: Richard Tirtadji <rtirtadji@hotmail.com>,
//                          Hutdik Hermawan <hutdik76@hotmail.com>
// Purpose of file: FAQ system, based on PHP-Nuke Add-On http://nukeaddon.com/
// ----------------------------------------------------------------------

if (!defined('LOADED_AS_MODULE')) {
    die ('Access Denied');
}

$ModName = basename(dirname( __FILE__ ));

modules_get_language();
modules_get_manual();

include_once ("modules/$ModName/faq-categories.php");

/**
 * Faq Admin Function
 */

function faq_admin_main()
{
    include 'header.php';

    if (!pnSecAuthAction(0, 'FAQ::', '::', ACCESS_ADMIN)) {
        echo 'Access denied';
        include('footer.php');
        return;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $authid = pnSecGenAuthKey();

    $currentlang = pnUserGetLang();

    GraphicAdmin();
    OpenTable();
    echo '<h1>'._FAQADMIN.'</h1>';
    CloseTable();

    $lang = languagelist();
    $column = &$pntable['faqcategories_column'];
    $result =& $dbconn->Execute("SELECT count($column[id_cat])
                              FROM $pntable[faqcategories]");
    list($count) = $result->fields;
    if ($count > 0) {
        OpenTable();
        echo '<h2>'._ACTIVEFAQS.'</h2>'
        .'<div style="text-align:center"><strong>[<a href="admin.php?module=FAQ&amp;op=FaqCatUnanswered">'
        ._VIEWUNANSWERED.'</a>]</strong></div><br />'
        .'<table border="0" width="100%" cellpadding="3" cellspacing="1"><tr>'
        .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center"><strong>'._ID.'</strong></td>'
        .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center"><strong>'._CATEGORIES.'</strong></td>'
        .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center"><strong>'._SUBCATEGORIES.'</strong></td>'
        .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center"><strong>'._LANGUAGE.'</strong></td>'
        .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center"><strong>'._FUNCTIONS.'</strong></td></tr>';

        $column = &$pntable['faqcategories_column'];
        $result =& $dbconn->Execute("SELECT $column[id_cat], $column[categories], $column[language]
                                  FROM $pntable[faqcategories]
                                  WHERE $column[parent_id]=0
                                  ORDER BY $column[id_cat]");
        while(list($id_cat, $categories, $language) = $result->fields) {
            $result->MoveNext();

           echo '<tr>';
           echo '<td align="center" style="background-color:'.$GLOBALS['bgcolor3'].'">'.pnVarPrepForDisplay($id_cat).'</td>'
               .'<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">'.pnVarPrepForDisplay($categories).'</td>'
               .'<td style="background-color:'.$GLOBALS['bgcolor3'].'"></td>';
            if (!empty($language)) {
                echo '<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">'.pnVarPrepForDisplay($lang[$language]).'</td>';
            } else {
                echo '<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">'.pnVarPrepForDisplay(_ALL).'</td>';
            }
            echo '<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">[ '
			.'<a href="admin.php?module=FAQ&amp;op=FaqCatGo&amp;id_cat='.pnVarPrepForDisplay($id_cat).'">'._CONTENT.'</a> | '
			.'<a href="admin.php?module=FAQ&amp;op=FaqCatEdit&amp;id_cat='.pnVarPrepForDisplay($id_cat).'">'._EDIT.'</a> | '
			.'<a href="admin.php?module=FAQ&amp;op=FaqCatDel&amp;id_cat='.pnVarPrepForDisplay($id_cat).'&amp;ok=0&amp;authid='.pnVarPrepForDisplay($authid).'">'._DELETE.'</a> '
			.']</td>';
            echo '</tr>';

            $column = &$pntable['faqcategories_column'];
            $subresult =& $dbconn->Execute("SELECT $column[id_cat], $column[categories], $column[language]
                                         FROM $pntable[faqcategories]
                                         WHERE $column[parent_id]='".(int)pnVarPrepForStore($id_cat)."'
                                         ORDER BY $column[id_cat]");
            while(list($sid_cat, $scategories, $language) = $subresult->fields) {
				$subresult->MoveNext();

                echo '<tr>';
                echo '<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">'.pnVarPrepForDisplay($sid_cat).'</td>'
                .'<td style="background-color:'.$GLOBALS['bgcolor3'].'">&nbsp;</td>'
                .'<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">'.pnVarPrepForDisplay($scategories).'</td>';
                if (!empty($language)) {
                    echo '<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">'.pnVarPrepForDisplay($lang[$language]).'</td>';
                } else {
                    echo '<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">'.pnVarPrepForDisplay(_ALL).'</td>';
                }
                echo '<td style="background-color:'.$GLOBALS['bgcolor3'].'" align="center">[ '
				.'<a href="admin.php?module=FAQ&amp;op=FaqCatGo&amp;id_cat='.pnVarPrepForDisplay($sid_cat).'">'._CONTENT.'</a> | '
				.'<a href="admin.php?module=FAQ&amp;op=FaqCatEdit&amp;id_cat='.pnVarPrepForDisplay($sid_cat).'">'._EDIT.'</a> | '
				.'<a href="admin.php?module=FAQ&amp;op=FaqCatDel&amp;id_cat='.pnVarPrepForDisplay($sid_cat).'&amp;ok=0&amp;authid='.pnVarPrepForDisplay($authid).'">'._DELETE.'</a> '
				.']</td>';
                echo '</tr>';
            }
        }

        echo '</table>';
        CloseTable();
    }
    faq_admin_FaqCatNew();
    include 'footer.php';
}

function faq_admin_FaqCatGo($var)
{
    include 'header.php';

    if (!pnSecAuthAction(0, 'FAQ::', '::', ACCESS_ADMIN)) {
        echo 'Access denied';
        include('footer.php');
        return;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $authid = pnSecGenAuthKey();

    GraphicAdmin();
    OpenTable();
    echo '<h1>'._FAQADMIN.'</h1>';
    CloseTable();

    OpenTable();
    echo '<h2>'._QUESTIONS.'</h2>'
    .'<table border="0" width="100%" cellpadding="3" cellspacing="1"><tr>'
    .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center"><strong>'._CONTENT.'</strong></td>'
    .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center"><strong>'._FUNCTIONS.'</strong></td></tr>';
    $column = &$pntable['faqanswer_column'];
    $result =& $dbconn->Execute("SELECT $column[id], $column[question], $column[answer]
                              FROM $pntable[faqanswer]
                              WHERE $column[id_cat]='".pnVarPrepForStore($var['id_cat'])."' AND $column[answer]<>''
                              ORDER BY $column[id]");
    while(list($id, $question, $answer) = $result->fields) {
        $result->MoveNext();
		echo "<tr><td style=\"background-color:".$GLOBALS['bgcolor3'].";width:90%\"><em>".pnVarPrepHTMLDisplay(nl2br($question))."</em><br />".pnVarPrepHTMLDisplay(nl2br($answer)).""
			."</td><td style=\"background-color:".$GLOBALS['bgcolor2'].";width:10%\" align=\"center\">"
			."<strong>[ <a href=\"admin.php?module=".$GLOBALS['module']."&amp;op=FaqCatGoEdit&amp;id=$id\">"
			._EDIT."</a> | <a href=\"admin.php?module=".$GLOBALS['module']."&amp;op=FaqCatGoDel&amp;id=$id&amp;ok=0&amp;authid=$authid\">"._DELETE."</a> ]</strong></td></tr>";
    }
    echo '</table>';
    CloseTable();
	//fix
    OpenTable();
    echo '<h2>'._ADDQUESTION.'</h2>'
    .'<form action="admin.php" method="post"><div>'
    .'<table border="0" width="100%"><tr><td>'
    ._QUESTION.':</td><td><textarea id="question" name="question" cols="80" rows="5"></textarea></td></tr><tr><td>'
    ._ANSWER.':</td><td><textarea id="answer" name="answer" cols="80" rows="10"></textarea>'
    .'</td></tr></table>'
    .'<input type="hidden" name="id_cat" value="'.$var['id_cat'].'" />'
    .'<input type="hidden" name="module" value="'.$GLOBALS['module'].'" />'
    .'<input type="hidden" name="op" value="FaqCatGoAdd" />'
    .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
    .'<input type="submit" value="'._SAVE.'" /> '._GOBACK
    .'</div></form>';
    CloseTable();
    include 'footer.php';
}

function faq_admin_FaqCatGoEdit($var)
{
    include 'header.php';

    if (!pnSecAuthAction(0, 'FAQ::', '::', ACCESS_ADMIN)) {
        echo 'Access denied';
        include('footer.php');
        return;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $currentlang = pnUserGetLang();

    GraphicAdmin();
    OpenTable();
    echo '<h1>'._FAQADMIN.'</h1>';
    CloseTable();

    $column = &$pntable['faqanswer_column'];
    $result =& $dbconn->Execute("SELECT $column[question], $column[answer], $column[id_cat], $column[submittedby]
                              FROM $pntable[faqanswer]
                              WHERE $column[id]='".pnVarPrepForStore($var['id'])."'");
    list($question, $answer, $id_cat, $uid) = $result->fields;
    if (is_numeric($uid)) {
    	$uid = pnUserGetVar('uname', $uid);
    } 
    OpenTable();
    echo '<h2>'._EDITQUESTIONS.'</h2>'
    .'<form action="admin.php" method="post"><div>'
    .'<input type="hidden" name="id" value="'.pnVarPrepForDisplay($var['id']).'" />'
    .'<table border="0" width="100%"><tr><td>'
    ._FAQFROM.':</td><td>'.pnVarPrepHTMLDisplay($uid).'</td></tr><tr><td>'
    ._CATEGORY
    .'</td><td>';

    echo '<select name="id_cat">';
    $column = &$pntable['faqcategories_column'];
    $result =& $dbconn->Execute("SELECT $column[id_cat], $column[categories]
                              FROM $pntable[faqcategories]
                              WHERE $column[parent_id] = 0
                              ORDER BY $column[id_cat]");
    while(list($nid_cat, $ncategories) = $result->fields) {
        $result->MoveNext();
        if( $nid_cat == $id_cat ) {
            echo '<option value="'.pnVarPrepForDisplay($nid_cat).'" selected="selected">'.pnVarPrepForDisplay($ncategories).'</option>';
        } else {
            echo '<option value="'.pnVarPrepForDisplay($nid_cat).'">'.pnVarPrepForDisplay($ncategories).'</option>';
        }

        $column = &$pntable['faqcategories_column'];
        $cresult =& $dbconn->Execute("SELECT $column[id_cat], $column[categories]
                                   FROM $pntable[faqcategories]
                                   WHERE $column[parent_id]='".pnVarPrepForStore($nid_cat)."'");
        while(list($cid_cat, $ccategories) = $cresult->fields ) {
            $cresult->MoveNext();
            if($cid_cat == $id_cat) {
                echo '<option value="'.pnVarPrepForDisplay($cid_cat).'" selected="selected"> '.pnVarPrepForDisplay($ncategories)." --> ".pnVarPrepForDisplay($ccategories).'</option>';
            } else {
                echo '<option value="'.pnVarPrepForDisplay($cid_cat).'"> '.pnVarPrepForDisplay($ncategories).' --> '.pnVarPrepForDisplay($ccategories).'</option>';
            }
        }
    }
    echo '</select></td></tr><tr><td>'
    ._QUESTION.':</td><td><textarea id="question" name="question" cols="80" rows="5">'.pnVarPrepHTMLDisplay($question).'</textarea></td></tr><tr><td>'
    ._ANSWER.':</td><td><textarea id="answer" name="answer" cols="80" rows="10">'.pnVarPrepHTMLDisplay($answer).'</textarea>'
    .'</td></tr>'
    .'<tr><td>';
    //echo "</select>";

    echo '</td></tr></table>'
    .'<input type="hidden" name="module" value="FAQ" />'
    .'<input type="hidden" name="op" value="FaqCatGoSave" />'
    .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
    .'<input type="submit" value="'._SAVE.'" /> '._GOBACK
    .'</div></form>';
    CloseTable();
    include 'footer.php';
}

function faq_admin_FaqCatGoSave($var)
{
    if (!pnSecAuthAction(0, 'FAQ::', '::', ACCESS_ADMIN)) {
        include('header.php');
        echo 'Access denied';
        include('footer.php');
        return;
    }

    list($id,
         $id_cat,
         $question,
         $answer)= pnVarCleanFromInput('id',
                                       'id_cat',
                                       'question',
                                       'answer');

    if (!isset($id) || !is_numeric($id)) {
        include 'header.php';
        echo _MODARGSERROR;
        include 'footer.php';
        exit;
    }
    if (!isset($id_cat) || !is_numeric($id_cat)) {
        include 'header.php';
        echo _MODARGSERROR;
        include 'footer.php';
        exit;
    }

	//make sure question is filled in. - skooter
    if (empty($question)){
   	    include 'header.php';
		OpenTable();
		echo '<div style="text-align:center"><br /><strong>';
        echo _QUESTIONBLANK;
		echo  '</strong><br />'._GOBACK.'</div>';
		CloseTable();
		include 'footer.php';
		exit;
	}
    
    if (!pnSecConfirmAuthKey()) {
        include 'header.php';
        echo _BADAUTHKEY;
        include 'footer.php';
        exit;
    }
    
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $column = &$pntable ['faqanswer_column'];
    $dbconn->Execute("UPDATE $pntable[faqanswer]
                     SET $column[question]='".pnVarPrepForStore($question)."',
                         $column[answer]='".pnVarPrepForStore($answer)."',
                         $column[id_cat]=".(int)pnVarPrepForStore($id_cat)."
                    WHERE $column[id]	='".(int)pnVarPrepForStore($id)."'");

	//changing redirect to take back to category list that admin is editing - skooter
    pnRedirect('admin.php?module=FAQ&op=FaqCatGo&id_cat='.$id_cat);
}

function faq_admin_FaqCatGoAdd($var)
{
    if (!pnSecAuthAction(0, 'FAQ::', '::', ACCESS_ADMIN)) {
        include('header.php');
        echo 'Access denied';
        include('footer.php');
        return;
    }

    list($id_cat,
         $question,
         $answer) = pnVarCleanFromInput('id_cat',
                                        'question',
                                        'answer');
    if (!isset($id_cat) || !is_numeric($id_cat)) {
        include 'header.php';
        echo _MODARGSERROR;
        include 'footer.php';
        exit;
    }

	//make sure question is filled in - skooter
    if (empty($question)){
   	    include 'header.php';
		OpenTable();
		echo '<div style="text-align:center"><br /><strong>';
        echo _QUESTIONBLANK;
		echo  '</strong><br />'._GOBACK.'</div>';
		CloseTable();
		include 'footer.php';
		exit;
	}
    
    if (!pnSecConfirmAuthKey()) {
        include 'header.php';
        echo _BADAUTHKEY;
        include 'footer.php';
        exit;
    }
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();
    $column = &$pntable ['faqanswer_column'];
    $newid = $dbconn->GenId($pntable['faqanswer']);
    $uid = pnUserGetVar('uid');
    $dbconn->Execute("INSERT INTO $pntable[faqanswer]
                              ($column[id], $column[id_cat], $column[question], $column[submittedby], $column[answer] )
                       values ($newid, ".(int)pnVarPrepForStore($id_cat).", '".pnVarPrepForStore($question)."', '".pnVarPrepForStore($uid)."', '".pnVarPrepForStore($answer)."')");
  
    pnRedirect('admin.php?module=FAQ&op=FaqCatGo&id_cat='.$id_cat);
}

function faq_admin_FaqCatGoDel($var)
{
    if (!pnSecAuthAction(0, 'FAQ::', '::', ACCESS_ADMIN)) {
        include('header.php');
        echo 'Access denied';
        include('footer.php');
        return;
    }

    $authid = pnVarCleanFromInput('authid');

    if (!pnSecConfirmAuthKey()) {
        include 'header.php';
        echo _BADAUTHKEY;
        include 'footer.php';
        exit;
    }

    list($ok,$id) = pnVarCleanFromInput('ok','id');
    if (!isset($id) || !is_numeric($id)) {
        include 'header.php';
        echo _MODARGSERROR;
        include 'footer.php';
        exit;
    }
    
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    if($ok==1) {
        $dbconn->Execute("DELETE FROM $pntable[faqanswer] WHERE {$pntable['faqanswer_column']['id']}='".(int)pnVarPrepForStore($id)."'");
        pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=main');
    } else {
        include 'header.php';
        GraphicAdmin();
        OpenTable();
        echo '<h2>'._FAQADMIN.'</h2>';
        CloseTable();

        OpenTable();
        echo '<br /><div style="text-align:center\"><strong>'._QUESTIONDEL.'</strong><br />';
		$authid = pnSecGenAuthKey();
		echo '[ <a href="admin.php?module=FAQ&amp;op=FaqCatGoDel&amp;id='.pnVarPrepForDisplay($var['id']).'&amp;ok=1&amp;authid='.pnVarPrepForDisplay($authid).'">' ._YES.'</a> | '
			.'<a href="admin.php?module=FAQ&amp;op=main">'._NO.'</a> ]</div><br />';
		CloseTable();
		include 'footer.php';
	}
}

function faq_admin_FaqCatUnanswered()
{
    include 'header.php';

    if (!pnSecAuthAction(0, 'FAQ::', '::', ACCESS_ADMIN)) {
        echo 'Access denied';
        include('footer.php');
        return;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $authid = pnSecGenAuthKey();

    GraphicAdmin();
    OpenTable();
    echo '<h2>'._FAQADMIN.'</h2>';
    CloseTable();

    OpenTable();
    echo '<div style="text-align:center"><strong>'._UNANSWEREDQUESTIONS.'</strong></div><br />'
    .'<table border="1" width="100%"><tr>'
    .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center">'._QUESTION.'</td>'
    .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center">'._FAQFROM.'</td>'
    .'<td style="background-color:'.$GLOBALS['bgcolor2'].'" align="center">'._FUNCTIONS.'</td></tr>';

    $column = &$pntable['faqanswer_column'];
    $result =& $dbconn->Execute("SELECT $column[id], $column[question], $column[submittedby], $column[answer]
                              FROM $pntable[faqanswer]
                              WHERE $column[answer]=''
                              ORDER BY $column[id]");
    while(list($id, $question, $uid, $answer) = $result->fields) {
	    if (is_numeric($uid)) {
    		$uid = pnUserGetVar('uname', $uid);
	    } 
        $result->MoveNext();
		echo '<tr><td style="background-color:'.$GLOBALS['bgcolor1'].';width:70%"><em>'.pnVarPrepHTMLDisplay($question).'</em>'
			.'</td><td style="background-color:'.$GLOBALS['bgcolor1'].';width:20%"><em>'.pnVarPrepHTMLDisplay($uid).'</em>'
			."</td><td align=\"center\" style=\"width:10%\">[ <a href=\"admin.php?module=".$GLOBALS['module']."&amp;op=FaqCatGoEdit&amp;id=$id\">"
			._ANSWER.'</a> | <a href="admin.php?module='.$GLOBALS['module'].'&amp;op=FaqCatGoDel&amp;id='.pnVarPrepForDisplay($id)
			.'&amp;ok=0&amp;authid='.pnVarPrepForDisplay($authid).'">'._DELETE.'</a> ]</td></tr>';
    }

    echo '</table>';
    CloseTable();

    OpenTable();
    echo '<div style="text-align:center">' . _GOBACK . '</div>';
    CloseTable();

    include 'footer.php';
}

?>
