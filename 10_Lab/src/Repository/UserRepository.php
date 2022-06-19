<?php

namespace App\Repository;

use App\Model\Mapper\UserMapper;

class UserRepository
{
    private UserMapper $dataMapper;
    private ?array $data = [];

    public function __construct()
    {
        $this->dataMapper = new UserMapper();
        $this->data = $this->dataMapper->findAll();
    }

    public function findByLogin($name) {
        for ($i = 0; $i < count($this->data); $i++) {
            if ($this->data[$i]->getLogin() == $name) {
                return $this->data[$i];
            }
        }
    }

    public function addUser($user) {
        $this->dataMapper->add($user);
        $this->data = $this->dataMapper->findAll(); //для только что зареганного юзверя
    }
}