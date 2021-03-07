<?php

class test_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function test()
    {
        $this->load->library('email');

        $this->email->from('audrey@jil.com');
        $this->email->to('duon.caroline@gmail.com');

        $this->email->subject('Formulaire de contact envoye par Audrey');
        $this->email->message('test');

        $this->email->send();
    }
}
