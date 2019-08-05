<?php

class UserRepository extends AppRepository
{
    public function __construct($write = false)
    {
        $class = $write ? 'UserWrite' : 'UserRead';
        parent::__construct('users', $class);
    }

}