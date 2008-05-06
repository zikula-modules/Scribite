<?php
// Generated: $d$ by $id$
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
$minage = pnConfigGetVar('minage');
define('_REGQUESTIONFAILED', 'Die Frage wurde nicht korrekt beantwortet!');
define('_USERAGENTINVALID', 'Useragent nicht erlaubt');
define('_2CHANGEINFO','Um die Informationen zu ändern');
define('_ALLOWEMAILVIEW','E-Mail-Adresse öffentlich anzeigen');
define('_ANDCONNECTOR','und');
define('_ASREG1','Kommentare unter dem Benutzernamen verfassen');
define('_ASREG2','Beiträge unter dem Benutzernamen verfassen');
define('_ASREG3','Einen benutzerdefinierten Block auf der Startseite erstellen');
define('_ASREG4','Die Anzahl der Beiträge auf der Startseite einstellen');
define('_ASREG5','Die Anzeige der Kommentare bestimmen');
define('_ASREG6','Das Seitendesign individuell einstellen');
define('_ASREG7','und eine Menge mehr...');
define('_ASREGUSER','Als ein registrierter Benutzer kann man:');
define('_CREATEGROUP','Direkte Gruppenmitgliedschaft anlegen: ');
//define('_CONSENT1','(Mit dem Klick auf den Link wird ein Mindestalter von<br />');
//define('_CONSENT2','Jahren bestätigt bzw. das Vorliegen einer Erlaubnis der Erziehungsberechtigten.)');

define('_CONSENT','(Mit dem Klick auf den Link wird ein Mindestalter von<br />'.$minage.' Jahren bestätigt bzw. das Vorliegen einer Erlaubnis der Erziehungsberechtigten.)');

define('_COOKIEWARNING','Anmerkung: Diese Webseite verwendet Session-Cookies.<br />');
define('_EMAILAGAIN','E-Mail-Adresse bestätigen');
define('_EMAILSDIFF','Die beiden E-Mail-Adressen sind unterschiedlich');
define('_EMAILINVALIDDOMAIN', 'Diese E-Mail-Adresse ist gesperrt');
define('_ERRORMUSTAGREE','Für die Registrierung muss den Nutzungsbedingungen zugestimmt werden!');
define('_FINISH','Fertig');
define('_FOLLOWINGMEM','Benutzerinformationen:');
define('_GETGROUP','Gruppenmitgliedschaft: ');
define('_HERE','hier');

//define('_MUSTBE1','Für dieses Portal ist ein Mindestalter von');
//define('_MUSTBE2','Jahren bzw. das Einverständnis der Erziehungsberechtigten erforderlich.');

define('_MUSTBE','Für diese Webseite ist ein Mindestalter von '.$minage.' Jahren bzw. das Einverständnis der Erziehungsberechtigten erforderlich.');

define('_NOTIFYEMAILCONT1','Eine neue Registrierung! Der Benutzername ');
define('_NOTIFYEMAILCONT2',' wurde soeben auf der Webseite '.pnConfigGetVar('sitename').' registriert.');
define('_NOTIFYEMAILSUB','Ein neuer Benutzer hat sich auf der WebSite registriert!');
define('_OPTIONALITEMS','Weitere freiwillige Angaben');

//define('_OVER13a','Ich bin mindestens');
//define('_OVER13b','Jahre oder besitze das Einverständnis meiner Erziehungsberechtigten.');

define('_OVER13','Ich bin mindestens '.$minage.' Jahre alt oder besitze das Einverständnis meiner Erziehungsberechtigten.');

define('_PASSWILLSEND','Das Kennwort wird an die eingetragene E-Mail-Adresse gesendet');
//define('_PASSWORD','Kennwort');
define('_PASSWDAGAIN','Kennwort bestätigen');
define('_PASSWDNEEDED','Bitte ein Kennwort angeben');
define("_PRIVACYPOLICY","Erklärung zum Datenschutz");
define('_REASONS','Anmerkung:');
define('_REGISTERDISABLED','Benutzer-Registrierung deaktiviert!');
define('_REGISTERNOW','Jetzt registrieren');
define('_REGISTRATION','Registrierung.');
define('_REGISTRATIONAGREEMENT','Einverständniserklärung zu');
define('_REGNEWUSER','Neuen Benutzer anlegen');
define('_RETURN','Zurück zur Hauptseite.');
define('_SORRY','Sorry');
define("_TERMSOFUSE","Allgemeinen Nutzungsbedingungen");
define('_TOREGISTER','wurde ein Account angemeldet bei');

//define('_UNDER13a','Ich bin jünger als');
//define('_UNDER13b','Jahre und habe keine Einverständniserklärung meiner Erziehungsberechtigten.');

define('_UNDER13','Ich bin jünger als '.$minage.' Jahre und habe keine Einverständniserklärung meiner Erziehungsberechtigten.');

define('_UNICKNAME','Benutzername:');
define('_UPASSWORD','Kennwort:');
define('_USERPASS4','Kennwort von');
define('_USERPASS42',''); //Add for non eng translation
define('_WEDONTGIVE','Die Daten werden gemäss Bundesdatenschutzgesetz vertraulich behandelt.<br /><a href=\'index.php?name=legal\'>Allgemeine Nutzungsbedingungen</a> und <a href=\'index.php?name=legal&amp;file=privacy\'>Erklärung zum Datenschutz</a>');
define('_YOUAREREGISTERED','Die Registrierung war erfolgreich - das Kennwort wird per E-Mail übermittelt.');
define('_YOURPASSIS','Das Kennwort lautet:');
define('_YOUUSEDEMAIL','Mit der E-Mail-Adresse');
?>