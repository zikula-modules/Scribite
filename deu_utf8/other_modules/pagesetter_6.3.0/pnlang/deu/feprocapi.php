<?php
/**
 * German Translation for PostNuke Pagesetter module
 * 
 * @package Pagesetter module
 * @subpackage Languages
 * @version $Id: feprocapi.php,v 1.3 2004/09/19 19:35:21 jornlind Exp $
 * @author Jorn Lind-Nielsen 
 * @link http://www.elfisk.de The Pagesetter Home Page
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */

define('_PGFEP_SUBMIT', 'Pagesetter Eingabeformular');
define('_PGFEP_SUBMITDESCR', 'Speichert Formulardaten in einer Pagesetter Publikation.');
define('_PGFEP_SUBMITTID', 'Pagesetter Typ-ID');
define('_PGFEP_SUBMITTOPIC', 'Themen-ID');
define('_PGFEP_SUBMITAUTHOR', 'Autor');
define('_PGFEP_SUBMITSTATE', 'Status des Workflows');
define('_PGFEP_SUBMITHELP', '<p>Erzeugt eine neue Pagesetter Publikation mit der angegebenen Typ-ID. Thema und Autor müssen als Teil der Handler Konfiguration angegeben werden, während die übrigen Publikationsdaten hart codiert werden.</p><p>Alle Werte der benutzdefinierten Felder werden dem Eingabeformular entnommen und übermittelt, bevor der Pagesetter Handler ausgeführt wird. Die Werte der Formularfelder werden in der Form Feldname&mdash;FormExpress-Feldname abgeglichen und müssen den Pagesetter Feldnamen entsprechen.</p>');

?>
