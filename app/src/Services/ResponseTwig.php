<?php

class ResponseTwig
{
    public $twig;

    public function __construct($tpl, $args = [])
    {
        $loader = new Twig_Loader_Filesystem('app/templates');
        $this->twig = new Twig_Environment($loader);
        $this->twig->addGlobal('main_url', Tools::serverUrl());
        $this->tpl = $tpl;
        $this->args = $args;
    }

    public function render()
    {

        echo $this->twig->render($this->tpl, $this->args);
    }
}