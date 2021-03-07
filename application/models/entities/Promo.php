<?php
class Promo
{
    private $title;
    private $year;

    public function __get($attribute) {
        if(isset($attribute)) {
            return $this->$attribute;
        }
    }

    public function __set($attribute, $value) {
        $this->$attribute = $value;
    }

}