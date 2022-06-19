<?php

namespace App\Controller;

use Twig\Environment;

class baseController {

    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invokeLogMenu()
    {
        echo $this->twig->render('menuLog.html.twig');
    }

    public function __invokeShowTable($result, $name)
    {
        echo $this->twig->render('tableRes.html.twig',['t' => $result, 'name' => $name]);
    }
}
