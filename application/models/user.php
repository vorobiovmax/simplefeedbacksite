<?php

namespace Application\Models\User;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/database/connection.php';


use PDO;
use function Application\Database\getPDO;


/**
 * @private
 */
function getPassword($login) {
    $dbh = getPDO();
    $query = 'select `password` from user where `login` = :login';
    $sth = $dbh->prepare($query);
    $sth->execute(array(
        'login' => $login
    ));
    return $sth->fetch(PDO::FETCH_COLUMN);
}
