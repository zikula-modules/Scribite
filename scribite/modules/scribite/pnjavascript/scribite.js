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
 * @author sven schomacker
 * @version $Id$
 */

function showInfo(location) {
	var win = new Window({className: "alphacube",
			      title: "scribite! info browser", 
			      top:100, left:100, width:500, height:400, 
			      url: location,
			      showEffectOptions: {duration:1.5}})
	win.show(); 
}


