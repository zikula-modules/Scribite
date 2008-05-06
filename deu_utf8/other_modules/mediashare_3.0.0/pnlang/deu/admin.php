<?php
// ------------------------------------------------------------------------------------
// Translation for PostNuke Mediashare module
// Translation by: Daniel Neugebauer / Thomas Smiatek
// ------------------------------------------------------------------------------------

require_once('modules/mediashare/pnlang/deu/common.php');

define('_MSALLOWTEMPLATEOVERRIDE', 'Überschreiben der Templates in Alben erlauben?');
define('_MSAPPLYGLOBALTEMPLATE', 'Global zuweisen');
define('_MSAPPLYGLOBALTEMPLATECONFIRM', 'Alle Album-Templates überschreiben');
define('_MSDEFAULTALBUMTEMPLATE', 'Standard Album-Template');
define('_MSDEFAULTSLIDESHOWTEMPLATE', 'Standard Diashow-Template');
define('_MSDIRNOTWRITABLE', 'Kein Schreibzugriff auf dieses Verzeichnis.');
define('_MSGENERAL', 'Allgemein');
define('_MSGENERALSETUP', 'Allgemeines Setup');
define('_MSIMPORT', 'Import');
define('_MSMEDIADIR', 'Medien-Upload Verzeichnis');
define('_MSMEDIADIRHELP', "Hier werden ihre Medien-Dateien gespeichert. Achten Sie darauf, dass es sich auf ein 'mediashare'-Verzeichnis im PostNuke-Verzeichnis bezieht und dass Schreibzugriff für den Webserver besteht.");
define('_MSMEDIAHANDLERS', 'Medien-Treiber');
define('_MSMEDIAHANDLERSINFO', 'Die untenstehende Liste zeigt die verfügbaren Medien-Handler. Die Plugins erstellen Thumbnails (Vorschaubilder) und stellen die von Ihnen hochgeladenen Dateien dar.');
define('_MSMEDIASOURCES', 'Medien-Quellen');
define('_MSMEDIASOURCESINFO', 'Die untenstehende Liste zeigt die verfügbaren Medien-Quellen. Diese Plugins beinhalten verschiedenste Möglichkeiten, Medienobjekte Ihren Alben hinzuzufügen.');
define('_MSMODULEDIR', 'Aktuelles Modul-Verzeichnis');
define('_MSOPENBASEDIR', 'Open-base dir (PHP restriction)');
define('_MSPLUGINS', 'Plugins');
define('_MSPREVIEWSIZE', 'Vorschau-Größe (Pixel)');
define('_MSSCANFORPLUGINS', 'Nach Plugins suchen');
define('_MSSINGLEALLOWEDSIZE', 'Max. Größe einer Media-Datei (kb)');
define('_MSTOTALALLOWEDSIZE', 'Max. Größe aller Dateien eines Users (kb)');
define('_MSTHUMBNAILSIZE', 'Größe der Thumbnails (Pixel)');
define('_MSTMPDIR', 'Temp-Verzeichnis');
define('_MSTMPDIRHELP', "Dieses Verzeichnis benötigt Mediashare während des Uploadvorgangs für temporäre Dateien. Stellen Sie sicher, dass Schreibzugriff für den Webserver besteht.");
define('_MSVFSDBSELECTION', 'Speichern in der Datenbank');
define('_MSVFSDBSELECTIONHELP', 'Das Speichern der Dateien in der Datenbank erhöht die Sicherheit und ermöglicht die Nutzung mehrerer Webserver auf Kosten der Performance.');
define('_MSVFSDIRECTSELECTION', 'Speichern im lokalen Dateisystem');
define('_MSVFSDIRECTSELECTIONHELP', 'Das Speichern im lokalen Dateisystem erhöht die Performance auf Kosten einiger Sicherheitsaspekte und der Nutzungsmöglichkeit mehrerer Webserver.');
define('_MSSHARPEN', 'Thumbnail-Schärfung aktivieren');
define('_MSSHARPENHELP', 'Die Schärfung von Thumbnails und Vorschaubildern erhöht die Bildqualität, belastet aber die CPU Ressourcen');
define('_MSTHUMBNAILSTART', 'Thumbnails anzeigen');
define('_MSTHUMBNAILSTARTHELP', 'Die Standardansicht eines Albums kann entweder eine Thumbnail-Übersicht sein, oder eine Folge von 1-Bild-Ansichten');

define('_MSREC_PAGETITLE', 'Thumbnails und Vorschaubilder neu erzeugen');
define('_MSREC_INTRO', 'Die Neuerzeugung aller Thumnails und Vorschaubilder beansprucht eine gewisse Zeit. Dieses Feature verwendet JavaScript zur Erstellung jeweils einer Datei ohne dabei eine PHP Laufzeitüberschreitung auszulösen. Der Rahmen rechts wird zur Kommunikation mit dem Server genutzt. Der Fortschritt kann sowohl in diesem Rahmen wie auch in der Markierungsliste unten verfolgt werden.');
define('_MSREC_RECALCULATE', 'Neu erzeugen');

?>
