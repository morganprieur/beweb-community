<?php
class StaticPage_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StaticPage_model');
        $this->load->library('session');
        $this->load->helper(array('form', 'text', 'html', 'url_helper', 'url', 'onglet_title_helper'));
    }


    /***********GET ALL**********/
    public function get_all()
    {
        $data = array(
            'pageTitle' => 'Documents',
            'documents' => $this->StaticPage_model->get_document(),
            'session' => $this->session->userdata('username', 'role')
		);


        $this->load->view('templates/header', $data);
        $this->load->view('staticPage/get_all', $data);
        $this->load->view('templates/footer');
    }


    /**********GET ALL BY ID***********/
    public function get_by_id(int $id)
    {
        $data = array(
            'pageTitle' => 'Document',
            'document' => $this->StaticPage_model->get_document($id),
            'docs' => $this->StaticPage_model->get_document(),
            'session' => $this->session->userdata('username', 'role')
		);

        $this->load->view('templates/header', $data);
        $this->load->view('staticPage/get_by_id_staticPage', $data);
        $this->load->view('templates/footer');

    }


    /***********CREATE*************/
    public function create_staticPage()
    {
        $this->load->library('form_validation');

        $data = array(
            'pageTitle' => 'Document',
            'session' => $this->session->userdata('username', 'role')
        );
        
        $this->form_validation->set_rules('title', 'Titre', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_rules('lien_doc', 'Lien');
        $this->form_validation->set_rules('userfile', 'upload-image');
        $this->form_validation->set_rules('video', 'Video');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('staticPage/create', $data);
            $this->load->view('templates/footer');
        } else {
            if (!empty($_FILES['userfile']['name'])) {
                // tableau de régles pour l'upload
                $configUpload = array(
                    'upload_path' => "./asset/images/",
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'max_size' => "2048000",
                    'max_height' => "1600",
                    'max_width' => "2560"
                );

                $this->load->library('upload', $configUpload);

                if ($this->upload->do_upload()) {
                    array('upload_data' => $this->upload->data());
                    $this->StaticPage_model->set_staticPage();
                    redirect(site_url('dashboard'));
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    return $this->load->view('users/update', $error);
                }
            } else {
                $this->StaticPage_model->set_staticPage();
                redirect(site_url('dashboard'));
                }
        }
    }


        /***********UPDATE*************/
        public function update_staticPage(int $id)
        {
            $this->load->library('form_validation');
    
            $data = array(
                'pageTitle' => 'Modifier document',
                'single_staticPage' => $this->StaticPage_model->get_document($id),
                'session' => $this->session->userdata('username', 'role')
            );
            
            $this->form_validation->set_rules('title', 'Titre', 'min_length[5]');
            $this->form_validation->set_rules('text', 'Text');
            $this->form_validation->set_rules('lien_doc', 'Lien');
            $this->form_validation->set_rules('userfile', 'upload-image');
            $this->form_validation->set_rules('video', 'Video');

            var_dump($this->StaticPage_model->set_staticPage($id));
    
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('staticPage/update', $data);
                $this->load->view('templates/footer');
            } else {
                if (!empty($_FILES['userfile']['name'])) {
                    // tableau de régles pour l'upload
                    $configUpload = array(
                        'upload_path' => "./asset/images/",
                        'allowed_types' => "jpg|png|jpeg",
                        'overwrite' => TRUE,
                        'max_size' => "2048000",
                        'max_height' => "1600",
                        'max_width' => "2560"
                    );
    
                    $this->load->library('upload', $configUpload);
    
                    if ($this->upload->do_upload()) {
                        array('upload_data' => $this->upload->data());
                        $this->StaticPage_model->set_staticPage($id);
                        redirect(site_url('dashboard'));
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        return $this->load->view('users/update', $error);
                    }
                } else {
                    $this->StaticPage_model->set_staticPage($id);
                    redirect(site_url('dashboard'));
                    }
            }
        }
    

    /**************DELETE PAGE STATIC*********/
    public function delete_staticPage(int $id)
    {
        $this->StaticPage_model->delete_staticPage($id);
        redirect(site_url('dashboard'));
    }
}
