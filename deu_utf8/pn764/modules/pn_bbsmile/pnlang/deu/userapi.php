<?php
// $Id: userapi.php,v 1.2 2005/08/08 09:02:56 larsneo Exp $
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
// Original Author of file: Hinrich Donner
// changed to pn_bbsmile: larsneo
// ----------------------------------------------------------------------

// include smilie alternative text defines
@include_once('modules/pn_bbsmile/pnlang/deu/smilies.php');

define('_PNBBSMILE_NOSCRIPTWARNING',           'Ihr Browser unterstützt kein Javascript oder Javascript ist deaktiviert. Einige Features dieser Seite werden daher nicht funktionieren.');
define('_PNBBSMILE_ARGSERROR',                 '[pn_bbsmile] Interner Fehler! Parameter fehlen!');
define('_PNBBSMILE_MORESMILIES',               'Weitere Smilies');

define('_PNBBSMILE_SHOWHIDE_SMILIES','Smilies ein-/ausblenden');

?>