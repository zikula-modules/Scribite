<?php
// File: $Id: admin.php 15630 2005-02-04 06:35:42Z jorg $
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

modules_get_language();
modules_get_manual();

/**
 * REVIEWS Block Functions
 */

function mod_main()
{
    list($title,
     $description) = pnVarCleanFromInput('title',
                         'description');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $column = &$pntable['reviews_main_column'];
    $result =& $dbconn->Execute("UPDATE $pntable[reviews_main]
                              SET $column[title]='".pnVarPrepForStore($title)."',
                                  $column[description]='".pnVarPrepForStore($description)."'");
    if($dbconn->ErrorNo()<>0) {
        error_log("ERROR: " . $dbconn->ErrorMsg());
    }
    pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=reviews');
}

function reviews()
{
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    include ('header.php');
    GraphicAdmin();
    OpenTable();
    echo '<h2>'._REVADMIN.'</h2>';
    CloseTable();

    $column = &$pntable['reviews_main_column'];
    $resultrm =& $dbconn->Execute("SELECT $column[title], $column[description]
                                FROM $pntable[reviews_main]");
    list($title, $description) = $resultrm->fields;

    // Configuration
    if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_ADMIN)) {
        OpenTable();
        echo '<form action="admin.php" method="post"><div>'
            ._REVTITLE.'<br />'
            ."<input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\" /><br />"
            .""._REVDESC.'<br />'
            ."<textarea id=\"description\" name=\"description\" rows=\"10\" cols=\"80\">".pnVarPrepForDisplay($description)."</textarea><br />"
            ."<input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\" />"
            ."<input type=\"hidden\" name=\"op\" value=\"mod_main\" />"
            .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
            ."<input type=\"submit\" value=\""._SAVECHANGES."\" />"
            ."</div></form>";
        CloseTable();
    }

    // Waiting reviews
    if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_ADD)) {
        OpenTable();
        echo '<h2>'._REVWAITING.'</h2>';
        $column = &$pntable['reviews_add_column'];
        $result =& $dbconn->Execute("SELECT $column[id], $column[date], $column[title],
                                    $column[text], $column[reviewer], $column[email],
                                    $column[score], $column[url], $column[url_title],
                                    $column[language]
                                  FROM $pntable[reviews_add] ORDER BY $column[id]");
        if (!$result->EOF) {
            while(list($id, $date, $title, $text, $reviewer, $email, $score, $url, $url_title, $rlanguage) = $result->fields) {
                $result->MoveNext();
                echo "<form action=\"admin.php\" method=\"post\">"
                ."<hr /><br /><table border=\"0\" cellpadding=\"1\" cellspacing=\"2\">"
                ."<tr><td><strong>"._REVIEWID.":</td><td><strong><span class=\"pn-sub\">".pnVarPrepForDisplay($id)."</span></strong></td></tr>"
                ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
                ."<tr><td>"._DATE.":</td><td><input type=\"text\" name=\"date\" value=\"".pnVarPrepForDisplay($date)."\" size=\"11\" maxlength=\"10\" /></td></tr>"
                ."<tr><td>"._PRODUCTTITLE.":</td><td><input type=\"text\" name=\"title\" value=\"".pnVarPrepForDisplay($title)."\" size=\"25\" maxlength=\"40\" /></td></tr>"
                ."<tr><td>"._LANGUAGE.":</td><td>";

                lang_dropdown();

                echo "</td></tr><tr><td>"._TEXT.":</td><td><textarea id=\"reviewtext\" name=\"text\" rows=\"10\" wrap=\"virtual\" cols=\"80\">".pnVarPrepHTMLDisplay($text)."</textarea></td></tr>"
                    ."<tr><td>"._REVIEWER."</td><td><input type=\"text\" name=\"reviewer\" value=\"".pnVarPrepForDisplay($reviewer)."\" size=\"41\" maxlength=\"40\" /></td></tr>"
                    ."<tr><td>"._EMAIL.":</td><td><input type=\"text\" name=\"email\" value=\"".pnVarPrepForDisplay($email)."\" size=\"41\" maxlength=\"80\" /></td></tr>"
                    ."<tr><td>"._SCORE."</td><td><input type=\"text\" name=\"score\" value=\"".pnVarPrepForDisplay($score)."\" size=\"3\" maxlength=\"2\" /></td></tr><tr><td>";

                if ($url != "") {
                    echo "<tr><td>"._RELATEDLINK.":</td><td><input type=\"text\" name=\"url\" value=\"".pnVarPrepForDisplay($url)."\" size=\"25\" maxlength=\"100\" /></td></tr>"
                        ."<tr><td>"._LINKTITLE.":</td><td><input type=\"text\" name=\"url_title\" value=\"".pnVarPrepForDisplay($url_title)."\" size=\"25\" maxlength=\"50\" /></td></tr>";
                    }

                echo "<tr><td>"._IMAGE.":</td><td><input type=\"text\" name=\"cover\" size=\"25\" maxlength=\"100\" /><br /><em>"
                ._REVIMGINFO."</em></td></tr></table>"
                ."<input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\" />"
                .'<input type="hidden" name="authid" value="' . pnSecGenAuthKey() . '" />'
                ."<input type=\"hidden\" name=\"op\" value=\"add_review\"><input type=\"submit\" value=\""
                ._ADDREVIEW."\" /> - [ <a href=\"admin.php?module=".$GLOBALS['module']."&amp;op=delete_waiting_review&amp;id=$id\">"
                ._DELETE."</a> ]</div></form>";
            }
        } else {
            echo "<br /><em>"._NOREVIEW2ADD."</em><br />";
        }
        echo "<a href=\"index.php?name=Reviews&amp;req=write_review\">"._CLICK2ADDREVIEW."</a>";
        CloseTable();
    }

    // Modify
    if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_EDIT)) {
        OpenTable();
        echo '<h2>'._DELMODREVIEW.'</h2>'._MODREVINFO;
        CloseTable();
    }
    include 'footer.php';
}

function add_review()
{
    list($id,
     $date,
     $title,
     $text,
     $reviewer,
     $email,
     $score,
     $cover,
     $url,
     $url_title,
     $rlanguage) = pnVarCleanFromInput('id',
                       'date',
                       'title',
                       'text',
                       'reviewer',
                       'email',
                       'score',
                       'cover',
                       'url',
                       'url_title',
                       'rlanguage');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    if (!(pnSecAuthAction(0, 'Reviews::', '::', ACCESS_ADD))) {
        include 'header.php';
        echo _REVIEWSADDNOAUTH;
        include 'footer.php';
        return;
    }

    $column = &$pntable['reviews_column'];
    $nextid = $dbconn->GenId($pntable['reviews']);
    $result =& $dbconn->Execute("INSERT INTO $pntable[reviews] ($column[id],
                                $column[date], $column[title], $column[text],
                                $column[reviewer], $column[email], $column[score],
                                $column[cover], $column[url], $column[url_title],
                                $column[hits], $column[language])
                              VALUES ($nextid, '".pnVarPrepForStore($date)."', '".pnVarPrepForStore($title)."', '".pnVarPrepForStore($text)."', '".pnVarPrepForStore($reviewer)."',
                                '".pnVarPrepForStore($email)."', '".pnVarPrepForStore($score)."', '".pnVarPrepForStore($cover)."', '".pnVarPrepForStore($url)."', '".pnVarPrepForStore($url_title)."',
                                '1', '$rlanguage')");
    if($dbconn->ErrorNo()<>0) {
        error_log("ERROR inserting review: " . $dbconn->ErrorMsg());
    }
    else {
        $result =& $dbconn->Execute("DELETE FROM $pntable[reviews_add]
                                  WHERE {$pntable['reviews_add_column']['id']} = '".pnVarPrepForStore($id)."'");
        if($dbconn->ErrorNo()<>0) {
            error_log("ERROR deleting queued review: " . $dbconn->ErrorMsg());
        }
    }
    pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=reviews');
}

function ReviewsDelNew()
{
    $id = pnVarCleanFromInput('id');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    if (!pnSecAuthAction(0, 'Reviews::', '::', ACCESS_DELETE)) {
        include 'header.php';
        echo _REVIEWSDELNOAUTH;
        CloseTable();
        include 'footer.php';
        return;
    }

    $result =& $dbconn->Execute("DELETE FROM $pntable[reviews_add] WHERE {$pntable['reviews_add_column']['id']} = '".pnVarPrepForStore($id)."'");
    if($dbconn->ErrorNo()<>0) {
            error_log("ERROR deleting queued review: " . $dbconn->ErrorMsg());
    }

    pnRedirect('admin.php?module='.$GLOBALS['module'].'&op=reviews');
}

function reviews_admin_main($var)
{
   $op = pnVarCleanFromInput('op');
   extract($var);

   if (!(pnSecAuthAction(0, 'Reviews::', '::', ACCESS_EDIT))) {
       include 'header.php';
       echo _REVIEWSNOAUTH;
       include 'footer.php';
   } else {
       switch ($op){

        case "reviews":
            reviews();
            break;

        case "delete_waiting_review":
            ReviewsDelNew();
            break;

        case "add_review":
            add_review();
            break;

        case "mod_main":
            mod_main();
            break;
        default:
            reviews();
        break;
       }
   }
}

?>
