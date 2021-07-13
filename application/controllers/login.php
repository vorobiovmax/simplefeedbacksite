<?php

namespace Application\Controllers\Login;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/page.php';


use Application\Services;
use Application\Common\Page;


function runLoginPage(): string {
    if(Services\User\isAuthorized()) {
        Page\redirect('index', 303);
    }

    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    $displayData = array(
        'pageTitle' => 'Страница авторизации',
        'formTitle' => 'Авторизация',
        'autocompleteLogin' => $login
    );

    if(isset($_POST['action']) && $_POST['action'] === 'login') {
        try {
            Services\User\authorize($login, $password);
            Page\redirect('index', 303);
        } catch (\Exception $exception) {
            $displayData['errors'] = array($exception->getMessage());
        }
    }

    return Page\renderContent('login', $displayData);
}
