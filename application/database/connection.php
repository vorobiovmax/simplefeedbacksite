<?php

namespace Application\Database;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/database/settings/connectionparams.php';


use function Application\Database\Settings\getConnectionParams;
use PDO;


/**
 * @private
 */
function getPDO(): PDO {
    static $dbh;
    if (!($dbh instanceof PDO)) {
        $params = getConnectionParams();
        $dbh = new PDO($params['dns'], $params['user'], $params['password']);
    }
    return $dbh;
}
