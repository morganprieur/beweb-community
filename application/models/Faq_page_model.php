<?php
class Faq_page_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('entities/faq_page');
    }


    /***********GET FAQ*********/
    public function get_faq(int $id = 0)
    {
        if ($id <= 0) {
            $query = $this->db->get('faq_page');
            return $query->custom_result_object('faq_page');
        } else {
            $query = $this->db->get_where('faq_page', array('faq_id' => $id));
            return $query->custom_row_object($id, 'faq_page');
        }
    }


    /***********CREATE - UPDATE FAQ*********/
    public function set_faq(int $id = 0)
    {
        $data = array(
            'question' => $this->input->post('question'),
            'answer' => $this->input->post('answer')
        );

        if ($id <= 0) {
            return $this->db->insert('faq_page', $data);
        } else {
            $this->db->where('faq_id', $id);
            return $this->db->update('faq_page', $data);
        }
    }


    /********DELETE*********/
    public function delete_faq(int $id)
    {
        return $this->db->delete('faq_page', array('faq_id' => $id));
    }
}
