<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

    public function indexAction() {

        $this->template->render("Главная страница");

    }

}