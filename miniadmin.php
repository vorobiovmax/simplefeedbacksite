<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/controllers/miniadmin.php';


use function Application\Controllers\Miniadmin\runMiniadminPage;


define('ENTRY_POINT_USED', true);
echo runMiniadminPage();