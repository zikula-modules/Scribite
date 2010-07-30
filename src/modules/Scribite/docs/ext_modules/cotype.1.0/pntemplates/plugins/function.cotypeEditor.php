<?php
/**
 * CoType
 *
 * @copyright (C) 2007, Jorn Wildt
 * @link http://www.elfisk.dk
 * @version $Id$
 * @license See license.txt
 */

function smarty_function_cotypeEditor($params, &$render) 
{
  $inputId = $params['inputId'];
  $documentId = (int)$params['documentId'];

  static $firstTime = true;

  if ($firstTime)
  {
    PageUtil::AddVar('javascript', 'javascript/ajax/prototype.js');

    $moduleStylesheet = '../../../../' . ThemeUtil::getModuleStylesheet('cotype','editor.css');
    $url = System::getBaseUrl(); 
    $head = "<script type=\"text/javascript\">
CoTypeStylesheet = '$moduleStylesheet';
CoTypeDocumentId = $documentId;
</script>";

    //global $additional_header;
    //$additional_header[] = $head;
    PageUtil::AddVar('rawtext', $head);
  }

  $firstTime = false;

  $html = "";

  return $html;
}

?>
