<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->model('entities/user');
        $this->load->model('entities/techno');
        $this->load->model('entities/promo');
    }

    /*******GET******/
    public function get_user(int $id = 0)
    {
        // si l'id est <= 0 on récupère tous les users dans la bdd
        if ($id <= 0) {
            $this->db->select('user.*, role.type');
            $this->db->join('role', 'role.role_id = user.fk_roleId');

            $query = $this->db->get('user');
            return $query->custom_result_object('user');

            // si l'id > 0 on récupère les infos du user en fonction de l'id
        } else {
            $query = $this->db->get_where('user', array('user_id' => $id));
            return $query->custom_row_object($id, 'user');
        }
    }

    /****************** GET_USER_BY_USERNAME **********/
    public function get_user_by_username($username)
    {
        $this->db->select('user.*, role.type');
        $this->db->join('role', 'role.role_id = user.fk_roleId');
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->custom_row_object($username, 'user');
    }

    /****************** GET_QQS_USERS ***********/
    public function get_qqs_users(int $limit = 0)
    {
        //  if $limit <= 0 on récupère tous les users
        if ($limit <= 0) {
            $this->db->select('user.*, role.type');
            $this->db->join('role', 'role.role_id = user.fk_roleId');

            $query = $this->db->get('user');
            return $query->custom_result_object('user');

            //  sinon on récupère les 6 premières lignes
        } else {
            $this->db->select('user.*, role.type');
            $this->db->join('role', 'role.role_id = user.fk_roleId');
            $this->db->limit($limit);

            $query = $this->db->get('user');
            return $query->custom_result_object('user');
        }
    }



    /******GET USER IS_ACTIVE = 1*******/
    // affiche uniquement les users actifs
    public function get_user_activ()
    {
        $this->db->select('user.*, role.type');
        $this->db->join('role', 'role.role_id = user.fk_roleId');
        $this->db->where('is_active', 1);
        $query = $this->db->get('user');
        return $query->custom_result_object('user');
    }


    /********JOINTURE USER-TECHNO_USER-TECHNO********/
    // permet d'afficher les techno par user
    public function join_techno(int $id)
    {
        $this->db->select('user.*, techno.name');
        $this->db->from('user');
        $this->db->join('techno_user', 'techno_user.fk_user = user.user_id');
        $this->db->join('techno', 'techno.techno_id = techno_user.fk_techno');
        $this->db->where('user.user_id', $id);
        $query = $this->db->get();
        return $query->custom_result_object('user');
    }


    /*********JOINTURE ROLE-USER*******/
    public function join_role()
    {

        $this->db->select('user.*, role.type');
        $this->db->from('user');
        $this->db->join('role', 'role.role_id = user.fk_roleId');
        $query = $this->db->get();
        return $query->custom_result_object('user');
    }


    /**** CREATE USER *****/
    public function create_user() {

      /** hachage du password **/
      $userName = $this->input->post('username');
      $passwd = $this->input->post('password');
      $hachpasswd = $this->hash_passwd($passwd);

      /**tableau qui récupère les contenu de chaque input du formulaire
       * sauf pour le passwd ou on utilise le haché**/
      $data = array(
        'lastname' => $this->input->post('lastname'),
        'firstname' => $this->input->post('firstname'),
        'mail' => $this->input->post('mail'),
        'username' => $userName,
        'password' => $hachpasswd,
        'user_image' => 'logo.png',
        'linkedin' => $this->input->post('linkedin'),
        'promo' => $this->input->post('promo')
      );
      // insère dans la bdd
      return $this->db->insert('user', $data);
    }


    /*******GET_ALL_ROLE*******/
    public function get_all_promo()
    {
        $query = $this->db->get('promo');
        return $query->custom_result_object('promo');
    }



    /******UPDATE*****/
    public function update_user(int $id)
    {

        // récupère l'avatar du user en fonction de son id
        $query = $this->db->get_where('user', array('user_id' => $id));
        $user = $query->custom_row_object($id, 'user');

        $data = array(
            'lastname' => $this->input->post('lastname'),
            'firstname' => $this->input->post('firstname'),
            'mail' => $this->input->post('mail'),
            'linkedin' => $this->input->post('linkedin'),
            'user_image' => empty($_FILES['userfile']['name']) ?  $user->user_image : $_FILES['userfile']['name'],
            'username' => $this->input->post('username'),
            'promo' => $this->input->post('promo')
        );
        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }


    /******UPDATE PASSWORD*****/
    public function update_password(int $id)
    {
        /**hachage du password actuel**/
        $password = $this->input->post('password_actuel');
        $hachpasswdUpdate = $this->hash_passwd($password);

        // récupère les mot de passe du user en fonction de son id
        $query = $this->db->get_where('user', array('user_id' => $id));
        $user = $query->custom_row_object($id, 'user');

        // si le passwd haché du form est identique que celui de la bdd
        if ($user->password == $hachpasswdUpdate) {
            echo 'Vous n\'avez pas renseignez le bon mot de passe';
            // si identique, on insére dans la bdd    
        } else {
            $password_new = $this->input->post('password_new');
            $hachpw_new = $this->hash_passwd($password_new);

            $data = array(
                'password' => $hachpw_new,
            );
            $this->db->where('user_id', $id);
            return $this->db->update('user', $data);
        }
    }


    /*******CREATE TECHNO*********/
    public function create_techno($id, $technos)
    {
        // inserer user_id, techno_id dans la table techno_user
        foreach ($technos as $techno) {
            $data_techno_create = array(
                'fk_techno' => $techno,
                'fk_user' => $id
            );
            // $this->db->set($data);
            $this->db->insert('techno_user', $data_techno_create);
        }
    }


    /********UPDATE TECHNO*********/
    public function update_techno($id, $technos)
    {
        // supprime avant de modifier
        $this->db->delete('techno_user', array('fk_user' => $id));

        // inserer user_id, techno_id dans la table techno_user
        foreach ($technos as $techno) {
            $data = array(
                'fk_techno' => $techno,
                'fk_user' => $id
            );
            $this->db->insert('techno_user', $data);
        }
    }



    /******DELETE = ARCHIVE******/
    // Ne supprime pas mais met en archive le user en mettant is_active a 0
    public function delete(int $id)
    {
        $data = array(
            'is_active' => 0
        );

        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }



    /*******ACTIVER = REMET ACTIF*****/
    public function actif(int $id)
    {
        $data = array(
            'is_active' => 1
        );

        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }


    /*********CONNEXION********/
    public function login()
    {
        $user_form = $this->input->post('username');

        $query = $this->db->get_where('user', array('username' => $user_form));
        return $query->custom_row_object($user_form, 'user');
    }


    /********ADMIN********/
    // pour passer de membre a admin
    public function admin(int $id)
    {
        $data = array(
            'fk_roleId' => 2
        );

        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }


    /********MEMBER********/
    // pour passer d'admin a membre
    public function member(int $id)
    {
        $data = array(
            'fk_roleId' => 1
        );
        $this->db->where('user_id', $id);
        return $this->db->update('user', $data);
    }


    /******METHODE DE HACHAGE*******/
    private function hash_passwd($passwd)
    {
        return password_hash($passwd, PASSWORD_DEFAULT);
    }
}
