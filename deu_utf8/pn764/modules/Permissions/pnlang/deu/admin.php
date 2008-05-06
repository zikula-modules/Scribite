<?php
// $Id: admin.php,v 1.1 2005/04/29 17:04:33 larsneo Exp $
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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Andreas Krapohl <larsneo@postnuke.com>
// Purpose of file: Translation files
// Translation team: Read credits in /docs/CREDITS.txt
// ----------------------------------------------------------------------

/**
 * @package PostNuke_System_Modules
 * @subpackage  PostNuke_Permissions
 * @license http://www.gnu.org/copyleft/gpl.html
*/

if (!defined('_DELETE')) {
    define('_DELETE','Löschen');
}
if (!defined('_EDIT')) {
    define('_EDIT','Editieren');
}
if (!defined('_PERMISSIONS')) {
    define('_PERMISSIONS','Zugriffsrechte');
}
define('_ALLGROUPS','Alle Gruppen');
define('_ALLREALMS','Alle Realms');
define('_ALLUSERS','Alle Benutzer');
define('_REALM','Realm');
define('_INSTANCE','Instanz');
define('_COMPONENT','Komponente');
if (!defined('_DOWN')) {
    define('_DOWN','runter');
}
define('_USERPERMS','Benutzer');
define('_GROUPPERMS','Gruppe');
define('_VIEWGROUPPERMS','Gruppenrechte zeigen');
define('_VIEWUSERPERMS','Benutzerrechte zeigen');
define('_MODIFYPERM','Zugriffsrechte modifizieren');
define('_MODIFYGROUPPERM','Gruppenrechte modifizieren');
define('_MODIFYUSERPERM','Userrechte modifizieren');
define('_NEWPERM','neues Zugriffsrecht');
define('_NEWGROUPPERM','neues Gruppenrecht');
define('_NEWUSERPERM','neues Benutzerrecht');
define('_PERMLEVEL','Berechtigung');
define('_PERMOPS','Operation');
define('_SEQUENCE','ID');
define('_UNREGISTEREDGROUP','unregistrierte (Gruppe)');
define('_UNREGISTEREDUSER','unregistrierte (Benutzer)');
if (!defined('_UP')) {
    define('_UP','hoch');
}
define('_PERMISSIONINFO','Info zu Zugriffsrechten');
define('_REGISTEREDCOMP','registrierte Komponenten');
define('_INSTANCETEMP','mögliche Instanzen');

// MMaes: Removed some hardcoded text
define('_PERM_INC','Berechtigung hochgesetzt');
define('_PERM_DEC','Berechtigung runtergesetzt');
define('_PERM_UPD','Berechtigung aktualisiert');
define('_PERM_CREATED','Berechtigung angelegt');
define('_PERM_DEL','Berechtigung entfernt');
define('_PERM_DECINCERR_NOID','keine solche Berechtigungs-ID: ');
define('_PERM_DECERR_NOSWAP','keine Berechtigung direkt unterhalb');
define('_PERM_INCERR_NOSWAP','keine Berechtigung direkt oberhalb');
// MMaes: Direct Insert capability
// define('_PERM_THINS','Ins.');
define('_PERMINSBEFORE_ALTTXT','Berechtigung darüber einfügen');
define('_PERM_INSERR','Fehler beim aktualisieren der Berechtigungen');
define('_PERM_INSNOTIFY','Berechtigung einfügen an Position ');
// MMaes: Only show permissions applying to a group
define('_SEQ_ADJUST','auf/ab');
define('_PERM_VWSHOWONLY','Berechtigungen für Gruppe: ');
define('_PERM_VWFILTER','Filter');
define('_PERM_WARN_FILTERACTIVE','<strong>- TEILWEISE ANSICHT -</strong>');
define('_PERM_PARTLY','Berechtigungen werden nur teilweise angezeigt!');
define('_PERM_SHOWING','Gruppe: ');
define('_PERM_DECINCERR_NOSWAPPART','Reihenfolge der Berechtigungen in der teilweisen Ansicht kann nur geändert werden wenn beide Berechtigungen sichtbar sind. Bitte vollständige Ansicht nutzen');
// MMaes: ListEdit-function, editing in the mainview
define('_PERM_LISTNONEFOUND','Keine passende Berechtigung vorhanden. Zuerst eine einfügen...');
define('_PERM_COMP_INPUTERR',' [nicht erlaubt bei Komponente!] ');
define('_PERM_INST_INPUTERR',' [nicht erlaubt bei Instanz!] ');
// MMaes: Module-settings
define('_PERM_ENABLEFILTER','Gruppen-Filter ermöglichen');
define('_PERM_DISPLAYWARNING','Warnung bei aktiven Filtern anzeigen');
define('_PERM_ROWHEIGHTVIEW','minimale Feldhöhe der Textbox bei Ansicht (Pixel)');
define('_PERM_ROWHEIGHTEDIT','minimale Feldhöhe der Textbox bei Bearbeitung (Pixel)');
define('_PERM_UPDATESETTINGS','Einstellungen speichern');
define('_PERMISSIONSDELETE', 'Zugriffsrecht löschen');
define('_PERMISSIONSCONFIRMDELETE', 'Löschen der Zugriffsberechtigung bestätigen');
define('_PERMISSIONSCANCELDELETE', 'Löschen der Zugriffsberechtigung abbrechen');
?>