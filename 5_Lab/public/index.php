<?php

spl_autoload_register(function ($className) {
    $path = 'src/';
    $extension = '.php';
    $fullPath = dirname(__DIR__ ) . '/' . $path . str_replace("\\", "/", $className) . $extension;
    require_once $fullPath;
});

use Human;
use subclass\Hand;

$a= new Human();
$b = new Hand();
$a->print();
$b->print();
