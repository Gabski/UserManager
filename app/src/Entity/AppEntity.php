<?php

class AppEntity
{
    protected $table;

    public function __construct($array = [])
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $this->$key = $value;
            }
        }
    }
}