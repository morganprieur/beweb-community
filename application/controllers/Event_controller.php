<?php

class Event_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->model('user_model');

        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->helper('onglet_title_helper');

        $this->load->library('session');
    }

    /********* GET ALL EVENTS ******************/
    public function all_events() {
        $this->load->helper('text');

        $data = array(
            'pageTitle' => 'Tous nos événements',
			'events' => $this->event_model->get_all_events(), 
            'session' => $this->session->userdata('username', 'role')
		);
        
        foreach ($this->event_model->get_all_events() as $id_event){
            $table_tech[] = $this->event_model->join_techno($id_event->event_id);
            $table_cat[] = $this->event_model->join_categ($id_event->event_id);
        }
        $data['technos'] = $table_tech;
        $data['categories'] = $table_cat;

        $this->load->view('templates/header', $data);
        $this->load->view('events/view_all_events', $data);
        $this->load->view('templates/footer');
    }


    /********* GET ALL EVENTS VALIDATED 1 ******************/
    public function all_events_validated() {
        $this->load->helper('text');

        $data = array(
            'pageTitle' => 'Tous nos événements',
			'events' => $this->event_model->get_events_validated(), 
            'session' => $this->session->userdata('username', 'role')
		);
        
        foreach ($this->event_model->get_all_events() as $id_event){
            $table_tech[] = $this->event_model->join_techno($id_event->event_id);
            $table_cat[] = $this->event_model->join_categ($id_event->event_id);
        }
        $data['technos'] = $table_tech;
        $data['categories'] = $table_cat;

        $this->load->view('templates/header', $data);
        $this->load->view('events/view_all_events', $data);
        $this->load->view('templates/footer');
    }
    
    /********* GET EVENT BY ID ****************/
    public function get_event($id)
    {
        $data = array(
            'pageTitle' => 'Détail d\'un événement',
            'title' => 'Détail d\'un événement',
            'event' => $this->event_model->get_event_by_id($id),
            'categs' =>  $this->event_model->join_categ($id),
            'technos' => $this->event_model->join_techno($id),
            'session' => $this->session->userdata('username', 'role')
		);

        $this->load->view('templates/header', $data);
        $this->load->view('events/view_event', $data);
        $this->load->view('templates/footer');
    }


    /***********GET EVENT BY DATE ACTUEL*********/
    public function get_event_archive()
    {
        $this->load->helper('date');

        $first_date = '2019-01-01'; // la date a partir de laquelle la selection commence
        
        $date = date("Y-m-d"); // la date a partir de laquelle la selection finie
        $second_date = date('Y-m-d', strtotime($date . '-10 days'));

        $data = array(
            'pageTitle' => 'Evénements passés',
            'title' => 'Evénements passés',
            'events' => $this->event_model->get_event_by_date($first_date, $second_date),
            'session' => $this->session->userdata('username', 'role')
		);

        $this->load->view('templates/header', $data);
        $this->load->view('events/get_by_date', $data);
        $this->load->view('templates/footer');
    }


    /********* CREATE ******************/
    public function add_event()
    {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');
        $this->load->helper('date_helper');

        $data = array(
            'pageTitle' => 'Créer un événement',
            'categories' =>  $this->event_model->all_categ(),
            'technos' => $this->event_model->all_techno(),

            'session' => $this->session->userdata('username', 'role')
		);

        $event_array = $this->get_input_event();
        $categories = $this->input->post('groupe[]');
        $technos = $this->input->post('techno[]');

        $this->form_valid();

        if ($this->form_validation->run() === FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('events/create', $data);
            $this->load->view('templates/footer');
        } else {
            // si une image est à télécharger
            if ($_FILES && $_FILES['userfile']['name']) {
                $this->make_upload($event_array, $categories, $technos);
            } else {
                $this->event_model->create_event($event_array, $categories, $technos);
            }

            redirect(site_url('evenement_cree'));
        }
    }

    /**************SUCCESS CREATE EVENT***********/
    public function success_create_event()
    {
        $data['pageTitle'] = 'Evénement';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/success_event', $data);
        $this->load->view('templates/footer');
    }

    /******************** GET INPUT EVENT *************************/
    private function get_input_event() {
        if($this->input->post('creation_user_id') != null){
            $username_form = $this->input->post('creation_user_id');
            $user_bdd = $this->user_model->get_user_by_username($username_form);
            $id_user = $user_bdd->user_id;
            
            return array(
                'title' => $this->input->post('title'),
                'lieu' => $this->input->post('lieu'),
                'date' => $this->input->post('date'),
                'description' => $this->input->post('description'),
                'hour' => $this->input->post('hour'),
                'creation_user_id' => $id_user,
                'event_image' => empty($_FILES['userfile']['name']) ?  'BWB_logo.png' : $_FILES['userfile']['name'],
            );
        }
    }

    /************** PRIVATE VALIDATION FORM *****************/
    private function form_valid()
    {
        $this->form_validation->set_rules('title', 'Titre', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('lieu', 'Lieu', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('hour', 'Heure', 'required');
        $this->form_validation->set_rules('creation_user_id', 'creation_user_id', 'required');
    }

    private function get_config()
    {
        return array(
            'upload_path' => "./asset/images/",
            'allowed_types' => "jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'max_height' => "1600",
            'max_width' => "2560"
        );
    }

    private function make_upload($event_array, $categories, $technos)
    {
        $config = $this->get_config();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()) {
            array('upload_data' => $this->upload->data());
            return $this->event_model->create_event($event_array, $categories, $technos);
        } else {
            $error = array('error' => $this->upload->display_errors());
            return $this->load->view('events/create', $error);
        }
    }
}

