<?php

class PageController extends AppController
{
    public function home($args)
    {
        return $this->twig->render("register.html.twig", []);
    }

    public function no_page($args)
    {
        return $this->twig->render("no_page.html.twig", []);
    }
}