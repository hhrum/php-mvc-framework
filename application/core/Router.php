<?php

namespace application\core;

use application\core\View;

/*

    //

*/

class Router {

    static function start() {

        $req = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $route = [
            "controller" => empty($req[0]) ? "main" : $req[0],
            "action" => empty($req[1]) ? "index" : $req[1],
        ];

        $controller_name = $route['controller'];
        $action_name = $route['action'];

        $controller_name = ucfirst($controller_name) . "Controller";
        $action_name = ucfirst($action_name) . "Action";

        $controller_path = "application\controllers\\" . $controller_name;

        if(class_exists($controller_path) && method_exists($controller_path, $action_name)) {

            $controller = new $controller_path($route);
            $controller -> $action_name();

        } else {

            Router::ErrorPage(404);

        }

    }

    static function ErrorPage($code) {
        http_response_code($code);
        View::errorCode($code);

        exit();
    }

}