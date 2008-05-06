<?php
// $Id: global.php,v 1.10 2006/09/05 16:11:59 larsneo Exp $
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
define('_REG_QUESTION', 'Registrierungsfrage');
define('_REG_ANSWER', 'Registrierungsantwort');
define('_REG_QUESTIONDESC', '(individuelle Fragen können helfen, Spamregistrierungen zu vermeiden)');
define('_REG_ANSWERDESC', '(Antwort auf die Spamprotect-Frage)');
define('_ILLEGALUSERAGENTS', 'Gebannte Useragents');
define('_ILLEGALUSERAGENTDESC', 'Kommaseparierte Liste von Useragents über die keine Registrierung erlaubt ist');
define('_LOGIN_REDIRECT_WCAG', 'WCAG-konforme Weiterleitung bei An/Abmeldung');
define('_LOGIN_REDIRECT_DESC', 'Verzicht auf das Meta-Refresh');
define('_COOKIEHINTFORLOGIN', 'Ab hier müssen Cookies erlaubt sein. Eine Anmeldung ist sonst nicht möglich.');
define('_USERALLOWCOOKIES', 'Bitte Cookies für die Seite zulassen!');
define('_USERREDIRECT', 'weiter');
define('_USERPROFILELINK', 'Profilseite');
define('_IDNNAMES','IDN-Domains:');
define('_IDNNAMESDESC', 'Erlaubt auch Umlaut-Adressen bei E-Mail und URL');
define('_ADDFIELD','Felder hinzufügen');
define('_ADDINSTRUCTIONS','Beispiel: _MYINT - die Übersetzung für diese Variable muss in /language/deu/global.php hinterlegt sein');
define('_ADDUSER','Neuen Benutzer hinzufügen');
define('_ADDUSERBUT','Benutzer hinzufügen');
define('_ALLOWREG','Benutzerregistierung ermöglichen:');
define('_ALLOWUSERS','Diese E-Mail-Adresse öffentlich anzeigen');
define('_ANONYMOUSNAME','Default-Name für unregistrierte Benutzer');
define('_BIO','Zusatzinformation');
define('_DELETEFIELD','Feld und Daten löschen');
define('_DELETEUSER','Benutzer löschen');
define('_DYNAMICDATA','Dynamische Benutzerdaten');
define('_EDITUSER','Benutzer bearbeiten');
define('_ERRORINVURL','FEHLER: ungültige URL');
define('_FIELDACTIVE','Aktiv');
define('_FIELDLABEL','Feldbezeichnung');
define('_FIELDLENGTH','Länge');
define('_FIELDTYPE','Datentyp');
define('_FIELDVALIDATION','Validation');
define('_FIELDWEIGHT','Reihenfolge');
define('_FIELD_ACTIVATE','Aktivieren');
define('_FIELD_DEACTIVATE','Deaktivieren');
define('_FIELD_DEL_SURE','alle Daten dieses Feldes löschen?');
define('_FIELD_NA','N/A');
define('_FIELD_NOEXIST','Feld existiert nicht');
define('_FIELD_REQUIRED','notwendig');
define('_FORCHANGES','(nur zur Änderung)');
define('_GROUP','Gruppe');
define('_GROUPMEMBERSHIP','Gruppen-Mitgliedschaft');
define('_IFNO','Falls Nein, hier die Gründe angeben:');
define('_ILLEGALMAILDOMAINS', 'Gebannte Mail-Domains');
define('_ILLEGALDOMAINDESC', 'Kommaseparierte Liste von E-Mail-Domains über die keine Registrierung erlaubt ist');
define('_ILLEGALUNAME','Ungültige Benutzernamen: ');
define('_ILLEGALUNAMEDESC',' hier können Benutzernamen (mit Leerzeichen getrennt) angegeben werden, die nicht registriert werden können');
define('_INTERESTS','Interessen');
define('_LAST10COMMENTS','Letzte zehn Kommentare von');
define('_LAST10SUBMISSIONS','Letzte zehn Beiträge von');
define('_LOCATION','Ort');
define('_LOGGINGYOU','Anmeldung erfolgreich!');
define('_LOGININCOR','Benutzername/Kennwort nicht korrekt...');
define('_LOGINSITE','Anmeldung.');
define('_MEMBEROF','Mitglied');
define('_MINAGE','Mindestalter (COPPA):');
define('_MINAGEDESCR','Setzt ein Mindestalter zur Registrierung<br />(0=keine Überprüfung)');
define('_MODIFYUSERSADDNOAUTH','Keine Autorisierung, Benutzer hinzuzufügen');
define('_MODIFYUSERSDELNOAUTH','Keine Autorisierung, Benutzer zu löschen');
define('_MODIFYUSERSEDITNOAUTH','Keine Autorisierung, Benutzer zu editieren');
define('_MODIFYUSERSNOAUTH','Keine Autorisierung, Benutzer zu modifizieren');
define('_MYEMAIL','E-Mail-Adresse:');
define('_MYHOMEPAGE','Webseite:');
define('_NEEDTOCOMPLETE','Alle notwendigen Felder müssen ausgefüllt werden');
define('_NOINFOFOR','Keine verfügbare Information für');
define('_NOTALLOWREG','Benutzer-Registrierung deaktiviert!');
define('_NOTIFYEMAIL','Benachrichtigung über neue Mitglieder an: ');
define('_NOTIFYEMAILDESC',' Bei neuen Benutzerregistrierungen eine E-Mail an die eingetragene Adresse senden (leer für keine Info)');
define('_OCCUPATION','Beruf');
define('_OFFLINE','Offline.');
define('_OPTITEMS','Optionale Felder anzeigen');
define('_OPTITEMSDESC','Anzeige der zusätzlichen (dynamischen) Userdaten');
define('_PASSBYMAIL','bei \'Nein\' können Benutzer das Kennwort frei wählen');
define('_PASSWDLEN','Mindest-Passwortlänge:');
define('_PASSWDNOMATCH','Die Passworte stimmen nicht überein');
define('_REASONS','Anmerkung:');
define('_REGCONF','Konfiguration Benutzerregistrierung');
define('_REGDATE', 'Anmeldedatum');
define('_REGISTER','Neu-Registrierung.');
define('_REGISTEREDUSER','Registrierter Benutzer #');
define('_RETRIEVEPASS','Vergessenes Kennwort anfordern.');
define('_RETYPEPASSWD','Kennwort wiederholen');
define('_SELECTOPTION','Bitte eine Option aus dem folgenden Menü wählen:');
define('_STRING_INSTRUCTIONS','NUR STRING: Grössenbereich (1-254)');
define('_SURE2DELETE','Benutzer löschen?');
define('_UDT_CORE','Core');
define('_UDT_FLOAT','Float');
define('_UDT_INTEGER','Integer');
define('_UDT_MANDATORY','Core notwendig');
define('_UDT_STRING','String');
define('_UDT_TEXT','Text');
define('_UNIEMAIL','Eindeutige E-Mail-Adresse notwendig:');
define('_UNIEMAILDESC','jeder registrierte Benutzer muss eine eindeutige E-Mail-Adresse besitzen');
define('_USERADMIN','Benutzer-Administration');
define('_USERCONF','Benutzer-Konfiguration');
define('_USERGRAPHIC','Icons auf der persönlichen Seite?');
define('_USEREXIST','Fehler! Der Benutzername wurde bereits registriert');
define('_USERID','User ID');
define('_USERLOGIN','Login');
define('_USERNOEXIST','Der Benutzer existiert nicht!');
define('_USERPATH','Bildpfad für Icons der persönlichen Seite');
define('_USERREGLOGIN','Benutzeranmeldung und Registrierung');
define('_USERSTATUS','Aktueller Benutzerstatus');
define('_USERUPDATE','Benutzer aktualisieren');
define('_VERIFYEMAIL','Kennwort vom System erzeugen lassen: ');
define('_YOUARELOGGEDOUT','Abmeldung erfolgreich!');
?>