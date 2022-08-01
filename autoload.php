<?php

class Autoload
{
    public static function inclusionAuto($className)
    {
        // require du bon fichier qui contient la classe que l'on souhaite instancier
        // "C:\xampp\htdocs\blogphp\"
        require_once __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
        //                                            controller\Controller  . '.php'
    }
}

spl_autoload_register(array('Autoload', 'inclusionAuto'));



// echo __DIR__;

// TEST

// $c = new controller\Controller;


