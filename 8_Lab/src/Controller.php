<?php

namespace App;

use Twig\Environment;

class Controller
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invokeMenu()
    {
        echo $this->twig->render('menu.html.twig');
    }

    public function __invokeFindByID()
    {
        echo $this->twig->render('findByID.html.twig');
    }

    public function __invokeFindByField()
    {
        echo $this->twig->render('findByField.html.twig');
    }

    public function __invokeSave()
    {
        echo $this->twig->render('save.html.twig');
    }

    public function __invokeDelete()
    {
        echo $this->twig->render('delete.html.twig');
    }

    public function __invokeShowTable($result)
    {
        echo $this->twig->render('tableRes.html.twig',['t' => $result]);
    }
}