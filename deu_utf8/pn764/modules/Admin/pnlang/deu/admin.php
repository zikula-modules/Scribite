<?php
// $Id: admin.php,v 1.3 2006/01/13 17:58:01 larsneo Exp $
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
// Original Author of file: Andreas Krapohl <larsneo@postnuke.com>
// Purpose of file: Translation files
// Translation team: Read credits in /docs/CREDITS.txt
// ----------------------------------------------------------------------

/**
 * @package     PostNuke_System_Modules
 * @subpackage  PostNuke_Admin
 * @license http://www.gnu.org/copyleft/gpl.html
*/

define('_ADMIN_UPGRADE_PHP','Sicherheitshinweis: upgrade.php sollte gelöscht werden!');
define('_ADMIN_LEGACY_MODE','Hinweis: legacy-Modus ist aktiv!');
define('_ADMIN_MAGIC_QUOTES','Sicherheitshinweis: <a href="http://php.net/magic_quotes">magic_quotes_gpc</a> ist nicht aktiv!');
define('_ADMIN_REGISTER_GLOBALS','Sicherheitshinweis: <a href="http://php.net/register_globals">register_globals</a> ist aktiv!');
define('_ADMIN_CONFIG_PHP','Sicherheitshinweis: config.php ist beschreibbar (ggfs. chmod 644 setzen)!');
define('_ADMIN_CONFIG_OLD_PHP','Sicherheitshinweis: config-old.php ist beschreibbar (ggfs. chmod 644 setzen)!');
define('_ADMIN_PNTEMP_HTACCESS','Sicherheitshinweis: /pnTemp-Verzeichnis ggfs. mit .htaccess vor externem Zugriff schützen.');
define('_ADMINCONTINUE','Weiter');
define('_ADMININSTALLWARNING','Warnung! Bitte die Datei install.php und den Ordner install aus dem Stammverzeichnis der Installation löschen');
define('_ADMINPSAKWARNING', 'Warnung! Bitte das Swiss army knife tool aus dem Stammverzeichnis der Installation löschen');
define('_ADMIN', 'PostNuke Administration');
define('_ADMINSYSTEMMODULES', 'System Module');
define('_ADMINCONTENTMODULES', 'Content Module');
define('_ADMINUTILITYMODULES', 'Utility Module');
define('_ADMINRESOURCEPACKMODULES', 'Resource Pack');
define('_ADMINTHIRDPARTYMODULES', '3rd-Party Module');
define('_ADMINUNCATEGORISEDMODULES',' Unkategorisierte Module');
define('_ADMINMODULESPERROW', 'Module pro Reihe');
define('_ADMINNEW', 'Neue Kategorie');
define('_ADMINADMINVIEW', 'Kategorien anzeigen');
define('_ADMINADDCATEGORY', 'Kategorie hinzufügen');
define('_ADMINNAME', 'Kategoriename');
define('_ADMINDESCRIPTION', 'Kategorie-Beschreibung');
define('_ADMINCATEGORYCREATED', 'Kategorie erstellt');
define('_ADMINUPDATEFAILED', 'Fehler! Admin-Kategorie konnte nicht aktualisiert werden');
define('_ADMINNOSUCHITEM', 'Keine entsprechende Admin-Kategorie');
define('_ADMINDELETEFAILED', 'Fehler! Admin-Kategorie konnte nicht gelöscht werden');
define('_ADMINCREATEFAILED', 'Fehler! Admin-Kategorie konnte nicht erstellt werden');
define('_ADMINDELETEFAILEDDEFAULT', 'Die Default Admin-Kategorie kann nicht gelöscht werden');
define('_ADMINDELETEFAILEDSTART', 'Die Start Admin-Kategorie kann nicht gelöscht werden');
define('_ADMINVIEW', 'Admin-Kategorien anzeigen');
define('_ADMINOPTIONS', 'Optionen');
define('_ADMINUPDATECATEGORY', 'Kategorie aktualisieren');
define('_ADMINCATEGORYUPDATED', 'Admin-Kategorie aktualisiert');
define('_ADMINDELETECATEGORY', 'Admin-Kategorie löschen');
define('_ADMINCONFIRMCATEGORYDELETE', 'Löschen der Admin-Kategorie bestätigen');
define('_ADMINCANCELCATEGORYDELETE', 'Löschen der Admin-Kategorie abbrechen');
define('_ADMINDELETED', 'Admin-Kategorie gelöscht');
define('_ADMINFAILEDADDMODTOCAT', 'Fehler! Modul konnte nicht in die Kategorie aufgenommen werden');
define('_ADMINPANELCATEGORY', 'Admin-Bereich');
define('_ADMINDISPLAYICONS', 'Icons im Adminbereich anzeigen');
define('_ADMINDEFAULTCATEGORY', 'Default Kategorie für neue Module');
define('_ADMINITEMSPERPAGE', 'Kategorien pro Seite');
define('_ADMINSKIN', 'Stylesheet für Adminbereich');
define('_ADMINSTARTCATEGORY', 'Start-Kategorie');
define('_ADMINIGNOREINSTALLERCHECK', 'Check nach install-Dateien ausschalten');
define('_ADMINIGNOREINSTALLERCHECKWARNING', 'WARNUNG: nur in Testumgebungen auf die Überprüfung verzichten.');
define('_ADMINAUTOMATEDARTICLES','Zeitgesteuerte Beiträge');
define('_ADMINNOAUTOARTICLES','Keine zeitgesteuerten Beiträge');
define('_ADMINSTORYID', 'Beitrag ID');
define('_ADMINCURRENTPOLL', 'Aktuelle Umfrage');

?>