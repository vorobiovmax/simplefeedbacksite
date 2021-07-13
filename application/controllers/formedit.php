<?php


namespace Application\Controllers\FormEdit;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/form.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/form.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/page.php';


use Application\Services;
use Application\Common;


function runFormEditPage() {
    if (!Services\User\isAuthorized()) {
        Common\Page\redirect('login', 303);
    }

    $formId = $_REQUEST['formId'] ?? null;

    if(empty($formId)) {
        Common\Page\redirect('miniadmin', 303);
    }

    $displayData = array(
        'formTitle' => 'Редактирование формы',
        'csrfToken' => Common\Form\getCsrf(),
        'sendButtonTitle' => 'Изменить',
        'resetButtonNeeded' => false,
        'formActionParams' => array(
            'action' => 'update'
        ),
        'formId' => $formId
    );

    if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'update') {
        Common\Form\isCsrfValid($_POST['csrfToken'] ?? null) || die('Не делай CSRF!');

        $form = array(
            'name' => $_POST['name'] ?? null,
            'sex' => $_POST['sex'] ?? null,
            'story' => $_POST['story'] ?? null,
            'type' => $_POST['type'] ?? null,
            'publish' => $_POST['publish'] ?? null
        );

        try {
            Common\Form\validate($form);

            Services\Form\update(intval($formId), $form);

            Common\Page\redirect('miniadmin', 303);
        } catch (\Exception $exception) {
            $displayData = array_merge($displayData, Common\Form\prepareFormFieldsToDisplay($form));

            $displayData['errors'] = explode('|', $exception->getMessage());
        }
    } else {
        try {

            $form = Services\Form\get(intval($formId));
            $displayData = array_merge($displayData, Common\Form\prepareFormFieldsToDisplay($form));
        } catch (\Exception $exception) {
            Common\Page\redirect('miniadmin', 303);
        }
    }

    return Common\Page\renderContent('index', $displayData);
}