<?php
if (!session_id()) @session_start();

require '../vendor/autoload.php';


use DI\ContainerBuilder;
use JasonGrimes\Paginator;
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;
use Respect\Validation\Validator;


$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    PDO::class => function() {
    $driver = 'mysql';
    $host = 'localhost';
    $db_name = 'test_site';
    $username = 'root';
    $password = 'root';
    return new PDO("$driver:host=$host;dbname=$db_name", $username, $password);
    },

    Paginator::class => function() {
        $totalItems = null;
        $itemsPerPage = $_GET['show_by'] ?? 10;
        $currentPage = $_GET['page'] ?? 1;
        $urlPattern = isset($_GET['show_by']) ? "?show_by={$_GET['show_by']}&page=(:num)" : '?page=(:num)';
        return new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    },

    Engine::class => function() {
    return new Engine('../app/views');
    },

    QueryFactory::class => function() {
        return new QueryFactory('mysql');
    },

    Validator::class => function() {
    return new Validator();
    },


]);
$container = $containerBuilder->build();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute(['GET'],  '/guest_book', ['App\controllers\HomeController', 'showGuestBook']);
    $r->addRoute(['POST'],  '/guest_book', ['App\models\Post', 'validateRequest']);
    $r->addRoute(['GET'],  '/guest_book/create_post', ['App\controllers\HomeController', 'showCreatePost']);
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
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        http_response_code(405);
        break;
    case FastRoute\Dispatcher::FOUND:
       $container->call($routeInfo[1], $routeInfo[2]);
        break;
}


