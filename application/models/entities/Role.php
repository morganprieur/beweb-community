<?php

class Role
{
    private $role_id;
    private $type;
    private $description;


    public function __get($attribute)
    {
        if (isset($this->$attribute)){
            return $this->$attribute;
        }
    }

    public function __set($attribute,$value)
    {
        $this->$attribute = $value;
    }
}