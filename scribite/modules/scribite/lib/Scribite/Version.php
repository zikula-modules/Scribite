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

class PageMaster_Version extends Zikula_Version
{
    public function getMetaData()
    {
        $meta = array();
        $modversion['displayname'] = 'scribite!';
        $modversion['url'] = $this->__('scribite');
        $modversion['version'] = '4.2.1';
        $modversion['description'] = $this->__('WYSIWYG for Zikula');
        $modversion['contact'] = 'sven schomacker aka hilope - http://code.zikula.org/scribite/';
        $modversion['securityschema'] = array('Scribite::' => 'Modulename::');
        return $meta;
    }
}