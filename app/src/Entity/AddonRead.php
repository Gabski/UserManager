<?php
class AddonRead extends Addon
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

}