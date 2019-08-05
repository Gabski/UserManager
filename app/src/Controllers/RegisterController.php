<?php

class RegisterController extends AppController
{
    public function register($args)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = new UserWrite();
            Tools::listen('register', $user);
            $save = $user->save();

            $data = [
                'callback' => 'register',
                'success' => $save,
            ];

            return new ResponseJson($data);
        }

        return false;
    }
}