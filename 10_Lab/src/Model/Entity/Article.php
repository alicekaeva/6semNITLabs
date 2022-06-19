<?php

namespace App\Model\Entity;

use PDO;

class Article
{
    private int $id;
    private string $name;
    private string $author_name;
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=magazine;host=127.0.0.1','root','2001Galkin!');
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM arictles';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $this->connection->query($sql);
    }
}
