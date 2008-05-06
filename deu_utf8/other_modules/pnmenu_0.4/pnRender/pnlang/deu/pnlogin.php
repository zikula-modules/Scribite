<?php // File: $Id: pnlogin.php,v 1.1 2004/03/08 15:05:43 fschummertz Exp $ $Name:  $
// $Id: pnlogin.php,v 1.1 2004/03/08 15:05:43 fschummertz Exp $
// ----------------------------------------------------------------------
// POST-NUKE Content Management System
// Copyright (C) 2001 by the Post-Nuke Development Team.
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

define('_ASREGISTERED',' <a href="user.php?op=lostpassscreen&module=NS-LostPassword">Passwort vergessen?</a><br> Neu hier? <a href="user.php">Anmelden!</a>');
define('_BLOCKNICKNAME','Benutzername');
define('_BLOCKPASSWORD','Kennwort');
if (!defined('_REMEMBERME')) {
    define('_REMEMBERME','in Cookie speichern');
}
?>