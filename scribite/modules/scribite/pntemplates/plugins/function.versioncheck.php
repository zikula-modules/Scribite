<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @version    $Id$
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 * @category   Zikula_Extension
 * @package    Utilities
 * @subpackage scribite!
 */

// This plugin checks current version for scribite (func="version") or will
// check if a newer version is available for download.

function smarty_function_versioncheck()
{
    // check module version
    // some code based on work from Axel Guckelsberger - thanks for this inspiration
    $currentversion = pnModGetInfo(pnModGetIDFromName('scribite'));
    $currentversion = trim($currentversion['version']);

    // current version
    $output = $currentversion;

    // get newest version number
    require_once('Snoopy.class.php');
    $snoopy = new Snoopy;
    $snoopy->fetchtext("http://scribite.de/scribite_version.txt");
    //$snoopy->fetchtext("http://localhost/scribite_version.txt");

    $newestversion = $snoopy->results;
    $newestversion = trim($newestversion);

    if (!$newestversion)
    {
        // newest version check not possible, so return only current version number
        echo($output);
        return;
    }

    if ($currentversion < $newestversion)
                          {
        // generate info link if new version is available
        $output .= " (<a id=\"versioncheck\" href=\"javascript:showInfo('http://scribite.de/scribite_verinfo.htm')\" style=\"color:red;\"><strong>".$newestversion." available</strong></a>)";
        //$output .= " (<a id=\"versioncheck\" href=\"javascript:showInfo('http://localhost/scribite_verinfo.htm')\" style=\"color:red;\"><strong>".$newestversion." available</strong></a>)";
    }
    echo($output);
    return;
}

