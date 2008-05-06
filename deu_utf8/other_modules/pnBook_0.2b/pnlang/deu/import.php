<?php
// $Id: import.php 33 2006-01-03 13:47:18Z philipp $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2002 by the PostNuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// $Log: import.php,v 2.0
// Revision 2.0  2005/12/27 23:32:00  Philipp Niethammer
//      Adding Language-defines for import of v. 0.2
//
// ----------------------------------------------------------------------

/**
 *
 * @version      $Id: import.php 33 2006-01-03 13:47:18Z philipp $
 * @author       $Author: philipp $
 * @link         http://www.guite.de
 * @copyright    Copyright (C) 2005 by Guite
 * @license      http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */

include_once('modules/'. pnModGetName() . '/pnlang/deu/global.php');

define('_PNBOOKMODNOTAVAILABLE', "Das ausgewählte Fremdmodul ist nicht installiert.");
define('_PNBOOKIMPORTOPTIONS', "Optionen");
define('_PNBOOKIMPORTSETTINGS', "Einstellungen vom Fremdmodul übernehmen");
define('_PNBOOKIMPORTNEXTSTEP', "Nächster Schritt");
define('_PNBOOKIMPORTMODDEACTIVATE', "Fremdmodul deaktivieren");
define('_PNBOOKIMPORTMODDELETE', "Fremdmodul löschen");
define('_PNBOOKIMPORTFROM', "Quellmodul zur Importierung");
