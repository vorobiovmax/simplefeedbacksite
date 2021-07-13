<?php

namespace Application\Services\Form;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/models/form.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/exceptions/notauthorizedexception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/services/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/exceptions/backendvalidationexception.php';


use Application\Exceptions\BackendValidationException;
use Application\Exceptions\FormAddException;
use Application\Exceptions\FormDeleteException;
use Application\Exceptions\FormsNotFindException;
use Application\Exceptions\FormUpdateException;
use Application\Exceptions\NotAuthorizedException;
use Application\Services;
use Application\Models;


/**
 * @public
 * @throws FormAddException
 * @throws BackendValidationException
 * @throws NotAuthorizedException
 */
function send(array $fields): void {
    if(!Services\User\isAuthorized()) {
        throw new NotAuthorizedException('Для работы с формами нужно быть авторизованым');
    }

    checkFields($fields);

    Models\Form\add($fields);
}

/**
 * @public
 * @throws FormsNotFindException
 * @throws NotAuthorizedException
 */
function getAll(): array {
    if(!Services\User\isAuthorized()) {
        throw new NotAuthorizedException('Для работы с формами нужно быть авторизованым');
    }

    return Models\Form\findAll();
}

/**
 * @public
 * @throws FormsNotFindException
 * @throws NotAuthorizedException
 */
function get(int $formId): array {
    if(!Services\User\isAuthorized()) {
        throw new NotAuthorizedException('Для работы с формами нужно быть авторизованым');
    }

    return Models\Form\findById($formId);
}

/**
 * @public
 * @throws NotAuthorizedException
 * @throws FormDeleteException
 */
function delete(int $formId): void {
    if(!Services\User\isAuthorized()) {
        throw new NotAuthorizedException('Для работы с формами нужно быть авторизованым');
    }

    Models\Form\delete($formId);
}

/**
 * @public
 * @throws BackendValidationException
 * @throws NotAuthorizedException
 * @throws FormUpdateException
 */
function update(int $formId, array $data): void {
    if(!Services\User\isAuthorized()) {
        throw new NotAuthorizedException('Для работы с формами нужно быть авторизованым');
    }

    checkFields($data);

    Models\Form\update($formId, $data);
}

/**
 * @private
 * @throws BackendValidationException
 */
function checkFields($data) {
    $exceptionMessages = null;

    if (mb_strlen($data['name'] ?? '') < 2) {
        $exceptionMessages[] = 'Введите имя длиннее 2-х символов';
    }

    if (!preg_match('/^[a-zа-яё. ]+$/iu', $data['name'] ?? '')) {
        $exceptionMessages[] = 'При вводе имени используйте только буквы, точки, пробелы';
    }

    if (empty($data['story'])) {
        $exceptionMessages[] = 'Расскажите историю';
    }

    if (empty($data['sex'])) {
        $exceptionMessages[] = 'Выберите пол';
    }

    if(!empty($exceptionMessages)) {
        throw new BackendValidationException(implode('|', $exceptionMessages));
    }
}
