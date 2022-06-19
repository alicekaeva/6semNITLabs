<?php

namespace App\Model\Mapper;

use PDO;
use App\Model\Entity\User;

class UserMapper
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=magazine;host=127.0.0.1', 'root', '2001Galkin!');
    }

    public function add($user) {
        $login = $user->getLogin();
        $password = $user->getPassword();
        $sql = 'INSERT INTO users(user_login, user_password) values (:login, :password)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('login', $login, PDO::PARAM_STR);
        $stmt->bindParam('password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function findAll(): ?array
    {
        $sql = 'SELECT * from users';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $users = [];
        if (isset($results)) {
            foreach ($results as $result) {
                if (isset($result)) {
                    array_push($users, new User($result['user_login'], $result['user_password']));
                }
            }
        }
        return $users;
    }
}