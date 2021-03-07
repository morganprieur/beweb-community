<?php
class MonCompte_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('event_model');
        $this->load->model('techno_model');
        $this->load->helper(array('form', 'text', 'html', 'url_helper', 'url', 'onglet_title_helper'));
        $this->load->library('session');
    }


    /**********GET EVENT BY ID USER*********/
    public function get_event_by_id_user()
    {
        $id_user = $this->id_session();

        $data = array(
            'pageTitle' => 'Mon compte',
            'title' => 'Mon compte',
            'events' => $this->event_model->get_event_by_id_user($id_user),
            'session' => $this->session->userdata('username', 'role'),
            'user' => $this->user_model->get_user($id_user),
            'technos' => $this->user_model->join_techno($id_user)
        );

        $this->load->view('templates/header', $data);
        $this->load->view('users/mon_compte', $data);
        $this->load->view('templates/footer');
    }


    /******UPDATE USER*******/
    public function update_user(int $id)
    {
        $this->load->library('form_validation');

        $data['single_user'] = $this->user_model->get_user($id);
        $data['pageTitle'] = 'Modifier mon profil';

        $this->form_validation->set_rules('lastname', 'Lastname');
        $this->form_validation->set_rules('firstname', 'Firstname');
        $this->form_validation->set_rules('mail', 'Mail', 'valid_email');
        $this->form_validation->set_rules('linkedin', 'linkedin');
        $this->form_validation->set_rules('userfile', 'upload-image');
        $this->form_validation->set_rules('username', 'Username slack');
        $this->form_validation->set_rules('promo', 'Promo');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/update', $data);
            $this->load->view('templates/footer');
        } else {
            if (!empty($_FILES['userfile']['name'])) {
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
                    $this->user_model->update_user($id);
                    redirect(site_url('mon_compte'));
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    return $this->load->view('users/update', $error);
                }
            } else {
                $this->user_model->update_user($id);
                if($_SESSION['role'] === 'member'){
                    redirect(site_url('mon_compte'));
                } elseif($_SESSION['role'] === 'admin'){
                    redirect(site_url('dashboard'));
                }
            }
        }
    }



    /****** UPDATE TECHNO *******/
    public function update_techno()
    {
        $this->load->library('form_validation');

        $data = array(
            'pageTitle' => 'Ajouter des technos',
            'technos' => $this->event_model->all_techno(),
            'session' => $this->session->userdata('username', 'role')
        );

        $this->form_validation->set_rules('techno[]', 'Techno', 'required');

        $id = $this->id_session();
        $technos = $this->input->post('techno[]');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/update_techno', $data);
            $this->load->view('templates/footer');
        } else {
            if (empty($this->user_model->join_techno($id))) {
                $this->user_model->create_techno($id, $technos);
            } else {
                $this->user_model->update_techno($id, $technos);
            }
            redirect(site_url('mon_compte'));
        }
    }




    /************UPDATE PASSWORD***********/
    public function update_password()
    {
        $this->load->library('form_validation');

        $id = $this->id_session();

        $data['single_user'] = $this->user_model->get_user($id);

        $this->form_validation->set_rules('password_actuel', 'password_actuel', 'required');
        $this->form_validation->set_rules('password_new', 'password_new', 'required');
        $this->form_validation->set_rules('password_confirm', 'password_confirm', 'required|matches[password_new]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/mon_compte', $data);
            $this->load->view('templates/footer');
        } else {
            $this->user_model->update_password($id);
            redirect(site_url('success_edit_pw'));
        }
    }



    /**************SUCCESS EDIT PASSWORD***********/
    public function success_edit_pw()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/success_edit_pw');
        $this->load->view('templates/footer');
    }


    /******DELETE*******/
    // Ne supprime pas mais met en archive en mettant is_active a 0
    // supprime la session
    public function delete_user()
    {
        // is_active a 0
        $id = $this->id_session();
        $this->user_model->delete($id);

        // log_out
        $array_items = array('username', 'role');
        $this->session->unset_userdata($array_items);

        redirect(site_url());
    }


    /**********recup id session*******/
    private function id_session()
    {
        $username_session = $_SESSION['username'];
        $user_bdd = $this->user_model->get_user_by_username($username_session);
        return $user_bdd->user_id;
    }
}
