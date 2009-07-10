<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) 2001, Zikula Development Team
 * @link http://www.zikula.org
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 *
 * @package scribite!
 * @license http://www.gnu.org/copyleft/gpl.html
 *
 * @author sven schomacker
 * @version $Id$
 */

// common
define('_EDITORDOWNLOADS', 'Zusätztliche Editoren wie Xinha, FCKeditor, TinyMCE, nicedit und openwysiwyg können unter <a href="http://code.zikula.org/downloads">http://code.zikula.org/downloads</a> heruntergeladen werden!');
define('_EDITOR', 'scribite!');
define('_EDITORINFO', 'WYSIWYG für Zikula');
define('_EDITORNOCONFCHANGE', 'Konfiguration nicht aktualisiert');
define('_EDITORMODTITLE', 'Module');
define('_EDITORUPDATE', 'Konfiguration speichern');
define('_EDITORUPDATED', 'Konfiguration aktualisiert');
define('_EDITORSPATH', 'Editorpfad');
define('_JSWARNING', 'Der Ordner /modules/scribite/pnincludes ist nicht mehr nötig und kann gelöscht werden!');
define('_ADDMOD', 'Modul hinzufügen');
define('_EDITMOD', 'Modul bearbeiten');
define('_DELMOD', 'Modul löschen');
define('_DELMODQUESTION', 'Soll das Modul wirklich gelöscht werden?');
define('_MODNAME', 'Modulname');
define('_MODFUNCS', 'Modulfunktionen (kommasepariert, "all" für alle Funktionen)');
define('_MODAREAS', 'Textarea-ID\'s (kommasepariert, "all" für alle Textareas)');
define('_MODEDITOR', 'Editor');
define('_WARNING', 'Warnung');
define('_JSQACTIVATED', 'JS Quick Tags sind aktiviert.<br />Für eine einwandfreie Funktion sollte dies in den Zikula Einstellungen deaktiviert werden');
define('_DEFAULTEDITOR', 'Standardeditor');
define('_ERRORCREATINGHOOK', 'Hook konnte nicht erstellt werden!');
define('_HOOKHINT', '<strong>scribite!</strong> wurde als Core-Hook aktiviert. Die Einstellungen können <a href="index.php?module=Modules&type=admin&func=hooks&id=0">hier</a> überprüft werden!<br />Das Template-Plugin von älteren scribite!-Versionen kann aus den Templates entfernt werden.');
define('_VERSIONHINT', 'Diese Version von scribite! arbeitet nur mit Zikula 1.1.x und höher. Bitte ein Upgrade durchführen oder scribite! in Version 2.x benutzen.');

// xinha
define('_XINHASETTINGS', 'Xinha');
define('_XINHALANGUAGE', 'Editorsprache');
define('_XINHASKIN', 'Skin');
define('_XINHABARMODE', 'Symbolleiste');
define('_XINHABARMODE0', 'voll');
define('_XINHABARMODE1', 'reduziert');
define('_XINHABARMODE2', 'mini');
define('_XINHAWINDOW', 'Editorbreite und -höhe');
define('_XINHASTATUSBAR', 'Statusbar');
define('_XINHASTYLE', 'Editor-Stylesheet');
define('_XINHACONVERTURLS', 'Urls in Links umwandeln');
define('_XINHASHOWLOADING', 'Laden des Editors anzeigen');
define('_XINHAPLUGINS', 'Xinha Plugins (<a href="http://xinha.python-hosting.com/wiki/Plugins" target="_blank">documentation</a>)');

// tinymce
define('_TINYMCESETTINGS', 'TinyMCE');
define('_TINYMCELANGUAGE', 'Editorsprache');
define('_TINYMCETHEME', 'Theme');
define('_TINYMCEDATEFORMAT', 'Datumsformat');
define('_TINYMCETIMEFORMAT', 'Zeitformat');
define('_TINYMCEWINDOW', 'Editorbreite und -höhe');
define('_TINYMCESTYLE', 'Editor-Stylesheet');
define('_TINYMCEASK', 'Editor erst auf Nachfrage aktivieren');
define('_TINYMCEPLUGINS', 'TinyMCE Plugins (<a href="http://wiki.moxiecode.com/index.php/TinyMCE:Plugins" target="_blank">documentation</a>)');
define('_TINYMCEMCPUK', 'TinyMCEMCPUK');

// fckeditor
define('_FCKEDITORSETTINGS', 'FCKeditor');
define('_FCKEDITORLANGUAGE', 'Editorsprache');
define('_FCKEDITORAUTOLANG', 'automatische Sprachwahl');
define('_FCKEDITORBARMODE', 'Symbolleiste');
define('_FCKEDITORSKIN', 'Skin');
define('_FCKEDITORWINDOW', 'Editorbreite und -höhe');
define('_FCKEDITORPLUGINS', 'FCKeditor Plugins (<a href="http://wiki.fckeditor.net/" target="_blank">documentation</a>)');

// openwysiwyg
define('_OPENWYSIWYGSETTINGS', 'openWYSIWYG');
define('_OPENWYSIWYGBARMODE', 'Symbolleiste');
define('_OPENWYSIWYGBARMODE0', 'voll');
define('_OPENWYSIWYGBARMODE1', 'reduziert');
define('_OPENWYSIWYGWINDOW', 'Editorbreite und -höhe');

// NicEdit
define('_NICEDITORSETTINGS', 'NicEdit');
define('_NICEDITORFULLPANEL', 'volle Toolbar');
define('_NICEDITORXHTML', 'XHTML (experimentell)');

// YUI
define('_YUISETTINGS', 'YUI Editor');
define('_YUITYPE', 'Symbolleiste');
define('_YUIWINDOW', 'Editorbreite und -höhe');
define('_YUIDOMBAR', 'Statusleiste');
define('_YUIANIMATE', 'Animation');
define('_YUICOLLAPSE', 'Verkleinern erlauben');