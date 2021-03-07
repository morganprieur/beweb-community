<?php 

class Faq_page
{
    private $faq_id;
    private $question;
    private $answer;


    public function __get($attribute)
    {
        if(isset($attribute)) {
            return $this->$attribute;
        }
    }


    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }
}