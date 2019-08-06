<?php
class AttributeWrite extends Attribute
{
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