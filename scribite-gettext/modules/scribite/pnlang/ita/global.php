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
 *
 * @translator Wilfried Santer and Giacomo (Arthens)
 */

// common
define('_EDITORDOWNLOADS', 'You can download additional editors Xinha, FCKeditor, TinyMCE, nicedit and openwysiwyg at <a href="http://code.zikula.org/downloads">http://code.zikula.org/downloads</a>!');
define('_EDITOR', 'scribite!');
define('_EDITORINFO', 'WYSIWYG per Zikula');
define('_EDITORNOCONFCHANGE', 'Configurazione non salvata');
define('_EDITORMODTITLE', 'Moduli');
define('_EDITORUPDATE', 'Salva Impostazioni');
define('_EDITORUPDATED', 'Configurazione salvata');
define('_EDITORSPATH', 'Percorso dell\'editor');
define('_JSWARNING', 'La cartella /modules/scribite/pnincludes � deprecata e dovrebbe essere eliminata!');
define('_ADDMOD', 'aggiungi modulo');
define('_EDITMOD', 'modifica modulo');
define('_DELMOD', 'rimuovi modulo');
define('_DELMODQUESTION', 'Sei sicuro di voler rimuovere il modulo?');
define('_MODNAME', 'nome del modulo');
define('_MODFUNCS', 'funzioni del modulo (separare con la virgola, "all"
per tutte le funzioni)');
define('_MODAREAS', 'ID delle textarea (separare con la virgola, "all" per
tutte le aree)');
define('_MODEDITOR', 'editor');
define('_WARNING', 'Attenzione');
define('_JSQACTIVATED', 'I Quick Tags JavaScript sono attivati.<br />Per un corretto funzionamento dovresti disattivarli nelle Impostazioni di Zikula');
define('_DEFAULTEDITOR', 'Editor di default');
// v3.x
define('_ERRORCREATINGHOOK', 'Error creating Hook!'); //en
define('_HOOKHINT', '<strong>scribite!</strong> was activated as core hook. You can check settings <a href="index.php?module=Modules&type=admin&func=hooks&id=0">here</a>!<br />The template plugin from previous versions of scribite! can removed from templates.'); //en
define('_VERSIONHINT', 'This version from scribite! only works with Zikula 1.1.x and higher. Please upgrade your Zikula version or use scribite! version 2.x .'); //en

// xinha
define('_XINHASETTINGS', 'Xinha');
define('_XINHALANGUAGE', 'Lingua Editor');
define('_XINHASKIN', 'Skin');
define('_XINHABARMODE', 'Barra degli strumenti');
define('_XINHABARMODE0', 'completa');
define('_XINHABARMODE1', 'ridotta');
define('_XINHABARMODE2', 'minima');
define('_XINHAWINDOW', 'Dimensioni dell\'Editor');
define('_XINHASTATUSBAR', 'Barra di stato');
define('_XINHASTYLE', 'Foglio di stile dell\'Editor');
define('_XINHACONVERTURLS', 'Converti url in link');
define('_XINHASHOWLOADING', 'Mostra caricamento');
define('_XINHAPLUGINS', 'Xinha Plugins (<a href="http://xinha.python-hosting.com/wiki/Plugins" target="_blank">documentation</a>)');

// tinymce
define('_TINYMCESETTINGS', 'TinyMCE');
define('_TINYMCELANGUAGE', 'Lingua Editor');
define('_TINYMCETHEME', 'Tema');
define('_TINYMCEDATEFORMAT', 'formato della data');
define('_TINYMCETIMEFORMAT', 'formato dell\'ora');
define('_TINYMCEWINDOW', 'Dimensioni dell\'Editor');
define('_TINYMCESTYLE', 'Foglio di stile dell\'Editor');
define('_TINYMCEASK', 'Richiedi se attivare l\'editor');
define('_TINYMCEPLUGINS', 'TinyMCE Plugins (<a
href="http://wiki.moxiecode.com/index.php/TinyMCE:Plugins"
target="_blank">documentation</a>)');
define('_TINYMCEMCPUK', 'TinyMCEMCPUK');

// fckeditor
define('_FCKEDITORSETTINGS', 'FCKeditor');
define('_FCKEDITORLANGUAGE', 'Lingua Editor');
define('_FCKEDITORAUTOLANG', 'Impostazione automatica lingua');
define('_FCKEDITORBARMODE', 'Barra degli strumenti');
define('_FCKEDITORSKIN', 'Skin');
define('_FCKEDITORWINDOW', 'Dimensioni dell\'Editor');
define('_FCKEDITORPLUGINS', 'FCKeditor Plugins (<a
href="http://wiki.fckeditor.net/" target="_blank">documentation</a>)');

// openwysiwyg
define('_OPENWYSIWYGSETTINGS', 'openWYSIWYG');
define('_OPENWYSIWYGBARMODE', 'Barra degli strumenti');
define('_OPENWYSIWYGBARMODE0', 'completa');
define('_OPENWYSIWYGBARMODE1', 'ridotta');
define('_OPENWYSIWYGWINDOW', 'Dimensioni dell\'Editor');

// NicEdit
define('_NICEDITORSETTINGS', 'NicEdit');
define('_NICEDITORFULLPANEL', 'Barra degli strumenti completa');
define('_NICEDITORXHTML', 'XHTML (experimental)'); //eng

// YUI
define('_YUISETTINGS', 'YUI Editor'); //en
define('_YUITYPE', 'Toolbar'); //en
define('_YUIWINDOW', 'Editor width and height'); //en
define('_YUIDOMBAR', 'Statusbar'); //en
define('_YUIANIMATE', 'Animation'); //en
define('_YUICOLLAPSE', 'Collapsable'); //en