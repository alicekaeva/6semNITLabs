<?php

namespace App\Repository;

use App\Model\Article;
use PDO;

class ArticleRepository
{
    private $AllArticles = array();
    private ArticleDataMapper $mapper;

    public function __construct()
    {
        $this->mapper = new ArticleDataMapper();
        $this->AllArticles = $this->mapper->getAll();
    }

    public function RepGetAll()
    {
        return $this->AllArticles;
    }

    public function Repadd($id,$name,$author_name)
    {
         $this->mapper->add($id,$name,$author_name);
    }

    public function Repupdate($id,$name,$author_name)
    {
        $this->mapper->update($id,$name,$author_name);
    }

    public function Repdelete($DelId)
    {
         $this->mapper->delete($DelId);
    }

    public function RepfindById($findID)
    {
        return $this->mapper->findById($findID);
    }

    public function RepfindByValue($columnName, $value)
    {
        return $this->mapper->findByValue($columnName, $value);
    }
}
