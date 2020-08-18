<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

    public function indexAction() {
        
        d($this->model->getAllSome());

        $this->view->render("Главная страница");

    }

}