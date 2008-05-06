<?php
// $Id: user.php,v 1.1 2005/04/29 16:42:19 larsneo Exp $
// Xanthia Theme Engine FOR POST-NUKE Content Management System
// Copyright (C) 2003 by the CorpNuke.com Development Team.
// Copyright is claimed only on changes to original files
// Modifications by: Larry E. Masters aka. PhpNut 
// nut@phpnut.com
// http://www.coprnuke.com/
// ----------------------------------------------------------------------
// Based on: Encompass Theme Engine - http://madhatt.info/
// Original Autoher: Brian K. Virgin (MADHATter7)
// ----------------------------------------------------------------------
// Based on:
// eNvolution Content Management System
// Copyright (C) 2002 by the eNvolution Development Team.
// http://www.envolution.com/
// ----------------------------------------------------------------------
// Based on:
// Postnuke Content Management System - www.postnuke.com
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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html

/**
 * @package     Xanthia_Templating_Environment
 * @subpackage  Xanthia
 * @license http://www.gnu.org/copyleft/gpl.html
 * @author larsneo <larsneo@postnuke.com>
*/

// Global Defines
if (!defined('_XA_ARGSERROR')) {
	define('_XA_ARGSERROR','Fehler bei Xanthia Argumenten');
}
if (!defined('_XA_APILOADFAILED')) {
	define('_XA_APILOADFAILED','Fehler beim öffnen der Xanthia API');
}
if (!defined('_XA_BADAUTHKEY')) {
	define('_XA_BADAUTHKEY','keine Berechtigung');
}
if (!defined('_XA_COMPASSNOAUTH')) {
	define('_XA_COMPASSNOAUTH','keine Berechtigung für Xanthia Configurator');
}
if (!defined('_XA_COMPASSAPINOAUTH')) {
	define('_XA_COMPASSAPINOAUTH','keine Berechtigung für Xanthia Admin API.');
}
if (!defined('_XA_ANERROROCCURED')) {
	define('_XA_ANERROROCCURED','Bei Xanthia trat ein schwerwiegender Fehler auf');
}
if (!defined('_XA_NOMODINFO')) {
	define('_XA_NOMODINFO','keine Xanthia Modul-Info gefunden');
}
if (!defined('_XA_LOADADDONFAIL')) {
	define('_XA_LOADADDONFAIL','Ein Addon für das Skin konnte nicht geladen werden');
}

// Zone Related Defines
if (!defined('_XA_COMPASSNOZONES')) {
	define('_XA_COMPASSNOZONES','Keine Zonen in den API Argumenten angegeben');
}
if (!defined('_XA_INZONE')) {
	define('_XA_INZONE','in Zone');
}
if (!defined('_XA_MAINZONENOTPL')) {
	define('_XA_MAINZONENOTPL','Ein notwendiges Zone-Template konnte nicht geladen werden');
}
if (!defined('_XA_NOZONEFOUND')) {
	define('_XA_NOZONEFOUND', 'folgende Zone wurde nicht gefunden:');
}
if (!defined('_XA_THEME')) {
	define('_XA_THEME', 'Theme');
}
?>