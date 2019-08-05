<?php
class UserRead extends User
{
    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmplacement()
    {
        return $this->emplacement;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEditUrl()
    {
        return "/admin/user/$this->id";
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}