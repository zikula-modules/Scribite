<?php
// File : $Id: user.php,v 1.2 2004/12/01 01:21:14 fd Exp $
// ----------------------------------------------------------------------
// POST-NUKE Content Management System
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
// Original Author of file: Chestnut :: http://www.pnconcept.com
// Purpose of file: User Lang for the pncPayPal
// ----------------------------------------------------------------------

// Main page
define('_PNCPPINSTRUCTIONS',    'Anleitung');
define('_PNCPPINSTRUCPART1',    'Im Feld den gewünschten Betrag eingeben.');
define('_PNCPPINSTRUCPART2',    'Bei registrierten Benutzern wird der Benutzername der PayPal-Transaktion beigefügt.');
define('_PNCPPINSTRUCPART3',    'Überprüfen-Button klicken um weiterzumachen.');
define('_PNCPPINSTRUCPART4',    'Die nächste Seite zeigt den Betrag und den Benutzernamen (falls eingeloggt).');

define('_PNCPPAMOUNT',          'Betrag');

// Last Donators' List
define('_PNCPPLASTDONATIONS',   'Letzte Spenden');
define('_PNCPPTXNTYPE',         'txn_type');
define('_PNCPPITEMNAME',        'Eintragsname');
define('_PNCPPUSERNAME',        'Username');
define('_PNCPPMEMO',            'Memo');
define('_PNCPPDATE',            'Datum');
define('_PNCPPSTATUS',          'Status');

// Verification Page
define('_PNCPPVERIFICATION',    'Überprüfung');
define('_PNCPPVERIFERROR',      'Fehler - Bitte');
define('_PNCPPHAPPY',           'Falls Betrag in Ordnung, bitte PayPal-Button unten klicken.');
define('_PNCPPENDVERIF1',       'Nach Abschluss der Transaktion findet eine Weiterleitung auf eine Danke-Seite ');
define('_PNCPPENDVERIF2',       'mit weiteren Details der Transaktion statt.');

// Thank You Page
define('_PNCPPSORRY',           'Sorry... Beim Übermitteln der Transaktionsdaten trat ein Fehler auf.');
define('_PNCPPTHANKSDUDE',      'Vielen Dank');
define('_PNCPPYTXNSAVED',       'Die Transaktion wurde gespeichert!');

// Utils
define('_PNCPPMAINTITLE',       'pncPayPal :: Donation MOD');
define('_PNCPPSUBMIT',          'Senden');
define('_PNCPPVERIFY',          'Überprüfen');
define('_PNCPPMAINPAGE',        'Hauptseite');
define('_PNCPPGOBACK',          'zurück!');
define('_PNCPPPAYPALMOJO',      'Make payments with PayPal - it\'s fast, free and secure! (From what they say...)');

define('_PNCPPISINDUMMYMODE',   'The module is currently set to be use with the PayPal Sandbox (Developpers Test Environment). Both admin and the Payer must have an account on the Paypal Developers Website (https://developer.paypal.com).');

// 1.1
define('_PNCPPSTATUSCOMPLETED', 'Abgeschlossen');
define('_PNCPPSTATUSPENDING',   'Ausstehend');
define('_PNCPPISANONYMOUS',     'Anonyme Spende');
define('_PNCPPANONYMOUS',       'Anonym');
define('_PNCPPOTHER',           'Sonstige');

?>
