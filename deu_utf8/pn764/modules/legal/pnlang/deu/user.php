<?php
// $Id: user.php,v 1.1 2005/04/29 17:12:19 larsneo Exp $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2003 by the PostNuke Development Team.
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
// Purpose of file:  legal language defines
// ----------------------------------------------------------------------
$privacyurl = pnVarPrepHTMLDisplay(pnModURL('legal', 'user', 'privacy'));
$termsofuseurl = pnVarPrepHTMLDisplay(pnModURL('legal','user','termsofuse'));

define('_TOUNOTACTIVE', 'Allgemeine Nutzungsbedingungen nicht aktiviert');
define('_PPNOTACTIVE', 'Erklärung zum Datenschutz nicht aktiviert');
define('_ASNOTACTIVE', 'Accessibility statement not activated');

define("_PPTOPTEXT","<strong>Erklärung zum Datenschutz (Privacy Policy) v1.03 für ".pnConfigGetVar('sitename')."</strong>");
define('_PPTITLEINTRO','<strong>Vorwort</strong>');
define("_PPTEXTINTRO","Die Betreiber von ".pnConfigGetVar('sitename')." nehmen den Schutz der privaten Daten ernst. Die besondere Beachtung der Privatsphäre bei der Verarbeitung persönlicher Daten ist ein wichtiges Anliegen. Persönliche Daten werden gemäss den Bestimmungen des Bundesdatenschutzgesetzes BDSG verwendet; die Betreiber dieser Website verpflichten sich zur Verschwiegenheit. Diese Webseiten können Links zu Webseiten anderer Anbieter enthalten, auf die sich diese Datenschutzerklärung nicht erstreckt. Weitere wichtige Informationen finden sich auch in den <a href=\"".$termsofuseurl."\">Allgemeinen Nutzungsbedingungen</a>.");
define('_PPTITLE1','<strong>1. Personenbezogene Daten</strong>');
define('_PPTEXT1','Personenbezogene Daten sind Informationen, die dazu genutzt werden können, die Identität zu erfahren. Darunter fallen Informationen wie richtiger Name, Adresse, Postanschrift, Telefonnummer. Informationen, die nicht direkt mit der wirklichen Identität in Verbindung gebracht werden (wie zum Beispiel favorisierte Webseiten oder Anzahl der Nutzer einer Site) fallen nicht darunter.<br /> 
Man kann unser Online-Angebot grundsätzlich ohne Offenlegung der Identität nutzen. Wenn man sich für eine Registrierung entscheidet, sich also als Mitglied (registrierter Benutzer) anmeldet, kann man im individuellen Benutzerprofil persönlichen Informationen hinterlegen. Es unterliegt der freien Entscheidung, ob diese Daten eingegeben werden. Da versucht wird, für eine Nutzung des Angebots so wenig wie möglich personenbezogene Daten zu erheben, reicht für eine Registrierung die Angabe eines Namens - unter dem man als Mitglied geführt wird und der nicht mit dem realen Namen übereinstimmen muss - und die Angabe der E-Mail-Adresse, an die das Kennwort geschickt wird, aus. In Verbindung mit dem Zugriff auf unsere Seiten werden serverseitig Daten (zum Beispiel IP-Adresse, Datum, Uhrzeit und betrachtete Seiten) gespeichert. Es findet keine personenbezogene Verwertung statt. Die statistische Auswertung anonymisierter Datensätze bleibt vorbehalten.<br />
Wir nutzen die persönlichen Daten zu Zwecken der technischen Administration der Webseiten und zur Kundenverwaltung nur im jeweils dafür erforderlichen Umfang.
Darüber hinaus werden persönliche Daten nur dann gespeichert, wenn diese freiwillig angegeben werden.');
define('_PPTITLE2','<strong>2. Weitergabe personenbezogener Daten</strong>');
define('_PPTEXT2','Wir verwenden personenbezogene Informationen nur für diese Webseite. Wir geben die Informationen nicht ohne ausdrückliches Einverständnis an Dritte weiter. Sollten im Rahmen der Auftragsdatenverarbeitung Daten an Dienstleister weitergegeben werden, so sind diese an das Bundesdatenschutzgesetz BDSG, andere gesetzliche Vorschriften und an diese Privacy Policy gebunden.<br /> Erhebungen beziehungsweise Übermittlungen persönlicher Daten an staatliche Einrichtungen und Behörden erfolgen nur im Rahmen zwingender Rechtsvorschriften.');
define('_PPTITLE3','<strong>3. Einsatz von Cookies</strong>');
define('_PPTEXT3','Wir setzen Cookies - kleine Dateien mit Konfigurationsinformationen - ein. Sie helfen dabei, benutzerindividuelle Einstellungen zu ermitteln und spezielle Benutzerfunktionen zu realisieren. Wir erfassen keine personenbezogenen Daten über Cookies. Sämtliche Funktionen der Website sind auch ohne Cookies einsetzbar, einige benutzerdefinierte Eigenschaften und Einstellungen sind dann allerdings nicht verfügbar.');
define('_PPTITLE4','<strong>4. Kinder</strong>');
define("_PPTEXT4","Personen unter 18 Jahren sollten ohne Zustimmung der Eltern oder Erziehungsberechtigten keine personenbezogenen Daten an uns übermitteln. Wir fordern keine personenbezogenen Daten von Kindern an, sammeln diese nicht und geben sie nicht an Dritte weiter.");
define('_PPTITLE5','<strong>5. Recht auf Widerruf</strong>');
define("_PPTEXT5","Wenn Sie uns personenbezogene Daten überlassen haben, können Sie diese jederzeit im <a href=\"user.php\">Benutzerprofil</a> wieder ändern und löschen. Für eine vollständige Löschung des Accounts bitte an den <a href=\"mailto:".pnVarPrepHTMLDisplay(pnConfigGetVar('adminmail'))."\">Webmaster</a> wenden. Bis zu diesem Zeitpunkt erfolgte Beiträge in Foren, Kommentaren, Terminankündigungen und Artikeln bleiben allerdings unter Umständen erhalten - Informationen dazu auch bei den <a href=\"".$termsofuseurl."\">Allgemeinen Nutzungsbedingungen</a>.");
define('_PPTITLE6','<strong>6. Links zu anderen Websites</strong>');
define('_PPTEXT6','Unser Online-Angebot enthält Links zu anderen Websites. Wir haben keinen Einfluss darauf, dass deren Betreiber die Datenschutzbestimmungen einhalten.');
define('_PPTITLE7','<strong>7. Beiträge</strong>');
define('_PPTEXT7','Die Beiträge auf unserer Seite sind für jeden zugänglich. Beiträge sollten vor der Veröffentlichung sorgfältig darauf überprüft werden, ob sie Angaben enthalten, die nicht für die Öffentlichkeit bestimmt sind. Die Beiträge werden möglicherweise in Suchmaschinen erfasst und auch ohne gezielten Aufruf dieser Website weltweit zugreifbar.');
define('_PPTITLE8','<strong>8. Fragen und Kommentare</strong>');
define("_PPTEXT8","Bei Fragen und für Anregungen und Kommentare zum Thema Datenschutz bitte per Mail an den <a href=\"mailto:".pnVarPrepHTMLDisplay(pnConfigGetVar('adminmail'))."\">Webmaster</a> von ".pnConfigGetVar('sitename')." wenden.");

define("_TOUTOPTEXT","<strong>Allgemeine Nutzungsbedingungen v1.04<br />für ".pnConfigGetVar('sitename')."</strong>");
define('_TOUTITLE1','<strong>1. Informationen zum Urheberrecht</strong>');
define('_TOUTEXT1','Alle Informationen dieser Web-Seite werden wie angegeben ohne Anspruch auf Richtigkeit, Vollständigkeit oder Aktualität zur Verfügung gestellt.<br />
Wenn nicht ausdrücklich anderweitig in dieser Publikation zu verstehen gegeben, und zwar in Zusammenhang mit einem bestimmten Ausschnitt, einer Datei, oder einem Dokument, ist jedermann dazu berechtigt, dieses Dokument anzusehen, zu kopieren, zu drucken und zu verteilen, unter den folgenden Bedingungen:<br /> 
Das Dokument darf nur für nichtkommerzielle Informationszwecke genutzt werden. Jede Kopie dieses Dokuments oder eines Teils davon muss diese urheberrechtliche Erklärung und das urheberrechtliche Schutzzeichen des Betreibers enthalten. Das Dokument, jede Kopie des Dokuments oder eines Teils davon dürfen nicht ohne schriftliche Zustimmung des Betreibers verändert werden. Der Betreiber behält sich das Recht vor, diese Genehmigung jederzeit zu widerrufen, und jede Nutzung muss sofort eingestellt werden, sobald eine schriftliche Bekanntmachung seitens des Betreibers veröffentlicht wird.');
define('_TOUTITLE2','<strong>2. Vertragliche Zusicherungen und Verzichterklärungen</strong>');
define('_TOUTEXT2',"Die Website »".pnConfigGetVar('sitename')."« steht Ihnen - soweit nicht anders vereinbart - kostenlos zur Verfügung. Die Betreiber übernehmen keinerlei Gewähr für Richtigkeit der enthaltenen Informationen, Verfügbarkeit der Dienste, Verlust von auf ".pnConfigGetVar('sitename')." abgespeicherten Daten oder Nutzbarkeit für irgendeinen bestimmten Zweck.<br /> 
Die Betreiber haften auch nicht für Folgeschäden, die auf einer Nutzung des Angebotes beruhen. <br />
Soweit ein Haftungsausschluss nicht in Betracht kommt, haften die Betreiber lediglich für grobe Fahrlässigkeit und Vorsatz. Produkt- und Firmennamen sind Marken der jeweiligen Eigentümer und werden auf diesen Seiten ausschliesslich zu Informationszwecken eingesetzt. <br />
Diese Publikation könnte technische oder andere Ungenauigkeiten enthalten oder Schreib- oder Tippfehler. Von Zeit zu Zeit werden der vorliegenden Information Änderungen hinzugefügt; diese Änderungen werden in neuen Ausgaben der Publikation eingefügt. Der Betreiber kann jederzeit Verbesserungen und/oder Veränderungen an den Angeboten vornehmen, die in dieser Publikation beschrieben werden.");
define('_TOUTITLE3','<strong>3. Meinungsäusserungen bei Kommentaren und im Forum</strong>');
define("_TOUTEXT3","Aufgrund der sich ständig verändernden Inhalte bei Kommentaren und im Forum ist es dem Betreiber nicht möglich, alle Beiträge lückenlos zu sichten, inhaltlich zu prüfen und die unmittelbare aktive Kontrolle darüber auszuüben. Es wird keine Verantwortung für den Inhalt, die Korrektheit und die Form der eingestellten Beiträge übernommen.");
define('_TOUTITLE4','<strong>3a. Spezielle Bestimmungen für angemeldete Nutzer</strong>');
define("_TOUTEXT4","Mit der Anmeldung bei »".pnConfigGetVar('sitename')."« erklärt sich der Nutzer - nachfolgend »Mitglied« gegenüber dem Betreiber mit folgenden Nutzungsbedingungen einverstanden:<br />
Mitglieder, die sich an Diskussionsforen und Kommentaren beteiligen, verpflichten sich dazu,<br />
<strong>&nbsp;&middot;&nbsp;</strong>1. Sich in Ihren Beiträgen jeglicher Beleidigungen, strafbarer Inhalte, Pornographie und grober Ausdrucksweise zu enthalten,<br />
<strong>&nbsp;&middot;&nbsp;</strong>2. Die alleinige Verantwortung für die von ihnen eingestellten Inhalte zu tragen, Rechte Dritter (insbesondere Marken-, Urheber- und Persönlichkeitsrechte) nicht zu verletzen und die Betreiber von »".pnConfigGetVar('sitename')."« von durch ihre Beiträge ausgelösten Ansprüchen Dritter vollständig freizustellen.<br />
<strong>&nbsp;&middot;&nbsp;</strong>3. Weder in Foren noch in Kommentaren Werbung irgendwelcher Art einzustellen oder Foren und Kommentare zu irgendeiner Art gewerblicher Tätigkeit zu nutzen. Insbesondere gilt das für die Veröffentlichung von »0190«-Rufnummern zu irgendeinem Zweck.<br />
Es besteht keinerlei Anspruch auf Veröffentlichung von eingereichten Kommentaren oder Forenbeiträgen. Die Betreiber von »".pnConfigGetVar('sitename')."« behalten sich vor, Kommentare und Forenbeiträge nach eigenem Ermessen zu editieren oder zu löschen. Bei Verletzungen der Pflichten unter 1), 2) und 3) behalten sich die Betreiber ferner vor, die Mitgliedschaft zeitlich begrenzt zu sperren oder dauernd zu löschen.");
define('_TOUTITLE5','<strong>4. Einreichen von Beiträgen und Artikeln</strong>');
define('_TOUTEXT5',"Soweit das Mitglied von der Möglichkeit Gebrauch macht, eigene Beiträge für redaktionellen Teil von »".pnConfigGetVar('sitename')."« einzureichen, gilt Folgendes:<br />
Voraussetzung für das Posten eigener Beiträge ist, dass das Mitglied seinen vollständigen und korrekten Vor- und Nachnamen in sein »".pnConfigGetVar('sitename')."« - Benutzerprofil eingetragen hat
oder nach dem Einreichen des Artikels dort einträgt. Mit dem dort eingetragenen Namen wird der eingereichte Beitrag bei Veröffentlichung (öffentlich) gekennzeichnet.<br />
Das Mitglied gibt für alle Beiträge, die von ihm oder ihr zukünftig auf »".pnConfigGetVar('sitename')."« eingereicht werden, folgende Erklärungen ab:<br />
<strong>&nbsp;&middot;&nbsp;</strong>1. Das Mitglied versichert, dass die eingereichten Beiträge frei von Rechten Dritter, insbesonders Urheber-, Marken- oder Persönlichkeitsrechten sind. Dies gilt für alle eingereichten Beiträge und Bildwerke.<br />
<strong>&nbsp;&middot;&nbsp;</strong>2. Das Mitglied räumt den Betreibern von »".pnConfigGetVar('sitename')."« ein uneingeschränktes Nutzungsrecht an den eingereichten Beiträgen ein. Dieses umfasst die Veröffentlichung im Internet auf »".pnConfigGetVar('sitename')."« sowie auf anderen Internetservern, in Newslettern, Printmedien und anderen Publikationen.<br />
<strong>&nbsp;&middot;&nbsp;</strong>3. Eingereichte Beiträge werden auf Verlangen des Mitgliedes per Email an die Adresse des <a href=\"mailto:".pnVarPrepHTMLDisplay(pnConfigGetVar('adminmail'))."\">Webmasters</a> wieder gelöscht bzw. anonymisiert. Die Löschung bzw. Anonymisierung erfolgt innerhalb von 7 Tagen nach der Mitteilung. Für Folgeschäden, die dem Mitglied aus der verspäteten Löschung des Beitrages entstehen haften die Betreiber nur insoweit, als sie nicht auf einer Pflichtverletzung des Mitgliedes (oben unter 1), 2) und 3) ) und soweit sie darüber hinaus auf grobem Verschulden oder Vorsatz der Betreiber von »".pnConfigGetVar('sitename')."« beruhen. Wir weisen in diesem Zusammenhang ausdrücklich darauf hin, dass »".pnConfigGetVar('sitename')."« regelmäßig von Suchmaschinen indexiert wird, und dass wir keinen Einfluss darauf haben, ob, wo und wie lange bei uns veröffentlichte Beiträge möglicherweise auch nach Löschung bei »".pnConfigGetVar('sitename')."« in Datenbanken von Suchmaschinen und Webkatalogen gespeichert werden und abrufbar sind.<br />
<strong>&nbsp;&middot;&nbsp;</strong>4. Es besteht keinerlei Anspruch auf Speicherung, Veröffentlichung oder Archivierung der eingereichten Beiträge. Die Betreiber behalten sich vor, eingereichte Beiträge ohne Angabe von Gründen nicht zu veröffentlichen, vor Veröffentlichung zu editieren oder nach Veröffentlichung nach freiem Ermessen wieder zu löschen.<br />
<strong>&nbsp;&middot;&nbsp;</strong>5. Durch die Veröffentlichung eingereichter Beiträge entstehen keinerlei Vergütungsansprüche (Honorare, Lizenzgebühren, Aufwendungsentschädigungen oder Ähnliches) des Mitgliedes gegenüber »".pnConfigGetVar('sitename')."«. Die Mitarbeit ist ehrenamtlich (unentgeltlich).");
define('_TOUTITLE6','<strong>5. Erklärung zum Datenschutz (Privacy Policy)</strong>');
define("_TOUTEXT6","Sofern innerhalb des Internetangebotes die Möglichkeit zur Eingabe persönlicher oder geschäftlicher Daten genutzt wird, so erfolgt die Preisgabe dieser Daten seitens des Nutzers auf ausdrücklich freiwilliger Basis. Die Inanspruchnahme unseres Dienstes ist - soweit technisch möglich und zumutbar - auch ohne Angabe solcher Daten bzw. unter Angabe anonymisierter Daten oder eines Pseudonyms gestattet. Weitere wichtige Informationen zum Thema Datenschutz finden sich in unserer <a href=\"".$privacyurl."\">Erklärung zum Datenschutz (Privacy Policy)</a>.");
define('_TOUTEXT6MORE','');
define('_TOUTITLE7','<strong>6. Registrierung und Passwort</strong>');
define('_TOUTEXT7','Der Benutzer ist verpflichtet, die Kombination Benutzername/Passwort vertraulich zu behandeln und nicht an Dritte weiterzugeben. Bei Verdacht auf Missbrauch der Zugangsdaten ist der Betreiber zu informieren.');
define('_TOUTITLE8','<strong>7. Hinweis gemäss Teledienstgesetz</strong>');
define('_TOUTEXT8','Für Internetseiten Dritter, auf die die dieses Angebot durch sog. Links verweist, tragen die jeweiligen Anbieter die Verantwortung. Der Betreiber ist für den Inhalt solcher Seiten Dritter nicht verantwortlich. Desweiteren kann die Web-Seite ohne unser Wissen von anderen Seiten mittels sog. Links angelinkt werden. Der Betreiber übernimmt keine Verantwortung für Darstellungen, Inhalt oder irgendeine Verbindung zu dieser Web-Seite in Web-Seiten Dritter. Für fremde Inhalte ist der Betreiber nur dann verantwortlich, wenn von ihnen (d.h. auch von einem rechtswidrigen oder strafbaren Inhalt) positive Kenntnis vorliegt und es technisch möglich und zumutbar ist, deren Nutzung zu verhindern. Der Betreiber ist nach dem Teledienstgesetz jedoch nicht verpflichtet, die fremden Inhalte ständig zu überprüfen.');
define('_TOUTITLE9','<strong>Kontakt</strong>');
define('_TOUTEXT9','Fragen rund um '.pnConfigGetVar('sitename').' bitte an den <a href="mailto:'.pnVarPrepHTMLDisplay(pnConfigGetVar('adminmail')).'">Webmaster</a> richten.');
define('_TOUTITLE10','<strong>Rechtswirksamkeit</strong>');
define('_TOUTEXT10','Diese Allgemeinen Nutzungsbedingungen beziehen sich auf '.pnConfigGetVar('sitename').'.<br />
Sofern Teile oder einzelne Formulierungen dieses Textes der geltenden Rechtslage nicht, nicht mehr oder nicht vollständig entsprechen sollten, bleiben die übrigen Teile des Dokumentes in ihrem Inhalt und ihrer Gültigkeit davon unberührt.');
define('_TOUTEXT10MORE','');
define('_TOUTEXT10MORE1','');

/* ZUSATZINFORMATION IN BEZUG AUF DIE ANGABE EINES IMPRESSUMS:
Nach Paragraph 6 Teledienstgesetz ist jeder Diensteanbieter verpflichtet, folgende Informationen auf einer geschäftsmässg betriebenen Website erkennbar, unmittelbar erreichbar und ständig verfügbar zu halten:
- Namen und Anschrift, bei juristischen Personen zusätzlich den Vertretungsberechtigen. Nicht ausreichend ist die Angabe eines Postfaches;
- Angaben, die eine schnelle elektronische Kommunikation und unmittelbare Kommunikation mit dem Diensteanbieter ermöglichen, also zumindest eine Telefonnummer sowie eine E-Mail-Adresse
- Angaben zur ständigen Aufsichtsbehörde, soweit der Teledienst im Rahmen einer Tätigkeit angeboten oder erbracht wird, die der behördlichen Zulassung bedarf. Diese Vorschrift betrifft insbesondere Betreiber von Anlagen und Einrichtungen die öffentlich-rechtlicher Genehmigung bedürfen
- Das Handelsregister, Vereinsregister, Partnerschaftsregister oder Genossenschaftsregister, in das der Diensteanbieter eingetragen ist sowie die die entsprechende Registernummer
- Besondere Informationspflichten gelten für sogenannte "reglementierte Berufe" im Sinne der europäischen Diplomanerkennungsrichtlinien, um für den jeweiligen Nutzer die Qualifikation, Befugnisse und gegebenenfalls besondere Pflichtenstellung des Diensteanbieters transparent zu machen
- Falls vorhanden, die Umsatzsteueridentifikationsnummer nach Paragraph 27a des Umsatzsteuergesetzes

Als Empfehlung zur Erstellung eines Impressums: http://www.digi-info.de/webimpressum/ 
*/

define('_TOUTITLE11','');
define('_TOUTEXT11','');   
define('_TOUTEXT11MORE','');
define('_TOUTITLE12','');
define('_TOUTEXT12','');
define('_TOUTITLE13','');
define("_TOUTEXT13",""); 
define('_TOUTITLE14','');
define("_TOUTEXT14","");
define('_TOUTITLE15','');
define("_TOUTEXT15","");

define('_ASTITLE1', 'Barrierefreiheit');
define('_ASTEXT1', 'Um den Anforderungen möglichst vieler Besucherinnen und Besucher unserer Website gerecht zu werden, bemühen wir uns, diese Website barrierefrei zu gestalten. Der Gesetzgeber hat für Website von öffentlichen Einrichtungen, Behörden und Ämtern rechtliche Vorgaben geschaffen, die die Barrierefreiheit garantieren sollen.<br />
Wir fallen zwar nicht direkt unter diese Auflagen, möchten uns aber dennoch daran orientieren.<br />
Sollten dennoch konkrete Schwierigkeiten bei der barrierefreien Nutzung dieser Website auftreten, bitten wir um eine kurze Mitteilung. Wir sind für Hinweise dankbar und versuchen, nach Kräften zu helfen.<br />
Wenden Sie sich bitte per Email an '.pnConfigGetVar('adminmail').'.');
define('_ASTITLE2', '');
define('_ASTEXT2', '');
define('_ASTEXT3', '');
define('_ASTITLE3', '');
define('_ASTEXT4', '');
define('_ASTEXT5', '');
define('_ASTEXT6', '');
define('_ASTEXT7', '');
define('_ASTEXT8', '');
define('_ASTITLE4', '');
define('_ASTEXT9', '');
define('_ASTEXT10', '');
define('_ASTITLE5', '');
define('_ASTEXT11', '');
define('_ASTEXT12', '');
define('_ASTITLE6', '');
define('_ASTEXT13', '');
define('_ASTEXT14', '');
define('_ASTITLE7', '');
define('_ASTEXT15', '');
define('_ASTEXT16', '');
define('_ASTEXT17', '');

define('_LEGAL', 'Nutzungsbedingungen');
define('_LEGALTERMSOFUSE', 'Allgemeine Nutzungsbedingungen');
define('_LEGALPRIVACYPOLICY', 'Erklärung zum Datenschutz');
define('_LEGALACCESIBILITYSTATEMENT', 'Erklärung zur Barrierefreiheit');

?>