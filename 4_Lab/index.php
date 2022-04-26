<form action="/" method="post">
    <label> Логин
        <input name="login" autocomplete="off"/>
    </label><br>
    <label> Пароль
        <input type="password" name="password" autocomplete="off"/>
    </label><br>
    <label> Сообщение
        <input name="message" autocomplete="off"/>
    </label><br>
    <input type="submit" value="Опубликовать" autocomplete="off"/>
</form>

<?php

function addMessage($login, $message){
    if ($message !== '') {
        $myJSON = json_decode(file_get_contents("messages.json"));
        $messageBody = (object)['date' => time(), 'user' => $login, 'message' => $message];
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

$login = $_POST["login"];
$password = $_POST["password"];
$message = $_POST["message"];
if (($login === "alicekaeva" && $password === "crazy_frog_2022") || ($login === "шлепа" && $password === "чмоня")) {
    addMessage($login, $message);
}
else {
    echo '<p style="color:red">Такого пользователя не существует</p>';
}
displayMessages();

?>
