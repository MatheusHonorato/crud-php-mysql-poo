<?php

session_start();

define('ROOT', dirname(__FILE__, 2).DIRECTORY_SEPARATOR);

require_once ROOT.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$routes = require_once ROOT.'config'.DIRECTORY_SEPARATOR.'routes.php';

try {
    \App\Http\Router::run($routes);
} catch (\Exception $e) {
    echo $e->getMessage();
    http_response_code($e->getCode());
}
