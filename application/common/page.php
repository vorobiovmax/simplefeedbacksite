<?php

namespace Application\Common\Page;


/**
 * @public
 */
function renderContent(string $pageName, array $displayData, bool $enableHeaderFooter = true) {
    ob_start();
    if($enableHeaderFooter) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/application/header.php';
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/application/views/' . $pageName . '.php';

    if($enableHeaderFooter) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/application/footer.php';
    }

    return ob_get_clean();
}

/**
 * @public
 */
function redirect(string $pageName, int $code) {
    header('Location: /' . $pageName . '.php', true, $code);
    die();
}

/**
 * @public
 */
function setResponseCode(int $code) {
    http_response_code($code);
}