<?php
/************************************************************************
 * pnForum - The Post-Nuke Module                                       *
 * ==============================                                       *
 *                                                                      *
 * Copyright (c) 2001-2004 by the pnForum Module Development Team       *
 * http://www.pnforum.de/                                               *
 ************************************************************************
 * Modified version of:                                                 *
 ************************************************************************
 * phpBB version 1.4                                                    *
 * begin                : Wed July 19 2000                              *
 * copyright            : (C) 2001 The phpBB Group                      *
 * email                : support@phpbb.com                             *
 ************************************************************************
 * License                                                              *
 ************************************************************************
 * This program is free software; you can redistribute it and/or modify *
 * it under the terms of the GNU General Public License as published by *
 * the Free Software Foundation; either version 2 of the License, or    *
 * (at your option) any later version.                                  *
 *                                                                      *
 * This program is distributed in the hope that it will be useful,      *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of       *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        *
 * GNU General Public License for more details.                         *
 *                                                                      *
 * You should have received a copy of the GNU General Public License    *
 * along with this program; if not, write to the Free Software          *
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 *
 * USA                                                                  *
 ************************************************************************
 *
 * german language defines
 * @version $Id: init.php,v 1.4 2005/11/05 12:46:21 landseer Exp $
 * @author Andreas Krapohl, Frank Schummertz, Steffen Voss
 * @copyright 2004 by Andreas Krapohl, Frank Schummertz, Steffen Voss
 * @package pnForum
 * @license GPL <http://www.gnu.org/licenses/gpl.html>
 * @link http://www.pnforum.de
 *
 ***********************************************************************/

define('_PNFORUM_WELCOMETOINTERACTIVEUPGRADE', 'pnForum Upgrade');
define('_PNFORUM_OLDVERSION', 'alte Version');
define('_PNFORUM_NEWVERSION', 'neue Version');
define('_PNFORUM_NEXTVERSION', 'nächste Version');

define('_PNFORUM_BACKUPHINT', 'Vor der Durchführung dieses Upgrades<br />bitte eine Sicherung der Datenbank erstellen!');
define('_PNFORUM_UPGRADE_ADDINDEXNOW', 'Indexfelder jetzt anlegen');
define('_PNFORUM_UPGRADE_ADDINDEXLATER', 'Indexfelder manuell in phpmyadmin o.ä anlegen');

define('_PNFORUM_TO25_HINT', 'Das Upgrade auf Version 2.5 beinhaltet einige Datenbankänderungen, u.a. das Hinzufügen zweier Indexfelder, um die Volltextsuche zu beschleunigen. Dies könnte auf manchem Systemen aufgrund der Laufzeitbegrenzung von PHP-Skripten in Zusammenhang mit einem großen Datenbestand zu Problemen führen.<br /><br />');
define('_PNFORUM_TO25_FAILED', 'Upgrade auf pnForum 2.5 fehlgeschlagen');

define('_PNFORUM_TO26_HINT', 'Das Upgrade auf Version 2.6 beinhaltet einige Datenbankänderungen, um pnForum als Kommentarmodul zu verwenden.<br />');
define('_PNFORUM_TO26_FAILED', 'Upgrade auf pnForum 2.6 fehlgeschlagen');

?>