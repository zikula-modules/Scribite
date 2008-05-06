<?php
// $Id: global.php,v 1.3 2006/09/04 21:19:00 larsneo Exp $
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
// Original Author of file: Hinrich Donner
// changed to pn_bbcode: larsneo
// ----------------------------------------------------------------------

define('_PNBBCODE_NOSCRIPTWARNING', 'Ihr Browser unterstützt kein JavaScript oder es ist abgeschaltet. Einige Funktionen auf dieser Seite können deshalb nicht benutzt werden bzw. die Seite wird möglicherweise nicht angezeigt wie erwartet.');
define('_PNBBCODE_ADMINCODECONFIG', 'Konfiguration [code][/code]');
define('_PNBBCODE_ADMINCOLORCONFIG', 'Konfiguration [color][/color]');
define('_PNBBCODE_ADMINISTRATION', 'pn_bbcode Verwaltung');
define('_PNBBCODE_ADMINQUOTECONFIG', 'Konfiguration [quote][/quote]');
define('_PNBBCODE_ADMINSIZECONFIG', 'Konfiguration [size][/size]');
define('_PNBBCODE_ARGSERROR',                 '[pn_bbcode] Interner Fehler! Argumente nicht verfügbar!');
define('_PNBBCODE_BOLD', 'b');
define('_PNBBCODE_BOLD_HINT', 'Fettschrift');
define('_PNBBCODE_CODE', 'Code');
define('_PNBBCODE_CODEHINT', '%h = Überschrift (_PNBBCODE_CODE), %c=Codezeilen, %j=Codezeilen, vorbereitet für Javascript');
define('_PNBBCODE_CODE_ADDLINENUMBERS', 'Zeilen nummerieren');
define('_PNBBCODE_CODE_HINT', 'Codezeilen einfügen');
define('_PNBBCODE_CODE_SYNTAXHIGHLIGHTING', 'Codehervorhebung einschalten');
define('_PNBBCODE_COLOR_ALLOWUSERCOLOR', 'Erlaube userdefinierte Textfarben');
define('_PNBBCODE_COLOR_BLACK', 'Schwarz');
define('_PNBBCODE_COLOR_BLUE', 'Blau');
define('_PNBBCODE_COLOR_BROWN', 'Braun');
define('_PNBBCODE_COLOR_CYAN', 'Türkis');
define('_PNBBCODE_COLOR_DARKBLUE', 'Dunkelblau');
define('_PNBBCODE_COLOR_DARKRED', 'Dunkelrot');
define('_PNBBCODE_COLOR_DEFAULT', 'Standard');
define('_PNBBCODE_COLOR_DEFINE', 'Selbst definieren');
define('_PNBBCODE_COLOR_ENABLE', 'Flexible Textfarben einschalten');
define('_PNBBCODE_COLOR_GREEN', 'Grün');
define('_PNBBCODE_COLOR_HINT', 'Schriftfarbe wählen');
define('_PNBBCODE_COLOR_INDIGO', 'Indigo');
define('_PNBBCODE_COLOR_OLIVE', 'Oliv');
define('_PNBBCODE_COLOR_ORANGE', 'Orange');
define('_PNBBCODE_COLOR_RED', 'Rot');
define('_PNBBCODE_COLOR_TEXTCOLORCODE', 'Farbcode angeben');
define('_PNBBCODE_COLOR_VIOLET', 'Violett');
define('_PNBBCODE_COLOR_WHITE', 'Weiss');
define('_PNBBCODE_COLOR_YELLOW', 'Gelb');
define('_PNBBCODE_CONFIGCHANGED', 'Konfiguration geändert');
define('_PNBBCODE_ENTER_EMAIL_ADDRESS','gewünschte E-Mail-Adresse angeben');
define('_PNBBCODE_ENTER_LIST_ITEM','Listen-Eintrag angeben. Bitte beachten, dass Listen geöffnet und geschlossen werden müssen');
define('_PNBBCODE_ENTER_PAGE_TITLE','Seitentitel');
define('_PNBBCODE_ENTER_SITE_TITLE','Titel der Seite angeben');
define('_PNBBCODE_ENTER_TEXT_BOLD','den fetten Text angeben');
define('_PNBBCODE_ENTER_TEXT_ITALIC','den kursiven Text angeben');
define('_PNBBCODE_ENTER_TEXT_UNDERLINE','den unterstrichenenen Text angeben');
define('_PNBBCODE_ENTER_URL','URL der gewünschten Seite angeben');
define('_PNBBCODE_ENTER_WEBIMAGE_URL','URL für das anzuzeigende Bild angeben');
define('_PNBBCODE_FONTCOLOR', 'Schriftfarbe');
define('_PNBBCODE_FONTSIZE', 'Schriftgrösse');
define('_PNBBCODE_IMAGE', 'Grafik');
define('_PNBBCODE_IMAGE_HINT', 'Eine Grafik einfügen');
define('_PNBBCODE_ITALIC', 'i');
define('_PNBBCODE_ITALIC_HINT', 'Kursivschrift');
define('_PNBBCODE_LISTCLOSE', '/ul');
define('_PNBBCODE_LISTCLOSE_HINT', 'Liste schliessen');
define('_PNBBCODE_LISTITEM', 'li');
define('_PNBBCODE_LISTITEM_HINT', 'Listeneintrag');
define('_PNBBCODE_LISTOPEN', 'ul');
define('_PNBBCODE_LISTOPEN_HINT', 'Liste öffnen');
define('_PNBBCODE_MAIL', 'Email');
define('_PNBBCODE_MAIL_HINT', 'Eine Mailadresse einfügen');
define('_PNBBCODE_NO', 'Nein');
define('_PNBBCODE_NOAUTH', 'Keine Berechtigung für diese Aktion');
define('_PNBBCODE_NOSPECIALCODE', 'kein spezieller Code');
define('_PNBBCODE_NOTALLOWEDTOSEEEMAILS', '*Keine Berechtigung für Emails*');
define('_PNBBCODE_NOTALLOWEDTOSEEEXTERNALLINKS', '*Keine Berechtigung für Links*');
define('_PNBBCODE_ORIGINALSENDER', 'Absender');
define('_PNBBCODE_PNADMINISTRATION', 'Administration');
define('_PNBBCODE_PREVIEW','Vorschau');
define('_PNBBCODE_QUOTE', 'Zitat');
define('_PNBBCODE_QUOTEHINT', '%u = Username, %t=zitierter Text');
define('_PNBBCODE_QUOTE_HINT', 'Zitat einfügen');
define('_PNBBCODE_SELECTCODE', 'Codetyp auswählen');
define('_PNBBCODE_SIZE_ALLOWUSERSIZE', 'Erlaube userdefinierte Textgröße');
define('_PNBBCODE_SIZE_DEFINE', 'Selbst definieren');
define('_PNBBCODE_SIZE_ENABLE', 'Flexible Textgrößen einschalten');
define('_PNBBCODE_SIZE_HINT', 'Schriftgrösse wählen');
define('_PNBBCODE_SIZE_HUGE', 'Sehr gross');
define('_PNBBCODE_SIZE_LARGE', 'Gross');
define('_PNBBCODE_SIZE_NORMAL', 'Normal');
define('_PNBBCODE_SIZE_SMALL', 'Klein');
define('_PNBBCODE_SIZE_TEXTSIZE', 'Textgrösse angeben');
define('_PNBBCODE_SIZE_TINY', 'Winzig');
define('_PNBBCODE_UNDERLINE', 'u');
define('_PNBBCODE_UNDERLINE_HINT', 'unterstrichene Schrift');
define('_PNBBCODE_URL', 'URL');
define('_PNBBCODE_URL_HINT', 'Einen Link einfügen');
define('_PNBBCODE_YES', 'Ja');


?>
