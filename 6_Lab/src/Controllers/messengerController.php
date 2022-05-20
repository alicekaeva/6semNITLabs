<?php

namespace Controllers;
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

    function addMessage($login, $message){
        if ($message !== '') {
            $myJSON = json_decode(file_get_contents('messages.json'));
            $messageBody = (object)['date' => date('m/d/Y H:i:s', time()), 'user' => $login, 'message' => $message];
            $myJSON->messages[] = $messageBody;
            file_put_contents('messages.json', json_encode($myJSON));
            $this->log->pushHandler($this->messengerHandler);
            $this->log->info('New message', ['who' => $login, 'what' => $message]);
            header('Location: /');
        }
        else {
            echo '<p style="color:red">Сообщение пустое</p>';
            $this->log->error('Empty message box');
        }
    }

    function displayMessages(){
        $myJSON = json_decode(file_get_contents('messages.json'));
        foreach($myJSON->messages as $message){
            echo $this->twig->render('message.html.twig',
                ['message' => $message,]);
        }
    }
}