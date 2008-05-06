<?php 
// $Id: pnRender.php,v 1.1 2005/04/29 17:01:44 larsneo Exp $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2001 by the PostNuke Development Team.
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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
/**
 * pnRender - PostNuke wrapper class for Smarty
 * 
 * Language file for pnRender block
 * 
 * @author      Frank Schummertz 
 * @version     .7/.8
 * @link        http://www.post-nuke.net              PostNuke home page
 * @link        http://smarty.php.net                 Smarty home page
 * @license     http://www.gnu.org/copyleft/gpl.html  GNU General Public License
 * @package     Xanthia_Templating_Environment
 * @subpackage  pnRender
 */
 
define('_PNRENDERBLOCK_MODULENAME',   'Modulname');
define('_PNRENDERBLOCK_TEMPLATENAME', 'Templatedatei');
define('_PNRENDERBLOCK_HINT',         'Die Templatedatei muss sich im /pntemplates Verzeichnis des genannten Moduls befinden');
define('_PNRENDERBLOCK_NOBLOCK',      'kein Block definiert');
define('_PNRENDERBLOCK_NOMODULE',     'kein Modul: ');
define('_PNRENDERBLOCK_PARAMETERS',   'Parameter (im Format assign=value;assign2=value2...)');

?>