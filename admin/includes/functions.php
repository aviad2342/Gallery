<?php 

function classAutoLoader($class){
    $class = strtolower($class);
    $path = "includes/{$class}.php";

    if(is_file($path) && !class_exists($class)) {
        require_once($path);
    } else {
        die("The file name: <strong>{$class}.php</strong> was not found...");
    }
}

function redirect($location) {
    header("Location: {$location}");
}

spl_autoload_register('classAutoLoader');



?>