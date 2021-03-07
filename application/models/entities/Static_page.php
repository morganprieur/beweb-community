<?php
class Static_page
{
    private $documentId;
    private $title;
    private $text;
    private $lien_doc;
    private $image;
    private $video;


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