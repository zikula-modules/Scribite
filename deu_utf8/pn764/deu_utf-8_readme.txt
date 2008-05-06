Neue Postnuke-Installation in utf-8
###################################
 - Einfach alle Sprachdateien für das entsprechende Postnuke-Paket einspielen.
 - Drittmodule mit den utf-8-kodierten Sprachdateien versehen.
 - Postnuke installieren.
 
 Das wars ;)
 
Upgrade einer ISO-8859-1(5) Installation auf utf-8
##################################################
Alle Schritte sollten sehr behutsam durchgeführt werden!
Das Wichtigste ist aber ein komplettes Backup aller Dateien und der Datenbank!

Alle Schritte werden auf eigene Gefahr durchgeführt. 

1.  Alle Dateien sichern!!!!!!
2.  Datenbank-Dump erstellen und sichern!
3.  Dump in einem geeigneten Texteditor öffnen und als utf-8 abspeichern (Original behalten als Backup!!!!)
4.  Alle relevanten Sprachdateien auf dem Server einspielen (Postnuke-Paket und alle externen Module)
5.  utf-Datenbank-Dump einspielen
6.  Administration:Mailer: Kodierung utf-8 eintragen
7.  Administration:pnRender: alle Templates und den Cache löschen
8.  Administration:Xanthia: alle Templates neu einlesen
9.  Menüeinträge, Zugriffsrechte und andere relevante Einstellungen auf Sonderzeichen prüfen und ggf. anpassen.
10. Seite testen und in utf-8 arbeiten :)

Zusätzliche Tools
#################
Im Paket sind zwei Modifier enthalten, die für pnRender-basierte Modulausgaben benutzt 
werden können, wenn externe Daten in ISO-Kodierung vorliegen (wie zum Beispiel 
RSS-Feeds von externen Seiten).
    Benutzung:
     * <!--[$details.info|utf8encode]-->
     *   or
     * <!--[$details.info|utf8decode]-->
     
Außerdem kann zu Umwandlung von Sprachpaketen, bzw. des Datenbankdumps das CharSetCon.exe-Tool verwendet werden.
  Aufruf:
    Datenbank-Dump:
    * CharSetConv.exe sqldump.sql
    PHP-Dateien (-r bedeutet rekursiv, also inklusive der Unterordner):
    * CharSetConv.exe -r *.php
  CharSetConv.exe wurde von Andreas Merkle (http://www.amerkle.org) geschrieben.
  Vielen Dank für dieses Tool.
