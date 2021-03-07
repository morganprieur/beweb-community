<?php

class Category_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('entities/category');
    }

    /*********************** CREATE UPDATE CATEGORY *******************/
    public function set_category(int $id = 0)
    {

        $data = array(
            'type' => $this->input->post('type'),
            'description' => $this->input->post('description')
        );

        //  si id <= 0 on crée une nouvelle catégorie
        if ($id <= 0) {
            return $this->db->insert('category', $data);

            //  sinon on update la catégorie de l' $id
        } else {
            $this->db->where('category_id', $id);
            return $this->db->update('category', $data);
        }
    }


    /*********************** GET CATEGORY *******************************/
    public function get_category(int $id = 0)
    {

        //  si $id <= 0 on récupère toutes les catégories
        if ($id <= 0) {
            $query = $this->db->get('category');
            return $query->custom_result_object('category');

            //  sinon on récupère l'$id en paramètre
        } else {
            $query = $this->db->get_where('category', array('category_id' => $id));
            return $query->custom_row_object($id, 'category');
        }
    }


    /*********************GET CATEGORY_EVENT BY ID***********************/
    public function get_category_event_by_id($id)
    {
        $query = $this->db->get_where('category_event', array('fk_category_id', $id));
        return $query->custom_result_object('category_event');
    }
}
