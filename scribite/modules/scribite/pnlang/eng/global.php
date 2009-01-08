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
define('_EDITOR', 'scribite!');
define('_EDITORINFO', 'WYSIWYG for Zikula');
define('_EDITORNOCONFCHANGE', 'Configuration not updated');
define('_EDITORMODTITLE', 'Modules');
define('_EDITORUPDATE', 'Save Configuration');
define('_EDITORUPDATED', 'Configuration updated');
define('_EDITORSPATH', 'Editorpath');
define('_JSWARNING', 'Folder /modules/scribite/pnincludes is deprecated and should be deleted!');
define('_ADDMOD', 'add module');
define('_EDITMOD', 'edit module');
define('_DELMOD', 'delete module');
define('_DELMODQUESTION', 'Do you really want to remove the following module?');
define('_MODNAME', 'module name');
define('_MODFUNCS', 'module functions (komma separated, "all" for all funcs)');
define('_MODAREAS', 'textarea-ID\'s (komma separated, "all" for all areas)');
define('_MODEDITOR', 'editor');
define('_WARNING', 'Warning');
define('_JSQACTIVATED', 'JS Quick Tags are activated.<br />For proper use you should deactivate this in Zikula Settings');
define('_DEFAULTEDITOR', 'Default editor');
// v3.x
define('_ERRORCREATINGHOOK', 'Error creating Hook!'); //en
define('_HOOKHINT', '<strong>scribite!</strong> was activated as core hook. You can check settings <a href="index.php?module=Modules&type=admin&func=hooks&id=0">here</a>!<br />The template plugin from previous versions of scribite! can removed from templates.'); //en
define('_VERSIONHINT', 'This version from scribite! only works with Zikula 1.1.x and higher. Please upgrade your Zikula version or use scribite! version 2.x .'); //en

// xinha
define('_XINHASETTINGS', 'Xinha');
define('_XINHALANGUAGE', 'Language');
define('_XINHASKIN', 'Skin');
define('_XINHABARMODE', 'Toolbar');
define('_XINHABARMODE0', 'full');
define('_XINHABARMODE1', 'reduced');
define('_XINHABARMODE2', 'mini');
define('_XINHAWINDOW', 'Editor width and height');
define('_XINHASTATUSBAR', 'Statusbar');
define('_XINHASTYLE', 'Editor-Stylesheet');
define('_XINHACONVERTURLS', 'Convert urls to links');
define('_XINHASHOWLOADING', 'Show loading');
define('_XINHAPLUGINS', 'Xinha Plugins (<a href="http://xinha.python-hosting.com/wiki/Plugins" target="_blank">documentation</a>)');

// tinymce
define('_TINYMCESETTINGS', 'TinyMCE');
define('_TINYMCELANGUAGE', 'Editorlanguage');
define('_TINYMCETHEME', 'Theme');
define('_TINYMCEDATEFORMAT', 'Date format');
define('_TINYMCETIMEFORMAT', 'Time format');
define('_TINYMCEWINDOW', 'Editor width and height');
define('_TINYMCESTYLE', 'Editor-Stylesheet');
define('_TINYMCEASK', 'Ask for editor');
define('_TINYMCEPLUGINS', 'TinyMCE Plugins (<a href="http://wiki.moxiecode.com/index.php/TinyMCE:Plugins" target="_blank">documentation</a>)');
define('_TINYMCEMCPUK', 'TinyMCEMCPUK');

// fckeditor
define('_FCKEDITORSETTINGS', 'FCKeditor');
define('_FCKEDITORLANGUAGE', 'Editorlanguage');
define('_FCKEDITORAUTOLANG', 'automatic language');
define('_FCKEDITORBARMODE', 'Toolbar');
define('_FCKEDITORSKIN', 'Skin');
define('_FCKEDITORWINDOW', 'Editor width and height');
define('_FCKEDITORPLUGINS', 'FCKeditor Plugins (<a href="http://wiki.fckeditor.net/" target="_blank">documentation</a>)');

// openwysiwyg
define('_OPENWYSIWYGSETTINGS', 'openWYSIWYG');
define('_OPENWYSIWYGBARMODE', 'Toolbar');
define('_OPENWYSIWYGBARMODE0', 'full');
define('_OPENWYSIWYGBARMODE1', 'reduced');
define('_OPENWYSIWYGWINDOW', 'Editor width and height');

// NicEdit
define('_NICEDITORSETTINGS', 'NicEdit');
define('_NICEDITORFULLPANEL', 'Full toolbar');

// YUI
define('_YUISETTINGS', 'YUI Editor');
define('_YUITYPE', 'Toolbar');
define('_YUIWINDOW', 'Editor width and height');
define('_YUIDOMBAR', 'Statusbar');
define('_YUIANIMATE', 'Animation');
define('_YUICOLLAPSE', 'Collapsable');