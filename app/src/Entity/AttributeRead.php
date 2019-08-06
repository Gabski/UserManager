<?php
class AttributeRead extends Attribute
{

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getEmplacement()
    {
        return $this->emplacement;
    }

    public function getValue()
    {
        return $this->value ?? "";
    }

    public function getUser_id()
    {
        return $this->user_id ?? 0;
    }

    public function getAddon_id()
    {
        return $this->addon_id ?? "";
    }
}