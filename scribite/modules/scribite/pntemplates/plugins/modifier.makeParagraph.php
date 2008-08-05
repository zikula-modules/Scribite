<?php
/**
 * Zikula Application Framework
 *
 * @copyright (c) 2001, Zikula Development Team
 * @link http://www.zikula.org
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 *
 * @package scribite!
 * @license http://www.gnu.org/copyleft/gpl.html
 *
 * @author Steffen Voss (kaffeeringe.de)
 * @version 1.0
 *
 * Use this modifier in order to set text in textare into paragraphs when
 * no ENTER is pressed in wysiwyg-editor and no p-tags have been added
 *
 */

function smarty_modifier_makeParagraph($string)
{
  if (substr($string, 0, 3)!="<p>") {
    return("<p>".$string."</p>");
  } else {
    return($string);
  }    
}

