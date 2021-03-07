<?php

class User
{
    private $user_id;
    private $lastname;
    private $firstname;
    private $mail;
    private $username;
    private $password;
    private $user_image;
    private $promo;
    private $is_active;
    private $type;


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