<?php
    define('BASE_PATH', dirname(__DIR__));

    require BASE_PATH . '/vendor/autoload.php';
    require BASE_PATH . '/helpers.php';

    use Framework\Router;
    use Framework\Session;

    Session::start();

    $router = new Router();
    $routes = require basePath('routes.php');

    // Get the URI and strip the base directory path
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    if (strpos($uri, $basePath) === 0) {
        $uri = substr($uri, strlen($basePath));
    }
    if (empty($uri)) {
        $uri = '/';
    }
    
    $method = $_SERVER['REQUEST_METHOD'];

    $router->route($uri, $method);
?>