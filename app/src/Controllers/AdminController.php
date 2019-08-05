<?php

class AdminController extends AppController
{
    function list($args) {

        $userRep = new UserRepository();
        return new ResponseTwig("admin/user_list.html.twig", ['users' => $userRep->findBy()]);
    }

}