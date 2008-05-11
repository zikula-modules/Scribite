<?php
/**
 * Smarty plugin to include ChCounter into Xanthia templates
 * 
 * Example
 *   <!--[chcounter]-->
 * 
 * @author       Sven Schomacker aka hilope
 * @since        02/03/2007
 *
 * If ChCounter is not installed in /counter from pn-root you have to modify line 24
 */

function smarty_function_chcounter($params, &$smarty) 
{
  extract($params); 
  unset($params);

  if (isset($GLOBALS['info']) && is_array($GLOBALS['info'])) {
    $title = strip_tags($GLOBALS['info']['title']);
  }
  $chCounter_visible = 1;	
  $chCounter_page_title = $title;
  include( 'counter/counter.php' );
}
?>
