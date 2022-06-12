<?php

namespace App\Model;

class Article
{
    private int $id;
    private string $name;
    private string $author_name;

    public function __construct()
    {
    }

    public function setAll($id, $name, $author_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->author_name = $author_name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->author_name;
    }
}

