<?php
// $Id: pninit.php 15324 2005-01-10 15:11:12Z markwest $
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2002 by the PostNuke Development Team.
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
// Original Author of file: Mark West
// Purpose of file:  Initialisation functions for Mailer
// ----------------------------------------------------------------------

/**
 * @package PostNuke_System_Modules
 * @subpackage Mailer
 * @license http://www.gnu.org/copyleft/gpl.html
*/
/**
 * initialise the template module
 * This function is only ever called once during the lifetime of a particular
 * module instance
 * @author Mark West
 * @return bool true if successful, false otherwise
 */
function Mailer_init()
{
    // Set up an initial value for a module variable.  Note that all module
    // variables should be initialised with some value in this way rather
    // than just left blank, this helps the user-side code and means that
    // there doesn't need to be a check to see if the variable is set in
    // the rest of the code as it always will be
    pnModSetVar('Mailer', 'mailertype', 1);
    pnModSetVar('Mailer', 'charset', 'utf-8');
    pnModSetVar('Mailer', 'encoding', '8bit');
    pnModSetVar('Mailer', 'contenttype', 'text/plain');
    pnModSetVar('Mailer', 'wordwrap', 50);
    pnModSetVar('Mailer', 'msmailheaders', false);
    pnModSetVar('Mailer', 'sendmailpath', '/usr/sbin/sendmail');
    pnModSetVar('Mailer', 'smtpauth', 1);
    pnModSetVar('Mailer', 'smtpserver', 'localhost');
    pnModSetVar('Mailer', 'smtpport', 25);
    pnModSetVar('Mailer', 'smtptimeout', 10);
    pnModSetVar('Mailer', 'smtpusername', '');
    pnModSetVar('Mailer', 'smtppassword', '');

    // Initialisation successful
    return true;
}

/**
 * upgrade the template module from an old version
 * This function can be called multiple times
 * @author Mark West
 * @param int $oldversion version to upgrade from
 * @return bool true if successful, false otherwise
 */
function Mailer_upgrade($oldversion)
{
    // Update successful
    return true;
}

/**
 * delete the Mailer module
 * This function is only ever called once during the lifetime of a particular
 * module instance
 * @author Mark West
 * @return bool true if successful, false otherwise
 */
function Mailer_delete()
{
    // Delete any module variables
    pnModDelVar('Mailer', 'mailertype');
    pnModDelVar('Mailer', 'charset');
    pnModDelVar('Mailer', 'encoding');
    pnModDelVar('Mailer', 'contenttype');
    pnModDelVar('Mailer', 'wordwrap');
    pnModDelVar('Mailer', 'msmailheaders');
    pnModDelVar('Mailer', 'sendmailpath');
    pnModDelVar('Mailer', 'smtpauth');
    pnModDelVar('Mailer', 'smtpserver');
    pnModDelVar('Mailer', 'smtpport');
    pnModDelVar('Mailer', 'smtptimeout');
    pnModDelVar('Mailer', 'smtpusername');
    pnModDelVar('Mailer', 'smtppassword');

    // Deletion successful
    return true;
}

?>
