<?php

require 'app/lib/Dev.php';
require 'app/lib/Smarty/Smarty.class.php';

use app\core\Router;

$main_config = require "app/config/main.php";

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

Router::start();