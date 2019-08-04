<?php

class PageController extends AppController
{
    public function home($args)
    {
        return new ResponseTwig("register.html.twig");
    }

    public function no_page($args)
    {
        return new ResponseTwig("no_page.html.twig");
    }
}