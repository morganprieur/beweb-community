<?php

class Event_model extends CI_Model
{

    public function __construct() {

        $this->load->database();
        $this->load->model('entities/event');
        $this->load->model('entities/category');
        $this->load->model('entities/techno');
        $this->load->model('entities/user');
    }

    /********* CREATE ******************/
    public function create_event($dataArray, $categories, $technos) {

      $this->db->insert('event', $dataArray);

      // recupèrer l'id du dernier event créé
      $insert_id = $this->db->insert_id();

      // inserer event_id, category_id dans la table category_event
      foreach ($categories as $category) {
        $data_categ = array(
          'fk_category_id' => $category,
          'fk_event_id' => $insert_id
        );
        $this->db->insert('category_event', $data_categ);
      }

      // inserer event_id, techno_id dans la table techno_event
      foreach ($technos as $techno) {
        $data_techno = array(
          'fk_techno' => $techno,
          'fk_event' => $insert_id
        );
        $this->db->insert('techno_event', $data_techno);
      }
    }


    /********* GET_ALL_EVENTS ******************/
    public function get_all_events(int $limit = 0) {
    
      //  Si $limit <= 0 on récupère tous les events
      if ($limit <= 0) {
        $this->db->select('event.*, user.username');
        $this->db->from('event');
        $this->db->join('user', 'user.user_id = event.creation_user_id');
        $query = $this->db->get();
        return $query->custom_result_object('event');

        //  si $limit >= 1 on récupère ce nombre de lignes
      } else {
        $this->db->select('event.*, user.username');
        $this->db->from('event');
        $this->db->join('user', 'user.user_id = event.creation_user_id');
        $this->db->limit(6);
        $query = $this->db->get();
        return $query->custom_result_object('event');
      }
    }


    /********* GET_ALL_EVENTS VALIDATED 1 ******************/
    public function get_events_validated()
    {
        $this->db->select('event.*, user.username');
        $this->db->join('user', 'user.user_id = event.creation_user_id');
        $this->db->where('event.is_validated', 1);
        $query = $this->db->get('event');
        return $query->custom_result_object('event');
    }


    /*********** GET BY ID *************/
    public function get_event_by_id($id)
    {
        $this->db->select('event.*, user.user_id, user.username, user.mail');
        $this->db->join('user', 'user.user_id = event.creation_user_id', 'left');
        $query = $this->db->get_where('event', array('event_id' => $id));
        return $query->custom_row_object($id, 'event');
    }

    /***recup toutes les technos*** */
    public function all_techno()
    {
        $query = $this->db->get('techno');
        return $query->custom_result_object('techno');
    }

    /***recup toutes les categ*** */
    public function all_categ()
    {
        $query = $this->db->get('category');
        return $query->custom_result_object('category');
    }


    /********GET EVENT BY ID USER**********/
    public function get_event_by_id_user($id)
    {
        $query = $this->db->get_where('event', array('creation_user_id' => $id));
        return $query->custom_result_object('event');
    }


    /*************** JOINTURE CATEGORY-CATEGORY_EVENT-EVENT *****************/
    public function join_categ(int $id)
    {
        $this->db->select('event.*, category.*');
        $this->db->from('event');
        $this->db->join('category_event', 'category_event.fk_event_id=event.event_id');
        $this->db->join('category', 'category_event.fk_category_id=category.category_id');
        $this->db->where('event.event_id', $id);
        $query = $this->db->get();
        return $query->custom_result_object('event');
    }

    /************** JOINTURE TECHNO-TECHNO_EVENT-EVENT *******************/
    public function join_techno(int $id)
    {
        $this->db->select('event.event_id, techno.name');
        $this->db->from('event');
        $this->db->join('techno_event', 'techno_event.fk_event = event.event_id');
        $this->db->join('techno', 'techno_event.fk_techno = techno.techno_id');
        $this->db->where('event.event_id', $id);
        $query = $this->db->get();
        return $query->custom_result_object('event');
    }

    /****************************/
    /*          ADMIN           */
    /****************************/

    /********* UPDATE ******************/
    public function update_event(int $id, $event_array, $categories, $techs) {

        $this->db->where('event_id', $id);
        $this->db->update('event', $event_array);

        // supprime avant de modifier
        $this->db->delete('category_event', array('fk_event_id' => $id));
        $this->db->delete('techno_event', array('fk_event' => $id));
        
        // inserer event_id, category_id dans la table category_event
        if( !empty($categories) ) {
            foreach ($categories as $category) {
                $data_categ = array(
                    'fk_category_id' => $category,
                    'fk_event_id' => $id
                );

                $this->db->insert('category_event', $data_categ);
            }
        }
    
        // inserer event_id, techno_id dans la table techno_event
        if( !empty($techs) ) {
            foreach($techs as $tech) {
                $data_techno = array(
                    'fk_techno' => $tech,
                    'fk_event' => $id
                );

                $this->db->insert('techno_event', $data_techno);
            }
        }
    }

    /********GET EVENT BY DATE*********/
    public function get_event_by_date($first_date, $second_date)
    {
        $this->db->select('event.*, user.username');
        $this->db->from('event');
        $this->db->join('user', 'user.user_id = event.creation_user_id');
        $this->db->where('date >=', $first_date);
        $this->db->where('date <=', $second_date);
        $query = $this->db->get();
        return $query->custom_result_object('event');

    }


    /*********GET EVENT ARCHIV********/
    public function get_event_archiv()
    {
        $query = $this->db->get_where('event', array('is_active' => 0));
        return $query->custom_result_object('event');
    }


    /************ GET_EVENTS_NOT_VALIDATED **************/
    public function get_events_not_validated()
    {
        $query = $this->db->get_where('event', array('is_validated' => 0));
        return $query->custom_result_object('event');
    }


    /******EVENT VALID AND ACTIV*******/
    public function get_val_act()
    {
        $query = $this->db->get_where('event', array('is_validated' => 1, 'is_active' => 1));
        return $query->custom_result_object('event');
    }


    /************** VALIDATE EVENT ****************/
    public function validate(int $id)
    {
        $data = array(
            'event_id' => $id,
            'is_validated' => 1
        );
        $this->db->where('event_id', $id);
        return $this->db->update('event', $data);
    }


    /************** refus EVENT ****************/
    public function refus_event(int $id)
    {
        $data = array(
            'event_id' => $id,
            'is_validated' => 0
        );
        $this->db->where('event_id', $id);
        return $this->db->update('event', $data);
    }


    /************** active EVENT ****************/
    public function active(int $id)
    {
        $data = array(
            'event_id' => $id,
            'is_active' => 1
        );
        $this->db->where('event_id', $id);
        return $this->db->update('event', $data);
    }


    /************** archive EVENT ****************/
    public function archive(int $id)
    {
        $data = array(
            'event_id' => $id,
            'is_active' => 0
        );
        $this->db->where('event_id', $id);
        return $this->db->update('event', $data);
    }



    /************** DELETE_EVENT ***********************/
    public function delete_event(int $id)
    {
        $data = array('event_id' => $id);
        $this->db->where($data);
        $this->db->delete('event');
    }
}