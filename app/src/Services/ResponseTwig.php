<?php

class ResponseTwig
{
    public $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem('app/templates');
        $this->twig = new Twig_Environment($loader);
        $this->twig->addGlobal('main_url', Tools::serverUrl());
    }

    public function render($tpl, $args = [])
    {
        return $this->twig->render($tpl, $args);
    }
}