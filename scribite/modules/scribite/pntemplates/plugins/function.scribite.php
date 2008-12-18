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

function smarty_function_scribite($params, &$smarty)
{
    extract($params);
    unset($params);

    if(pnModAvailable('scribite'))
    {
        return pnModFunc('scribite', 'user', 'editorheader');
    }
}
