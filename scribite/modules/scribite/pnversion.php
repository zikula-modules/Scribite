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

$dom = ZLanguage::getModuleDomain('scribite');

$modversion['name'] = 'scribite';
$modversion['displayname'] = __('scribite', $dom);
$modversion['url'] = __('scribite', $dom);
$modversion['version'] = '4.0';
$modversion['description'] = 'Editors for Zikula';
$modversion['credits'] = 'pndocs/credits.txt';
$modversion['help'] = 'pndocs/scribite!-documentation-eng.pdf';
$modversion['changelog'] = 'pndocs/changelog.txt';
$modversion['license'] = 'pndocs/license.txt';
$modversion['official'] = 0;
$modversion['author'] = 'sven schomacker aka hilope';
$modversion['contact'] = 'http://code.zikula.org/scribite/';
$modversion['admin'] = 1;
$modversion['securityschema'] = array('scribite::' => 'Modulename::');

