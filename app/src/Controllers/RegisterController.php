<?php

class RegisterController extends AppController
{
    public function register($args)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $send = false;

            $user = new UserWrite();
            Tools::listen('register', $user);
            $save = $user->save();

            if ($save) {

                $email = new Mail();
                $email
                    ->setSubject("Udana rejestracja")
                    ->setFrom("gabski@automail.com")
                    ->setTo($_REQUEST['email'])
                    ->setMessage("Udane")
                ;

                $send = $email->send();
            }

            $data = [
                'callback' => 'register',
                'success' => $save,
                'email' => $send,
            ];

            return new ResponseJson($data);
        }

        return false;
    }
}