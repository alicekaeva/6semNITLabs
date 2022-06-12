<?php

namespace App\Repository;

use App\Model\Article;
use PDO;

class ArticleDataMapper
{

    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=magazine;host=127.0.0.1', 'root', '2001Galkin!');
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM arictles';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $results = $this->connection->query($sql);
        $arr = array();
        foreach ($results as $result)
        {
            $article = new Article();
            $article->setAll($result['article_id'], $result['article_name'], $result['article_author']);
            array_push($arr, $article);
        }
        return $arr;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM arictles WHERE article_id=$id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $this->connection->query($sql);
    }

    public function findByValue($columnName, $value)
    {
        $sql = "SELECT * FROM arictles WHERE $columnName = '$value'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $this->connection->query($sql);
    }

    public function add($id,$name,$author_name)
    {
        $sql = "INSERT INTO arictles
        values( $id,'$name', '$author_name')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()==0){
            echo '<br><label>Запись с такими ID уже существует</label>';
        } else {
            echo '<br><label>Запись была добавлена</label>';
        }
    }

    public function update($id,$name,$author_name)
    {
        $sql = "UPDATE arictles SET article_name='$name',
        article_author='$author_name' WHERE article_id=$id";
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
