<?php
class Addon extends AppEntity
{
    protected $id = 0;
    protected $name;
    protected $type;
    protected $emplacement;

    public function __construct($array = [])
    {
        $this->table = "users";
        parent::__construct($array);
    }
}