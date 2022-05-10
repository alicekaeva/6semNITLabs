<form action="/" method="get">
    <label> Логин
        <input name="login" autocomplete="off"/>
    </label><br>
    <label> Пароль
        <input type="password" name="password" autocomplete="off"/>
    </label><br>
    <label> Сообщение
        <input name="message" autocomplete="off"/>
    </label><br>
    <input type="submit" value="Опубликовать">
    <input type="submit" name="clear" value="Очистить чат">
</form>
<style>
    body {background-color: #debc8a;}
</style>

<?php
function addMessage($login, $message){
    if ($message !== '') {
        $myJSON = json_decode(file_get_contents("messages.json"));
        $messageBody = (object)['date' => time() + 60*60*10, 'user' => $login, 'message' => $message];
        $myJSON->messages[] = $messageBody;
        file_put_contents("messages.json", json_encode($myJSON));
    }
    else {
        echo '<p style="color:red">Сообщение пустое</p>';
    }
}

function displayMessages(){
    $myJSON = json_decode(file_get_contents("messages.json"));
    foreach($myJSON->messages as $message){
        echo '<p style="color:blue">' . date('m/d/Y H:i:s', $message->date) . ' ' . $message->user . '</p>';
        echo '<p>' . $message->message . '</p><hr>';
    }
}

if (!isset($_GET['login']) && !isset($_GET['password'])){
    echo '<p style="color:red">Вы не авторизованы</p>';
}
else {
    $login = $_GET["login"];
    $password = $_GET["password"];
    $message = $_GET["message"];
    if (($login === "alicekaeva" && $password === "crazy_frog_2022") || ($login === "шлепа" && $password === "чмоня")) {
        addMessage($login, $message);
        header('Location: /');
    }
    else  {
        echo '<p style="color:red">Такого пользователя не существует</p>';
    }
}
if (isset($_GET['clear']))
{
    file_put_contents('messages.json', '{"messages":[]}');
}
displayMessages();
?>