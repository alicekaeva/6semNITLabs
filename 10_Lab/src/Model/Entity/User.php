<?php

namespace App\Model\Entity;

class User
{
    private string $login;
    private string $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }
}