<?php

class AdminController extends AppController
{
    function list($args) {

        $userRep = new UserRepository();
        return new ResponseTwig("admin/user_list.html.twig", ['users' => $userRep->findBy()]);
    }

    public function user($args)
    {
        $userRep = new UserRepository();
        $user = $userRep->findOneBy(['id' => $args['user_id']]);

        $appRep = new AppRepository('emplacements', 'EmplacementRead');
        $emplacements = $appRep->findby();

        return new ResponseTwig("admin/user_edit.html.twig", [
            'user' => $user,
            'emplacements' => $emplacements,
        ]);
    }

    public function save($args)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $request = $_REQUEST;

            $userRep = new UserRepository(true);
            $user = $userRep->findOneBy(['id' => $request['user_id']]);
            Tools::listen('save', $user);
            $save = $user->save();

            $data = [
                'callback' => 'save',
                'success' => $save,
            ];

            return new ResponseJson($data);
        }

        return false;
    }
}