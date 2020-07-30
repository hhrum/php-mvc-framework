<?php

namespace application\core;

class View {
    
    public $path;
    public $route;
    public $layout = "default";

    public function __construct($route) {

        $this->route = $route;
        $this->path = "application/views/" . $route['controller'] . "/" . $route['action'] . ".php";

    }

    public function render($title, $vars = []) {
        extract($vars);
        
        if (file_exists($this->path)) {
            
            ob_start();
            require $this->path;
            $content = ob_get_clean();
            require "application/views/layouts/" . $this->layout . ".php";

        }
    }

    public static function errorCode($code) {
        $path = "application/views/errors/$code.php";

        if(file_exists($path)) {
            require $path;
        }
    }

	public function redirect($url) {
		header('location: '.$url);
		exit;
    }
    
}