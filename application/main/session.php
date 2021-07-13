<?php

namespace Application\Main\Session;


/**
 * @private
 */
function isSessionStarted(): bool {
    return session_status() != PHP_SESSION_NONE;
}

/**
 * @public
 */
function sessionSetParam($param, $value) {
    if (!isSessionStarted()) {
        session_start();
    }
    $_SESSION[$param] = $value;
}

/**
 * @public
 */
function sessionGetParam($param) {
    if (!isSessionStarted()) {
        session_start();
    }
    return $_SESSION[$param] ?? null;
}

/**
 * @public
 */
function sessionUnset($param) {
    if(isSessionStarted()) {
        unset($_SESSION[$param]);
    }
}
