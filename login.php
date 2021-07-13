<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/controllers/login.php';


use function Application\Controllers\Login\runLoginPage;


define('ENTRY_POINT_USED', true);
echo runLoginPage();