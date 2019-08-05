<?php

class AddonRepository extends AppRepository
{
    public function __construct()
    {
        $class = 'AddonRead';
        parent::__construct('addons', $class);
    }

}