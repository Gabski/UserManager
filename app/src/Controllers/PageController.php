<?php

class PageController extends AppController
{
    public function home($args)
    {
        $appRep = new AppRepository('emplacements', 'EmplacementRead');
        $emplacements = $appRep->findby();

        $addonRep = new AddonRepository();
        $addons = $addonRep->findby(['emplacement' => 1]);

        return new ResponseTwig("register.html.twig", [
            'emplacements' => $emplacements,
            'addons' => $addons,
        ]);
    }

    public function no_page($args)
    {
        return new ResponseTwig("no_page.html.twig");
    }

    public function formAdd($args)
    {
        $id = (int) $_REQUEST['id'] ?? 1;
        $addonRep = new AddonRepository();
        $addons = $addonRep->findby(['emplacement' => $id]);

        return new ResponseTwig("form_add.html.twig", [
            'addons' => $addons,
        ]);
    }
}