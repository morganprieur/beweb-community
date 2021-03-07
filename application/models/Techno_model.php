<?php

class Techno_model extends CI_Model {

  public function __construct() {
    $this->load->database();
    $this->load->model('entities/event');
    $this->load->model('entities/category');
    $this->load->model('entities/techno');
    $this->load->model('entities/user');
  }

  /******************* CREATE / UPDATE TECHNO *************************/
  public function set_techno(int $id = 0) {
    $data = array(
      'name' => $this->input->post('name'),
      'description' => $this->input->post('description'),
    );

    if($id <= 0) {
      return $this->db->insert('techno', $data);
    } else {
      $this->db->where('techno_id', $id);
      return $this->db->update('techno', $data);
    }
  }

  /******************* GET_TECHNO ************************************/
  public function get_techno(int $id = 0) {

    //   si $id<=0 on récupère toutes les technos
    if($id<=0) {
      $query = $this->db->get('techno');
      return $query->custom_result_object('techno');
    
    //  sinon on récupère l'$id en paramètre
    } else {
      $query = $this->db->get_where('techno', array('techno_id'=>$id));
      return $query->custom_row_object($id, 'techno');
    }
  }


   

}


