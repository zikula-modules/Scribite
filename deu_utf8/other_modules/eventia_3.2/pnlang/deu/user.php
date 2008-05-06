<?php
// $Id: user.php,v 3.2 2005/02/14 14:28:33 hepcat Exp $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2002 by The PostNuke Development Team.
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
// Original Author of file: Andreas Behrens
// Purpose of file: Translation files
// ----------------------------------------------------------------------
/**
    * @author       Andreas Behrens
    * @version      v 3.2 2005/02/14 14:28:33 hepcat Exp $
    * @package      PostNuke_Miscellaneous_Modules
    * @subpackage   eventia
    * @license      http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */
/* Set locale to German */
setlocale(LC_ALL, 'de_DE.utf-8');
if (!defined('_eventia')) {
    define('_eventia','Eventia');
}
define('_eventiaITEMFAILED', 'Sorry! Derzeit sind keine Kurse verfügbar');

if (!defined('_eventiacourse_NR')) {
    define('_eventiacourse_NR', 'Kursnummer:');
}
if (!defined('_eventia_course_title')) {
    define('_eventia_course_title', 'Kursthema:');
}
if (!defined('_eventiacourse_start')) {
    define('_eventiacourse_start', 'Kursstart:');
}
if (!defined('_eventiacourse_end')) {
    define('_eventiacourse_end', 'Kursende:');
}
define('_eventiaVIEW',                  'Kurse ansehen');
define('_eventiacourse_type',           'Kursart:');
define('_eventiacourse_description',    'Kursdetails:');
define('_eventiacourse_adress',         'Veranstaltungsort:');
define('_eventiacourse_street',         'Strasse:');
define('_eventiacourse_plz',            'PLZ:');
define('_eventiacourse_city',           'Ort:');
define('_eventiacourse_trainer',        'Trainer:');
define('_eventiacourse_start',          'Kursstart:');
define('_eventiacourse_length',         'Dauer je Tag:');
define('_eventiacourse_length1',        'Dauer:');
define('_eventiacourse_length_type',    'Einheiten');
define('_eventiacourse_starttime',      'Schulungsbeginn:');
define('_eventiacourse_hour',           'Uhr');
define('_eventiacourse_edu_points',     'Fortbildungspunkte:');
define('_eventiacourse_cost',           'Gebühr:');
define('_eventiacourse_cost1',          'Gebühr:');
define('_eventiacourse_currency',       'EUR');
define('_eventia_course_registration',  'Anmelden');
define('_eventia_registration_form',    'Anmeldung');
define('_eventia_conditions_header',    'Anmeldebedingungen:');
define('_eventia_conditions',           'Die <b>Anmeldungen</b> werden in der Reihenfolge des Eingangs bearbeitet.
                                         Mit der Anmeldebestätigung erhalten Sie die Rechnung über die Teilnahmegebühr.
                                         Die Kursgebühr inkl. der gesetzlichen Mehrwertsteuer ist unmittelbar nach
                                         Erhalt der Rechnung fällig.');
define('_eventia_conditions_1',         'Eine Stornierung der Teilnahme (bitte nur schriftlich) ist bis 3 Wochen vor
                                         Kursbeginn kostenlos möglich.
                                         Danach wird die volle Teilnahmegebühr fällig.');
define('_eventia_conditions_2',         'Sollte die Veranstaltung aus wichtigem Grund abgesagt werden müssen,
                                         benachrichtigen wir Sie so schnell wie möglich und erstatten bereits gezahlte
                                         Gebühren sofort zurück.');
define('_eventia_conditions_3',         'Sonstige Ansprüche entstehen nicht.');
define('_eventia_reg_conditions',       'Ich akzeptiere die Anmeldebedingungen.*');
define('_eventia_for',                  'für');
define('_eventia_reg_button',           'Anmelden');
define('_EVENTIABODY',                  'zusätzliche Infos:');
define('_EVENTIAMESSAGESENT',           '<hr><font color="green"><b>Ihre Anmeldung wurde versendet.</b></font><hr>');
define('_EVENTIAMESSAGENOTSENT',        '<hr><font color="red"><b>Ein Fehler ist aufgetreten!<br>Leider konnte die Anmeldung nicht versendet werden.<br />Ggf. haben Sie nicht alle Felder ausgefüllt.</b></font><hr>');
define('_EVENTIAMESSAGESCONDITIONS',    '<hr><font color="red"><b>Sie müssen die Anmeldebedingungen akzeptieren.<br />Bitte nutzen Sie den "Zurück"-Button Ihres Browsers !!!</b></font><hr>');
define('_EVENTIAFROMNAME',              'Absenderadresse:');
define('_EVENTIAFROMADDRESS',           'Absender-Adresse:');
define('_EVENTIAHTML',                  'HTML-formatiert');
define('_EVENTIATONAME',                'Name:');
define('_EVENTIATOADDRESS',             'Ihre EMail-Adresse:');
define('_EVENTIASUBJECT',               'Betreff:');
define('_EVENTIAPNMAIL',                'pnMail-formatiert:');
define('_EVENTIATOADDRESS2',            'Strasse u. Nr:');
define('_EVENTIATOADDRESS3',            'PLZ/Ort:');
define('_EVENTIATEL',                   'Telefonnummer');
define('_EVENTIAMESSAGETONAME',         '<hr><font color="red"><b>Sie müssen Ihren Namen angeben.<br />Bitte nutzen Sie den "Zurück"-Button Ihres Browsers !!!</b></font><hr>');
define('_EVENTIAMESSAGETOADDRESS',      '<hr><font color="red"><b>Sie müssen Ihre EMail-Adresse angeben.<br />Bitte nutzen Sie den "Zurück"-Button Ihres Browsers !!!</b></font><hr>');
define('_EVENTIAMESSAGETOADDRESS2',     '<hr><font color="red"><b>Sie müssen Ihre Strasse und Hausnummer angeben.<br />Bitte nutzen Sie den "Zurück"-Button Ihres Browsers !!!</b></font><hr>');
define('_EVENTIAMESSAGETOADDRESS3',     '<hr><font color="red"><b>Sie müssen Ihre Postleitzahl und den Ort angeben.<br />Bitte nutzen Sie den "Zurück"-Button Ihres Browsers !!!</b></font><hr>');
define('_EVENTIAMESSAGETEL',            '<hr><font color="red"><b>Sie müssen Ihre Telefonnummer angeben.<br />Bitte nutzen Sie den "Zurück"-Button Ihres Browsers !!!</b></font><hr>');
define('_EVENTIAADDRESS',               'EMail-Adresse:');
define('_EVENTIAREGISTER',              'Anmeldung von:');
define('_EVENTIAADDRESS2',              'Anschrift:');
define('_EVENTIATEL2',                  'Telefonnummer:');
define('_EVENTIAINFO',                  'Anmerkungen:');
define('_EVENTIASUBJECT2',              'Anmeldung zum Kurs:');
define('_EVENTIAREGISTERNR',            'Anmeldungsnummer:');
define('_EVENTIAPLEASEDATA',            'Bitte geben Sie hier Ihre Kontaktdaten ein:');
define('_EVENTIAREGUSERINFO',           'Vielen Dank für Ihre Anmeldung.');
define('_EVENTIAREGUSERINFO1',          'Folgende Daten wurden uns übermittelt:');
define('_EVENTIAREGUSERINFO2',          'Sollten die von Ihnen übermittelten Daten nicht korrekt sein, informieren Sie uns bitte.');
define('_EVENTIAREGUSERINFO3',          'Sollte diese Anmeldung nicht von Ihnen vorgenommen worden sein, melden Sie diesen Kurs bitte per E-Mail ab.');
define('_EVENTIAREGUSERINFO4',          'Sie erhalten in Kürze eine Anmeldebestätigung inkl. einer Rechnung per Post.');
define('_EVENTIAREGUSERINFO5',          'Bitte verwenden Sie bei jeglicher Korrespondenz die im Betreff angegebene Anmeldenummer.');
define('_EVENTIAREGUSERINFO6',          'Mit freundlichen Grüssen');
define('_EVENTIAREGUSERINFO7',          'Ihr pnEventia-Team.');
define('_EVENTIALINE',                  '__________________________________________________');
define('_eventia_reg_required',         '* Eingabe erforderlich');
define('_eventia_reg_required_sign',    ' *');
define('_eventiacourse_no_cost',        'Für diesen Kurs fallen');
define('_eventiacourse_no_cost1',       'keine Kosten an');
define('_eventiacourse_no_cost2',       'Für diesen Kurs fallen keine Kosten an');
define('_eventiacourse_at',             'Am:');
define('_eventiaduration_a',            'á');
define('_eventiaduration_min',          'min');
define('_eventiaduration_std',          'Std');
define('_eventia_course_public',        'Details');
define('_eventia_course_full',          'Belegt');
define('_eventiacourse_publicinfo',     'Für diesen Kurs ist keine Anmeldung erforderlich');
define('_eventiacourse_fullinfo',       'Dieser Kurs ist voll belegt. Eine Anmeldung ist nicht mehr möglich!');
define('_eventia_course_optstring',     'Anpassbares Feld 1:');
define('_eventia_course_optstring1',    'Anpassbares Feld 2:');
define('_eventiacourse_cost_tax',       ' inkl. MwST');
define('_eventiacourse_cost_tax1',      ' zzgl. MwST');
define('_eventiacourse_discount_yes_txt','Ich bin Rabatt berechtigt');
define('_EVENTIADISCOUNTTRUE',          'Rabattberechtigte Anmeldung');
define('_EVENTIADISCOUNTTRUEUSER',      'Bitte weisen Sie einen Nachweis für die Rabattberechtigung schriftlich nach.');
?>
