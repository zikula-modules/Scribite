<?php
// $Id: global.php,v 1.7 2006/01/23 19:35:42 larsneo Exp $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2001 by The PostNuke Development Team.
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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Andreas Krapohl <larsneo@postnuke.com>
// Purpose of file: Translation files
// Translation team: Read credits in /docs/CREDITS.txt
// ----------------------------------------------------------------------

define('_HTMLSAFEHTML', 'Safehtml-Filter für Ausgabe verwenden');
define('_ACTMULTILINGUAL','ML aktivieren');
define('_ACTUSEFLAGS','Flaggen aktivieren');
define('_ACTAUTODETECT', 'Sprache aufgrund der Browser-Einstellung voreinstellen');

define('_ADMINEMAIL','Administrator-E-Mail');
define('_ADMINGRAPHIC','Icons im Adminmenü?');
define('_ANONYMOUSSESSIONS', 'Session-Cookies auch für unregistrierte Benutzer setzen');
define('_ARTINADMIN','Artikel im Adminmenü');
define('_BACKENDCONF','Backend-Konfiguration');
define('_BACKENDLANG','Backend-Sprache');
define('_BACKENDTITLE','Backend-Titel');
define('_BLOCKSINARTICLES','Rechte Blöcke in Beiträgen anzeigen?');
define('_CENSORTEXT','Zensur aktivieren?');
define('_DEFAULTGROUP','Standardgruppe für Benutzer');
define('_DEFAULTTHEME','Standard-Theme der Seite');
define('_DYNKEYWORDS','Meta-Keywords dynamisch erzeugen');
define('_ERRORREPORTING', 'Error Reporting');
define('_FOOTERLINE','Fuß-Zeile (HTML erlaubt)');
define('_FOOTERMSG','Fuß-Nachricht');
define('_FUNTEXT','Douglas Adams Zitate in error.php');
define('_GENSITEINFO','Information');
define('_HTMLALLOWED','In Beiträgen erlaubte HTML-Tags');
define('_HTMLALLOWENTITIES','Eingebettete HTML-Entitäten in normale Zeichen wandeln');
define('_HTMLOPT','HTML Optionen');
define('_HTMLTAGALLOWED','erlaubt');
define('_HTMLTAGALLOWEDWITHPARAMS','erlaubt mit Parametern');
define('_HTMLTAGNAME','Tag');
define('_HTMLTAGNOTALLOWED','nicht erlaubt');
define('_HTMLWARNING','ANMERKUNG: Tags nur soweit unbedingt notwendig und nach Möglichkeit ohne Parameter erlauben. Einige Tags (z.B. A und IMG) müssen allerdings mit Parametern freigegeben werden um zu funktionieren. SCRIPT-Tags sollten generell nicht erlaubt werden.');
define('_INACTIVEXANTHIATHEMES', 'Xanthia-Theme Administration');
define('_LOADLEGACY', 'legacy-Unterstützung aktivieren');
define('_METAKEYWORDS','Meta Keywords');
define('_METATAGS', 'Meta Tags');
define('_MINUTES', 'Minuten');
define('_MISCELLANEOUS', 'Sonstiges');
define('_MLSETTINGS', 'ML Einstellungen');
define('_NEWSSETTINGS', 'News Einstellungen');
define('_NEWSPAGER', 'Pager für Newsbeiträge anzeigen');
define('_PNANTICRACKERTEXT','pnAntiCracker aktivieren?');
define('_REFERERONPRINT', 'Referer bei print.php prüfen?');
define('_REPORTLEVEL','error.php Meldungen via E-Mail senden');
define('_REPORTLEVEL0','keine');
define('_REPORTLEVEL1','von Zugriffen innerhalb der Domain');
define('_REPORTLEVEL2','generell');
define('_SECHIGH', 'hoch (Benutzer müssen sich bei jedem Besuch anmelden)');
define('_SECINACTIVELENGTH', 'Benutzer werden nach folgender Zeit inaktiv (10)');
define('_SECLEVEL', 'Sicherheitslevel');
define('_SECLOW', 'niedrig (Benutzer bleiben dauerhaft angemeldet)');
define('_SECMEDIUM', 'mittel (Benutzer bleiben für eine bestimmte Anzahl an Tagen angemeldet)');
define('_SECMEDLENGTH', 'Tagesanzahl der Dauer bei mittlerer Sicherheit');
define('_SECOPT', 'Sicherheitsoptionen');
define('_SETTINGSNOAUTH','Keine Berechtigung für die Einstellungen');
define('_SITECONFIG','Konfiguration');
define('_SITELOGO','Logo (Druckansicht)');
define('_SITEOFF', 'Seite komplett deaktivieren');
define('_SITEOFFREASON', 'Grund für die Deaktivierung');
define('_SITESLOGAN','Slogan');
define('_STARTDATE','Startdatum');
define('_STARTPAGE','Startseite');
define('_STARTTYPE','Start Function Type');
define('_STARTFUNC','Start Function');
define('_STARTARGS','Argumente für Start Function');
define('_STARTARGSCOMMASEP','kommasepariert, z.B. name=value,name2=value2');
define('_STARTPAGEDESCR','Das Modul mit dem gestartet werden soll');
define('_STORIESHOME','Beiträge auf der Startseite');
define('_STORIESORDER','Reihenfolge der News');
define('_STORIESORDER0','nach ID');
define('_STORIESORDER1','nach Datum');
define('_THEMES', 'Themes');
define('_THEMECHANGE','Dürfen Benutzer Theme individuell einstellen?');
define('_USECOMPRESSION', 'Kompression aktivieren?');
define('_WYSIWYGEDITORTEXT','WYSIWYG-Editor benutzen?');
?>