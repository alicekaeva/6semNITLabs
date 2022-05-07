<?php

spl_autoload_register(function ($className) {
    $path = 'src/';
    $extension = '.php';
    $fullPath = dirname(__DIR__ ) . '/' . $path . str_replace("\\", "/", $className) . $extension;
    require_once $fullPath;
});

use subclass\Hand;
use subclass\subsubclass\Fingers;

$a= new Human();
$b = new Hand();
$c = new Fingers();
$a->print();
$b->print();
$c->print();