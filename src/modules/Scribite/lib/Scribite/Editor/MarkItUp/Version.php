<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */

class Scribite_Editor_MarkItUp_Version
{
    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = $this->__('MarkItUp');
        return $meta;
    }

    public function getDefaults()
    {
        return array(
            'markitup_width'  => '65%',
            'markitup_height' => '400px'
        );
    }
}
