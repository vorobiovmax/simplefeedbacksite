<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/controllers/index.php';


use function Application\Controllers\Index\runIndexPage;


define('ENTRY_POINT_USED', true);
echo runIndexPage();