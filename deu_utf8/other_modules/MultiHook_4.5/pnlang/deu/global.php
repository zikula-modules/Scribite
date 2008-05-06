<?php
// $Id: global.php 126 2006-10-15 10:07:23Z landseer $
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

// even newer :-)
define('_MH_CENSOR', 'Zensur');
define('_MH_TYPEILLEGALWORD', 'unerwünschter Begriff');
define('_MH_VIEWILLEGALWORDS', 'Unerwünschte Begriffe');

// new
define('_MH_ISHOOKEDWITH', 'Der Multihook wird mit folgenden Modulen verwendet');
define('_MH_ADDHOOK', 'Hook für weitere Module aktivieren');
define('_MH_START','Start');
define('_MH_TYPENEEDLES', 'Needle');
define('_MH_VIEWNEEDLES', 'Needles');
define('_MH_EXISTSINDB', 'bereits in der Datenbank vorhanden');
define('_MH_NONEEDLES', 'Keine Needles gefunden');
define('_MH_NODESCRIPTIONFOUND', 'keine Beschreibung vorhanden');
define('_MH_NEEDLEDATAERROR', 'Fehler beim Einlesen der Needledaten für \'%s\' oder Modul \'%s\' nicht aktiv');

//
// A
//
define('_MH_ABACFIRST', 'Gefundene Einträge nur jeweils einmal im Text ersetzen');
define('_MH_ABBREVIATION', 'Abkürzung');
define('_MH_ACRONYM', 'Akronym');
define('_MH_ADD', 'Hinzufügen');
define('_MH_ADMINTITLE','Links, Abkürzungen und Akronyme');

//
// C
//
define('_MH_CREATE', 'Erstellen');
define('_MH_CREATED', 'Eintrag erstellt');
define('_MH_CREATEFAILED','Anlegen des Eintrags fehlgeschlagen');

//
// D
//
define('_MH_DELETE', 'Eintrag löschen');
define('_MH_DELETED', 'Eintrag gelöscht');
define('_MH_DELETEFAILED','Löschen des Eintrags fehlgeschlagen');

//
// E
//
define('_MH_ERRORREADINGDATA', 'Fehler beim Einlesen');
define('_MH_EXTERNALLINKCLASS', 'CSS-Klasse für externe Links');

//
// G
//
define('_MH_GLOSSARY', 'Glossar');

//
// I
//
define('_MH_ITEMSPERPAGE', 'Anzahl der Einträge pro Seite in der Adminanzeige');

//
// L
//
define('_MH_LANGUAGE','Sprache');
define('_MH_LANGUAGEEMPTY', 'Sprache fehlt');
define('_MH_LINK', 'Link');
define('_MH_LOADINGDATA', 'lade Daten...');
define('_MH_LONG','Langfassung');
define('_MH_LONGEMPTY', 'Langfassung fehlt');
define('_MH_LONGHINT', '(im Fall eines Links, die Ziel-URL, wird bei unerwünschten Begriffen ignoriert)');

//
// M
//
define('_MH_MHINCODETAGS', 'MultiHook innerhalb [code][/code] benutzen');
define('_MH_MODIFYCONFIG', 'Konfiguration modifizieren');

//
// N
//
define('_MH_NOAUTH', 'Keine Berechtigung für das Multihook Modul');
define('_MH_NOITEMS', 'Keine Einträge vorhanden');
define('_MH_NOSUCHITEM', 'Unbekannter Eintrag nicht vorhanden');

//
// O
//
define('_MH_OPTIONS', 'Optionen');

//
// R
//
define('_MH_REPLACEABBREVIATIONS', 'Abkürzungen duch Langtext ersetzen');
define('_MH_REPLACELINKWITHTITLE', 'Links durch Titel ersetzen');

//
// S
//
define('_MH_SAVINGDATA', 'speichere Daten...');
define('_MH_SELECT','Auswählen');
define('_MH_SELECTFAILED','MultiHook: Select auf die Datenbank fehlgeschlagen - bitte Admin verständigen');
define('_MH_SHORT','Kurz');
define('_MH_SHORTEMPTY', 'Kurzform fehlt');
define('_MH_SHOWEDITLINK', 'Link zum Editieren anzeigen');
define('_MH_SHOWME','Anzeigen');

//
// T
//
define('_MH_TITLE','Titel');
define('_MH_TITLEEMPTY', 'Titel fehlt');
define('_MH_TITLEHINT', '(nur bei einem Link notwendig, wird bei unerwünschten Begriffen ignoriert)');
define('_MH_TYPE','Typ');
define('_MH_TYPEABBREVIATION', 'Abkürzung');
define('_MH_TYPEACRONYM', 'Akronym');
define('_MH_TYPEEMPTY', 'Typ fehlt');
define('_MH_TYPELINK', 'Link');

//
// U
//
define('_MH_UPDATECONFIG', 'Konfiguration aktualisieren');
define('_MH_UPDATED', 'Eintrag aktualisiert');
define('_MH_UPDATEDCONFIG', 'Konfiguration aktualisiert');
define('_MH_UPDATEFAILED','Aktualisierung des Eintrags fehlgeschlagen');

//
// V
//
define('_MH_VIEWABBR','Abkürzungsliste');
define('_MH_VIEWACRONYMS','Akronymliste');
define('_MH_VIEWLINKS','Linkliste');

//
// W
//
define('_MH_WRONGPARAMETER_LONG', 'Keine Langversion oder (im Falle eines Links) keine URL angegeben');
define('_MH_WRONGPARAMETER_SHORT', 'Kurzbegriff nicht gewählt');
define('_MH_WRONGPARAMETER_TITLE', 'keine Titel angegeben');
define('_MH_WRONGPARAMETER_TYPE', 'ungültiger Typ');

?>