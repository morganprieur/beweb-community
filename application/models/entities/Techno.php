<?php

class Techno
{
    private $techno_id;
    private $name;
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