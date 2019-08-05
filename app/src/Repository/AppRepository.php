<?php

class AppRepository
{

    public $table;
    public $inst;

    public function __construct($table, $inst)
    {

        $this->table = $table;
        $this->inst = $inst;
    }

    public function findOneBy($array = [], $type = MYSQLI_ASSOC)
    {
        $where = "";
        $i = 0;
        foreach ($array as $key => $value) {
            $value = htmlspecialchars($value);
            $where .= $i > 0 ? ", " : "";
            $where .= ' ' . $key . ' = "' . $value . '"';
            $i++;
        }
        $sql = Db::query('Select * from ' . $this->table . ' WHERE ' . $where . ' LIMIT 1');
        return new $this->inst($sql->fetch_array($type));
    }

    public function findBy($array = [], $type = MYSQLI_ASSOC)
    {
        $where = " WHERE ";
        $i = 0;
        foreach ($array as $key => $value) {
            $value = htmlspecialchars($value);
            $where .= $i > 0 ? ", " : "";
            $where .= ' ' . $key . ' = "' . $value . '"';
            $i++;
        }

        if (count($array) == 0) {
            $where = "";
        }

        $sql = Db::query('Select * from ' . $this->table . $where);

        $result = [];
        while (($row = $sql->fetch_array($type)) != null) {

            $result[] = new $this->inst($row);
        }

        return $result;
    }

}