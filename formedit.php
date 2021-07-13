<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/controllers/formedit.php';


use function Application\Controllers\FormEdit\runFormEditPage;


define('ENTRY_POINT_USED', true);
echo runFormEditPage();