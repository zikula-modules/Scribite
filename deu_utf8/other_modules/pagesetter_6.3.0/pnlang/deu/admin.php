<?php
/**
 * German Translation for PostNuke Pagesetter module
 * 
 * @package Pagesetter module
 * @subpackage Languages
 * @version $Id: admin.php,v 1.31 2006/08/20 21:34:56 jornlind Exp $
 * @author Jorn Lind-Nielsen 
 * @author klausd
 * @author Jörg Napp 
 * @author Henning Hraban Ramm
 * @author Aleksander Vrcko
 * @link http://www.elfisk.de The Pagesetter Home Page
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */

require_once 'modules/pagesetter/guppy/lang/deu/global.php';
require_once 'modules/pagesetter/pnlang/deu/common.php';

define('_PGBACKTOADMIN', 'Zurück zur Administration');
define('_PGBTBACKTOPUBLIST', 'Zurück zu den Publikationen');
define('_PGCANCEL', 'Abbrechen'); //
define('_PGCOMMIT', 'Ausführen');
define('_PGCONFIGURATION', 'Pagesetter Konfiguration');
define('_PGCONFIGAUTOFILLPUBDATE', 'Veröffentlichungsdatum automatisch ausfüllen');
define('_PGCONFIGEDITOR', 'Editor');
define('_PGCONFIGEDITORENABLED', 'WYSIWYG-Editor einschalten');
define('_PGCONFIGEDITORSTYLED', 'Benutze die Style-Sheets aus dem Theme im Editor');
define('_PGCONFIGEDITORUNDO', 'Undo im Editor einschalten (verdeckt die Statuszeile)');
define('_PGCONFIGEDITORWORDKILL', 'Word Code Kill bei Paste im Editor einschalten');
define('_PGCONFIGGENERAL', 'Allgemein');
define('_PGCONFIGUPLOAD', 'Upload-Konfiguration');
define('_PGCONFIRMLISTDELETE', 'Sind Sie WIRKLICH sicher, dass Sie diese Liste löschen wollen?');
define('_PGCONFIRMPUBTYPEDELETE', 'Sind Sie WIRKLICH sicher, dass Sie diesen Publikationstyp löschen wollen - mit allen bereits angelegten Einträgen?');
define('_PGCREATETEMPLATES', 'Wählen Sie die Vorlagen aus, die automatisch generiert werden sollen');
define('_PGDEFAULTFOLDER', 'Voreingestelter Ordner');
define('_PGDEFAULTPUBTYPE', 'Default publication type (to display on frontpage)'); // ENG
define('_PGDEFAULTSUBFOLDER', 'Voreingestelter Unterordner');
define('_PGDESCRIPTION', 'Beschreibung');
define('_PGDOWNLOADINGSCHEMA', 'Der Download der Schema-Datei sollte jetzt starten. Sollte nicht passieren, klicken Sie bitte auf "Download"');
define('_PGDOWNLOAD', 'Download');
define('_PGEDIT', 'Ändern');
define('_PGNERROROTACCESSIBLEDIR', 'In das angegebene Verzeichnis kann nicht geschrieben werden!');
define('_PGERRORUPLOAD', 'Fehler beim Upload dieser Datei: ');
define('_PGERRORUPLOADDIREMPTY', 'Es wurde kein temporäres Upload-Verzeichnis angegeben. Legen Sie dieses Verzeichnis fest in Administration > Pagesetter > Konfiguration > Allgemein.');
define('_PGERRORUPLOADMOVE', 'Die Datei des Uploads konnte nicht verschoben werden von/nach: ');
define('_PGENABLEHOOKS', 'PostNuke-Hooks einschalten');
define('_PGENABLEREVISIONS', 'Revisionsprüfung einschalten');
define('_PGENABLEEDITOWN', 'Bearbeiten der eigenen Publikationen ermöglichen');
define('_PGENABLETOPICACCESS', 'Thematische Zugriffsberechtigung einschalten');
define('_PGEXPORT', 'Export');
define('_PGEXPORTFORM', 'Pagesetter Struktur exportieren');
define('_PGEXPORTSCHEMA', 'Export Datenbankstruktur (ohne Daten)');
define('_PGFIELDTYPE', 'Typ');
define('_PGFIELDISTITLE', 'Feld als Titel benutzen');
define('_PGFOLDERNOTINSTALLED', 'Order Modul nicht installiert');
define('_PGFOLDERNONE', 'Keine Ordner benutzen');
define('_PGFOLDERSETUP','Einstellungen zur benutzung mit dem Ordner Modul');
define('_PGFOLDERDEFAULT','Voreingellter Ordner');
define('_PGFOLDERDEFAULTTOPIC','Voreingestelltes/er Thema');
define('_PGFOLDERSUBDEFAULT','Voreingellter Unterordner');
define('_PGFOLDERSTRANSFERED', 'Alle Publikationen transferiert zum Ordner Modul');
define('_PGFTCREATEDDATE', 'Erstellt');
define('_PGFTMANDATORY', 'M'); // ENG
define('_PGFTMULTIPLEPAGES', 'MS');
define('_PGFTPUBLISHDATE', 'Veröffentlichungsdatum');
define('_PGFTSEARCHABLE', 'D');
define('_PGID', 'id');
define('_PGIMPORTPUBLICATIONS', 'Publikationen importieren');
define('_PGIMPORTARTICLE', 'Create Article'); // ENG
define('_PGIMPORTARTICLEDESC', 'Creates a new general purpose article publication type with title, text and image.'); // ENG
define('_PGIMPORTCE', 'Import von ContentExpress');
define('_PGIMPORTCEDESC', 'Erzeugt einen neuen Publikationstyp CE und importiert alle ContentExpress-Artikel.');
define('_PGIMPORTFILEUPLOAD', 'Erzeuge FileUpload');
define('_PGIMPORTFILEUPLOADDESC', 'Erzeugt einen neuen Publikationstyp zur behandlung generischer Datei-uploads. Dieser Typ wurde zur Zusammenarbeit mit dem Ordner Modul etwickelt');
define('_PGIMPORTIMAGE', 'Erzeuge Bild');
define('_PGIMPORTIMAGEDESC', 'Bildet einen neuen Publikationstyp zur behandlung von Bildern. Dieser Typ wurde zur Zusammenarbeit mit dem Ordner Modul etwickelt');
define('_PGIMPORTNEWS', 'News importieren');
define('_PGIMPORTNEWSDESC', 'Erzeugt einen neuen Publikationstyp PN-News und importiert alle PostNuke-News-Beiträge.');
define('_PGIMPORTNEWSEXTRA', 'Ein Bild-Feld hinzufügen');
define('_PGIMPORTPC', 'Import von PostCalendar');
define('_PGIMPORTPCDESC', 'Erzeugt einen neuen Publikationstype PostCalendar und importiert alle PostCalendar-Einträge.');
define('_PGIMPORTXMLSCHEMA', 'XML-Schema importieren');
define('_PGIMPORTXMLSCHEMADESC', 'Erzeugt einen neuen Publikationstyp, basierend auf der übermittelten Pagesetter XML-Schema-Datei.');
define('_PGIMPORTXMLSCHEMAFILE', 'XML-Schema Datei');
define('_PGINCLUDECAT', 'Kategorien einschließen');
define('_PGLISTEDIT', 'Listen bearbeiten');
define('_PGLISTITEMS', 'Elemente auflisten');
define('_PGLISTLIST', 'Listen');
define('_PGLISTSETUP', 'Einstellungen für Listen');
define('_PGLISTSHOWCOUNT', 'Anzahl von Publikationen in der Liste');
define('_PGLISTTITLE', 'Titel');
define('_PGMISSINGFIELDROW', 'You must add at least one publication field'); // ENG
define('_PGNAME', 'Name');
define('_PGNEWPUBINSTANCE', 'Neu');
define('_PGNEWLIST', 'Neue Liste');
define('_PGNOAUTH', 'Sie sind nicht berechtigt, diese Funktion zu benutzen.');
define('_PGNODEFAULTSUBFOLDER', 'Kein Ordner voreingestellt'); //
define('_PGNONE', 'Nichts');
define('_PGONLYONEPAGEABLE', 'Zur Seitentrennung kann nur ein Feld verwendet werden!');
define('_PGPAGESETTERBASEDIR', 'Pagesetter Installationsverzeichnis');
define('_PGPUBLICATIONFIELDS', 'Publikationsfelder');
define('_PGPUBLICATIONTYPES', 'Publikationstypen');
define('_PGPUBLICATIONTYPEEDIT', 'Konfiguration des Publikationstyps');
define('_PGPUBLICATIONTYPEADD1', 'Create new publication type'); // ENG
define('_PGPUBLICATIONTYPEADD2', 'Create templates and setup sorting'); // ENG
define('_PGPUBLIST', 'Liste');
define('_PGPUBTYPETITLE', 'Titel');
define('_PGPUBTYPEFILENAME', 'Vorlage'); 
define('_PGPUBTYPEFORMNAME', 'Formularname');
define('_PGPUBTYPETEMPLATES', 'Output template creation'); // ENG
define('_PGPUBTYPELISTGENERATE', 'Generate template for frontpage list'); // ENG
define('_PGPUBTYPELISTTEMPLATE', 'List template filename'); // ENG
define('_PGPUBTYPEFULLGENERATE', 'Generate template for full page display'); // ENG
define('_PGPUBTYPEFULLTEMPLATE', 'Full template filename'); // ENG
define('_PGPUBTYPEPRINTGENERATE', 'Generate template for printable version'); // ENG
define('_PGPUBTYPEPRINTTEMPLATE', 'Printable template filename'); // ENG
define('_PGPUBTYPERSSGENERATE', 'Generate template for RSS'); // ENG
define('_PGPUBTYPERSSTEMPLATE', 'RSS template filename'); // ENG
define('_PGPUBTYPEBLOCKGENERATE', 'Generate template for block list'); // ENG
define('_PGPUBTYPEBLOCKTEMPLATE', 'Block template filename'); // ENG
define('_PGPUBTYPEEDITCOLINFO', 'M = Mandatory, S = Searchable, MP = Multiple pages'); // ENG
define('_PGPUBTYPESHELP', '<p>This window is where you can add new publication types (for instance News,
        Recipies, or Articles&mdash;you choose yourself).</p>
        <p>Click on "New Publication Type" to define what database fields your 
        publication should consist of (for instance a Title field, an Intro text,
        and a Full text for a News publication).</p>
        <p>You can also install <em>predefined publication types</em>.
        Click on the menu "Tools:Import data" to get an overview.</p>'); // ENG
define('_PGREL_PUBLICATION_SELECT', 'Publication type'); // ENG
define('_PGREL_FIELD_SELECT', 'Field'); // ENG
define('_PGREL_STYLE_SELECT', 'Selector type'); // ENG
define('_PGREL_STYLE_ASPOPUP', 'Popup window'); // ENG
define('_PGREL_FILTER_INPUT', 'Standard filter'); // ENG
define('_PGREL_STYLE_SELECTLIST', 'List'); // ENG
define('_PGREL_STYLE_ADVANCEDSELECT', 'Split list'); // ENG
define('_PGREL_STYLE_CHECKBOX', 'Checkbox'); // ENG
define('_PGREL_STYLE_HIDDEN', 'Hidden (not shown)'); // ENG
define('_PGSORTCREATED', 'Erstellt am');
define('_PGSORTFIELD1', 'Erster Sortierschlüssel');
define('_PGSORTFIELD2', 'Zweiter Sortierschlüssel');
define('_PGSORTFIELD3', 'Dritter Sortierschlüssel');
define('_PGDEFAULTFILTER', 'Standardfilter');
define('_PGSETUPFOLDER', 'Übertrage Pagesetter Publikationen zum Ordner Modul'); //
define('_PGSETUPFOLDERNONESEL', 'Kein Ordner voreingestellt. Diese Publicationen können nicht übertragen werden.'); //
define('_PGSORTID', 'Publikations-ID');
define('_PGSORTDESC', 'Sortierung absteigend');
define('_PGSORTLASTUPDATED', 'Zuletzt geändert am');
define('_PGTITLE', 'Titel');
define('_PGTRANSFER', 'Übertragung');
define('_PGTS_EXTRATYPEINFO', 'Extra type information'); // ENG
define('_PGTS_EXTRATYPEINFOFOR', 'Extra type information for'); // ENG
define('_PGTS_PUBLICATION_SELECT', 'Select publication type'); // ENG
define('_PGTS_OK', 'Ok'); // ENG
define('_PGTS_CANCEL', 'Cancel'); // ENG
define('_PGTYPE', 'Typ'); //
define('_PGTYPESTRING', 'string');
define('_PGTYPETEXT', 'text');
define('_PGTYPEHTML', 'html');
define('_PGTYPEBOOL', 'bool');
define('_PGTYPEINT', 'int');
define('_PGTYPEREAL', 'real');
define('_PGTYPETIME', 'time');
define('_PGTYPEDATE', 'date');
define('_PGTYPEIMAGE', 'image (url)');
define('_PGTYPEIMAGEUPLOAD', 'Bild-Upload');
define('_PGTYPEUPLOAD', 'Beliebiger Upload');
define('_PGTYPEEMAIL', 'E-Mail');
define('_PGTYPEURL', 'Hyperlink');
define('_PGTYPECURRENCY', 'Währung');
define('_PGTYPEPUBID', 'Publikations-ID');
define('_PGUNKNOWNFOLDER', 'Unbekannter ordner'); //
define('_PGUPDATE', 'Aktualisieren');
define('_PGUPLOADDIR', 'Verzeichnis für Uploads');
define('_PGUPLOADDIRDOCS', 'Verzeichnis für Dokument-Uploads');
define('_PGVALUE', 'Wert');
define('_PGWFCFGLIST', 'Workflow-Konfiguration - Publikationstyp auswählen');
define('_PGWFCFG', 'Arbeitsablauf Konfiguration');
define('_PGWFWORKFLOW', 'Arbeitsablauf');
define('_PGWORKFLOW', 'Arbeitsablauf');

?>
