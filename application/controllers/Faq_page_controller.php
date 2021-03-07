<?php
class Faq_page_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('faq_page_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url', 'onglet_title_helper', 'text'));
    }

    /******************GET ALL*************/
    public function get_all_faq()
    {
        $data = array(
			'faqs' => $this->faq_page_model->get_faq(), 
            'pageTitle' => 'FAQ',
            'title' => 'Foire aux questions',
            'session' => $this->session->userdata('username', 'role')
        );


        $this->load->view('templates/header', $data);
        $this->load->view('staticPage/get_all_faq', $data);
        $this->load->view('templates/footer');
    }


    /**********GET BY ID************/
    public function get_faq_by_id(int $id)
    {
        $data = array(
            'faq' => $this->faq_page_model->get_faq($id), 
            'faqs' => $this->faq_page_model->get_faq(), 
            'pageTitle' => 'Question - Réponse',
            'title' => 'Question ',
            'session' => $this->session->userdata('username', 'role')
        );
        $this->load->view('templates/header', $data);
        $this->load->view('staticPage/get_faq_by_id', $data);
        $this->load->view('templates/footer');
    }


    /********* CREATE FAQ***********/
    public function create_faq()
    {
        $this->load->library('form_validation');

        $data = array(
            'pageTitle' => 'Ajouter une question',
            'session' => $this->session->userdata('username', 'role')
        );

        $this->form_validation->set_rules('question', 'Question', 'required');
        $this->form_validation->set_rules('answer', 'Reponse', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('staticPage/create_faq', $data);
            $this->load->view('templates/footer');
        } else {
            $this->faq_page_model->set_faq();
            redirect(site_url('dashboard'));
        }
    }


    /********* UPDATE FAQ***********/
    public function update_faq($id)
    {
        $this->load->library('form_validation');

        $data = array(
            'pageTitle' => 'FAQ',
            'faqs' => $this->faq_page_model->get_faq($id),
            'session' => $this->session->userdata('username', 'role')
        );

        $this->form_validation->set_rules('question', 'Question', 'required');
        $this->form_validation->set_rules('answer', 'Reponse', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('staticPage/update_faq', $data);
            $this->load->view('templates/footer');
        } else {
            $this->faq_page_model->set_faq($id);
            redirect(site_url('dashboard'));
        }
    }


    /***********DELETE FAQ*********/
    public function delete_faq(int $id)
    {
        $this->faq_page_model->delete_faq($id);
        redirect(site_url('dashboard'));
    }
}
