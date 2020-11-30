<?php

require __DIR__ . '/vendor/autoload.php';

use Delight\Auth\Auth;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new PDO('mysql:dbname=tech;host=localhost;charset=utf8mb4', 'root', 'root');
$query = file_get_contents('resources/sql/tables.sql');
$db->exec($query);

$auth = new Auth($db);

$loader = new FilesystemLoader(__DIR__ . '/resources/view');
$twig = new Environment($loader);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $router) {
    $router->get('/', 'main');
    $router->get('/auth', 'auth');
    $router->post('/signup', 'signup');
});

$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo $allowedMethods[0];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $handler();
        break;
}

function main() {

}

function auth() {
    global $twig;
    echo $twig->render('auth.html');
}

function signup() {
    global $auth;
    try {
        $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
            echo json_encode(['status' => 'ok', 'data' => [$selector, $token]]);
        });
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
        echo json_encode(['status' => 'err']);
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
        echo json_encode(['status' => 'err']);
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
        echo json_encode(['status' => 'err']);
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
        echo json_encode(['status' => 'err']);
    }
}

?>