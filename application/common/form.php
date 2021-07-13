<?php

namespace Application\Common\Form;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/main/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/exceptions/frontendvalidationexception.php';


use Application\Exceptions\FrontendValidationException;
use Application\Main\Session;


/**
 * @public
 */
function prepareFormFieldsToDisplay(array $form): array {
    $displayData = array();

    $displayData['text'] = array(
        'name' => $form['name'],
        'story' => $form['story']
    );

    $displayData['radio'] = array(
        'male' => $form['sex'] === 'male' ? 'checked' : null,
        'female' => $form['sex'] === 'female' ? 'checked' : null,
    );

    $displayData['checkbox'] = array(
        'love' => in_array('love', $form['type'] ?? array()) ? 'checked' : null,
        'war' => in_array('war', $form['type'] ?? array()) ? 'checked' : null,
        'funny' => in_array('funny', $form['type'] ?? array()) ? 'checked' : null,
    );

    $displayData['select'] = array(
        'magazine' => ($form['publish'] ?? null) === 'magazine' ? 'selected' : null,
        'newspaper' => ($form['publish'] ?? null) === 'newspaper' ? 'selected' : null,
        'book' => ($form['publish'] ?? null) === 'book' ? 'selected' : null
    );

    return $displayData;
}

/**
 * @public
 */
function validate(array $form) {
    $errors = array();

    if(mb_strlen($form['name']) < 2) {
        $errors[] = 'Имя короче 2-х символов';
    }

    if(!preg_match('/^[a-zа-яё. ]+$/iu', $form['name'])) {
        $errors[] = 'В имени должны быть только буквы';
    }

    if(empty($form['sex'])) {
        $errors[] = 'Не заполнен пол';
    }

    if(empty($form['story'])) {
        $errors[] = 'История должна быть рассказана';
    }

    if(empty($form['type'])) {
        $errors[] = 'Тип должен быть указан';
    }

    if(!empty($errors)) {
        throw new FrontendValidationException(implode('|', $errors));
    }
}

/**
 * @public
 */
function getCsrf() {
    if (is_null(Session\sessionGetParam('csrfToken'))) {
        Session\sessionSetParam('csrfToken', session_id());
    }

    return Session\sessionGetParam('csrfToken');
}

/**
 * @public
 */
function isCsrfValid(?string $csrfToken): bool {
    return $csrfToken === Session\sessionGetParam('csrfToken');
}