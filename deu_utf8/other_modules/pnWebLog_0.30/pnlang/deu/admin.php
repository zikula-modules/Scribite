<?php

//main
define(_PNWEBLOGADMINPANEL,'Administrations-Backend für bestehende WebLogs');
define(_PNWEBLOGADMININTROTEXT,'Die Administrationsoberfläche ist sehr kompakt gehalten, hat so jedoch die notwendigen Funktionen alle an einem Fleck.');
define(_PNWEBLOGDELETECOMMENT,'Kommentar löschen');
define(_PNWEBLOGDELETEPAGE,'Seite löschen');
define(_PNWEBLOGDELETEPOST,'Beitrag löschen');
define(_PNWEBLOGDELETEWEBLOG,'WebLog löschen');
define(_PNWEBLOGDELETELINK,'Link löschen');
define(_PNWEBLOGDELETELINKTEXT,'Ist die ID eines Links nicht bekannt, so muss über die WebLogadministration eines bestimmten WebLogs der Link ausgewählt werden');
define(_PNWEBLOGDELETECOMMENTTEXT,'Die Kommentar-ID-Nummer ist beim Kommentar selbst vermerkt. Diese bitte hier eintragen');
define(_PNWEBLOGDELETEPAGETEXT,'Die ID einer Seite kann der URL entnommen werden (page_id und die dahinter folgende Zahl)');
define(_PNWEBLOGDELETEPOSTTEXT,'Die ID eines Beitrags kann der URL entnommen werden (post_id und die dahinter folgende Zahl)');
define(_PNWEBLOGDELETEWEBLOGTEXT ,'Die ID eines WebLogs ist die Benutzer-ID des Besitzers des jeweiligen WebLogs und kann auch der URL des WebLogs entnommen werden (uid und die dahinter folgende Zahl)');
define(_PNWEBLOGDELCOMMENT,'Kommentar löschen');
define(_PNWEBLOGDELPAGE,'Seite löschen');
define(_PNWEBLOGDELPOST,'Beitrag löschen');
define(_PNWEBLOGDELWEBLOG,'WebLog löschen');
define(_PNWEBLOGREALLYDELETE,'Soll die Aktion wirklich durchgeführt werden? Ein Löschvorgang kann nicht rückgängig gemacht werden!');
define(_PNWEBLOGADMINQUICKLINKS,'Quick-Links zur Schnelladministration');
define(_PNWEBLOGADMINISTRATEAWEBLOG,'Einzelnes WebLog administrieren');
define(_PNWEBLOGUSERNAME,'Inhaber');
define(_PNWEBLOGTITLE,'Titel');
define(_PNWEBLOGADMINISTRATETHISWEBLOG,'Administration fortfahren');
define(_PNWEBLOGCHOSENWEBLOG,'Ausgewähltes Weblog');
define(_PNWEBLOGFROM,'von');
define(_PNWEBLOGDELLINK,'Link löschen');
define(_PNWEBLOGFUNCTIONEXECUTED,'Administrationsbefehl wurde ausgeführt');

define(_PNWEBLOGADMINTEXT,'Bitte die obigen Links nutzen um zur entsprechenden Administrationsoberfläche zu gelangen');
// menu
define(_PNWEBLOGADMINMAIN ,'Verwaltung der WebLogs');
define(_PNWEBLOGADMINPREFERENCES,'Globale Einstellungen');
define(_PNWEBLOGADMINMAININFO,'Administrations-Startseite');
// preferences
define(_PNWEBLOGADMINPANELPREFERENCES,'Globale Einstellungen');
define(_PNWEBLOGUSESHORTURL,'Kurze URL nutzen');
define(_PNWEBLOGUSESHORTURLREQUIREMENTS,'Voraussetzungen hierfür siehe modules/pnWebLog/pndocs/INSTALL.txt');
define(_PNWEBLOGSUBDOMAINEXPLANATION,'DNS-Catchall muss für Domain / Subdomain gesetzt sein');
define(_PNWEBLOGSUBDOMAIN,'Catchall-Bereich der Subdomain (z.B. blogs.mydomain.de für Useradressen in der Form von MusterBenutzer.blogs.mydomain.de)');
define(_PNWEBLOGBLOGSPERPAGE,'Anzahl der WebLogs die auf der Übersichtsseite auf einer Seite dargestellt werden sollen');
define(_PNWEBLOGUPDATEPREFERENCES,'Globale Einstellungen so speichern');
define(_PNWEBLOGADMININTROTEXTPREFERENCES,'Diese Einstellungen sind global für alle WebLogs wirksam.');
define(_PNWEBLOGHTACCESS,'.htaccess-Datei');
define(_PNWEBLOGHTACCESSUPDATEDAFTERSTORINGDATA,'Folgender Inhalt muss am Ende der .htaccess-Datei manuell angefügt werden.');

//info page
define(_PLEASECHECKRSSFILE,'Die backpnweblog.php wurde nicht im Wurzelverzeichnis der PostNuke-Installation gefunden. Mehr Informationen siehe modules/pnWebLos/pndoc/INSTAL.txt');
define(_XINHANOTINSTALLED,'Bitte das Modul xinha installieren und in xinha dieses für pnWebLog aktivieren (siehe Installationsdatei von pnWebLog), damit die Benutzer auch einen einfachen Editor für ihr WebLog nutzen können!');
define(_PNBBCODENOTINSTALLED,'Bitte das Modul pn_bbcode installieren und es für pnWebLog als HOOK aktivieren');
define(_PNBBSMILENOTINSTALLED,'Bitte das Modul pn_bbsmile installieren und es für pnWebLog als HOOK aktivieren');
define(_PLEASECOPYSEARCHINCLUDE,'Wenn die WebLogs in die Suche der Gesamtseite einbezogen werden sollen bitte wie in der pndocs/INSTALL.txt beschrieben die entsprechende Datei verlinken oder kopieren');
?>