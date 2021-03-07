<?php

class StaticPage_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('entities/Static_page');
    }


    /**********GET*********/
    public function get_document(int $id = 0)
    {
        if ($id <= 0) {
            $query = $this->db->get('static_page');
            return $query->custom_result_object('static_page');
        } else {
            $query = $this->db->get_where('static_page', array('documentId' => $id));
            return $query->custom_row_object($id, 'static_page');
        }
    }


    /******CREATE and UPDATE*******/
    public function set_staticPage(int $id = 0)
    {
        // récupère l'image du document
        $query = $this->db->get_where('static_page', array('documentId' => $id));
        $doc = $query->custom_row_object($id, 'static_page');


        if ($id <= 0) {
            $data = array(
                'title' => $this->input->post('title'),
                'text' => $this->input->post('text'),
                'lien_doc' => $this->input->post('lien_doc'),
                'image' => $_FILES['userfile']['name'],
                'video' => $this->input->post('video')
            );
    
            return $this->db->insert('static_page', $data);
        }
        $data = array(
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
            'lien_doc' => $this->input->post('lien_doc'),
            'image' => empty($_FILES['userfile']['name']) ?  $doc->image : $_FILES['userfile']['name'],
            'video' => $this->input->post('video')
        );

        $this->db->where('documentId', $id);
        return $this->db->update('static_page', $data);
    }


    /********DELETE*********/
    public function delete_staticPage(int $id)
    {
        return $this->db->delete('static_page', array('documentId' => $id));
    }
}
