<?php

namespace Application\Controllers\Miniadmin;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/form.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/form.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/page.php';


use Application\Services;
use Application\Common;


function runMiniadminPage(): string {
    if (!Services\User\isAuthorized()) {
        Common\Page\redirect('login', 303);
    }

    $displayData = array();

    try {
        $displayData = array(
            'csrfToken' => Common\Form\getCsrf(),
            'stories' => Services\Form\getAll()
        );
    } catch (\Exception $exception) {
        $displayData['error'] = $exception->getMessage();
    }

    return Common\Page\renderContent('miniadmin', $displayData);
}