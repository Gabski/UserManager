<?php
class Attribute extends AppEntity
{
    protected $id = 0;
    protected $value;
    protected $user_id;
    protected $addon_id;
    protected $name;
    protected $type;
    protected $emplacement;

    public function __construct($array = [])
    {
        $this->table = "attributes";
        parent::__construct($array);
    }

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

    protected $setters = [];

    public function setValue($value)
    {
        $this->value = $value;
        $this->setters[] = "value";
        return $this;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = (int) $user_id;
        $this->setters[] = "user_id";
        return $this;
    }

    public function setAddon_id($addon_id)
    {
        $this->addon_id = (int) $addon_id;
        $this->setters[] = "addon_id";
        return $this;
    }

    public function save()
    {

        if (!is_array($this->setters)) {
            return false;
        }

        if (count($this->setters) <= 0) {
            return false;
        }

        if ($this->user_id === 0) {
            return false;
        }

        if ($this->addon_id === 0) {
            return false;
        }

        $save = [];

        $this->setters = array_unique($this->setters);
        foreach ($this->setters as $value) {
            $save[$value] = $this->$value;
        }

        $id = Db::flush($this->table, $save, $this->id);
        return true;
    }

    public function delete()
    {
        return Db::delete($this->table, $this->id);
    }
}