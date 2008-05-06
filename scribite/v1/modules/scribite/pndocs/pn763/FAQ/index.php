<?php
// $Id: index.php 17854 2006-02-09 13:40:06Z markwest $
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
// Original Author of file: Francisco Burzi
// Purpose of file: displays the FAQS
// ----------------------------------------------------------------------
// Based on Automated FAQ
// Copyright (c) 2001 by
//    Richard Tirtadji AKA King Richard (rtirtadji@hotmail.com)
//    Hutdik Hermawan AKA hotFix (hutdik76@hotmail.com)
// http://www.phpnuke.web.id
// ----------------------------------------------------------------------

if (!defined('LOADED_AS_MODULE')) {
    die ("You can't access this file directly...");
}

/**
 * Credits to Edgar Miller -- http://www.bosna.de/ from his post on PHP-Nuke
 * (http://phpnuke.org/article.php?sid=2010&mode=nested&order=0&thold=0)
 * Further Credits go to Djordjevic Nebojsa (nesh) for the fix for the fix
 */

modules_get_language();

// Security check
if (!pnSecAuthAction(0, 'FAQ::', '::', ACCESS_OVERVIEW)) {
    include 'header.php';
    echo _BADAUTHKEY;
    include 'footer.php';
    return;
}

function ShowFaq() {
    $id_cat = pnVarCleanFromInput('id_cat');

    if (!isset($id_cat) || !is_numeric($id_cat)) {
        // markwest - removed unneeded call to header.php
        // results is path disclosure if invalid $id_cat
        //include 'header.php';
        echo _MODARGSERROR;
        include 'footer.php';
        return;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();
    $column = &$pntable['faqcategories_column'];

    $currentlang = pnUserGetLang();

    if (pnConfigGetVar('multilingual') == 1) {
        /* the OR is needed to display stories who are posted to ALL languages */
        $querylang = "AND ($column[flanguage]='".pnVarPrepForStore($currentlang)."' OR $column[flanguage]='')";
    } else {
        $querylang = '';
    }

    // get catname for authcheck
    $presult =& $dbconn->Execute("SELECT $column[categories], $column[parent_id]
                                  FROM $pntable[faqcategories]
                                  WHERE $column[id_cat]='".(int)pnVarPrepForStore($id_cat)."' $querylang");
    list($categories, $parent_id) = $presult->fields;

    if (pnSecAuthAction(0,'FAQ::',"$categories::$id_cat",ACCESS_READ)) {
        OpenTable();
        echo '<h1>'.pnConfigGetVar('sitename').' '._FAQ2.'</h1>';
        CloseTable();
        OpenTable();
        if (pnSecAuthAction(0,'FAQ::',"$categories::$id_cat",ACCESS_COMMENT)) {
            echo '<div style="text-align:center">'
            .'[ <a href="index.php?name=FAQ&amp;askaquestion=yes&amp;id_cat=0">'._ASKAQUESTION.'</a> ]'
            .'</div>';
        }

        echo "<a id=\"top\"></a>"._CATEGORY.": <a href=\"index.php?name=FAQ\">"._MAIN."</a>";

        if($parent_id > 0) {
            $column = &$pntable['faqcategories_column'];
            $presult =& $dbconn->Execute("SELECT $column[categories]
                                        FROM $pntable[faqcategories]
                                        WHERE $column[id_cat]='".(int)pnVarPrepForStore($parent_id)."' $querylang");
            list($pcategories) = $presult->fields;

            $pcatname = urlencode($pcategories);
            echo " -> <a href=\"index.php?name=FAQ&amp;id_cat=$parent_id&amp;parent_id=0\">".pnVarPrepForDisplay($pcategories)."</a>";
        }

        echo " -> ".pnVarPrepForDisplay($categories);

        if($parent_id == 0) {
            // it's a parent categories - any childs around?
            $column = &$pntable['faqcategories_column'];
            $sresult =& $dbconn->Execute("SELECT $column[id_cat], $column[categories]
                                        FROM $pntable[faqcategories]
                                        WHERE $column[parent_id]='".(int)pnVarPrepForStore($id_cat)."' $querylang");
            $parent_id = $id_cat;

            $subcategoryline = "";
            for($loopcount=0;!$sresult->EOF;$sresult->MoveNext() ) {
                list($sid_cat, $scategories) = $sresult->fields;
                if (pnSecAuthAction(0,'FAQ::',"$scategories::$sid_cat",ACCESS_READ)) {
                    $subcategoryline .= "<li><a href=\"index.php?name=FAQ" .
                    "&amp;id_cat=$sid_cat\">".pnVarPrepHTMLDisplay($scategories)."</a></li>\n";
                    $loopcount++;
                }
            }
            if ($subcategoryline != "") {
                echo '<br />'._SUBCATEGORIES;
                echo "<ul>\n";
                echo $subcategoryline;
                echo "</ul>\n";
            }
        }

        echo '<h2 style="background-color:'.$GLOBALS['bgcolor2'].'">'._QUESTION.'</h2>';

        $column = &$pntable['faqanswer_column'];
        $result =& $dbconn->Execute("SELECT $column[id], $column[id_cat], $column[question], $column[answer]
                                FROM $pntable[faqanswer]
                                WHERE $column[id_cat]='".(int)pnVarPrepForStore($id_cat)."' AND $column[answer] != ''
                  ORDER BY $column[id]");
        if ($result->RecordCount() != 0) {
            echo '<ul>';
        }

        $requesturi = pnVarPrepForDisplay(pnServerGetVar('REQUEST_URI'));
        while(list($id, $id_cat, $question, $answer) = $result->fields) {
            $result->MoveNext();
            list($answer) = pnModCallHooks('item', 'transform', '', array($answer));
            echo "<li><a href=\"$requesturi#q$id\">".pnVarPrepHTMLDisplay($question)."</a></li>\n";
        }
        if ($result->RecordCount() != 0) {
            echo '</ul>';
        }
    } else {
        echo _BADAUTHKEY;
        include 'footer.php';
        return;
    }
}

function ShowFaqAll() {
    $id_cat = pnVarCleanFromInput('id_cat');

    if (!isset($id_cat) || !is_numeric($id_cat)) {
        // markwest - removed unneeded call to header.php
        // results is path disclosure if invalid $id_cat
        //include 'header.php';
        echo _MODARGSERROR;
        include 'footer.php';
        exit;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    echo '<h2>'._ANSWER.'</h2>';

    $column = &$pntable['faqanswer_column'];
    $result =& $dbconn->Execute("SELECT $column[id],
                                     $column[id_cat],
                                     $column[question],
                                     $column[answer]
                              FROM $pntable[faqanswer]
                              WHERE $column[id_cat]='".(int)pnVarPrepForStore($id_cat)."' AND $column[answer] != ''
                ORDER BY $column[id]");

    while(list($id, $id_cat, $question, $answer) = $result->fields) {
        $result->MoveNext();
        list($question, $answer) = pnModCallHooks('item', 'transform', '', array($question, $answer));
        echo '<div><a id="q'.pnVarPrepForDisplay($id).'"></a>'
            .'<strong>'.pnVarPrepHTMLDisplay(nl2br($question)).'</strong>'
            .'<p>'.pnVarPrepHTMLDisplay(nl2br($answer)).'</p>'
            .'<a href="#top">'._BACKTOTOP.'</a>'
            .'<hr /></div>';
        // added hook call - markwest
        echo pnModCallHooks('item', 'display', $id, "index.php?name=FAQ&id_cat=$id_cat#$id");
    }

    echo '<div style="text-align:center">[ <a href="index.php?name=FAQ">'._BACKTOFAQINDEX.'</a> ]</div>';
    CloseTable();
}

function AskQuestion()
{

    $id_cat = pnVarCleanFromInput('id_cat');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    if (!(pnSecAuthAction(0, 'FAQ::', '::', ACCESS_COMMENT))) {
        echo _FAQADDNOAUTH;
        return;
    }

    OpenTable();
    echo '<h1>'.pnConfigGetVar('sitename').' '._FAQ2.'</h1>';
    CloseTable();
    OpenTable();
    echo '<h2>'._ASKAQUESTION.'</h2>';

    echo "<form action=\"index.php\" method=\"post\"><div>";
    echo "<input type=\"hidden\" name=\"name\" value=\"FAQ\" />";
    echo "<input type=\"hidden\" name=\"askaquestion\" value=\"yes\" />";
    echo "<input type=\"hidden\" name=\"askquestionsubmit\" value=\"yes\" />";
    echo "  <table width=\"100%\">";
    echo "      <tr align=\"center\">";
    echo "          <td>"._SPECIFYQUESTION.":</td>";
    echo "      </tr>";
    echo "      <tr align=\"center\"><td>";

    echo "          <select name=\"id_cat\">";
    echo "              <option value=\"0\">"._UNSURE."</option>";

    $column = &$pntable['faqcategories_column'];
    $result =& $dbconn->Execute("SELECT $column[id_cat], $column[categories]
                           FROM $pntable[faqcategories]
                           WHERE $column[parent_id]=0 ORDER BY $column[id_cat]");
    while(list($id_cat, $categories) = $result->fields) {
        $result->MoveNext();
        if (pnSecAuthAction(0,'FAQ::',"$categories::$id_cat",ACCESS_READ)) {
            echo "                  <option value=\"$id_cat\">".pnVarPrepForDisplay($categories)."</option>";
        }
    }
    echo "          </select><br />";

    echo "      </td></tr>";
    echo "      <tr align=\"center\">";
    echo "          <td>"._PLEASEDESCRIBE."</td>";
    echo "      </tr>";
    echo "      <tr align=\"center\">";
    echo "          <td><textarea id=\"question\" name=\"question\" cols=\"80\" rows=\"10\"></textarea></td>";
    echo "      </tr>";
    echo "      <tr align=\"center\">";
    echo "          <td>";
    echo "              <input type=\"hidden\" name=\"cat_id\" value=\"$id_cat\" />";
    echo "              <input type=\"submit\" value=\""._SUBMITQUESTION."\" />";
    echo "          </td>";
    echo "      </tr>";
    echo "  </table>";
    echo "</div></form>";
    echo "<div style=\"text-align:center\">[ <a href=\"index.php?name=FAQ\">"._BACKTOFAQINDEX."</a> ]</div>";
    CloseTable();

}

function AskQuestionSubmit()
{
    list($id_cat, $question) = pnVarCleanFromInput('id_cat', 'question');

    if (!isset($id_cat) || !is_numeric($id_cat)) {
        include 'header.php';
        echo _MODARGSERROR;
        include 'footer.php';
        return;
    }

    //make sure question is filled in. - skooter
    if (empty($question)){
        OpenTable();
        echo '<div style="text-align:center"><strong>'._QUESTIONBLANK.'</strong>'._GOBACK.'</div>';
        CloseTable();
        include 'footer.php';
        return;
    }

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    if (!(pnSecAuthAction(0, 'FAQ::', '::', ACCESS_COMMENT))) {
        echo _FAQADDNOAUTH;
        return;
    }

    OpenTable();
    //$question = pnVarPrepForStore($question);
    //$email = pnVarPrepForStore($email);
    $uid = pnUserGetVar('uid');
    $column = &$pntable['faqanswer_column'];
    $nextid = $dbconn->GenId($pntable['faqanswer']);
    $sql = "INSERT INTO $pntable[faqanswer]
               ($column[id], $column[id_cat], $column[question], $column[submittedby], $column[answer])
               VALUES ($nextid, ".(int)pnVarPrepForStore($id_cat).", '".pnVarPrepForStore($question)."', '".(int)pnVarPrepForStore($uid)."', '')";
    $result =& $dbconn->Execute($sql);
    echo _THANKSSUB;
    echo "<div align=\"center\">[ <a href=\"index.php?name=FAQ\">"._BACKTOFAQINDEX."</a> ]</div>";
    CloseTable();
}

list($id_cat, $askaquestion) = pnVarCleanFromInput('id_cat','askaquestion');

if (empty($id_cat) && $askaquestion != "yes") {

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $currentlang = pnUserGetLang();

    $column = &$pntable['faqcategories_column'];
    if (pnConfigGetVar('multilingual') == 1) {
        $column = &$pntable['faqcategories_column'];
        /* the OR is needed to display stories who are posted to ALL languages */
        $querylang = "AND ($column[flanguage]='".pnVarPrepForStore($currentlang)."' OR $column[flanguage]='')";
    } else {
        $querylang = "";
    }

    include 'header.php';
    OpenTable();
    echo '<h1>'.pnConfigGetVar('sitename').' '._FAQ2.'</h1>';
    CloseTable();

    OpenTable();
    $column = &$pntable['faqcategories_column'];
    $total_result =& $dbconn->Execute("SELECT COUNT($column[id_cat]) FROM $pntable[faqcategories]");
    list($total) = $total_result->fields;
    if ($total) {
        if (pnSecAuthAction(0, 'FAQ::', '::', ACCESS_COMMENT)){
            echo '<div style="text-align:center">'
            .'[ <a href="index.php?name=FAQ&amp;askaquestion=yes&amp;id_cat=0">'._ASKAQUESTION.'</a> ]'
            .'</div>';
        }
    }
    echo '<h2>'._CATEGORIES.'</h2>';

    $column = &$pntable['faqcategories_column'];
    $result =& $dbconn->Execute("SELECT $column[id_cat], $column[categories]
              FROM $pntable[faqcategories]
              WHERE $column[parent_id]=0 $querylang");

    if ($result->RecordCount() != 0) {
        echo '<ul>';
    }
    while(list($id_cat, $categories) = $result->fields) {
        $result->MoveNext();
        if (pnSecAuthAction(0,'FAQ::',"$categories::$id_cat",ACCESS_READ)) {
            echo "<li><a href=\"index.php?name=FAQ&amp;id_cat=$id_cat\">".pnVarPrepForDisplay($categories)."</a></li>\n";

            $column = &$pntable['faqcategories_column'];
            $sresult =& $dbconn->Execute("SELECT $column[id_cat], $column[categories]
                                  FROM $pntable[faqcategories]
                                  WHERE $column[parent_id]='".(int)pnVarPrepForStore($id_cat)."' $querylang");

            $parent_id = $id_cat;

            for(;!$sresult->EOF;$sresult->MoveNext()) {
                list($sid_cat, $scategories) = $sresult->fields;
                if (pnSecAuthAction(0,'FAQ::',"$scategories::$sid_cat",ACCESS_READ)) {
                    echo "<li>--<a href=\"index.php?name=FAQ&amp;id_cat=$sid_cat\">".pnVarPrepForDisplay($scategories)."</a></li>\n";
                }
            }
        }
    }
    if ($result->RecordCount() != 0) {
        echo '</ul>';
    }
    CloseTable();
    include 'footer.php';

} else {

    $askquestionsubmit = pnVarCleanFromInput('askquestionsubmit');

    include 'header.php';

    if(isset($askaquestion)) {
        if(empty($askquestionsubmit)) {
            AskQuestion();
        } else {
            AskQuestionSubmit();
        }
    } else {
        ShowFaq();
        ShowFaqAll();
    }

    include 'footer.php';
}

?>
