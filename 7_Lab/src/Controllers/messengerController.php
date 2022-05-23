<?php

namespace Controllers;
use PDO;
use Twig\Environment;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class messengerController
{
    private Environment $twig;
    private Logger $log;
    private StreamHandler $messengerHandler;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->log = new Logger('action');
        $this->messengerHandler = new StreamHandler('messenger.log', Logger::INFO);
        echo $this->twig->render('main.html.twig');
    }

    function addMessage($login, $message, $conn){
        if ($message !== '') {
            $now = date("Y-m-d H:i:s");
            $sql = 'insert into messages (user_date, user_login, user_message) values (:now, :login, :message)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam('now', $now, PDO::PARAM_STR);
            $stmt->bindParam('login', $login, PDO::PARAM_STR);
            $stmt->bindParam('message', $message, PDO::PARAM_STR);
            $stmt->execute();
            $this->log->pushHandler($this->messengerHandler);
            $this->log->info('New message', ['who' => $login, 'what' => $message]);
            header('Location: /');
        }
        else {
            echo '<p style="color:red">Сообщение пустое</p>';
            $this->log->error('Empty message box');
        }
    }

    function displayMessages($conn){
        $sql = 'SELECT * from messages ORDER BY user_date ASC';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $messages = $stmt->fetchAll();
        echo $this->twig->render('message.html.twig',
            ['messages' => $messages]);
    }
}