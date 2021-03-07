<?php

class User_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('techno_model');
        $this->load->helper(array('form', 'url', 'onglet_title_helper'));
        $this->load->library('session');
    }


    /****GET ALL ACTIVE 1 & 0 ****/
    public function get_all_user()
    {
        //        $data['users'] = $this->user_model->get_six_users();
        $data['users'] = $this->user_model->get_user();

        $this->session->set_userdata('username', 'moi');

        $this->check_session();

        $this->load->view('templates/header', $data);
        $this->load->view('users/get_all', array($data, $this->check_session()));
        $this->load->view('templates/footer');
    }


    /***************** CREATE ***********************/
    public function create_user()
    {
        $this->load->library('form_validation');

        $data = array(
            'pageTitle' => 'Créer un compte',
            'technos' => $this->techno_model->get_techno(),
            'session' => $this->session->userdata('username', 'role')
        );

        // régles du formulaire
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('mail', 'Mail', 'required|valid_email|is_unique[user.mail]');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirmPasswd', 'ConfirmPasswd', 'required|matches[password]');
        $this->form_validation->set_rules('promo', 'Promo');
        $this->form_validation->set_rules('linkedin', 'linkedin');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/create', $data);
            $this->load->view('templates/footer');
        } else {
            $this->user_model->create_user();
            redirect(site_url('success_create'));
        }
    }


    /**************SUCCESS CREATE USER***********/
    public function success_create_user()
    {
        $data['pageTitle'] = 'Inscription';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/success_inscription', $data);
        $this->load->view('templates/footer');
    }


    /*******CONNEXION*******/
    public function login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $passwd_form = $this->input->post('password');
        $username_form = $this->input->post('username');
        $username_bdd = $this->user_model->get_user_by_username($username_form);

        $data['pageTitle'] = 'Connexion';

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/connexion', $data);
            $this->load->view('templates/footer');
        } else {
            if ($username_bdd->is_active === '1') {
                if (!password_verify($passwd_form, $this->user_model->login()->password) || $this->user_model->login() === null) {
                    $this->load->view('templates/header', $data);
                    $this->load->view('users/error_login', $data);
                } else {
                    $this->user_model->login();
                    $this->session_login($username_form);

                    redirect(site_url());
                }
            } else {
                redirect(site_url('erreur'));
            }
        }
    }

    private function session_login($username)
    {
        $user = $this->user_model->get_user_by_username($username);

        $newdata = array(
            'username'  => $username,
            'role'     => $user->type
        );

        $this->session->set_userdata($newdata);
    }


    /********DEMANDE DE CONNEXION AVANT QUE L'ADMIN EST VALIDE L'INSCRIPTION*********/
    public function error_connexion()
    {
        $data['pageTitle'] = 'Erreur connexion';

        $this->load->view('templates/header', $data);
        $this->load->view('users/error_connexion', $data);
        $this->load->view('templates/footer');
    }


    /****************** CHECK_SESSION **********************/
    private function check_session()
    {

        echo $this->session->username;
        echo $this->session->role;
    }
}
