<?php

class RegisterController extends AppController
{
    public function register($args)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'callback' => 'register',
                'success' => true,
            ];
            return new ResponseJson($data);
        }

        return false;
    }
}