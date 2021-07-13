<?php

namespace Application\Services\User;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/models/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/main/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/exceptions/passwordverifyexception.php';


use Application\Exceptions\PasswordVerifyException;
use Application\Models;
use Application\Main\Session;


/**
 * @public
 * @throws PasswordVerifyException
 */
function authorize($login, $password): void {
    $passwordHash = Models\User\getPassword($login);

    if (password_verify($password, $passwordHash)) {
        Session\sessionSetParam('USER', $login);
    } else {
        throw new PasswordVerifyException('Неверный логин или пароль');
    }
}

/**
 * @public
 */
function isAuthorized(): bool {
    $user = Session\sessionGetParam('USER');
    return !empty($user);
}
