<?php 
// File: $Id: global.php,v 1.4 2005/10/11 12:36:04 jna Exp $ 
// ----------------------------------------------------------------------
// Original Author of file: ???
// Purpose of file: Poll comments/module/admin defines.
// ----------------------------------------------------------------------
//
// please post comments regarding german translation at
// http://www.pncommunity.de
// last changes: 2003/06/12 larsneo
//

// new
define('_POLL_NOVOTE','Keine Stimmabgabe möglich');
define('_POLL_VOTEDTODAY','Es kann pro Tag nur eine Stimme abgegeben werden!');

define('_ALL','alle');
define('_ALLOWEDHTML','erlaubtes HTML:');
define('_BY','von');
define('_CHOOSEPOLL','Bitte eine Umfrage aus der folgenden Liste wählen:');
define('_COMMENT','kommentieren');
define('_COMMENTREPLY','Beitrag kommentieren');
define('_COMMENTS','Kommentare');
define('_COMMENTSBACK','zurück zu den Kommentaren');
define('_COMMENTSPOLLS','Kommentare in Umfragen aktivieren?');
define('_COMMENTSWARNING','Wir sind nicht verantwortlich für Kommentare unserer Benutzer');
define('_COMREPLYPRE','Kommentar-Vorschau');
define('_CONFIGURE','einstellen');
define('_CREATEPOLL','neue Umfrage erstellen');
define('_CREATEPOLLBUT','Umfrage erstellen');
define('_CURRENTPOLL','aktuelle Umfrage');
define('_CURRENTPOLLRESULTS','Ergebnisse der aktuellen Umfrage');
define('_DELETEPOLLS','Umfrage löschen');
define('_DIRECTCOM','direkter Umfrage-Kommentar...');
define('_DUPLICATE','Doppelter Eintrag - zweimal abgesendet?');
define('_EDITEXISTING','bestehende Umfragen editieren');
define('_EXTRANS','Wandlung (HTML-Tags in Text)');
define('_FLAT','chronologisch');
define('_HIGHEST','höchste Wertung zuerst');
define('_HTMLFORMATED','HTML-formatiert');
define('_LANGUAGE','Sprache');
define('_LOGINCREATE','Anmeldung/Registrierung');
define('_LOGOUT','Abmeldung');
define('_LVOTES','Stimmen');
define('_MODERATE','moderieren');
define('_MODIFY','ändern');
define('_MODIFYPOLLS','Umfrage ändern');
define('_NESTED','verschachtelt');
define('_NEWEST','neueste zuerst');
if (!defined('_NOANONCOMMENTS')) {
define('_NOANONCOMMENTS','Anonyme Benutzer können keine Kommentare verfassen, bitte <a href=\'user.php\'>anmelden</a>');
}
define('_NOCOMMENTS','Keine Kommentare');
define('_NOSUBJECT','Kein Titel');
define('_NOTRIGHT','Bei der Variablenübergabe ist es zu Problemen gekommen...');
if (!defined('_NUMVOTES')) {
    define('_NUMVOTES','Stimmen');
}
define('_OLDEST','älteste zuerst');
define('_ON','am');
define('_ONEPERDAY','pro Tag nur eine Stimme');
define('_ONN','am...');
define('_OTHERPOLLS','weitere Umfragen');
define('_PARENT','übergeordnet');
define('_PASTPOLLS','ältere Umfragen');
define('_PASTSURVEYS','ältere Abstimmungen');
define('_PCOMMENTS','Kommentare:');
define('_PLAINTEXT','einfacher Text');
define('_POLL','Umfrage');
define('_POLLCOM','Umfragekommentar schreiben');
define('_POLLCOMPRE','Vorschau Umfragekommentar');
define('_POLLDELWARNING','ACHTUNG: Die gewählte Umfrage wird komplett aus der Datenbank entfernt!');
define('_POLLEACHFIELD','Bitte jede Wahloption in ein eigenes Feld eintragen');
define('_POLLS','Umfragen');
define('_POLLSADDNOAUTH','Keine Berechtigung, Umfragen hinzuzufügen');
define('_POLLSADMIN','Umfrage-Administration');
define('_POLLSCONF','Umfrage-Konfiguration');
define('_POLLSDELNOAUTH','Keine Berechtigung, Umfragen zu löschen');
define('_POLLSEDITNOAUTH','Keine Berechtigung, Umfragen zu editieren');
define('_POLLSNOAUTH','Keine Berechtigung, auf Umfragen zuzugreifen');
define('_POLLTITLE','Titel');
define('_POSTANON','anonym schreiben');
define('_Poll','Umfrage');
define('_READREST','Kommentar weiterlesen...');
define('_REMOVEEXISTING','bestehende Umfrage löschen');
define('_REPLY','darauf antworten');
define('_REPLYMAIN','Kommentar schreiben');
define('_RESULTS','Ergebnisse');
define('_ROOT','Root');
define('_SCALEBAR','Skala des Ergebnisbalkens');
define('_SCORE','Wertung:');
define('_SENDAMSG','Nachricht schicken');
define('_SUBJECT','Titel');
define('_THREAD','Thread');
define('_THRESHOLD','Begrenzung');
define('_TOTALVOTES','Stimmen insgesamt:');
define('_UCOMMENT','Kommentar');
//define('_USERINFO','Benutzerinfo');
if (!defined('_VOTE')) {
    define('_VOTE','Stimme');
}
define('_VOTING','Stimmabgabe');
define('_YOURNAME','Name');
?>