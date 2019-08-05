<?php

class PageController extends AppController
{
    public function home($args)
    {
        $appRep = new AppRepository('emplacements', 'EmplacementRead');
        $emplacements = $appRep->findby();

        return new ResponseTwig("register.html.twig", [
            'emplacements' => $emplacements,
        ]);
    }

    public function no_page($args)
    {
        return new ResponseTwig("no_page.html.twig");
    }
}