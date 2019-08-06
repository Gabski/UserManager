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

            $userRep = new UserRepository();
            $user = $userRep->findOneBy(['id' => $save]);
            $success = $user != null;

            if ($success) {

                $message = new ResponseTwig("email.html.twig", ['user' => $user]);

                $email = new Mail();
                $email
                    ->setSubject("Udana rejestracja")
                    ->setFrom("gabski@automail.com")
                    ->setTo($_REQUEST['email'])
                    ->setMessage($message->getTwig())
                ;

                $send = $email->send();
            }

            $data = [
                'callback' => 'register',
                'success' => $success,
                'email' => $send,
            ];

            return new ResponseJson($data);
        }

        return false;
    }
}