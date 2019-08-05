<?php
class Emplacement extends AppEntity
{
    protected $id = 0;
    protected $name;

    public function __construct($array = [])
    {
        $this->table = "emplacements";
        parent::__construct($array);
    }

}