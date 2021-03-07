<?php

class Techno_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('techno_model');
        $this->load->helper(array(
            'url', 
            'form', 
            'text', 
            'onglet_title_helper'
        ));
        $this->load->library('session');
    }

    /*********************** CREATE TECHNO ***********************/
    public function create_techno() {
        $this->load->library('form_validation');

        $data['pageTitle'] = "Créer une techno";

        $this->form_validation->set_rules('name', 'Nom de la techno', 'required');        

        //  formulaire n'a pas été envoyé : on l'affiche
        if($this->form_validation->run() === false) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/create_techno', $data);
            $this->load->view('templates/footer');

        //  sinon on l'envoie au modèle
        } else {
            $this->techno_model->set_techno();
            redirect(site_url('dashboard'));
        }
    }

    /************************* UPDATE TECHNO ************************/
    public function update_techno(int $id) {
        
        $this->load->library('form_validation');

        $data['pageTitle'] = 'Modifier une techno';
        $data['title'] = 'Modifier la techno '; // ajouter l'id ou nametype dans la vue
        //  récupérer les données de l'enregistrement pour les afficher en values
        $data['techno'] = $this->techno_model->get_techno($id);

        $this->form_validation->set_rules('name', 'Nom de la techno', 'required');

        //  si le formulaire n'a pas été envoyé, on l'affiche
        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/update_techno', $data);
            $this->load->view('templates/footer');
        
        //  sinon on l'envoie à category_model
        } else {
            $this->techno_model->set_techno($id);
            redirect(site_url('dashboard'));
        }
    }

    /***************** GET ALL TECHNOS *************************/
    public function get_all_technos() {
        $data['pageTitle'] = 'Toutes les catégories';
        $data['technos'] = $this->techno_model->get_techno();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/all_technos', $data);
        $this->load->view('templates/footer');
    }

    /**************** GET ONE TECHNO **************************/
    public function get_techno($id)
    {
        $data['pageTitle'] = 'Techno';
        $data['techno'] = $this->techno_model->get_techno($id);
        $data['session'] = $this->session->userdata('username', 'role');

        $this->load->view('templates/header', $data);
        $this->load->view('admin/one_techno', $data);
        $this->load->view('templates/footer');
    }

}

