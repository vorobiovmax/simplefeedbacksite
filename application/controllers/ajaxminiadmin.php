<?php

namespace Application\Controllers\AjaxMiniadmin;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/form.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/form.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/common/page.php';


use Application\Services;
use Application\Common;


define('ENTRY_POINT_USED', true);

function handleAjaxRequest() {
    if(empty($_POST['isAjax'])) {
        Common\Page\setResponseCode(400);
        die('Не ajax запрос!');
    }

    if(!Common\Form\isCsrfValid($_REQUEST['csrfToken'] ?? null)) {
        Common\Page\setResponseCode(400);
        die('Не делай CSRF!');
    }

    $action = $_POST['action'] ?? null;
    $response = null;
    $code = null;

    switch ($action) {
        case 'refresh':
            $displayData = array();

            try {
                $displayData = array(
                    'csrfToken' => Common\Form\getCsrf(),
                    'stories' => Services\Form\getAll()
                );

                $code = 200;
            } catch (\Exception $exception) {
                $displayData['error'] = $exception->getMessage();

                $code = 500;
            }

            $response = Common\Page\renderContent('miniadmincontent', $displayData, false);
        break;

        case 'delete':
            $formId = $_POST['formId'] ?? null;

            if(!empty($formId)) {
                try {
                    Services\Form\delete($formId);

                    $response = 'OK';
                    $code = 200;
                } catch (\Exception $exception) {
                    $response = $exception->getMessage();
                    $code = 500;
                }
            } else {
                $code = 400;
                $response = 'Не указан ID формы';
            }
        break;

        default:
            $code = 400;
            $response = 'Некорректный запрос';
        break;
    }

    Common\Page\setResponseCode($code);
    die($response);
}

handleAjaxRequest();