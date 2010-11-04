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

class Scribite_Version extends Zikula_Version
{
    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = 'Scribite!';
        $meta['oldnames'] = array('scribite');
        $meta['url'] = $this->__('scribite');
        $meta['version'] = '4.2.2';
        $meta['description'] = $this->__('WYSIWYG for Zikula');
        $meta['securityschema'] = array('Scribite::' => 'Modulename::');
        return $meta;
    }
}