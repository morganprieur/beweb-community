<?php

class Mail_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mail_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url', 'onglet_title_helper', 'text'));
    }


    /******FORMULAIRE CONTACT MAIL******/
    public function mail() {

        $this->load->library('form_validation');
        
        $data = array(
            'pageTitle' => 'Nous contacter',
            'session' => $this->session->userdata('username', 'role')
		);

        $this->form_validation->set_rules('mail', 'E-Mail', 'required|valid_email');
        $this->form_validation->set_rules('pseudo', 'Pseudo slack');
        $this->form_validation->set_rules('content', 'Contenu du mail', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('staticPage/contact', $data);
            $this->load->view('templates/footer');
        } else {
            $this->mail_model->mail();
            redirect(site_url());
        }
    }


    /*********MP OUBLIE********/
    // recupère le mail a verifier dans la bdd
    public function pw_forget()
    {
        $data['pageTitle'] = 'Mot de passe oublié';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mail', 'E-Mail', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('staticPage/form_pw_forget', $data);
            $this->load->view('templates/footer');
        } else {
            $this->mail_model->pw_forget();
            redirect(site_url());
        }
    }


    // recupère les deux nouveaux mails a comparer
    public function reset_pw()
    {
        $uri = $_SERVER['REQUEST_URI']; // recupère l'url
        $explode = explode("/", $uri); // coupe au niveau des /
        $data['token'] = end($explode); // pointe le curseur du tableau sur le dernier element pour recup le token

        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Mot de passe', 'required');
        $this->form_validation->set_rules('psswd_confirm', 'Mot de passe conf', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('staticPage/upload_pw', $data);
            $this->load->view('templates/footer');
        } else {
            $this->mail_model->upload_mp();
            redirect(site_url());
        }
    }

}
