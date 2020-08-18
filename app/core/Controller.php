<?php

namespace app\core;

use app\core\Template;
use app\lib\Responser;

abstract class Controller extends Responser {

    public $route;
    public $view;

    public function __construct($route) {

        $this->route = $route;
        $this->template = new Template($route);

    }

}