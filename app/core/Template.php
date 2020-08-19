<?php

namespace app\core;

class Template extends \Smarty {
    
    protected $route;
    protected $config;
    public $layout = "default";

    public function __construct($route = [])
    {
        global $main_config;
        
        $this->route = $route;
        $this->config = require "app/config/template.php";

        parent::__construct();
        
        $this->setTemplateDir($this->config['template']);
        $this->setCompileDir($this->config['template_c']);
        $this->setConfigDir($this->config['config']);
        $this->setCacheDir($this->config['cache']);

        $this->assign("url", $main_config['url']);
    }

    /**
     * Метод рендера страницы
     * 
     * @param string $title Заголовок страницы
     */
    public function render($title) {
        $layout_file = '_layouts/' . $this->layout . '.tpl';
        $layout_path = $this->config['template'] . '/' . $layout_file;
        $tpl_file = $this->route['controller'] . '/' . $this->route['action'] . '.tpl';
        $tpl_path = $this->config['template'] . '/' . $tpl_file;

        if (file_exists($layout_path) && file_exists($tpl_path)) {
            $this->assign("title", $title);
            $this->assign("controller", $this->route['controller']);
            $this->assign("content", $tpl_file);

            $this->display($layout_file);
        }
    }

    /**
     * Метод вовзращает пользователю страницу ошибки
     * 
     * @param string $code код ошибки
     */
    public function errorCode($code) {
        $file = "_errors/$code.tpl";
        $path = $this->config['template'] . '/' . $file;
        
        if(file_exists($path)) {
            $this->display($file);
        } 
    }

}