<?php

namespace app\core;

use app\core\Template;

abstract class Controller {

    public $route;
    public $view;

    public function __construct($route) {

        $this->route = $route;
        $this->template = new Template($route);

    }

}