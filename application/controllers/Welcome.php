<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model(array(
			'event_model', 
			'user_model', 
			'staticPage_model'
		));
		$this->load->helper(array(
			'url', 
			'html', 
			'text', 
			'onglet_title'
		));
		$this->load->library('session');
	}

	public function index() {

		$data['session'] = $this->session->userdata('username', 'role');

		//	member
		if($this->session->userdata('role') === 'member') {
			$data = array(
				'pageTitle' => 'Accueil',
				'title' => 'Soyez les bienvenus, anciens élèves de Beweb',
				'qsn' => $this->staticPage_model->get_document(1),
				'events' => $this->event_model->get_all_events(6),
				'session' => $this->session->userdata('username', 'role')
			);
	
			foreach ($data['events'] as $id_event){	//..$this->event_model->get_all_events(6)
				$data['technos'][] = $this->event_model->join_techno($id_event->event_id);
				$data['cats'][] = $this->event_model->join_categ($id_event->event_id);
			};

			$this->load->view('templates/header', $data);
			$this->load->view('index', $data);
			$this->load->view('templates/footer');

		//	admin
		} elseif($this->session->userdata('role') === 'admin') {
			$data = array(
				'pageTitle' => 'Accueil',
				'title' => 'Soyez les bienvenus, anciens élèves de Beweb',
				'qsn' => $this->staticPage_model->get_document(1),
				'events' => $this->event_model->get_all_events(6),
				'session' => $this->session->userdata('username', 'role')
			);

			foreach ($data['events'] as $id_event){	//..$this->event_model->get_all_events(6)
				$data['technos'][] = $this->event_model->join_techno($id_event->event_id);
				$data['cats'][] = $this->event_model->join_categ($id_event->event_id);
			};

			$this->load->view('templates/header', $data);
			$this->load->view('index', $data);			
			$this->load->view('templates/footer');

		//	visiteur pas connecté
		} else {
			$data = array(
				'pageTitle' => 'Accueil',
				'title' => 'Soyez les bienvenus, anciens élèves de Beweb',
				'qsn' => $this->staticPage_model->get_document(1),
				'events' => $this->event_model->get_all_events(6)
			);

			foreach ($data['events'] as $id_event){	//..$this->event_model->get_all_events(6)
				$data['technos'][] = $this->event_model->join_techno($id_event->event_id);
				$data['cats'][] = $this->event_model->join_categ($id_event->event_id);
			};

			$this->load->view('templates/header', $data);
			$this->load->view('index', $data);
			$this->load->view('templates/footer');

		}
	}
}
