<?php
class Asso_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('staticPage_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'url', 'onglet_title_helper'));
    }


    /****** GET ALL ACTIVE 1 ********/
    public function get_all_activ()
    {
        $data = array(
            'pageTitle' => 'L\'association',
			'users' => $this->user_model->get_user_activ(), 
            'documents' => $this->staticPage_model->get_document(),
            'session' => $this->session->userdata('username', 'role')
		);

        $this->load->view('templates/header', $data);
        $this->load->view('page_asso/asso_view', $data);
        $this->load->view('templates/footer');
    }


    /************LES DOCUMENTS**********/
    /***********GET ALL**********/
    // public function get_all()
    // {
    //     $data = array(
    //         'documents' => $this->StaticPage_model->get_document(),
    //         'pageTitle' => 'Association',
    //         'session' => $this->session->userdata('username', 'role')
	// 	);


    //     $this->load->view('templates/header', $data);
    //     $this->load->view('staticPage/get_all', $data);
    //     $this->load->view('templates/footer');
    // }


    /**********GET ALL BY ID***********/
    // public function get_by_id(int $id)
    // {
    //     $data = array(
    //         'document' => $this->StaticPage_model->get_document($id),
    //         'pageTitle' => 'Association',
    //         'session' => $this->session->userdata('username', 'role')
	// 	);

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('staticPage/get_by_id_staticPage', $data);
    //     $this->load->view('templates/footer');

    // }

}
