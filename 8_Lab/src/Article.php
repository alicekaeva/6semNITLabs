<?php

namespace App;

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

    public function setAll($id,$name,$author_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->author_name = $author_name;
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM arictles';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $this->connection->query($sql);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM arictles WHERE article_id=$id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $this->connection->query($sql);
    }

    public function findByField($columnName, $value)
    {
        $sql = "SELECT * FROM arictles WHERE $columnName = '$value'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $this->connection->query($sql);
    }

    public function add()
    {
        $sql = "INSERT INTO arictles
        values( $this->id,'$this->name', '$this->author_name')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()==0){
            echo '<br><label>Запись с такими ID уже существует</label>';
        } else {
            echo '<br><label>Запись была добавлена</label>';
        }
    }

    public function update()
    {
        $sql = "UPDATE arictles SET article_name='$this->name',
        article_author='$this->author_name' WHERE article_id=$this->id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()==0){
            echo '<br><label>Записи с такими ID не существует</label>';
        } else {
            echo '<br><label>Запись была обновлена</label>';
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM arictles WHERE article_id=$id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()==0){
            echo '<br><label>Записи с такими ID не существует</label>';
        } else {
            echo '<br><label>Запись была удалена</label>';
        }
    }
}
