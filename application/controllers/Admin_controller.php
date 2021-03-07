<?php

class Admin_controller extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->model(array(
          'event_model',
          'mail_model',
          'techno_model',
          'user_model',
          'faq_page_model',
          'category_model',
          'Faq_page_model',
          'techno_model',
          'staticPage_model'
      ));
      $this->load->helper(array(
          'html',
          'form',
          'url',
          'onglet_title'
      ));
      $this->load->library('session');
  }



  /*****************************************************************************************/
  /************************************* DASHBOARD *****************************************/
  /*****************************************************************************************/

  /**** GET ALL USERS ACTIVE 1 & 0 ****/
  public function get_all_user() {

      $this->load->helper('text');
      $this->load->helper('date');

      foreach ($this->event_model->get_all_events() as $id_event) {
          $table_tech[] = $this->event_model->join_techno($id_event->event_id);
          $table_cat[] = $this->event_model->join_categ($id_event->event_id);
      }

      // la date a partir de laquelle la selection commence
      $date = date("Y-m-d");
      $first_date = date('Y-m-d', strtotime($date . '-10 days'));

      $date_end = '2022-01-01';
      $date1_end = str_replace('-', '/', $date_end);
      // la date a partir de laquelle la selection finit
      $second_date = date('Y-m-d', strtotime($date1_end . '+1 day'));


      //  récupérer les données du model (bdd)
      $data = array(
          'pageTitle' => 'Dashboard',
          'users' => $this->user_model->get_user(),
          'user_activ' => $this->user_model->get_user_activ(),
          'roles' => $this->user_model->join_role(),
          'events_valid' => $this->event_model->get_val_act(),
          'events_not_valid' => $this->event_model->get_events_not_validated(),
          'events' => $this->event_model->get_event_by_date($first_date, $second_date),
          'technos' => $table_tech,
          'categories' => $table_cat,
          'cats' => $this->category_model->get_category(),
          'techs' => $this->techno_model->get_techno(),
          'faqs' => $this->faq_page_model->get_faq(),
          'statics' => $this->staticPage_model->get_document(),
          'session' => $this->session->userdata('username', 'role')
      );

      //  envoyer les données récupérées à la vue
      $this->load->view('templates/header', $data);
      $this->load->view('admin/dashboard', $data);
      $this->load->view('templates/footer');
  }


  /***************** VALIDATE EVENT ***************/
  // passe en 1 is_validated
  public function validated(int $id) {
  
    $this->load->library('Slack');

    // pour modifier dans la dbb is_validated
    $this->event_model->validate($id);

    // recupère le titre, la description de l'event
    $event = $this->event_model->get_event_by_id($id);
    $event_title = $event->title;
    $event_description = $event->description;
    $route_event = site_url('events/view_event/' . $event->event_id);


    // envoie une notification sur le channel dédié de Slack
    $this->slack->send(
        "Un nouvel événement vient d'être validé
        Titre : $event_title,
        Description : $event_description.
        Pour plus d'information, cliquez ici $route_event .
        A très vite !"
    );

    // envoie d'email = confirmation de l'event
    $this->validate_event($id);

    redirect(site_url('dashboard'));
  }


  /***************** REFUS EVENT ***************/
  // passe en 0 is_validated
  public function refus_event($id) {

      $this->event_model->refus_event($id);
      redirect(site_url('dashboard'));
  }


  /***************** ACTIVE EVENT ***************/
  // passe en 1 is_actived
  public function active(int $id) {

      $this->event_model->active($id);
      redirect(site_url('dashboard'));
  }


  /***************** ARCHIVE EVENT ***************/
  // passe en 0 is_active
  public function archive_event($id) {

      $this->event_model->archive($id);
      redirect(site_url('dashboard'));
  }


  /*************** UPDATE EVENT ***************/
  public function update_event($id) {

      //  récupérer les données de la bdd 
      //  pour les afficher dans les values du form
      $data = array(
          'event' => $this->event_model->get_event_by_id($id),
          'pageTitle' => 'Modifier un événement',
          'title' => 'Modifier l\'événement ',
          'categories' =>  $this->event_model->all_categ(),
          'technos' => $this->event_model->all_techno(),
          'session' => $this->session->userdata('username', 'role')
      );

      //  charger le helper de date 
      //  et la library de formulaire pour valider le form à l'envoi
      $this->load->library('form_validation');
      $this->load->helper('date_helper','form', 'url');

      //  regrouper les values des inputs dans des variables
      $event_array = $this->get_input_event();
      $categories = $this->input->post('groupe[]');
      $techs = $this->input->post('tech[]');

      //  règles du formulaire
      $this->form_valid();

      //  Si le formulaire n'a pas été envoyé, l'afficher
      if ($this->form_validation->run() === FALSE) {

          $this->load->view('templates/header', $data);
          $this->load->view('admin/edit_event', $data);
          $this->load->view('templates/footer');

      //  sinon...
      } else {
          // ...si une image est à télécharger 
          //  on appelle la méthode privée make_upload
          //  pour effectuer l'upload en même temps que le formulaire
          if ($_FILES && $_FILES['userfile']['name']) {
              $this->make_upload($id, $event_array, $categories, $techs);
          
          //  si pas d'image à uploader 
          //  on appelle la méthode upate_event de event_model
          //  et on lui passe les variables des inputs
          } else {
              $this->event_model->update_event($id, $event_array, $categories, $techs);
          }

          redirect(site_url('dashboard'));
      }
  }

  private function get_all_catEventType($cat_event, $categories) {
    
      foreach($cat_event as $cat){
          $cat_event_type = $cat->type;

          foreach($categories as $category){
              $category_type = $category->type;
              if($cat_event_type == $category_type){
                  $type_active[] = $cat_event_type;
              }
          }
      }
  }


  /******ACTIVE USER*******/
  // remet le user en actif = is_active à 1
  public function actif_user(int $id) {

      $this->user_model->actif($id);

      // envoie de mail quand le user est activé
      $this->activ_user($id);

      redirect(site_url('dashboard'));
  }


  /******DELETE USER*******/
  // Ne supprime pas mais met en archive en mettant is_active a 0
  public function delete_user(int $id) {

      $this->user_model->delete($id);
      redirect(site_url('dashboard'));
  }


  /*************ADMIN USER************/
  // pour passer de membre a admin
  public function admin($id) {

      $this->user_model->admin($id);
      redirect(site_url('dashboard'));
  }


  /************MEMBER USER***********/
  // pour passer d'admin a membre
  public function member($id) {

      $this->user_model->member($id);
      redirect(site_url('dashboard'));
  }


  /*******METHODE PRIVATE VALIDATE_EVENT*********/
  private function validate_event($id) {

      $event = $this->event_model->get_event_by_id($id);
      $user_username = $event->username;
      $user_mail = $event->mail;
      $event_title = $event->title;
      $message = 'Bonjour ' . $user_username . ',<br> Votre événement : ' . $event_title . 'vient d\'être validé et publié.';

      $this->email->from('duon.caroline@gmail.com'); // adresse mail de l'admin
      $this->email->to($user_mail);

      $this->email->subject('Evénement publié !');
      $this->email->message($message);

      if ($this->email->send()) {
          echo "Mail envoyé, vérifier votre messagerie";
      } else {
          show_error($this->email->print_debugger());
      }
  }

  /************METHODE PRIVATE MAIL ACTIF USER**********/
  private function activ_user($id) {

      // envoie de mail quand le user est activé
      $user = $this->user_model->get_user($id);
      $user_mail = $user->mail;
      $user_username = $user->username;
      $message = 'Bonjour ' . $user_username . ',<br> Votre compte vient d\'être activé. Vous pouvez dès à présent vous connecter. Bonne visite du site !';

      $this->email->from('duon.caroline@gmail.com'); // adresse mail de l'admin
      $this->email->to($user_mail);

      $this->email->subject('Compte actif !');
      $this->email->message($message);

      if ($this->email->send()) {
          echo "Mail envoyé, vérifier votre messagerie";
      } else {
          show_error($this->email->print_debugger());
      }
  }




  /**************************************************************************************** */
  /************************************* SESSION ****************************************** */
  /**************************************************************************************** */

  /********LOG_OUT********/
  public function log_out() {

      $array_items = array('username', 'role');
      $this->session->unset_userdata($array_items);
      redirect(site_url());
  }

  /*******************************************************************/
  /**************************** PRIVATE METHODS **************/
  /*******************************************************************/
  
  /************ VALIDATION FORM *******************/
  private function form_valid() {

    $this->form_validation->set_rules('title', 'Titre', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');
    $this->form_validation->set_rules('lieu', 'Lieu', 'required');
    $this->form_validation->set_rules('date', 'Date', 'required');
    $this->form_validation->set_rules('hour', 'Heure', 'required');
  }
  /************** PRIVATE GET_INPUT_EVENT ********************/
  private function get_input_event() {

    return array(
        'title' => $this->input->post('title'),
        'lieu' => $this->input->post('lieu'),
        'date' => $this->input->post('date'),
        'description' => $this->input->post('description'),
        'hour' => $this->input->post('hour')    //,
    //    'event_image' => $_FILES['userfile']['name']
    );
  }

  /***************** private make_upload ******************************/
  private function make_upload($id, $event_array, $categories, $technos) {

    $config = $this->get_config();
    $this->load->library('upload', $config);

    if ($this->upload->do_upload()) {
        array('upload_data' => $this->upload->data());
        return $this->event_model->create_event($id, $event_array, $categories, $technos);
    } else {
        $error = array('error' => $this->upload->display_errors());
        return $this->load->view('events/create', $error);
    }
  }

  /**************** private get_config pour make_upload */
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
    
}
