<?php
class User extends AppEntity
{
    protected $id = 0;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $emplacement;
    protected $description;
    protected $attributes;

    public function __construct($array = [])
    {
        $this->table = "users";
        parent::__construct($array);
        $this->loadAttributes();
    }

    protected function loadAttributes()
    {
        $productAttributeRep = new AddonRepository();
        $this->attributes = $productAttributeRep->findAttributes($this->id);
    }

}