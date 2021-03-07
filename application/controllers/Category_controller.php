<?php

class Category_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->helper(array(
            'form',
            'url',
            'text',
            'onglet_title_helper'
        ));
        $this->load->library('session');
    }

    /********************* CREATE CATEGORY *******************/
    public function create_category()
    {
        $this->load->library('form_validation');

        $data['pageTitle'] = 'Créer une catégorie';

        $this->form_validation->set_rules('type', 'Nom de la catégorie', 'required');

        //  si le formulaire n'a pas été envoyé, on l'affiche
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/create_category', $data);
            $this->load->view('templates/footer');

            //  sinon on l'envoie à category_model
        } else {
            $this->category_model->set_category();
            redirect(site_url('dashboard'));
        }
    }

    /************************* UPDATE CATEGORY ************************/
    public function update_category(int $id)
    {

        $this->load->library('form_validation');

        $data['pageTitle'] = 'Modifier une catégorie';
        $data['title'] = 'Modifier la catégorie '; // ajouter l'id ou type dans la vue
        //  récupérer les données de l'enregistrement pour les afficher en values
        $data['category'] = $this->category_model->get_category($id);

        $this->form_validation->set_rules('type', 'Nom de la catégorie', 'required');

        //  si le formulaire n'a pas été envoyé, on l'affiche
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/update_category', $data);
            $this->load->view('templates/footer');

            //  sinon on l'envoie à category_model
        } else {
            $this->category_model->set_category($id);
            redirect(site_url('dashboard'));
        }
    }

    /************************* GET ALL CATEGORIES ********************/
    public function get_all_categories()
    {

        $data['pageTitle'] = 'Toutes les catégories';
        $data['categories'] = $this->category_model->get_category();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/all_categories', $data);
        $this->load->view('templates/footer');
    }

    /************************* GET CATEGORY BY ID ********************/
    public function get_category($id)
    {

        $data['pageTitle'] = 'Catégorie';
        $data['category'] = $this->category_model->get_category($id);

        $this->load->view('templates/header', $data);
        $this->load->view('admin/one_category', $data);
        $this->load->view('templates/footer');
    }
}
