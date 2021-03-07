<?php

class Event {

    private $event_id;
    private $title;
    private $lieu;
    private $date;
    private $description;
    private $is_validated;
    private $event_image;
    private $hour;
    private $is_active;
    private $creation_user_id;
    private $username;
    private $type;
    private $categories;
    private $technos;

    public function __get($attribute) {
        if(isset($attribute)) {
            return $this->$attribute;
        }
    }

    public function __set($attribute, $value) {
        $this->$attribute = $value;
    }

    

}


