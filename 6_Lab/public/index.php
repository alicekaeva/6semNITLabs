<?php

use Controllers\messengerController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once dirname(__DIR__) . "/vendor/autoload.php";

$loader = new FilesystemLoader(dirname(__DIR__) . "/templates");
$log = new Logger('user');
$userHandler = new StreamHandler('messenger.log', Logger::INFO);
$log->pushHandler($userHandler);
$twig = new Environment($loader);
$controller = new messengerController($twig, $log);

if (!isset($_GET['login']) && !isset($_GET['password']) && !isset($_GET['clear']) && !isset($_GET['logs'])){
    echo '<p style="color:red">Вы не авторизованы</p>';
    $log->error('Unauthorized user is trying to send a message');
} else {
    $login = $_GET['login'];
    $password = $_GET['password'];
    $message = $_GET['message'];
    if (($login === 'alicekaeva' && $password === 'crazy_frog_2022') || ($login === 'шлепа' && $password === 'чмоня') && !isset($_GET['clear']) && !isset($_GET['logs'])) {
        $controller->addMessage($login, $message);
    } elseif (!isset($_GET['clear'])) {
        echo '<p style="color:red">Такого пользователя не существует</p>';
        $log->error('This user doesn`t exist', ['who' => $login]);
    }
}
if (isset($_GET['clear'])) {
    file_put_contents('messages.json', '{"messages":[]}');
    echo '<p style="color:red">Чат очищен</p>';
    $log->info('Chat is cleared');
}
if (isset($_GET['logs'])) {
    $file = file_get_contents('messenger.log');
    echo $file;
}
$controller->displayMessages();