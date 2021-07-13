<?php

namespace Application\Controllers\Index;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/form.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/page.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/form.php';


use Application\Services;
use Application\Common;


function runIndexPage(): string {

    if (!Services\User\isAuthorized()) {
        Common\Page\redirect('login', 303);
    }

    $displayData = array(
        'formTitle' => 'Отправка формы',
        'csrfToken' => Common\Form\getCsrf(),
        'sendButtonTitle' => 'Отправить',
        'resetButtonNeeded' => true,
        'formActionParams' => array(
            'action' => 'send'
        )
    );

    if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'send') {
        Common\Form\isCsrfValid($_POST['csrfToken'] ?? null) || die('Не делай CSRF!');

        $form = array(
            'name' => $_POST['name'] ?? null,
            'sex' => $_POST['sex'] ?? null,
            'story' => $_POST['story'] ?? null,
            'type' => $_POST['type'] ?? null,
            'publish' => $_POST['publish'] ?? null
        );

        try{
            Common\Form\validate($form);

            Services\Form\send($form);

            Common\Page\redirect('index', 303);
        } catch (\Exception $exception) {
            $displayData = array_merge($displayData, Common\Form\prepareFormFieldsToDisplay($form));

            $displayData['errors'] = explode('|', $exception->getMessage());
        }
    }

    return Common\Page\renderContent('index', $displayData);
}
