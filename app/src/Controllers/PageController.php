<?php

class PageController extends AppController
{
    public function home($args)
    {
        return (new ResponseTwig())->render("register.html.twig");
    }

    public function no_page($args)
    {
        return (new ResponseTwig())->render("no_page.html.twig");
    }
}