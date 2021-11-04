<?php

if (!session_id()) @session_start();

require '../vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute(['GET'],  '/', ['App\controllers\HomeController', 'index']);
    $r->addRoute(['GET'],  '/create_post', ['App\controllers\HomeController', 'showCreatePost']);
    $r->addRoute(['POST'],  '/guest_book', ['App\controllers\HomeController', 'handlerPost']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        http_response_code(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // ... 405 Method Not Allowed
        http_response_code(405);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $action = $handler[1];
        $controller = new $handler[0];
        call_user_func([$controller, $action]);
        break;
    default:
        // ... 404 Not Found
        http_response_code(404);
}


