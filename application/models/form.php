<?php


namespace Application\Models\Form;


require_once $_SERVER['DOCUMENT_ROOT'] . '/application/database/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/exceptions/formaddexception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/exceptions/formdeleteexception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/exceptions/formsnotfindexception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/exceptions/formupdateexception.php';


use Application\Exceptions\FormAddException;
use Application\Exceptions\FormDeleteException;
use Application\Exceptions\FormsNotFindException;
use Application\Exceptions\FormUpdateException;
use function Application\Database\getPDO;
use PDO;


/**
 * @private
 * @throws FormAddException
 */
function add($data): void {
    if(is_array($data['type'])) {
        $data['type'] = implode(',', $data['type']);
    }

    $dbh = getPDO();
    $query = "insert into `form` (`name`, `sex`, `story`, `type`, `publish`) values (:name, :sex, :story, :type, :publish)";
    $sth = $dbh->prepare($query);

    $isSuccess = $sth->execute(array(
        'name' => $data['name'],
        'sex' => $data['sex'],
        'story' => $data['story'],
        'type' => $data['type'],
        'publish' => $data['publish']
    ));

    if(!$isSuccess) {
        throw new FormAddException('Не удалось добавить форму');
    }
}

/**
 * @private
 * @throws FormsNotFindException
 */
function findAll(): array {
    $dbh = getPDO();

    $query = "select * from `form` order by `id` desc";
    $sth = $dbh->prepare($query);

    $sth->execute();

    $result = array();
    while ($form = $sth->fetch(PDO::FETCH_ASSOC)) {
        $form['type'] = explode(',', $form['type']);

        $result[] = $form;
    }

    if(empty($result)) {
        throw new FormsNotFindException('Формы не найдены');
    }

    return $result;
}

/**
 * @private
 * @throws FormsNotFindException
 */
function findById(int $formId): array {
    $dbh = getPDO();

    $query = "select * from `form` where id = :id limit 1";
    $sth = $dbh->prepare($query);

    $sth->execute(array(
        'id' => $formId
    ));

    $form = $sth->fetchAll(PDO::FETCH_ASSOC)[0];


    if(empty($form)) {
        throw new FormsNotFindException('Форма не найдена');
    }

    $form['type'] = explode(',', $form['type']);

    return $form;
}



/**
 * @private
 * @throws FormUpdateException
 */
function update(int $rowId, $data): void {
    if(is_array($data['type'])) {
        $data['type'] = implode(',', $data['type']);
    }

    $dbh = getPDO();

    $updatableItems = array();
    foreach ($data as $type => $value) {
        $updatableItems[] = $type . ' = :' . $type;
    }

    $query = "update `form` set " . implode(', ', $updatableItems) . " where id = :id";
    $sth = $dbh->prepare($query);
    $data['id'] = $rowId;

    $isSuccess = $sth->execute($data);

    if(!$isSuccess) {
        throw new FormUpdateException('Не удалось обновить форму');
    }
}

/**
 * @private
 * @throws FormDeleteException
 */
function delete(int $rowId): void {
    $dbh = getPDO();
    $query = "delete from `form` where id = :id";
    $sth = $dbh->prepare($query);

    $isSuccess = $sth->execute(array(
        'id' => $rowId
    ));

    if(!$isSuccess) {
        throw new FormDeleteException('Не удалось удалить форму');
    }
}