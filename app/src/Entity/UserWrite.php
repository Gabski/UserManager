<?php
class UserWrite extends User implements SaveInterface
{
    protected $setters = [];

    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;
        $this->setters[] = 'emplacement';
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->setters[] = 'description';
        return $this;
    }

    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;
        $this->setters[] = 'first_name';
        return $this;
    }

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;
        $this->setters[] = 'last_name';
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->setters[] = 'email';
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