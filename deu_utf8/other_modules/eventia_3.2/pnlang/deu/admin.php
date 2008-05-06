<?php
// $Id: admin.php,v 3.2 2005/02/14 14:28:33 hepcat Exp $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2002 by the PostNuke Development Team.
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

if (!defined('_ADMINMENU')) {
        define('_ADMINMENU',                    'zurück zur Postnuke-Administration');
}
define('_eventia',                              'Eventia - Kursmanagement');
define('_EVENTIA_VERSION',                      'Eventia - Kursmanagement Version');
define('_EVENTIA_POWEREDBY',                    'Eventia Online-Support');
define('_eventia_course_type',                  'Kursart');
define('_eventiaADD',                           'Kurs hinzufügen');
define('_eventiaADMINVIEW',                     'Kurse auflisten');
define('_eventiaCANCELDELETE',                  'Löschen abbrechen');
define('_eventiaCONFIGUPDATED',                 '<hr><b><font color="green">Modulkonfiguration aktualisiert</font></b><hr>');
define('_eventiaCONFIRMDELETE',                 'Kurs löschen bestätigen');
define('_eventiaCREATED',                       '<hr><b><font color="green">Kurs erstellt</font></b><hr>');
define('_eventiaCREATEFAILED',                  '<hr><b><font color="red">Fehler! Kurserstellung fehlgeschlagen</font></b><hr>');
define('_eventiaDELETE',                        'Kurs löschen');
define('_eventiaDELETED',                       '<hr><b><font color="green">Kurs gelöscht</font></b><hr>');
define('_eventiaDISPLAYBOLD',                   'Kursnamen fett anzeigen');
define('_eventiaEDIT',                          'Kurs anpassen');
define('_eventiaEDITCONFIG',                    'Konfiguration anpassen');
define('_eventiaITEMSPERPAGE',                  'Kurse pro Seite');
define('_eventiaMODIFYCONFIG',                  'Konfiguration anpassen');
define('_eventiaNEW',                           'Neuen Kurs erstellen');
define('_eventiaNOSUCHITEM',                    'Sorry! keinen Kurs gefunden');
define('_eventiaNOSUCHREGITEM',                 'Sorry! keine Registrierung gefunden');
define('_eventiaNUMBER',                        'Eventia Kursnummer');
define('_eventiaOPTIONS',                       'Optionen');
define('_eventiaUPDATE',                        'Kurs aktualisieren');
define('_eventiaUPDATECONFIG',                  'Modulkonfiguration übernehmen');
define('_eventiaUPDATED',                       '<hr><b><font color="green">Kurs aktualisiert</font></b><hr>');
define('_eventiaUPDATEFAILED',                  '<hr><b><font color="red">Kursaktualisierung fehlgeschlagen</font></b><hr>');
define('_eventia_course_title',                 'Kursthema:');
define('_eventia_course_description',           'Kursdetails:');
define('_eventia_course_location',              'Lokation:');
define('_eventia_course_street',                'Strasse:');
define('_eventia_course_plz',                   'PLZ');
define('_eventia_course_city',                  'Ort:');
define('_eventia_course_trainer',               'Trainer:');
define('_eventia_course_start',                 'Kursstart:');
define('_eventia_course_start_format',          'Format: 0000-00-00 = Jahr-Monat-Tag');
define('_eventia_course_length',                'Dauer in Std/je Tag:');
define('_eventia_course_starttime',             'Kursbeginn:');
define('_eventia_course_end',                   'Kursende:');
define('_eventia_course_edu_points',            'Fortbildungspunkte:');
define('_eventiacourse_cost',                   'Gebühr inkl. MwST:');
define('_eventiacourse_cost1',                  'Gebühr zzgl. MwST:');
define('_eventia_course_NR',                    'Kursnummer:');
define('_EVENTIAMAIL',                          'EVENTIA Mail-Konfiguration');
define('_EVENTIAMAILMODIFYCONFIG',              'Mail-Konfiguration einstellen');
define('_EVENTIAMAILTESTCONFIG',                'Mail-Konfiguration testen');
define('_EVENTIAMAILUPDATECONFIG',              'Mail-Konfiguration aktualisieren');
define('_EVENTIATRANSPORT',                     'Default Mail-Transport');
define('_EVENTIAPHPMAIL',                       'PHP Mail()');
define('_EVENTIASENDMAIL',                      'SendMail');
define('_EVENTIAQMAIL',                         'QMail');
define('_EVENTIASMTPMAIL',                      'SMTP');
define('_EVENTIACHARSET',                       'Default Character Set (default:iso-8859-1)');
define('_EVENTIAENCODING',                      'Default Encoding (default:8bit)');
define('_EVENTIACONTENTTYPE',                   'Default Content Type (default:text/plain)');
define('_EVENTIAWORDWRAP',                      'Wordwrap (default:50)');
define('_EVENTIAMSMAILHEADERS',                 'Microsoft Mail Client Header benutzen');
define('_EVENTIASENDMAILPATH',                  'Sendmail Pfad');
define('_EVENTIASMTPSERVER',                    'SMTP Server (default:localhost)');
define('_EVENTIASMTPPORT',                      'SMTP Port (default:25)');
define('_EVENTIASMTPTIMEOUT',                   'SMTP Timeout (seconds - default:10)');
define('_EVENTIASMTPAUTH',                      'SMTP Authentication');
define('_EVENTIASMTPUSERNAME',                  'SMTP Username');
define('_EVENTIASMTPPASSWORD',                  'SMTP Password');
define('_EVENTIAFROMADDRESS',                   'Absender E-Mail:');
define('_EVENTIAFROMNAME',                      'Absender Name:');
define('_EVENTIATOADDRESS',                     'Empfänger E-Mail:');
define('_EVENTIASUBJECT',                       'Betreff:');
define('_EVENTIAHTML',                          'HTML formatiert');
define('_EVENTIATONAME',                        'Empfänger Name:');
define('_EVENTIABODY',                          'Nachricht:');
define('_EVENTIAMESSAGESENT',                   'Nachricht gesendet');
define('_EVENTIAMESSAGENOTSENT',                'Nachricht nicht gesendet');
define('_EVENTIAADMIN',                         'Admin');
define('_EVENTIAPNMAIL',                        'Nachricht via pnMail API senden');
define('_EVENTIACOPY',                          'Bestätigungsmail an Kunden versenden');
define('_eventiaCurrency',                      'Anzuzeigende Währung');
define('_EVENTIAREGISTRATIONS',                 'Anmeldungen auflisten');
define('_EVENTIAREGITEMSPERPAGE',               'Anmeldungen pro Seite');
define('_eventia_reg_time_as_NR',               'Anmeldenummer');
define('_eventia_reg_time_as_Date',             'Anmeldezeit');
define('_eventia_reg_course_NR',                'Kursnummer:');
define('_eventia_reg_toname',                   'Name:');
define('_eventia_reg_toaddress',                'EMail-Adresse:');
define('_eventiaADMINREGSVIEW',                 'Anmeldungen ansehen');
define('_eventiaDISPLAYRegToDB',                'Anmeldungen in der Datenbank speichern');
define('_eventiaITEMFAILED',                    'Derzeit sind keine Kurse in der Datenbank verfügbar');
define('_eventiaREGITEMFAILED',                 'Derzeit sind keine Anmeldungen in der Datenbank gespeichert');
define('_eventiaREGSDELETE',                    'Anmeldungen löschen');
define('_eventiaCONFIRMREGDELETE',              'Anmeldung löschen');
define('_eventiaCANCELREGDELETE',               'Löschen abbrechen');
define('_eventiaREGDELETED',                    '<hr><b><font color="green">Anmeldung gelöscht</font></b><hr>');
define('_eventiaREGSMODIFY',                    'Anmeldung im Detail');
define('_eventia_reg_time',                     'Anmeldenummer:');
define('_eventia_toname',                       'Name:');
define('_eventia_reg_toaddress2',               'Strasse:');
define('_eventia_reg_toaddress3',               'PLZ/Ort:');
define('_eventia_reg_tel',                      'Telefon:');
define('_eventia_reg_info',                     'Übermittelte Zusatzinfos:');
define('_eventia_reg_info_int',                 'Interne Notitzen:');
define('_eventiaREGUPDATE',                     'Anmeldungsdetails aktualisieren');
define('_eventiaDETAILS',                       'Details');
define('_eventiaREGUPDATED',                    '<hr><b><font color="green">Anmeldung aktualisiert</font></b><hr>');
define('_eventiaCOURSEAVTIVE',                  'Nur aktive Kurse anzeigen (Administration):');
define('_eventiaREGACTIVE',                     'Nur aktive Anmeldungen anzeigen (Administration):');
define('_eventiaSHOWACTIVECOURSE',              'Aktiv');
define('_eventiaSHOWACTIVEREG',                 'Aktiv');
define('_eventia_course_starttime_format',      'Format: 00:00 = Std:min');
define('_eventia_req_fields',                   'Pflichtangaben - Eingabe erforderlich');
define('_eventia_opt_fields',                   'Optionale Angaben - Leere Felder werden nicht angezeigt.');
define('_EVENTIADURATION',                      'Länge einer Ausbildungseinheit:');
define('_eventia_YES',                          'Ja');
define('_eventia_NO',                           'Nein');
define('_eventiaREGREADY',                      'Anmeldung schriftlich bestätigt!');
define('_eventiaREGShortREADY',                 'Bestätigt!');
define('_eventiaREGREADYShow',                  'Nur anzeigen: Anmeldung noch nicht schriftlich bestätigt!');
define('_eventiaSHOWPublicCOURSE',              'Öffenlicher Kurs, Keine Anmeldung erforderlich');
define('_eventiaListPublicCOURSE',              'Öffentlich');
define('_eventiaInclusive',                     'Anzeige: Inkl. MwST');
define('_eventiaSHOWfullCOURSE',                'Kurs belegt:');
define('_EVENTIANOLESSONS',                     'Keine Einheiten anzeigen:');
define('_eventia_course_messageoptions',        'Benachrichtigungsoptionen:');
define('_eventiaadmmail',                       'Email an Admin:');
define('_eventiacourse_mail',                   'Anmeldungen per Email an:');
define('_eventia_course_trainer_new',           'neu');
define('_eventia_course_date_button',           'Datum wählen');
define('_eventiahideolduser',                   'Abgelaufene Events für User ausblenden');
define('_eventiahideoldadmin',                  'Abgelaufene Events für Admin ausblenden');
define('_eventiacourse_discount_desc',          'Hier kann ein Rabatt-Infotext angegeben werden:');
define('_eventiacourse_discount_desc1',         'z.B. Arbeitslose zahlen nur:');
define('_eventiacourse_optstring_desc',         'Optionale Feldbeschreibung:');
define('_eventiacourse_optstring_value',        'Optionaler Feldinhalt:');
define('_eventiaREGDISCOUNT',                   'Rabattberechtigt');
define('_eventiaGenSettings',                   'Allgemeine Einstellungen:');
define('_eventiaPublicSettings',                'Öffentliche Einstellungen:');
define('_eventiaAdminSettings',                 'Admin Einstellungen:');
define('_eventiaAdminImages',                   'Administration mit Images:');
define('_EVENTIATESTMAILCONFIG',                'Mail-Konfiguration anpassen');
define('_EVENTIA_link_POWEREDBY',               'Eventia-Support');
define('_EVENTIA_link_TESTMAILCONFIG',          'Mail-Konfiguration');
define('_eventia_link_MODIFYCONFIG',            'Konfiguration');
define('_eventia_link_pnADMIN',                 'pnAdministration');
define('_eventia_link_ADMINVIEW',               'Kurse');
define('_eventia_link_NEW',                     'Neuer Kurs');
define('_EVENTIA_link_REGISTRATIONS',           'Anmeldungen');

?>
