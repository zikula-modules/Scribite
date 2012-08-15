<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */

class Scribite_Editor_YUI_Version
{
    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = $this->__('YUI Rich Text Editor');
        return $meta;
    }


    public function getOptions()
    {
        return array('yui_types' => self::getTypes());

    }

    // load names into array
    public function getTypes()
    {
        $types = array();
        $types[0] = array(
            'text'  => 'Simple',
            'value' => 'Simple'
        );
        $types[1] = array(
            'text'  => 'Full',
            'value' => 'Full'
        );
        return $types;
    }

}
