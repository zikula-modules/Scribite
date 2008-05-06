<?php
// $Id: user.php,v 1.2 2002/06/29 10:38:59 philip Exp $
// ----------------------------------------------------------------------
// FormExpress module for POST-NUKE Content Management System
// Copyright (C) 2002 by Stutchbury Limited
// http://www.stutchbury.net/
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
// but WIthOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Philip Fletcher
// Purpose of file:  Language defines for pnuser.php
// ----------------------------------------------------------------------

//Headings etc
define('_FORMEXPRESS', 'FormExpress');
define('_FORMEXPRESSVIEW', 'zeige Formulare');
define('_FORMEXPRESSREQUIREDFIELD', "'*' Stern bezeichnet ein erforderliches Feld");
define('_FORMEXPRESSNAME', 'Formular Name');
define('_FORMEXPRESSDESCRIPTION', 'Beschreibung');


//Error messages
define('_FORMEXPRESSFORMFAILED', 'keine Formulare gefunden');
define('_FORMEXPRESSITEMFAILED', 'keine items gefunden');
define('_FORMEXPRESSVALIDATIONFAILED', 'Fehler! Validation Failed<br>');
define('_FORMEXPRESSVALUEREQUIRED', ' ist ein erforderliches Feld');
define('_FORMEXPRESSNOFORMFOUND', 'kein Formular gefunden');
define('_FORMEXPRESSNOITEMSFOUND', 'Es wurden keine Einzelteile für dieses Formular definiert.');
define('_FORMEXPRESSNOBLOCKFORMID', 'Es wurde kein Formular für diesen Block angegeben.');
if (!defined('_FORMEXPRESSNOAUTH')) {
	define('_FORMEXPRESSNOAUTH','Not authorised to access FormExpress module');
}
define('_FORMEXPRESSFUNCPARSEERROR', 'A parse error occured. Please check your Form action(s) syntax or your Item validation/default value syntax.');
define('_FORMEXPRESSFUNCVOIDRESULT', 'I was expecting a result, but got nothing (void returned from your dynamic function call).  Please check your Form action(s) syntax or your Item validation/default value syntax.');


//Sendmail backend
define('_FORMEXPRESSEMAILHEADER', 'YYY');
define('_FORMEXPRESSEMAILFOOTER', 'YYYY');
define('_FORMEXPRESSEMAILSENDERROR', 'Mailversand fehlgeschlagen');
define('_FORMEXPRESSEMAILID', 'Mail ID = ');
define('_FORMEXPRESSEMAILADDRERROR', 'Keine Email Adresse gefunden. Bitte überprüfen Sie Form action Schreibweise.');

?>
