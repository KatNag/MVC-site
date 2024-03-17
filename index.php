<?php
define('DEBUG_MODE', true);

if (DEBUG_MODE === true) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

session_start();

define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/MVC-site');

require_once(ROOT . '/components/autoload.php');
require_once(ROOT . '/components/Connection.php');
require_once(ROOT . '/config/dbConfig.php');
require_once(ROOT . '/components/Router.php');

$pdo = Connection::connect();

$router = new Router();
$router->run();