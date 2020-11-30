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



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// try {
//     //Server settings
//     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->Host       = "ssl://smtp.gmail.com";                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//     $mail->Username   = '19200114@turan-edu.kz';                     // SMTP username
//     $mail->Password   = 'mottsun7979';                      // SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//     $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//     //Recipients
//     $mail->setFrom('from@example.com', 'Mailer');
//     $mail->addAddress('feft9999@gmail.com', 'Joe User');     // Add a recipient

//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $router) {
    $router->get('/', 'main');
    $router->get('/auth', 'auth');
    $router->get('/verify', 'verify');
    $router->post('/signup', 'signup');
    $router->post('/signin', 'signin');
});

$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header("HTTP/1.0 404 Not Found");
        echo '404';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo $allowedMethods[0];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $handler($vars);
        break;
}

function main() {
    global $auth, $twig;
    // $auth->logout();
    if (!$auth->isLoggedIn()) header("Location: /auth");
    else echo $twig->render('main.html');
}

function auth() {
    global $twig, $auth;
    if (!$auth->isLoggedIn()) echo $twig->render('auth.html');
    else header("Location: /");
}

function verify() {
    global $auth;
    if (!isset($_GET['selector']) || !isset($_GET['token']) ) die('GET params are clear...');
    try {
        $auth->confirmEmail($_GET['selector'], $_GET['token']);
    
        echo 'Email address has been verified';
    }
    catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
        die('Invalid token');
    }
    catch (\Delight\Auth\TokenExpiredException $e) {
        die('Token expired');
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
        die('Email address already exists');
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
        die('Too many requests');
    }
}

function signin() {
    global $auth;

    try {
        $auth->login($_POST['email'], $_POST['password']);
        echo json_encode(['status' => 'ok']);
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
        echo json_encode(['status' => 'err', 'data' => 'InvalidEmail']);
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
        echo json_encode(['status' => 'err', 'data' => 'InvalidPassword']);
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
        echo json_encode(['status' => 'err', 'data' => 'EmailNotVerified']);
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
        echo json_encode(['status' => 'err', 'data' => 'TooManyRequests']);
    }
}

function signup() {
    global $auth;

    try {
        $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
            mail($_POST['email'], "Подтверждение", "Перейдите по ссылке: " . 'localhost/verify?selector=' . \urlencode($selector) . '&token=' . \urlencode($token));
            echo json_encode(['status' => 'ok', 'data' => [$selector, $token]]);
        });
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
        echo json_encode(['status' => 'err', 'data' => 'InvalidEmail']);
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
        echo json_encode(['status' => 'err', 'data' => 'InvalidPassword']);
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
        echo json_encode(['status' => 'err', 'data' => 'UserAlreadyExists']);
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
        echo json_encode(['status' => 'err', 'data' => 'TooManyRequests']);
    }
}

?>