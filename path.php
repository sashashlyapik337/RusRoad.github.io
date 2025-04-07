<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('SITE_ROOT')) {
    define('SITE_ROOT', __DIR__);
}

if (!defined('BASE_URL')) {
    define('BASE_URL', "http://localhost/RusRoad/");
}

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(dirname(__FILE__)));
}
