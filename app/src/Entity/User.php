<?php
class User extends AppEntity
{
    protected $id = 0;
    protected $firstname;
    protected $lastname;
    protected $email;

    public function __construct($array = [])
    {
        $this->table = "users";
        parent::__construct($array);
    }

}