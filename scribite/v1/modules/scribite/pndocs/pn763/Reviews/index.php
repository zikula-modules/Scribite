<?php
// $Id: index.php 17466 2006-01-05 13:02:18Z landseer $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2001 by the PostNuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// Based on: Reviews Addon
// Copyright (c) 2000 by Jeff Lambert (jeffx@ican.net)
// http://www.qchc.com
// More scripts on http://www.jeffx.qchc.com
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
// Filename: modules/Reviews/index.php
// Original Author of file: Jeff Lambert
// Purpose of file: Reviews system
// ----------------------------------------------------------------------

if (!defined('LOADED_AS_MODULE')) {
    die ("You can't access this file directly...");
}
/**
 * Credits to Edgar Miller -- http://www.bosna.de/ from his post on PHP-Nuke
 * (http://phpnuke.org/article.php?sid=2010&mode=nested&order=0&thold=0)
 */

$ModName = basename(dirname( __FILE__ ));

modules_get_language();

// Security check
if (!pnSecAuthAction(0, 'Reviews::', '::', ACCESS_READ)) {
	include 'header.php';
	echo _BADAUTHKEY;
	include 'footer.php';
	return;
}

$alphabet = array(_ALL, "A","B","C","D","E","F","G","H","I","J","K","L","M",
                  "N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
          	  "1","2","3","4","5","6","7","8","9","0");

function alpha()
{
       $num = count($GLOBALS['alphabet']) - 1;

    echo "<div style=\"text-align:center\">[ ";
    $counter = 0;

    while (list(, $ltr) = each($GLOBALS['alphabet'])) {
        echo "<a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$ltr\">".pnVarPrepForDisplay($ltr)."</a>";
        if($counter == round($num/2)) {
            echo " ]\n<br />\n[ ";
        } elseif($counter != $num ) {
            echo "&nbsp;|&nbsp;\n";
        }
        $counter++;
    }
    echo " ]</div>\n";
        if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_COMMENT)){
            echo "<div style=\"text-align:center\">[ <a href=\"index.php?name=$GLOBALS[ModName]&amp;req=write_review\">"._WRITEREVIEW."</a> ]</div><br />\n\n";
        }
}

function display_score($score)
{
   
    $image = "<img src=\"modules/$GLOBALS[ModName]/images/blue.gif\" alt=\"\" />";
    $halfimage = "<img src=\"modules/$GLOBALS[ModName]/images/bluehalf.gif\" alt=\"\" />";
    $full = "<img src=\"modules/$GLOBALS[ModName]/images/star.gif\" alt=\"\" />";

    if ($score == 10) {
        for ($i=0; $i < 5; $i++) {
            echo "$full";
        }
    } else {
        for ($i=0; $i < (floor($score/2)); $i++) {
            echo "$image";
        }
        if ($score % 2) {
            echo "$halfimage";
        }
    }
}

function write_review()
{
    // ML added rlanguage , dropdown with available languages , currentlang is pre-selected
  
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $currentlang = pnUserGetLang();

    include ('header.php');

    if (!(pnSecAuthAction(0, 'Reviews::', '::', ACCESS_COMMENT))) {
        echo _REVIEWSADDNOAUTH;
        include 'footer.php';
        return;
    }
    $sitename = pnVarPrepForDisplay(pnConfigGetVar('sitename'));

    OpenTable();
    echo "
    <form method=\"post\" action=\"index.php\"><div>
	<strong>"._WRITEREVIEWFOR." $sitename</strong><br />
    <em>"._ENTERINFO."</em><br />
    <input type=\"hidden\" name=\"name\" value=\"$GLOBALS[ModName]\" />
    <strong>"._PRODUCTTITLE.":</strong><br />
    <input type=\"text\" name=\"title\" size=\"50\" maxlength=\"150\" /><br />
    <em>"._NAMEPRODUCT."</em><br />";
    echo "<br /><strong>"._LANGUAGE.": </strong>"
            ."<select name=\"rlanguage\">";
                                                // ML BEGIN
    $lang = languagelist();
    $sel_lang[$currentlang] = ' selected="selected"';
    print '<option value="">'._ALL.'</option>';
    $handle = opendir('language');
    while ($f = readdir($handle))
    {
        if (is_dir("language/$f") && (!empty($lang[$f])))
        {
            $langlist[$f] = $lang[$f];
            $sel_lang[$f] = '';
        }
    }
    asort($langlist);
    foreach ($langlist as $k=>$v)
    {
        print "<option value=\"$k\"$sel_lang[$k]>$v</option>\n";
    }
    echo "</select>";
    echo "<br /><strong>"._REVIEW.":</strong><br />"
          ."<textarea id=\"reviewtext\" name=\"text\" rows=\"10\" cols=\"80\"></textarea><br />";

	echo "<em>"._CHECKREVIEW."</em><br />";
    echo ""._ALLOWEDHTML.'<br />';
    $AllowableHTML = pnConfigGetVar('AllowableHTML');
    while (list($key, $access, ) = each($AllowableHTML)) {
        if ($access > 0) echo " &lt;".$key."&gt;";
    }
    if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_ADD)) {
        echo '<br />'._PAGEBREAK.'<br />';
    }
    echo "
    <br />
    <strong>"._YOURNAME.":</strong><br />";
    echo "<input type=\"text\" name=\"reviewer\" size=\"41\" maxlength=\"40\" value=\"" . pnUserGetVar('name') . "\" /><br />
    <em>"._FULLNAMEREQ."</em><br />
    <strong>"._REMAIL.":</strong><br />
    <input type=\"text\" name=\"email\" size=\"40\" maxlength=\"80\" value=\"" . pnUserGetVar('femail') . "\" /><br />
    <em>"._REMAILREQ."</em><br />
    <strong>"._SCORE."</strong><br />
    <select name=\"score\">
    <option value=\"10\">(10) 5 "._STARS."</option>
    <option value=\"9\">(9) 4 1/2 "._STARS."</option>
    <option value=\"8\">(8) 4 "._STARS."</option>
    <option value=\"7\">(7) 3 1/2 "._STARS."</option>
    <option value=\"6\">(6) 3 "._STARS."</option>
    <option value=\"5\">(5) 2 1/2 "._STARS."</option>
    <option value=\"4\">(4) 2 "._STARS."</option>
    <option value=\"3\">(3) 1 1/2 "._STARS."</option>
    <option value=\"2\">(2) 1 "._STAR."</option>
    <option value=\"1\">(1) 1/2 "._STAR."</option>
    </select>
    <em>"._SELECTSCORE."</em><br />
    <strong>"._RELATEDLINK.":</strong><br />
    <input type=\"text\" name=\"url\" size=\"40\" maxlength=\"100\" /><br />
    <em>"._PRODUCTSITE."</em><br />
    <strong>"._LINKTITLE.":</strong><br />
    <input type=\"text\" name=\"url_title\" size=\"40\" maxlength=\"50\" /><br />
    <em>"._LINKTITLEREQ."</em><br />";
    if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_ADD)) {
        echo "
        <strong>"._RIMAGEFILE.":</strong><br />
        <input type=\"text\" name=\"cover\" size=\"40\" maxlength=\"100\" /><br />
        <em>"._RIMAGEFILEREQ."</em><br />";
    }
    echo "<em>"._CHECKINFO."</em><br />";
    echo "<input type=\"hidden\" name=\"req\" value=\"preview_review\" />"
    ."<input type=\"submit\" value=\""._PREVIEW."\" /> 
      <input type=\"button\" onclick=\"history.go(-1)\" value=\""._CANCEL."\" /></div></form>";
    CloseTable();
    include 'footer.php';
}

function preview_review()
{
   
    list($date,
     $title,
     $text,
     $reviewer,
     $email,
     $score,
     $cover,
     $url,
     $url_title,
     $hits,
     $id,
     $rlanguage) = pnVarCleanFromInput('date',
                       'title',
                       'text',
                       'reviewer',
                       'email',
                       'score',
                       'cover',
                       'url',
                       'url_title',
                       'hits',
                       'id',
                       'rlanguage');

    if (strpos($text, "<!--pagebreak-->") !== false) {
        $text = str_replace("<!--pagebreak-->","&lt;!--pagebreak--&gt;",$text);
    }
    include ('header.php');

    if (!(pnSecAuthAction(0, 'Reviews::', '::', ACCESS_COMMENT))) {
        echo _REVIEWSADDNOAUTH;
        include 'footer.php';
        return;
    }
    OpenTable();

    if ($title == "") {
		$error = 1;
        echo ""._INVALIDTITLE.'<br />';
    }
    if ($text == "") {
		$error = 1;
        echo ""._INVALIDTEXT.'<br />';
    }
    if (($score < 1) || ($score > 10)) {
        $error = 1;
        echo ""._INVALIDSCORE.'<br />';
    }
    if (($hits < 0) && ($id != 0)) {
        $error = 1;
        echo ""._INVALIDHITS.'<br />';
    }
    if ($reviewer == "" || $email == "") {
        $error = 1;
        echo ""._CHECKNAME.'<br />';
    } elseif ($reviewer != "" && $email != "") {
        $res = pnVarValidate($email, 'email');
        if($res == false) {
	        $error = 1;
            /* eregi checks for a valid email! works nicely for me! */
            /* nkame: centralization of mail validation */
            echo ""._INVALIDEMAIL.'<br />';
        }
    	$valid = pnVarValidate($url, 'url');
        if (($url_title != "" && $valid == false) || ($url_title == "" && !empty($url))) {
            $error = 1;
            echo ""._INVALIDLINK.'<br />';
        }
	}
	if (isset($error) && $error == 1)
		echo '<br />'._GOBACK."";
	else {
		if($date == "")
		  $date = date("Y-m-d H:i:s", time());
		$year2 = substr($date,0,4);
		$month = substr($date,5,2);
		$day = substr($date,8,2);
		$fdate = ml_ftime(_DATELONG,mktime (0,0,0,$month,$day,$year2));
		echo "<form method=\"post\" action=\"index.php\" name=\"review\"><div>
		<input type=\"hidden\" name=\"name\" value=\"$GLOBALS[ModName]\" />";
		echo "<table border=\"0\" width=\"100%\"><tr><td colspan=\"2\">";
		echo "<p><h2><em><strong>".pnVarPrepForDisplay($title)."</strong></em></h2><br />";
		echo "<blockquote><p>";
		if ($cover != "")
		  echo "<img src=\"modules/$GLOBALS[ModName]/images/$cover\" alt=\"\" />";
		echo "".pnVarPrepHTMLDisplay(nl2br($text))."<p>";
		echo '<strong>'._ADDED.'</strong> '.pnVarPrepForDisplay($fdate).'<br />';
		if (isset ($rlanguage) && $rlanguage != '') {
			echo '<strong>'._LANGUAGE.'</strong> '.pnVarPrepForDisplay($rlanguage).'<br />'; /* ML Added rlanguage for display */
		}
		echo '<strong>'._REVIEWER."</strong> <a href=\"mailto:". pnVarPrepForDisplay($email) ."\">".pnVarPrepForDisplay($reviewer)."</a><br />";
		echo '<strong>'._SCORE.'</strong> ';

		display_score($score);

		if ($url != "")
			echo "<br /><strong>"._RELATEDLINK.":</strong> <a href=\"".pnVarPrepHTMLDisplay($url)."\" target=\"new\">".pnVarPrepForDisplay($url_title)."</a>";
		if ($id != 0) {
			echo "<br /><strong>"._REVIEWID.":</strong>".pnVarPrepForDisplay($id).'<br />';
			echo '<strong>'._HITS.":</strong>".pnVarPrepForDisplay($hits).'<br />';
		}
		echo "</blockquote>";
		echo "</td></tr></table>";
		echo "<input type=\"hidden\" name=\"req\" value=\"send_review\" />";
		echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />
			  <input type=\"hidden\" name=\"hits\" value=\"".pnVarPrepHTMLDisplay($hits)."\" />
			  <input type=\"hidden\" name=\"date\" value=\"".pnVarPrepHTMLDisplay($date)."\" />
			  <input type=\"hidden\" name=\"title\" value=\"".pnVarPrepHTMLDisplay($title)."\" />
			  "._CHANGES."<br /><textarea id=\"reviewtext\" name=\"text\" rows=10 cols=80>".pnVarPrepHTMLDisplay($text)."</textarea>
			  <input type=\"hidden\" name=\"reviewer\" value=\"".pnVarPrepHTMLDisplay($reviewer)."\" />
			  <input type=\"hidden\" name=\"email\" value=\"".pnVarPrepHTMLDisplay($email)."\" />
			  <input type=\"hidden\" name=\"score\" value=\"".pnVarPrepHTMLDisplay($score)."\" />
			  <input type=\"hidden\" name=\"url\" value=\"".pnVarPrepHTMLDisplay($url)."\" />
			  <input type=\"hidden\" name=\"url_title\" value=\"".pnVarPrepHTMLDisplay($url_title)."\" />
			  <input type=\"hidden\" name=\"cover\" value=\"".pnVarPrepHTMLDisplay($cover)."\" />
			  <input type=\"hidden\" name=\"rlanguage\" value=\"".pnVarPrepHTMLDisplay($rlanguage)."\" />";
		echo "<p><em>"._LOOKSRIGHT."</em><br />
			  <input type=\"submit\" name=\"req\" value=\""._YES."\" /> </form><hr />";
		echo "<form method=\"post\" action=\"index.php\" name=\"preview\" />
			  <input type=\"hidden\" name=\"name\" value=\"$GLOBALS[ModName]\" />
			  <input type=\"hidden\" name=\"req\" value=\"preview_review\" />";
		echo '<strong>'._PRODUCTTITLE.":</strong><br />
			  <input type=\"text\" name=\"title\" size=\"50\" maxlength=\"150\" value=\"".pnVarPrepHTMLDisplay($title)."\" /><br />
			  <em>"._NAMEPRODUCT."</em><br />";
		echo "<input type=\"hidden\" name=\"rlanguage\" value=\"".pnVarPrepHTMLDisplay($rlanguage)."\" />";
		echo "<br /><strong>"._REVIEW.":</strong><br />"
			."<textarea id=\"previewtext\" name=\"text\" rows=\"10\" wrap=\"virtual\" cols=\"80\">".pnVarPrepHTMLDisplay($text)."</textarea><br />";

		echo "<em>"._CHECKREVIEW."</em><br />";
		echo ""._ALLOWEDHTML.'<br />';
		$AllowableHTML = pnConfigGetVar('AllowableHTML');
		while (list($key, $access, ) = each($AllowableHTML)) {
			if ($access > 0) echo " &lt;".$key."&gt;";
		}
		if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_ADD)) {
			echo '<br />'._PAGEBREAK.'<br />';
		}
		
		echo "<br /><strong>"._YOURNAME.":</strong><br />";
		echo "<input type=\"text\" name=\"reviewer\" size=\"41\" maxlength=\"40\" value=\"".pnVarPrepHTMLDisplay($reviewer)."\" /><br />
			 <em>"._FULLNAMEREQ."</em><br />
			 <strong>"._REMAIL.":</strong><br />
			 <input type=\"text\" name=\"email\" size=\"40\" maxlength=\"80\" value=\"".pnVarPrepHTMLDisplay($email)."\" /><br />
			 <em>"._REMAILREQ."</em><br />
			 <strong>"._SCORE."</strong><br />
			 <input type=\"text\" name=\"score\" size=\"40\" maxlength=\"2\" value=\"".pnVarPrepHTMLDisplay($score)."\" /><br />
			 <em>"._SELECTSCORE." (1-10)</em><br />
			 <strong>"._RELATEDLINK.":</strong><br />
			 <input type=\"text\" name=\"url\" size=\"40\" maxlength=\"100\" value=\"".pnVarPrepHTMLDisplay($url)."\" /><br />
			 <em>"._PRODUCTSITE."</em><br />
			 <strong>"._LINKTITLE.":</strong><br />
			 <input type=\"text\" name=\"url_title\" size=\"40\" maxlength=\"50\" value=\"".pnVarPrepHTMLDisplay($url_title)."\" /><br />
			 <em>"._LINKTITLEREQ."</em><br />";
		if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_ADD)) {
			echo '<strong>'._RIMAGEFILE.":</strong><br />
				  <input type=\"text\" name=\"cover\" size=\"40\" maxlength=\"100\" value=\"".pnVarPrepHTMLDisplay($cover)."\" /><br />
				  <em>"._RIMAGEFILEREQ."</em><br />";
		}
		echo "<p><em>"._LOOKSRIGHT."</em><br />
			  <input type=\"submit\" name=\"sub\" value=\""._PREVIEW."\" /></div></form>";
		if($id != 0) {
			$word = ""._RMODIFIED."";
		} else {
			$word = ""._RADDED."";
		}
		if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_ADD)) {
			echo "<br /><strong>"._NOTE.'</strong> '._ADMINLOGGED." $word.";
		}
    }
    CloseTable();
    include ('footer.php');
}

function send_review()
{
   
    list($date,
     $title,
     $text,
     $reviewer,
     $email,
     $score,
     $cover,
     $url,
     $url_title,
     $hits,
     $id,
     $rlanguage) = pnVarCleanFromInput('date',
                       'title',
                       'text',
                       'reviewer',
                       'email',
                       'score',
                       'cover',
                       'url',
                       'url_title',
                       'hits',
                       'id',
                       'rlanguage');
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    include ('header.php');

    if (!(pnSecAuthAction(0, 'Reviews::', '::', ACCESS_COMMENT))) {
        echo _REVIEWSSUBMITNOAUTH;
        include 'footer.php';
        return;
    }
    if (strpos($text, "<!--pagebreak-->") !== false) {
        $text = str_replace("<!--pagebreak-->","&lt;!--pagebreak--&gt;",$text);
    }
    if (strpos($text, "&lt;!--pagebreak--&gt;") !== false) {
        $text = str_replace("&lt;!--pagebreak--&gt;","<!--pagebreak-->",$text);
    }
    OpenTable();
    
    // check text input again
    if ($text == "") {
        echo '<br />'._INVALIDTEXT.'<br />';
        CloseTable();
        include 'footer.php';
        return;
    }
    
    echo '<br /><div style="text-align:center">'._RTHANKS;
    if ($id != 0)
        echo _MODIFICATION;
    else
        echo ", " . $reviewer. "!<br />";

    if ($id == 0) {
        // New review
        if (!(pnSecAuthAction(0, 'Reviews::', "$title::", ACCESS_COMMENT))) {
            echo _REVIEWSSUBMITNOAUTH;
            CloseTable();
            include 'footer.php';
            return;
        }

        if (pnSecAuthAction(0, 'Reviews::', "$title::", ACCESS_ADD)) {
            // Add immediately
            $column = &$pntable['reviews_column'];
            $newid = $dbconn->GenId($pntable['reviews']);
            $result =& $dbconn->Execute("INSERT INTO $pntable[reviews] ($column[id], $column[date], $column[title], $column[text], $column[reviewer], $column[email], $column[score], $column[cover], $column[url], $column[url_title], $column[hits], $column[language]) VALUES ($newid,
            '".pnVarPrepForStore($date)."',
                '".pnVarPrepForStore($title)."',
                '".pnVarPrepForStore($text)."',
                '".pnVarPrepForStore($reviewer)."',
                '".pnVarPrepForStore($email)."',
                '".pnVarPrepForStore($score)."',
                '".pnVarPrepForStore($cover)."',
                '".pnVarPrepForStore($url)."',
                '".pnVarPrepForStore($url_title)."',
                '1',
                '".pnVarPrepForStore($rlanguage)."'
            )");
            if($dbconn->ErrorNo()<>0) {
                error_log("ERROR 1 : " . $dbconn->ErrorMsg());
            }
            echo _ISAVAILABLE;
        } else {
            // Add to waiting list
            $column = &$pntable['reviews_add_column'];
            $nextid = $dbconn->GenId($pntable['reviews_add']);
            $result =& $dbconn->Execute("INSERT INTO $pntable[reviews_add] ($column[id], $column[date], $column[title], $column[text], $column[reviewer], $column[email], $column[score], $column[url], $column[url_title], $column[language]) VALUES ($nextid,
            '".pnVarPrepForStore($date)."',
                '".pnVarPrepForStore($title)."',
                '".pnVarPrepForStore($text)."',
                '".pnVarPrepForStore($reviewer)."',
                '".pnVarPrepForStore($email)."',
                '".pnVarPrepForStore($score)."',
                '".pnVarPrepForStore($url)."',
                '".pnVarPrepForStore($url_title)."',
                '".pnVarPrepForStore($rlanguage)."'
            )");
            if($dbconn->ErrorNo()<>0) {
                error_log("ERROR 1 : " . $dbconn->ErrorMsg());
            }
            echo _EDITORWILLLOOK;
        }

    } else {
        // Updated review
        if (!(pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_EDIT))) {
            echo _REVIEWSEDITNOAUTH;
            CloseTable();
            include 'footer.php';
            return;
        }

        $column = &$pntable['reviews_column'];
        $result =& $dbconn->Execute("UPDATE $pntable[reviews] SET $column[date]='".pnVarPrepForStore($date)."', $column[title]='".pnVarPrepForStore($title)."', $column[text]='".pnVarPrepForStore($text)."', $column[reviewer]='".pnVarPrepForStore($reviewer)."', $column[email]='".pnVarPrepForStore($email)."', $column[score]='".pnVarPrepForStore($score)."', $column[cover]='".pnVarPrepForStore($cover)."', $column[url]='".pnVarPrepForStore($url)."', $column[url_title]='".pnVarPrepForStore($url_title)."', $column[hits]='".pnVarPrepForStore($hits)."', $column[language]='".pnVarPrepForStore($rlanguage)."' WHERE $column[id] = '".pnVarPrepForStore($id)."'");
        if($dbconn->ErrorNo()<>0) {
            error_log("ERROR 2 : " . $dbconn->ErrorMsg());
        }
        echo _ISAVAILABLE;
    }
    echo "<br />[ <a href=\"index.php?name=$GLOBALS[ModName]\">"._RBACK."</a> ]</div>";
    CloseTable();
    include 'footer.php';
}

function reviews_index()
{
    
    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $currentlang = pnUserGetLang();

    include ('header.php');
    $column = &$pntable['reviews_column'];
    if (pnConfigGetVar('multilingual') == 1) {
        $querylang = "WHERE ($column[language]='$currentlang' OR $column[language]='')";
    } else {
        $querylang = "";
    }
    OpenTable();
    echo '<h1>'._RWELCOME.'</h1>';
    $column = &$pntable['reviews_main_column'];
    $result =& $dbconn->Execute("SELECT $column[title], $column[description] FROM $pntable[reviews_main]");
    list($title, $description) = $result->fields;
    echo "<h2>" . pnVarPrepForDisplay($title) . "</h2>";
	echo "<div style=\"text-align:center\">" . pnVarPrepHTMLDisplay($description) . "</div>";
    alpha();
    echo "<table border=\"0\" width=\"95%\" cellpadding=\"2\" cellspacing=\"4\">";
    echo "<tr><td style=\"width:50%;background-color:$GLOBALS[bgcolor2]\"><strong>"._10MOSTPOP."</strong></td>";
    echo "<td style=\"width:50%;background-color:$GLOBALS[bgcolor2]\"><strong>"._10MOSTREC."</strong></td></tr>";
    $column = &$pntable['reviews_column'];
    //$popquery = buildSimpleQuery('reviews', array ('id', 'title', 'hits'), $querylang, "$column[hits] DESC", 10);
    //$result_pop =& $dbconn->Execute($popquery);
	$popquery = "SELECT $column[id], $column[title], $column[hits]
				FROM $pntable[reviews] ".$querylang."
				ORDER BY $column[hits] DESC";
    $result_pop =& $dbconn->SelectLimit($popquery,10);
    $x = 0;
    while (!$result_pop->EOF)  {
        list($id, $title, $hits) = $result_pop->fields;
        $ida[$x] = $id;
        $titlea[$x] = $title;
        $hitsa[$x] = $hits;
        $x++;
        $result_pop->MoveNext();
    }

    //$recquery = buildSimpleQuery('reviews', array ('id', 'title', 'date', 'hits'), $querylang, "$column[date] DESC", 10);
    //$result_rec =& $dbconn->Execute($recquery);
	$recquery = "SELECT $column[id], $column[title], $column[date], $column[hits]
				FROM $pntable[reviews] ".$querylang."
				ORDER BY $column[date] DESC";
	$result_rec =& $dbconn->SelectLimit($recquery,10);
    $x = 0;
    while (!$result_rec->EOF)  {
        list($id, $title, $hits) = $result_rec->fields;
        $idb[$x] = $id;
        $titleb[$x] = $title;
        $hitsb[$x] = $hits;
        $x++;
        $result_rec->MoveNext();
    }

    $y = 1;
    for ($x = 0; $x < 10; $x++) {
        echo "<tr>";

        if(empty ($ida[$x])) {
	    $ida[$x]='';
	}
        $id=$ida[$x];
        if(empty ($titlea[$x])) {
	    $titlea[$x]='';
	}
        $title=$titlea[$x];

        if(empty($hitsa[$x])) {
	    $hitsa[$x]='';
	}
        $hits=$hitsa[$x];

        if (pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_READ)) {
            echo "<td style=\"width:50%;background-color:$GLOBALS[bgcolor4]\">".pnVarPrepForDisplay($y).") <a href=\"index.php?name=$GLOBALS[ModName]&amp;req=showcontent&amp;id=$id\">".pnVarPrepForDisplay($title)."</a></td>";
        } else {
            echo "<td style=\"width:50%;background-color:$GLOBALS[bgcolor4]\">".pnVarPrepForDisplay($y).")</td>";
        }
//        list($id, $title, , $hits)=$result_rec->fields;
        if(empty($idb[$x])) {
	    $idb[$x]='';
	}
        $id=$idb[$x];
        if(empty($titleb[$x])) {
	    $titleb[$x]='';
	}
        $title=$titleb[$x];
        if(empty($hitsb[$x])) {
	    $hitsb[$x]='';
	}
        $hits=$hitsb[$x];
        if (pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_READ)) {
            echo "<td style=\"width:50%;background-color:$GLOBALS[bgcolor4]\">$y) <a href=\"index.php?name=$GLOBALS[ModName]&amp;req=showcontent&amp;id=$id\">" . pnVarPrepForDisplay($title) . "</a></td>";
        } else {
            echo "<td style=\"width:50%;background-color:$GLOBALS[bgcolor4]\">$y)</td>";
        }
        echo "</tr>";
        $y++;
    }
    echo "<tr><td colspan=\"2\"></td></tr>";
    $result =& $dbconn->Execute("SELECT count(*) FROM $pntable[reviews] ".$querylang."");
    list($numresults) = $result->fields;
    echo "<tr><td colspan=\"2\"><div style=\"text-align:center\"><span class=\"pn-sub\">"._THEREARE."
    $numresults "._REVIEWSINDB."</span></div></td></tr></table>";
    /* memory flush */
    $result_pop->Close();
    $result_rec->Close();
    $result->Close();
    CloseTable();
    include 'footer.php';
}

function reviews()
{
     list($letter,
     $field,
     $order) = pnVarCleanFromInput('req',
				   'field',
				   'order');
	
	//force order into upper case
	$order = strtoupper($order);

	switch($order) {
		case "DESC": break;
		case "ASC": break;
		default: $order=""; break;
	};

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $reviewstable = $pntable['reviews'];
    $column = &$pntable['reviews_column'];

    $currentlang = pnUserGetLang();

    include ('header.php');
    if (pnConfigGetVar('multilingual') == 1) {
        $querylang = "AND ($column[language] ='$currentlang' OR $column[language] = '')";
    } else {
        $querylang = "";
    }
    $sitename = pnVarPrepForDisplay(pnConfigGetVar('sitename'));

    OpenTable();
    echo "<div style=\"text-align:center\"><strong>$sitename "._REVIEWS.'</strong><br />';
    if ($letter == _ALL) {
      $query = "SELECT $column[id], $column[title], $column[hits], $column[reviewer], $column[score]
                FROM $reviewstable WHERE $column[id] != '' $querylang ";
    } else {
      echo "<em>"._REVIEWSLETTER." \"".pnVarPrepForDisplay($letter)."\"</em><br />";
      $query = "SELECT $column[id], $column[title], $column[hits], $column[reviewer], $column[score]
                FROM $reviewstable
                WHERE UPPER($column[title]) LIKE '".pnVarPrepForStore($letter)."%'
                $querylang ";
    }

    switch($field) {

        case "reviewer":
            $query .= " ORDER by pn_reviewer $order";
            break;

        case "score":
            $query .= " ORDER by pn_score $order";
            break;

        case "hits":
            $query .= " ORDER by pn_hits $order";
            break;

        default:
            $query .= " ORDER by pn_title $order";
            break;
    }

    $result =& $dbconn->Execute($query);
	if ($dbconn->ErrorNo() != 0) {
		pnSessionSetVar('errormsg', 'Error: ' . $dbconn->ErrorNo() . ': ' . $dbconn->ErrorMsg());
    }
    if ($result->EOF) {
        echo '<em><strong>'._NOREVIEWS.' \''.$letter.'\'</strong></em><br />';
    } else {
        echo "<table border=\"0\" width=\"100%\" cellpadding=\"2\" cellspacing=\"4\">
                <tr>
                <td style=\"width:50%;background-color:$GLOBALS[bgcolor4]\">
                <p style=\"text-align:left\"><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$letter&amp;field=title&amp;order=ASC\"><img src=\"modules/$GLOBALS[ModName]/images/up.gif\" width=\"15\" height=\"9\" alt=\""._SORTASC."\" /></a><strong> "._PRODUCTTITLE." </strong><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$letter&amp;field=title&amp;order=DESC\"><img src=\"modules/$GLOBALS[ModName]/images/down.gif\" width=\"15\" height=\"9\" alt=\""._SORTDESC."\" /></a></p>
                </td>
                <td style=\"width:18%;background-color:$GLOBALS[bgcolor4]\">
                <p style=\"text-align:center\"><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$letter&amp;field=reviewer&amp;order=ASC\"><img src=\"modules/$GLOBALS[ModName]/images/up.gif\" width=\"15\" height=\"9\" alt=\""._SORTASC."\" /></a><strong> "._REVIEWER." </strong><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$letter&amp;field=reviewer&amp;order=DESC\"><img src=\"modules/$GLOBALS[ModName]/images/down.gif\" width=\"15\" height=\"9\" alt=\""._SORTDESC."\" /></a></p>
                </td>
                <td style=\"width:18%;background-color:$GLOBALS[bgcolor4]\">
                <p style=\"text-align:center\"><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$letter&amp;field=score&amp;order=ASC\"><img src=\"modules/$GLOBALS[ModName]/images/up.gif\" width=\"15\" height=\"9\" alt=\""._SORTASC."\" /></a><strong> "._SCORE." </strong><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$letter&amp;field=score&amp;order=DESC\"><img src=\"modules/$GLOBALS[ModName]/images/down.gif\" width=\"15\" height=\"9\" alt=\""._SORTDESC."\" /></a></p>
                </td>
                <td style=\"width:14%;background-color:$GLOBALS[bgcolor4]\">
                <p style=\"text-align:center\"><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$letter&amp;field=hits&amp;order=ASC\"><img src=\"modules/$GLOBALS[ModName]/images/up.gif\" width=\"15\" height=\"9\" alt=\""._SORTASC."\" /></a><strong> "._HITS." </strong><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=$letter&amp;field=hits&amp;order=DESC\"><img src=\"modules/$GLOBALS[ModName]/images/down.gif\" width=\"15\" height=\"9\" alt=\""._SORTDESC."\" /></a></p>
                </td>
                </tr>";
        $numshown=0;
        while(!$result->EOF) {
            $myrow = $result->GetRowAssoc(false);
            $title = $myrow['pn_title'];
            $id = $myrow['pn_id'];
            $reviewer = $myrow['pn_reviewer'];
            if(!empty ($myrow['pn_email'])){
                $email = $myrow['pn_email'];
            } else {
              $email='';
            }
            $score = $myrow['pn_score'];
            $hits = $myrow['pn_hits'];

            if (pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_READ)) {
                echo "<tr>
                        <td style=\"width:50%;background-color:$GLOBALS[bgcolor4]\"><a href=\"index.php?name=$GLOBALS[ModName]&amp;req=showcontent&amp;id=$id\">".pnVarPrepForDisplay($title)."</a></td>
                        <td style=\"width:18%;background-color:$GLOBALS[bgcolor4]\">";
                if ($reviewer != "")
                    echo "<div style=\"text-align:center\">".pnVarPrepForDisplay($reviewer).'</div>';
                echo "</td><td style=\"width:18%;background-color:$GLOBALS[bgcolor4]\"><div style=\"text-align:center\">";
                display_score($score);
                echo "</div></td><td style=\"width:14%;background-color:$GLOBALS[bgcolor4]\">".pnVarPrepForDisplay($hits)."</td>
                    </tr>";
                $numshown++;
            }
        $result->MoveNext();
        }
        echo "</table>";
        echo "<br /><span class=\"pn-sub\">$numshown "._TOTALREVIEWS."</span><br />";
    }
    echo "[ <a href=\"index.php?name=$GLOBALS[ModName]\">"._RETURN2MAIN."</a> ]</div>";
    /* memory flush */
    $result->Close();
    CloseTable();
    include ('footer.php');
}

function postcomment()
{
    
    list($id,
     $title) = pnVarCleanFromInput('id',
                       'title');

    $AllowableHTML = pnConfigGetVar('AllowableHTML');
    $anonymous = pnConfigGetVar('anonymous');

    include('header.php');
    if (!(pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_COMMENT))) {
        echo _REVIEWSCOMMENTNOAUTH;
        include 'footer.php';
        return;
    }

    $title = urldecode($title);
    OpenTable();
    echo '<div style="text-align:center"><strong>'._REVIEWCOMMENT." ".pnVarPrepForDisplay($title)."</strong></div>
    <form action=\"index.php\" method=\"post\"><div>
    <input type=\"hidden\" name=\"name\" value=\"$GLOBALS[ModName]\" />
    ";
    if (!pnUserLoggedIn()) {
        echo '<strong>'._YOURNICK.'</strong> '.pnVarPrepForDisplay($anonymous)." [ "._RCREATEACCOUNT." ]<br />";
        $uname = $anonymous;
    } else {
        $uname = pnUserGetVar('uname');
        echo '<strong>'._YOURNICK.'</strong> '.pnVarPrepForDisplay($uname)."<br />
        <input type=\"checkbox\" name=\"xanonpost\" /> "._POSTANON.'<br />';
    }
    echo "
    <input type=\"hidden\" name=\"uname\" value=\"$uname\" />
    <input type=\"hidden\" name=\"id\" value=\"$id\" />
    <strong>"._SELECTSCORE."</strong>
    <select name=\"score\">
    <option value=\"10\">10</option>
    <option value=\"9\">9</option>
    <option value=\"8\">8</option>
    <option value=\"7\">7</option>
    <option value=\"6\">6</option>
    <option value=\"5\">5</option>
    <option value=\"4\">4</option>
    <option value=\"3\">3</option>
    <option value=\"2\">2</option>
    <option value=\"1\">1</option>
    </select><br />
    <strong>"._YOURCOMMENT."</strong><br />
    <textarea name=\"comments\" rows=\"10\" cols=\"80\"></textarea><br />
    "._ALLOWEDHTML.'<br />';
    while (list($key, $access, ) = each($AllowableHTML)) {
        if ($access > 0) echo " &lt;".$key."&gt;";
    }
    echo "<br />
    <input type=\"hidden\" name=\"req\" value=\"savecomment\" />
    <input type=\"submit\" value=\""._SUBMIT."\" />
    </div></form>";
    CloseTable();
    include('footer.php');
}

function savecomment()
{
    
    list($xanonpost,
     $uname,
     $id,
     $score,
     $comments) = pnVarCleanFromInput('xanonpost',
                      'uname',
                      'id',
                      'score',
                      'comments');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $anonymous = pnConfigGetVar('anonymous');

    // jgm - need to get review title for proper authorisation
    if (!(pnSecAuthAction(0, 'Reviews::', "::$id", ACCESS_COMMENT))) {
        include 'header.php';
        echo _REVIEWSCOMMENTNOAUTH;
        include 'footer.php';
        return;
    }

    if ($xanonpost) {
        $uname = $anonymous;
    }
    $column = &$pntable['reviews_comments_column'];
    $newid = $dbconn->GenId($pntable['reviews_comments_column']);
    $result =& $dbconn->Execute("INSERT INTO $pntable[reviews_comments] ($column[cid], $column[rid], $column[userid], $column[date], $column[comments], $column[score]) VALUES (
    $newid,
        '".pnVarPrepForStore($id)."',
        '".pnVarPrepForStore($uname)."',
        now(),
        '".pnVarPrepForStore($comments)."',
        '".pnVarPrepForStore($score)."'
    )");
    if($dbconn->ErrorNo()<>0) {
        error_log("ERROR 4 : " . $dbconn->ErrorMsg());
    }
    pnRedirect('index.php?name='.$GLOBALS['ModName'].'&file=index');
 }

function r_comments()
{
    list($id, $title) = pnVarCleanFromInput('id', 'title');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $column = &$pntable['reviews_comments_column'];
    $result =& $dbconn->Execute("SELECT $column[cid], $column[userid], $column[date], $column[comments], $column[score]
                              FROM $pntable[reviews_comments]
                              WHERE $column[rid]='".(int)pnVarPrepForStore($id)."'
                              ORDER BY $column[date] DESC");
    while(!$result->EOF) {
        list($cid, $uname, $date, $comments, $score) = $result->fields;
        $date=$result->UnixTimeStamp($date);
        OpenTable();
        $title = urldecode($title);
        echo "<strong>$title</strong><br />";
        if ($uname == "Anonymous") {
            echo ""._POSTEDBY." $uname "._ON." ". ml_ftime(_DATETIMEBRIEF,GetUserTime($date)).'<br />';
        } else {
            echo ""._POSTEDBY." <a href=\"user.php?op=userinfo&amp;uname=$uname\">$uname</a> "._ON." ". ml_ftime(_DATETIMEBRIEF,GetUserTime($date)).'<br />';
        }
        echo ""._MYSCORE." ";
        display_score($score);
        if (pnSecAuthAction(0, 'Reviews::', '::', ACCESS_DELETE)) {
            echo "<br /><strong>"._REVIEWADMIN."</strong> [ <a href=\"index.php?name=$GLOBALS[ModName]&amp;req=del_comment&amp;cid=$cid&amp;id=$id\">"._DELETE."</a> ]<hr />";
        } else {
            echo "<hr />";
        }
		//transform hooks
		list($comments) = pnModCallHooks('item', 'transform', '', array($comments));
        echo pnVarPrepHTMLDisplay($comments);
        CloseTable();
        $result->MoveNext();
    }
}

function showcontent()
{
	list($id, $page) = pnVarCleanFromInput('id', 'page');

    if(!isset($page) || (!is_numeric($page))) {
    	$page = 1;
    }
    $next_page = "";
    $previous_page = "";

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    include ('header.php');

    // jgm - need to get review title for proper authorisation
    if (!(pnSecAuthAction(0, 'Reviews::', "::$id", ACCESS_READ))) {
        echo _REVIEWSREADNOAUTH;
        include 'footer.php';
        return;
    }

    OpenTable();
    if ($page == 1) {
        $column = &$pntable['reviews_column'];
        $result =& $dbconn->Execute("UPDATE $pntable[reviews] SET $column[hits]=$column[hits]+1 WHERE $column[id]='".(int)pnVarPrepForStore($id)."'");
        if($dbconn->ErrorNo()<>0)
        {
            error_log("ERROR 5 : " . $dbconn->ErrorMsg());
            echo _REVIEWSINVALIDID;
            CloseTable();
            include 'footer.php';
            return;
        }
    }
    $column = &$pntable['reviews_column'];
    $query = "SELECT * FROM $pntable[reviews] WHERE $column[id]='".(int)pnVarPrepForStore($id)."'";
    // 0=pn_id, 1=pn_date, 2=pn_title, 3=pn_text, 4=pn_reviewer, 5=pn_email, 6=pn_score,
    // 7=pn_cover, 8=pn_url, 9=pn_url_title, 10=pn_hits, 11=pn_language
    $result =& $dbconn->Execute($query);
    if($dbconn->ErrorNo()<>0)
    {
        echo _REVIEWSINVALIDID;
        CloseTable();
        include 'footer.php';
        return;
    }

    echo "<div style=\"text-align:center\">";

    $id        =  $result->fields[0];
    $date      = $result->fields[1];
    $year      = substr($date,0,4);
    $month     = substr($date,5,2);
    $day       = substr($date,8,2);
    $fdate     = ml_ftime(_DATELONG,mktime (0,0,0,$month,$day,$year));
    $title     = $result->fields[2];
    $text      = $result->fields[3];
    $reviewer  = $result->fields[4];
    $email     = $result->fields[5];
    $score     = $result->fields[6];
    $cover     = $result->fields[7];
    $url       = $result->fields[8];
    $url_title = $result->fields[9];
    $hits      = $result->fields[10];
    $rlanguage = $result->fields[11]; /* ML added */

	// set a page title
	$GLOBALS['info']['title'] = $title;

    $contentpages = explode( "<!--pagebreak-->", $text );
    $pageno = count($contentpages);
    if ( $page < 1 )
        $page = 1;
    if ( $page > $pageno )
        $page = $pageno;
    $arrayelement = (int)$page;
    $arrayelement --;
        echo "<h2><em>".pnVarPrepForDisplay($title)."</em></h2>";
        if ($cover != "")
        echo "<img src=\"modules/$GLOBALS[ModName]/images/$cover\" alt=\"\" />";
		//transform hooks
        echo "<p style=\"text-align:justify\">";
		list($contentpages[$arrayelement]) = pnModCallHooks('item', 'transform', '', array($contentpages[$arrayelement]));
        echo pnVarPrepHTMLDisplay(nl2br($contentpages[$arrayelement]));
        echo "</p>";
        if (pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_EDIT)) {
            echo '<strong>'._REVIEWADMIN."</strong> [ <a href=\"index.php?name=$GLOBALS[ModName]&amp;req=mod_review&amp;id=$id\">"._EDIT."</a> ";
            if (pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_DELETE)) {
                echo "| <a href=index.php?name=$GLOBALS[ModName]&amp;req=del_review&amp;id_del=$id>"._DELETE."</a> ";
            }
            echo "]";
        }
        echo '<br />';
        echo '<strong>'._ADDED."</strong>&nbsp; ".pnVarPrepForDisplay($fdate).'<br />';
        if ($reviewer != "")
        echo '<strong>'._REVIEWER."</strong> &nbsp;<a href=\"mailto:$email\">".pnVarPrepForDisplay($reviewer)."</a><br />";
        if ($score != "")
        echo '<strong>'._SCORE.'</strong> ';
        display_score($score);
        if ($url != "")
                echo "<br /><strong>"._RELATEDLINK.":</strong>&nbsp; <a href=\"".pnVarPrepForDisplay($url)."\">".pnVarPrepForDisplay($url_title)."</a>";
        echo "<br /><strong>"._HITS.":</strong>&nbsp;".pnVarPrepForDisplay($hits)."";
        if (isset($rlanguage) && $rlanguage != ''){
        	echo "<br /><strong>"._LANGUAGE.":</strong>&nbsp;".pnVarPrepForDisplay($rlanguage).""; /* ML ADDED */
    	}
    	if ($pageno > 1) {
        	echo "<br /><strong>"._PAGE.":</strong> $page/$pageno<br />";
    	}
//		echo "</td></tr><tr><td>";
        //echo "</td></tr></table>";
        //echo "</CENTER>";

        // memory flush
        $result->Close();
    if($page >= $pageno) {
          $next_page = "";
    } else {
        $next_pagenumber = $page + 1;
        if ($page != 1) {
            $next_page .= "<img src=\"modules/$GLOBALS[ModName]/images/blackpixel.gif\" width=\"10\" height=\"2\" alt=\"\" /> &nbsp;&nbsp; ";
        }
        $next_page .= "<a href=\"index.php?name=$GLOBALS[ModName]&amp;req=showcontent&amp;id=$id&amp;page=$next_pagenumber\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"index.php?name=$GLOBALS[ModName]&amp;req=showcontent&amp;id=$id&amp;page=$next_pagenumber\"><img src=\"modules/$GLOBALS[ModName]/images/right.gif\" alt=\""._NEXT."\" /></a>";
    }
    if($page <= 1) {
        $previous_page = "";
    } else {
        $previous_pagenumber = $page - 1;
        $previous_page = "<a href=\"index.php?name=$GLOBALS[ModName]&amp;req=showcontent&amp;id=$id&amp;page=$previous_pagenumber\"><img src=\"modules/$GLOBALS[ModName]/images/left.gif\" alt=\""._PREVIOUS."\" /></a> <a href=\"index.php?name=$GLOBALS[ModName]&amp;req=showcontent&amp;id=$id&amp;page=$previous_pagenumber\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
    }
    echo "<div>"
        ."$previous_page  &nbsp;&nbsp; $next_page <br />"
        ."[ <a href=\"index.php?name=$GLOBALS[ModName]\">"._RBACK."</a> ]";
	if (pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_COMMENT)) {
		echo " [ <a href=\"index.php?name=$GLOBALS[ModName]&amp;req=postcomment&amp;id=$id&amp;title=$title\">"._REPLYMAIN."</a> ]";
	}
	echo "</div></div>";
    CloseTable();
    if ($page == 1) {
        r_comments($id, $title);
    }

	// added hook call - markwest
    echo pnModCallHooks('item', 'display', $id, "index.php?name=$GLOBALS[ModName]&req=showcontent&id=$id");

    include ('footer.php');
}

function mod_review()
{
   
    $id = pnVarCleanFromInput('id');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $currentlang = pnUserGetLang();

    if (isset($multilingual) && $multilingual == 1) {
       $querylang = "AND (language='$currentlang' OR language='')";
    } else {
        $querylang = "";
    }

    include ('header.php');

    OpenTable();
    if ($id != 0) {
        $column = &$pntable['reviews_column'];
        $query = "SELECT * FROM $pntable[reviews] WHERE $column[id]='".(int)pnVarPrepForStore($id)."'";
        // 0=pn_id, 1=pn_date, 2=pn_title, 3=pn_text, 4=pn_reviewer, 5=pn_email, 6=pn_score,
        // 7=pn_cover, 8=pn_url, 9=pn_url_title, 10=pn_hits, 11=pn_language
        $result =& $dbconn->Execute($query);
        if (!$result->EOF) {
            $id        = $result->fields[0];
            $date      = $result->fields[1];
            $title     = $result->fields[2];
            $text      = $result->fields[3];
            $reviewer  = $result->fields[4];
            $email     = $result->fields[5];
            $score     = $result->fields[6];
            $cover     = $result->fields[7];
            $url       = $result->fields[8];
            $url_title = $result->fields[9];
            $hits      = $result->fields[10];
            $rlanguage = $result->fields[11]; /* ML ADDED */
        }
        else
        {
           // Might have been given an invalid ID - blank it
           $id = "";
        }
        $result->Close();
        if (!(pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_EDIT))) {
            echo _REVIEWSEDITNOAUTH;
            CloseTable();
            include 'footer.php';
            return;
        }
        echo '<div style="text-align:center"><strong>'._REVIEWMOD.'</strong></div><br />';
        echo "<form method=\"post\" action=\"index.php\"><div>
        <input type=\"hidden\" name=\"name\" value=\"$GLOBALS[ModName]\" />
        <input type=\"hidden\" name=\"req\" value=\"preview_review\" />
        <input type=hidden name=\"id\" value=\"$id\" />";
        echo "<table border=\"0\" width=\"100%\">
                <tr>
                        <td style=\"width:12%\"><strong>"._RDATE."</strong></td>
                        <td><input type=\"text\" name=\"date\" size=\"15\" value=\"".pnVarPrepForDisplay($date)."\" maxlength=\"10\"  /></td>
                </tr>
                <tr>
                        <td style=\"width:12%\"><strong>"._RTITLE."</strong></td>
                        <td><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"150\" value=\"".pnVarPrepForDisplay($title)."\" /></td>
                </tr>
                <tr>
                        <td style=\"width:12%\"><strong>"._LANGUAGE."</strong></td>
                        <td><select name=\"rlanguage\" class=\"pn-text\" />";

    $lang = languagelist();
        $sel_lang[$currentlang] = ' selected="selected"';
        print '<option value="">'._ALL.'</option>';
        $handle = opendir('language');
        while ($f = readdir($handle)) {
            if (is_dir("language/$f") && (!empty($lang[$f]))) {
                $langlist[$f] = $lang[$f];
            }
        }
        asort($langlist);
        //  a bit ugly, but it works in E_ALL conditions (Andy Varganov)
        foreach ($langlist as $k=>$v){
        echo '<option value="'.$k.'"';
        if (isset($sel_lang[$k])) echo ' selected="selected"';
        echo '>'. $v . '</option>\n';
        }
        echo "</select></td>
                            </tr>
                            <tr>
                             <tr>
                                    <td style=\"width=12%\"><strong>"._RTEXT."</strong></td>
                                    <td><textarea id=\"reviewtext\" name=\"text\" rows=\"10\" wrap=\"virtual\" cols=\"80\" />".pnVarPrepHTMLDisplay($text)."</textarea></td>
                            </tr>
                            <tr>
                                    <td style=\"width=12%\"><strong>"._REVIEWER."</strong></td>
                                    <td><input type=\"text\" name=\"reviewer\" size=\"41\" maxlength=\"40\" value=\"".pnVarPrepForDisplay($reviewer)."\" /></td>
                            </tr>
                            <tr>
                                    <td style=\"width=12%\"><strong>"._REVEMAIL."</strong></td>
                                    <td><input type=\"text\" name=\"email\" value=\"".pnVarPrepForDisplay($email)."\" size=\"30\" maxlength=\"80\" /></td>
                            </tr>
                            <tr>
                                    <td style=\"width=12%\"><strong>"._SCORE."</strong></td>
                                    <td><input type=\"text\" name=\"score\" value=\"".pnVarPrepForDisplay($score)."\" size=\"3\" maxlength=\"2\" /></td>
                            </tr>
                            <tr>
                                    <td style=\"width=12%\"><strong>"._RLINK."</strong></td>
                                    <td><input type=\"text\" name=\"url\" value=\"".pnVarPrepForDisplay($url)."\" size=\"30\" maxlength=\"100\" /></td>
                            </tr>
                            <tr>
                                    <td style=\"width=12%\"><strong>"._RLINKTITLE."</strong></td>
                                    <td><input type=\"text\" name=\"url_title\" value=\"".pnVarPrepForDisplay($url_title)."\" size=\"30\" maxlength=\"50\" /></td>
                            </tr>
                            <tr>
                                    <td style=\"width=12%\"><strong>"._COVERIMAGE."</strong></td>
                                    <td><input type=\"text\" name=\"cover\" value=\"".pnVarPrepForDisplay($cover)."\" size=\"30\" maxlength=\"100\" /></td>
                            </tr>
                            <tr>
                                    <td style=\"width=12%\"><strong>"._HITS.":</strong></td>
                                    <td><input type=\"text\" name=\"hits\" value=\"".pnVarPrepForDisplay($hits)."\" size=\"5\" maxlength=\"5\" /></td>
                            </tr>
                    </table>";
        echo "<input type=\"hidden\" name=\"req\" value=\"preview_review\" /><input type=\"submit\" value=\""._PREMODS."\" />&nbsp;&nbsp;<input type=\"button\" onclick=\"history.go(-1)\" value="._CANCEL." /></div></form>";
    } else {
      echo _REVIEWSINVALIDID;
    }
    CloseTable();
    include ('footer.php');
}

function del_review()
{
   
    $id_del = pnVarCleanFromInput('id_del');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $column = &$pntable['reviews_column'];
    $result =& $dbconn->Execute("SELECT $column[title]
                              FROM $pntable[reviews]
                              WHERE $column[id]='".(int)pnVarPrepForStore($id_del)."'");
    list($title) = $result->fields;
    $result->Close();
    if (!(pnSecAuthAction(0, 'Reviews::', "$title::$id_del", ACCESS_DELETE))) {
        echo _REVIEWSDELNOAUTH;
        CloseTable();
        include 'footer.php';
        return;
    }
    $dbconn->Execute("DELETE FROM $pntable[reviews] WHERE {$pntable['reviews_column']['id']}='".(int)pnVarPrepForStore($id_del)."'");
    $dbconn->Execute("DELETE FROM $pntable[reviews_comments] WHERE {$pntable['reviews_comments_column']['rid']}='".(int)pnVarPrepForStore($id_del)."'");
    pnRedirect('index.php?name='.$GLOBALS[ModName].'&file=index');
}

function del_comment()
{
    
    list($cid,
     $id) = pnVarCleanFromInput('cid',
                    'id');

    $dbconn =& pnDBGetConn(true);
    $pntable =& pnDBGetTables();

    $column = &$pntable['reviews_column'];
    $result =& $dbconn->Execute("SELECT $column[title]
                              FROM $pntable[reviews]
                              WHERE $column[id]='".(int)pnVarPrepForStore($id)."'");
    list($title) = $result->fields;
    if (!(pnSecAuthAction(0, 'Reviews::', "$title::$id", ACCESS_DELETE))) {
        echo _REVIEWSDELNOAUTH;
        CloseTable();
        include 'footer.php';
        return;
    }
    $dbconn->Execute("DELETE FROM $pntable[reviews_comments] WHERE {$pntable['reviews_comments_column']['cid']}='".(int)pnVarPrepForStore($cid)."'");
    pnRedirect('index.php?name='.$GLOBALS[ModName].'&file=index');
}

$req = pnVarCleanFromInput('req');

if (!isset($req)) {
    $req = '';
}

if (isset($id) && $id!='' && !is_numeric($id)) {
	include 'header.php';
	echo _MODARGSERROR;
	include 'footer.php';
	return false;
}

if(in_array($req, $alphabet)) {
    reviews();
} else {

    switch($req) {

        case "showcontent":
            showcontent();
            break;

        case "write_review":
            write_review();
            break;

        case "preview_review":
            preview_review();
            break;

        case ""._YES."":
            send_review();
            break;

        case "del_review":
            del_review();
            break;

        case "mod_review":
            mod_review();
            break;

        case "postcomment":
            postcomment();
            break;

        case "savecomment":
            savecomment();
            break;

        case "del_comment":
            del_comment();
            break;

        default:
            reviews_index();
            break;
    }
}
?>
