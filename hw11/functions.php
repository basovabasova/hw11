<?php

function myAutoload1($classNameWithNamespace)
{
    $pathToFile = str_replace("/", DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'])
    . DIRECTORY_SEPARATOR 
    . str_replace("/", DIRECTORY_SEPARATOR, $classNameWithNamespace) 
    . '.php'; 
    if (file_exists($pathToFile)) {
        include "$pathToFile";
    } else {
        echo 'Ошибка';
    }
}

spl_autoload_register('myAutoload1');