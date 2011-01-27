<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */

class Scribite_Version extends Zikula_Version
{
    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = 'Scribite!';
        $meta['oldnames'] = array('scribite');
        $meta['url'] = $this->__('scribite');
        $meta['version'] = '4.2.3';
        $meta['core_min'] = '1.3.0';
        $meta['description'] = $this->__('WYSIWYG for Zikula');
        $meta['securityschema'] = array('Scribite::' => 'Modulename::',
                                        'Scribite:openwysiwyg:selectimage' => '::',
                                        'Scribite:openwysiwyg:uploadimage' => '::',
                                     );
        return $meta;
    }
}