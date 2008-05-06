<?php
// $Id: admin.php 91 2006-04-04 19:38:56Z philipp $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2002 by the PostNuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// $Log$
// Revision 1.4  2006/04/04 19:38:56  philipp
// pnBook V. 0.2b ready
//
// Revision 1.2  2006/04/03 20:10:38  philipp
// pn_notify support added
//
// Revision 1.1.2	2006/04/03 15:20:00	philipp
//		NOTIFY definitions
// Revision 2.0  2005/12/27 23:05:00  Philipp Niethammer
//      Adding Language-defines for admin of v. 0.2
//
// ----------------------------------------------------------------------

/**
 *
 * @version      $Id: admin.php 91 2006-04-04 19:38:56Z philipp $
 * @author       $Author: philipp $
 * @link         http://www.guite.de
 * @copyright    Copyright (C) 2005 by Guite
 * @license      http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */

include_once('modules/'. pnModGetName() . '/pnlang/deu/global.php');

define('_PNBOOKCENSORWORD', "Bitte geben Sie ein Suchwort ein");
define('_PNBOOKCENSORMODIFY', "Zensoreintrag bearbeiten");
define('_PNBOOKREGEX', "Regular Expression verwenden");
define('_PNBOOKWORD', "Suchwort");
define('_PNBOOKCENSORNEW', "Zensoreintrag erstellen");
define('_PNBOOKCENSORVIEW', "Erstellte Zensoreinträge");
define('_PNBOOKCENSOREDIT', "Zensoreintrag bearbeiten");
define('_PNBOOKCENSORDEL', "Zensoreintrag löschen");

define('_PNBOOKCONFIGFORM', "Konfiguration bearbeiten");
define('_PNBOOKPERPAGE', "Einträge pro Seite");
define('_PNBOOKORDER', "Reihenfolge");
define('_PNBOOKASC', "aufsteigend (ältester oben)");
define('_PNBOOKDESC', "absteigend (jüngster oben)");
define('_PNBOOKHTTPAUTO', "Homepage mit 'http://' vervollständigen");

define('_PNBOOKWORDWRAP', "Vorgehen bei langen Wörtern");
define('_PNBOOKWWACTION', "Aktion");
define('_PNBOOKNOTHING', "keine");
define('_PNBOOKTRUNCATE', "kürzen");
define('_PNBOOKWRAP', "unterbrechen");
define('_PNBOOKWWLIMIT', "Maximale Länge");
define('_PNBOOKWWSHORTTO', "Länge nach Durchführung");

define('_PNBOOKNOTIFY', "Benachrichtigung");
define('_PNBOOKPNNOTIFYNOTAVAILABLE', "Modul pn_notify ist nicht verfügbar.");
define('_PNBOOKNOTIFYNOWRITE', "pn_notify Sprachdateien können nicht geschrieben werden.");
define('_PNBOOKNOTIFYSTATE', "Benachrichtigung aktivieren");
define('_PNBOOKNOTIFYMAIL', "Empfänger E-Mail");
define('_PNBOOKNOTIFYSUBJECT', "Betreff");
define('_PNBOOKNOTIFYBODY', "Inhalt (%s = URL zum Gästebuch)");

define('_PNBOOKIPBANNEW', "IP bannen");
define('_PNBOOKIPBANVIEW', "Gebannte IPs");
define('_PNBOOKIPBANDEL', "Ban löschen");

define('_PNBOOKSUPPRESS', "Soll der Eintrag wirklich gelöscht werden?");

define('_PNBOOKMODIFYTABLE', "Eintrag editieren");

define('_PNBOOKVERSIONCHECK', "Versions-Kontrolle");
define('_PNBOOKVERSIONINSTALLED', "Die zur Zeit installierte Version ist ");
define('_PNBOOKVERSIONNEWERPRE', "Es gibt eine aktuellere Version (");
define('_PNBOOKVERSIONNEWERPOST', "). Wir empfehlen, auf diese zu aktualisieren.");
define('_PNBOOKVERSIONACTUAL', "Die aktuellste Version ist installiert.");

?>
