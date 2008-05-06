<?php // File: $Id: global.php,v 1.4 2005/08/13 13:33:47 larsneo Exp $ $Name: HEAD $
// ----------------------------------------------------------------------
// Purpose of file: downloads module language defines.
// ----------------------------------------------------------------------
//
// please post comments regarding german translation at
// http://www.pncommunity.de
// last changes: 2004/08/13 larsneo
//
$sitename = pnConfigGetVar('sitename');
$anonwaitdays = pnConfigGetVar('anonwaitdays');

define('_DOWNLOADSPAGE','Downloads pro Seite');
define('_ANONWAITDAYS','Tagesanzahl bis anonyme Benutzer einen Download bewerten können');
define('_OUTSIDEWAITDAYS','Tagesanzahl bis externe Benutzer Stimmen abgeben können');
define('_USEOUTSIDEVOTING', 'externe Stimmabgabe erlauben');
define('_ANONWEIGHT', 'Wieviele Stimmen unregistrierter Benutzer pro 1 Stimme registrierter Benutzer?');
define('_OUTSIDEWEIGHT', 'Wieviele externe Stimmen pro 1 Stimme registrierter Benutzer?');
define('_DETAILVOTEDECIMAL', 'Dezimalstellen bei detailiertem Abstimmungsergebnis');
define('_MAINVOTEDECIMAL', 'Dezimalstellen des Stimmergebnisses');
define('_TOPDOWNLOADSPERCENTRIGGER', '1 für Prozentsatz (ansonsten Anzahl)');
define('_TOPDOWNLOADS', 'Top Downloads: Anzahl oder Prozentsatz zur Anzeige');
define('_MOSTPOPDOWNLOADSPERCENTRIGGER', '1 für Prozentsatz (ansonsten Anzahl)');
define('_MOSTPOPDOWNLOADS', 'beliebteste Downloads: Anzahl oder Prozentsatz zur Anzeige');
define('_FEATUREBOX', 'Featured Link-Box auf der Hauptseite anzeigen?');
define('_LINKVOTEMIN', 'notwendige Stimmenanzahl für die \'Top 10\' Liste');
define('_BLOCKUNREGMODIFY', 'unregistrierten Benutzern das Vorschlagen von Änderungen verbieten?');
define('_TOBEPOPULAR', 'Hits für Beliebtheit');
define('_DOWNLOADSASNEW', 'Anzahl der neuen Downloads');
define('_DOWNLOADSASBEST', 'Anzahl der besten Downloads');
define('_DOWNLOADSINRES', 'Anzahl der Downloads in Suchergebnis');

define('_1WEEK','1 Woche');
define('_2WEEKS','2 Wochen');
define('_30DAYS','30 Tage');
define('_ACCEPT','akzeptieren');
define('_ADD','hinzufügen');
define('_ADDADOWNLOAD','neuen Download hinzufügen');
define('_ADDDOWNLOAD','Download hinzufügen');
define('_ADDEDITORIAL','Beschreibung hinzufügen');
define('_ADDEDON','hinzugefügt am');
define('_ADDITIONALDET','weitere Details');
define('_ADDMAINCATEGORY','Hauptkategorie hinzufügen');
define('_ADDNEWDOWNLOAD','neuen Download hinzufügen');
define('_ADDSUBCATEGORY','Unter-Kategorie hinzufügen');
define('_ADDTHISFILE','Datei hinzufügen');
define('_ADDURL','URL hinzufügen');
define('_ALLFILES','alle Dateien');
define('_ALLOWTORATE','anderen die Bewertung ermöglichen!');
define('_ALREADYEXIST','existiert bereits!');
define('_AND','und');
define('_ANONPOSTDOWNLOADS','Anmeldung durch anonyme Benutzer?');
define('_ASCENDING','aufsteigend');
define('_AUTHOR','Autor');
define('_AUTHOREMAIL','E-Mail Autor');
define('_AUTHORNAME','Name Autor');
define('_BEPATIENT','(bitte einen Augenblick Geduld)');
define('_BREAKDOWNBYVAL','Durchschnittliche Wertung');
define('_BROKENDOWNLOADSREP','als defekt gemeldete Downloads');
define('_BUTTONLINK','Button Link');
define('_CATEGORIES','Kategorien');
define('_CATEGORY','Kategorie');
define('_CHECK','prüfen');
define('_CHECKALLDOWNLOADS','ALLE Downloads prüfen');
define('_CHECKCATEGORIES','Kategorie prüfen');
define('_CHECKFORIT','Keine E-Mail-Adresse angegeben - der Eintrag wird trotzdem bearbeitet.');
define('_CHECKSUBCATEGORIES','Unter-Kategorien prüfen');
define('_CLEANDOWNLOADSDB','Abstimmungsliste zurücksetzen');
define('_COMMENTS','Kommentare');
define('_CREATIONDATE','Erstellungsdatum');
define('_DATEWRITTEN','geschrieben am');
define('_DAYS','Tage');
define('_DBESTRATED','bestbewertete Downloads');
define('_DCATLAST3DAYS','in den letzten drei Tagen neu in dieser Kategorie hinzugefügte Downloads');
define('_DCATNEWTODAY','heute neu in dieser Kategorie hinzugefügte Downloads');
define('_DCATTHISWEEK','in dieser Woche in dieser Kategorie neu hinzugefügte Downloads');
define('_DDATE1','Datum (älteste Einträge zuerst)');
define('_DDATE2','Datum (neueste Einträge zuerst)');
define('_DDELCATWARNING','WARNUNG: Wirklich die Kategorie und ALLE darin befindlichen Downloads löschen?');
define('_DDELETEINFO','löschen (löscht <strong><em>defekte Downloads</em></strong> und <strong><em>Meldungen</em></strong> für einen Download)');
define('_DESCENDING','absteigend');
define('_DESCRIPTION','Beschreibung');
define('_DESCRIPTION255','Beschreibung: (max. 255 Zeichen)');
define('_DETAILS','Details');
define('_DIGNOREINFO','ignorieren (löscht alle <strong><em>Meldungen</em></strong> für einen Download)');
define('_DISPLAYFILTERED','Sortierung nach');
define('_DLALSOAVAILABLE','Downloads ebenfalls verfügbar in');
define('_DLETSDECIDE','Angaben von Benutzern helfen die Downloads besser bewerten zu können.');
define('_DLOADPAGETITLE','Downloads');
define('_DNOREPORTEDBROKEN','keine als defekt gemeldete Downloads.');
define('_DONLYREGUSERSMODIFY','nur registrierte Benutzer können einen Download modifizieren');
define('_DOWNLOAD','Download');
define('_DOWNLOADALREADYEXT','FEHLER: Die URL ist bereits in der Datenbank eingetragen!');
define('_DOWNLOADCOMMENTS','Download Kommentare');
define('_DOWNLOADID','Download-ID');
define('_DOWNLOADMODREQUEST','gemeldete Änderungswünsche');
define('_DOWNLOADNAME','Name');
define('_DOWNLOADNODESC','FEHLER: Beschreibung für die URL angeben!');
define('_DOWNLOADNOTITLE','FEHLER: Titel für die URL angeben!');
define('_DOWNLOADNOURL','FEHLER: Pfad der URL angeben!');
define('_DOWNLOADNOW','Datei downloaden');
define('_DOWNLOADOWNER','Download-Besitzer');
define('_DOWNLOADPROFILE','Download-Profil');
define('_DOWNLOADRATING','Downloads-Wertung');
define('_DOWNLOADRATINGDET','Download-Wertungsdetails');
define('_DOWNLOADRECEIVED','Wir haben die Meldung erhalten - Vielen Dank!');
define('_DOWNLOADS','Downloads');
define('_DOWNLOADSACCESSNOAUTH', 'Keine Berechtigung für Downloads');
define('_DOWNLOADSADDNOAUTH', 'Keine Berechtigung, Downloads hinzuzufügen');
define("_DOWNLOADSCATADDNOAUTH","Keine Berechtigung, Download-Kategorie hinzuzufügen");
define("_DOWNLOADSCATDELNOAUTH","Keine Berechtigung, Download-Kategorie zu löschen");
define("_DOWNLOADSCATEDITNOAUTH","Keine Berechtigung, Download-Kategorie zu editieren");
define('_DOWNLOADSCONF','Download Konfiguration');
define('_DOWNLOADSECTION','Download-Bereich');
define('_DOWNLOADSINDB','Downloads in der Datenbank');
define('_DOWNLOADSMAIN','Download-Index');
define('_DOWNLOADSMAINCAT','Download-Kategorien');
define('_DOWNLOADSNOCATS','Keine Download-Kategorien verfügbar - Download deaktiviert');
define('_DOWNLOADSNOTUSER1','Derzeit nicht angemeldet');
define('_DOWNLOADSNOTUSER2','Registrierte Benutzer können Downloads hinzufügen');
define('_DOWNLOADSNOTUSER3','Die Registrierung ist einfach, kostenfrei und schnell erledigt.');
define('_DOWNLOADSNOTUSER4','Warum eine Registrierung für einige Funktionen notwendig ist?');
define('_DOWNLOADSNOTUSER5','Nur so können wir auch sicherstellen, bei Rückfragen');
define('_DOWNLOADSNOTUSER6','Kontakt aufnehmen zu können.');
define('_DOWNLOADSNOTUSER7','Wir möchten bestmögliche und abgeprüfte Inhalte bieten.');
define('_DOWNLOADSNOTUSER8','<a href=\'user.php\'>Registrierung</a>');
define('_DOWNLOADSWAITINGVAL','auf Freischaltung wartende Downloads');
define('_DOWNLOADTITLE','Download-Titel');
define('_DOWNLOADVALIDATION','Download-Freischaltung');
define('_DOWNLOADVOTE','bewerten!');
define('_DPOSTPENDING','alle Meldungen erscheinen erst nach Freischaltung');
define('_DRATENOTE4','<a href=\'index.php?name=Downloads&amp;req=TopRated\'>Liste der bestbewerteten Downloads</a>.');
define('_DSUBMITONCE','Downloads bitte nur einmal melden');
define('_DTOTALFORLAST','Downloads der letzten');
define('_DUSERMODREQUEST','Änderungswünsche für Downloads');
define('_DUSERREPBROKEN','als defekt gemeldete Downloads');
define('_DWEAPPROVED','Der Download ist freigeschaltet.');
define('_EDITORIAL','Editorial');
define('_EDITORIALADDED','Editorial hinzugefügt');
define('_EDITORIALBY','Editorial von');
define('_EDITORIALMODIFIED','Editorial modifiziert');
define('_EDITORIALREMOVED','Editorial entfernt');
define('_EDITORIALTEXT','Editorial-Text');
define('_EDITORIALTITLE','Editorial-Titel');
define('_EDITORREVIEW','Beschreibung des Autors');
define('_EDITTHISDOWNLOAD','Download editieren');
define('_ERRORNODESCRIPTION','FEHLER: Beschreibung für den Download angeben!');
define('_ERRORNOTITLE','FEHLER: Titel für den Download angeben!');
define('_ERRORNOURL','FEHLER: URL für den Download angeben!');
define('_ERRORTHECATEGORY','FEHLER: die Kategorie');
define('_ERRORTHESUBCATEGORY','FEHLER: die Unter-Kategorie');
define('_ERRORURLEXIST','FEHLER: Die URL existiert bereits in der Datenbank!');
define('_FAILED','fehlgeschlagen!');
define('_FEELFREE2ADD','Kommentar zum Download hinzufügen');
define('_FILEINFO','Datei-Information');
define('_FILESIZE','Dateigrösse');
define('_FILEURL','Dateipfad');
define('_FUNCTIONS','Funktionen');
define('_HIGHRATING','höchste Wertung');
define('_HITS','Hits');
define('_HOMEPAGE','Homepage');
define('_HTMLCODE1','Der benötigte HTML-Code lautet:');
define('_HTMLCODE2','Der Sourcecode für den Button lautet:');
define('_HTMLCODE3','Die Benutzung dieses Formulars erlaubt es Besuchern, direkt von einer anderen Seite aus abzustimmen. Wir erhalten die Bewertung und fügen sie in unsere Datenbank ein. Das obige Beispiel ist deaktiviert, aber in eine Seite eingebaut wird es funktionieren, wenn der HTML-Code genau übernommen wird. Hier nun der HTML-Code:');
define('_IDREFER','im Code entspricht der Seiten-ID in der '.$sitename.'-Datenbank. Bitte darauf achten, dass diese Nummer angegeben ist.');
define('_IDREFER1','im Code entspricht der Seiten-ID in der');
define('_IDREFER2','-Datenbank. Bitte darauf achten, dass diese Nummer angegeben ist.');
define('_IFYOUWEREREG','Registrierte Benutzer können Kommentare verfassen.');
define('_IGNORE','ignorieren');
define('_IN','in');
define('_INBYTES','in Bytes');
define('_INCLUDESUBCATEGORIES','(Inklusive Unter-Kategorien)');
define('_INDB','in der Datenbank');
define('_INFO','Info');
define('_INOTHERSENGINES','in anderen Suchmaschinen');
define('_INSTRUCTIONS','Anleitung:');
define('_ISTHISYOURSITE','Inhaber?');
define('_LAST30DAYS','letzte 30 Tage');
define('_LASTWEEK','letzte Woche');
define('_LDESCRIPTION','Beschreibung: (max. 255 Zeichen)');
define('_LINEBREAKWARN','Warnung! Der Zeilenumbruch innerhalb der URL liegt an der Formularfunktion. URL\'s sollten einzeilige Eingaben enthalten. Der Zeilenumbruch dient nur der Lesbarkeit');
define('_LOOKTOREQUEST','Die Anfrage wird in Kürze bearbeitet.');
define('_LOWRATING','niedrigste Wertung');
define('_LTOTALVOTES','Gesamtstimmen');
define('_LVOTES','Stimmen');
define('_MAIN','Link-Index');
define('_MODCATEGORY','Kategorie modifizieren');
define('_MODDOWNLOAD','Download modifizieren');
define('_MODIFY','modifizieren');
define('_MOSTPOPULAR','Prozentsatz der beliebtesten');
define('_NAME','Name');
define('_NEW','neue');
define('_NEWDOWNLOADADDED','Download wurde in die Datenbank aufgenommen');
define('_NEWDOWNLOADS','neue Downloads');
define('_NEWLAST3DAYS','neu in den letzten 3 Tagen');
define('_NEWTHISWEEK','neu in dieser Woche');
define('_NEWTODAY','heute neu');
define('_NEXT','nächster');
define('_NOEDITORIAL','kein Editorial für diesen Download');
define('_NOMODREQUESTS','derzeit keine Änderungswünsche');
define('_NONE','keine');
define('_NOOUTSIDEVOTES','keine Wertungen von fremden Seiten');
define('_NOREGUSERSVOTES','keine Wertungen von registrierten Benutzern');
define('_NOSUCHFILE','Datei existiert nicht...');
define('_NOUNREGUSERSVOTES','keine Wertungen von unregistrierten Benutzern');
define('_NUMBEROFRATINGS','Anzahl der Bewertungen');
define('_NUMOFCOMMENTS','Anzahl der Kommentare');
define('_NUMRATINGS','der Stimmen');
define('_OF','von');
define('_OFALL','von allen');
define('_ONLYREGUSERSMODIFY','nur registrierte Benutzer können Änderungswünsche melden. Bitte <a href=\'user.php\'>registrieren bzw. anmelden</a>.');
define('_ORIGINAL','Original');
define('_OUTSIDEVOTERS','externe Stimmen');
define('_OVERALLRATING','insgesamt bewertet');
define('_OWNER','Eigentümer');
define('_PAGETITLE','Seitentitel');
define('_PAGEURL','URL');
define('_POPULAR','beliebte');
define('_POPULARITY','Beliebtheit');
define('_POPULARITY1','Beliebtheit (aufsteigend)');
define('_POPULARITY2','Beliebtheit (absteigend)');
define('_POSTPENDING','Alle Downloads werden vor der Freischaltung überprüft.');
define('_PREVIOUS','vorheriger');
define('_PROGRAMNAME','Name');
define('_PROMOTE01','Wir bieten \'Bewerte meine Webseite\'-Boxen an - diese erlauben das platzieren eines Bildes (oder eines Stimmformulars) direkt auf anderen Webseiten, um die Anzahl der Stimmen zu erhöhen. Einfach aus den unten gegebenen Möglichkeiten eine passende auswählen:');
define('_PROMOTE02','Ein möglicher Verweis auf das Wertungsformular ist ein einfacher Text-Link:');
define('_PROMOTE03','Ebenfalls möglich ist ein Buttonlink:');
define('_PROMOTE04','Externe Stimmen werden besonders geprüft - bei Missbrauch wird der Eintrag komplett entfernt. So könnte die individuelle Box aussehen:');
define('_PROMOTE05','Vielen Dank und viel Erfolg bei der Abstimmung!');
define('_PROMOTEYOURSITE','Downloads bewerben');
define('_PROPOSED','vorgeschlagene Änderung');
define('_RATEIT','Download bewerten!');
define('_RATENOTE1','Bitte nicht mehrfach bei einem Download abstimmen.');
define('_RATENOTE2','Die Skala reicht von 1 - 10, 1 bedeutet schlecht und 10 exzellent.');
define('_RATENOTE3','Bitte möglichst objektiv bewerten.');
define('_RATENOTE4','<a href=\'index.php?name='.(empty($ModName) ? '' : $ModName).'&amp;req=TopRated\'>bestbewertete Einträge</a>.');
define('_RATENOTE5','Bitte nicht für den eigenen Eintrag abstimmen.');
define('_RATENOTE1ERROR','Abstimmung erfolgreich!');
define('_RATENOTE2ERROR','Es erfolgte bereits eine Stimmabgabe in den letzten '.$anonwaitdays.' Tagen.');
define('_RATENOTE2ERROR1','Es erfolgte bereits eine Stimmabgabe in den letzten');
define('_RATENOTE2ERROR2','Tagen.');
define('_RATENOTE3ERROR','Nur einmal für einen Download abstimmen.<br />Alle Stimmen werden geloggt.');
define('_RATENOTE4ERROR','Es kann nicht für eigene Downloads gestimmt werden.<br />Alle Stimmen werden geloggt.');
define('_RATENOTE5ERROR','Keine Wertung gewählt');
define('_RATERESOURCE','Eintrag bewerten');
define('_RATETHISSITE','Download bewerten');
define('_RATING','Bewertung');
define('_RATING1','Bewertung (aufsteigend)');
define('_RATING2','Bewertung (absteigend)');
define('_REGISTEREDUSERS','registrierte Benutzer');
define('_REMOTEFORM','externes Bewertungsformular');
define('_REPORTBROKEN','defekten Link melden');
define('_REQUESTDOWNLOADMOD','Änderung vorschlagen');
define('_RESSORTED','Einträge derzeit sortiert nach');
define('_RETURNTO','zurück zu');
define('_SEARCHRESULTS4','Suchergebnisse für');
define('_SECURITYBROKEN','aus Sicherheitsgründen werden Benutzername und IP kurzfristig aufgezeichnet');
define('_SELECTCATEGORY','Kategorieordner wählen');
define('_SELECTPAGE','Seite wählen');
define('_SENDREQUEST','Anforderung senden');
define('_SHOW','zeige');
define('_SHOWTOP','zeige Top');
define('_SORTDOWNLOADSBY','Downloads sortieren nach');
define('_SORTED','sortiert');
define('_STAFF','Staff');
define('_STATUS','Status');
define('_SUBCATEGORIES','Unter-Kategorien');
define('_SUBCATEGORY','Unter-Kategorie');
define('_SUBMITONCE','Downloads nur einmal einreichen');
define('_SUBMITTER','eingereicht von');
define('_TEXTLINK','Text Link');
define('_THANKSBROKEN','Vielen Dank für die Hilfe!');
define('_THANKSFORINFO','Vielen Dank für die Information!');
define('_THANKSTOTAKETIME','Vielen Dank für die Bewertung bei');
define('_THENUMBER','die Nummer');
define('_THEREARE','es gibt');
define('_TITLE','Titel');
define('_TITLEAZ','Titel (A-Z)');
define('_TITLEZA','Titel (Z-A)');
define('_TOPRATED','bestbewertete');
define('_TOTALNEWDOWNLOADS','neue Downloads insgesamt');
define('_TOTALOF','insgesamt');
define('_TOTALVOTES','Gesamtstimmen:');
define('_TRATEDDOWNLOADS','insgesamt bewertete Downloads');
define('_TRY2SEARCH','Starte Suche nach');
define('_TVOTESREQ','Stimmen mindestens benötigt');
define('_UDOWNLOADS','Downloads');
define('_UNKNOWN','unbekannt');
define('_UNREGISTEREDUSERS','unregistrierte Benutzer');
define('_UPLOADDATE','Upload-Datum');
define('_USER','Benutzer');
define('_USERANDIP','Benutzername und IP werden aufgezeichnet');
define('_USERAVGRATING','durchschnittliche Benutzerwertung');
define('_USERRATING','Benutzerwertung');
define('_USUBCATEGORIES','Unter-Kategorien');
define('_VALIDATEDOWNLOADS','überprüfe Downloads');
define('_VALIDATINGCAT','überprüfte Kategorie (inkl. Unter-Kategorie');
define('_VALIDATINGSUBCAT','überprüfte Unter-Kategorie');
define('_VERSION','Version');
define('_VISIT','Besuche');
define('_VOTE4THISSITE','Download bewerten!');
if (!defined('_VOTE')) {
    define('_VOTE','Stimme');
}
define('_VOTES','Stimmen');
define('_WEBDOWNLOADSADMIN','Download-Administration');
define('_WEIGHNOTE','* Achtung: Wir bewerten Stimmen von registrierten Benutzern zu unregistrierten Benutzern im Verhältnis');
define('_WEIGHOUTNOTE','* Achtung: Wir bewerten interne zu externen Stimmen im Verhältnis');
define('_YOUARENOTREGGED','Derzeit nicht registriert oder nicht angemeldet.');
define('_YOUAREREGGED','Derzeit als registrierter Benutzer angemeldet.');
define('_YOURDOWNLOADAT','Download bei');
?>