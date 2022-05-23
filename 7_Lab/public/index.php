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
$connection = new PDO('mysql:dbname=messenger;host=127.0.0.1', 'root', '2001Galkin!');

if (!isset($_GET['login']) && !isset($_GET['password']) && !isset($_GET['clear']) && !isset($_GET['logs'])){
    echo '<p style="color:red">Вы не авторизованы</p>';
    $log->error('Unauthorized user is trying to send a message');
} else {
    $login = $_GET['login'];
    $password = $_GET['password'];
    $message = $_GET['message'];
    $sql = 'SELECT * from users where user_login=:login';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam('login', $login, PDO::PARAM_STR);
    $stmt->execute();
    $users = $stmt->fetchAll();
    if ($users[0]['user_login'] == $login && $users[0]['user_password'] == $password && !isset($_GET['clear']) && !isset($_GET['logs'])) {
        $controller->addMessage($login, $message, $connection);
    } elseif (!isset($_GET['clear'])) {
        echo '<p style="color:red">Такого пользователя не существует</p>';
        $log->error('This user doesn`t exist', ['who' => $login]);
    }
}
if (isset($_GET['clear'])) {
    file_put_contents('messages.json', '{"messages":[]}');
    echo '<p style="color:red">Чат очищен</p>';
    $log->info('Chat is cleared');
    $sql = 'DELETE FROM messages';
    $stmt = $connection->prepare($sql);
    $stmt->execute();
}
if (isset($_GET['logs'])) {
    $file = file_get_contents('messenger.log');
    echo $file;
}
$controller->displayMessages($connection);