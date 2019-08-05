<?php
class User extends AppEntity
{
    protected $id = 0;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $emplacement;
    protected $description;

    public function __construct($array = [])
    {
        $this->table = "users";
        parent::__construct($array);
    }

}