<?php

class Mail_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('email');
        $this->load->model('entities/user');
    }


    /******FORMULAIRE DE CONTACT*******/
    public function mail() {
    
      $email = $this->input->post('mail');
      $pseudo = $this->input->post('pseudo');
      $content = $this->input->post('content');


      $this->email->from($email, $pseudo);
      $this->email->to('duon.caroline@gmail.com'); // adresse mail de l'admin
      //  mettre ce code dans le controller pour récupérer l'adresse mail de l'admin 
      //  et la mettre dans $this->email->to()

      $this->email->subject('Formulaire de contact envoye par ' . $pseudo);
      $this->email->message($content);

      $this->email->send();
    }

    /* Trouver aussi comment envoyer une copie du mail à l'expéditeur */

    /* Si des liens doivent être envoyés par mail, il faudrait mettre 
        {unwrap}http://example.com/a_long_link_that_should_not_be_wrapped.html{/unwrap}
        autour pour qu'ils ne soient pas wrapés comme du texte et coupés, ce qui les 
        rendrait umpossibles à cliquer. Si on veut qu'ils restent cliquable il faudra 
        mettre un truc (en regex ?) pour reconnaitre que c'est un lien et l'entourer de ces 
        mots-clé    */
 


    /*********** MOT DE PASSE OUBLIE *******/
    public function pw_forget() {
    
      // verification de l'email avec la bdd 
      $email_form = $this->input->post('mail');
      $query = $this->db->get_where('user', array('mail' => $email_form));
      $email_bdd = $query->custom_row_object($email_form, 'user');

      //  S'il n'est pas présent dans la BDD
      if ($email_form != $email_bdd->mail) {
        echo "Cet email n'existe pas";

        //  s'il est présent on crée un token via 2 méthodes privées
      } else {
        $token = $this->token_mail();

        $this->update_token($token, $email_form);

        $message = "Veuillez cliquer sur le lien pour reinitialiser votre mot de passe "
         . base_url() . "index.php/mail/reset/" . bin2hex($token);

        $this->email->from('duon.caroline@gmail.com'); // adresse mail de l'admin
        $this->email->to($email_form);

        $this->email->subject('Mot de passe oublie');
        $this->email->message($message);

        if ($this->email->send()) {
            echo "Mail envoyé, vérifier votre messagerie";
        } else {
            show_error($this->email->print_debugger());
        }
      }
    }


    // réinitialiser le mot de passe
    public function upload_mp()
    {
        // Il faudrait vérifier le token avant de changer le mdp ou (voir ligne 112)
        $token = $this->input->post('token');

        $password = $this->input->post('password');
        $hachpasswdUpdate = $this->hash_passwd($password);

        $data = array(
            'password' => $hachpasswdUpdate
        );

        $this->db->where('token', $token);
        return $this->db->update('user', $data);

        /* (suite ligne 99)
        si token n'est pas bon, on fait quoi ?
        */
    }


    /********** TOKEN MAIL OUBLIE ********/
    // creation du token
    private function token_mail() {

      return random_bytes(10);
    }

    // ajout du token dans la bdd
    private function update_token($token, $mail) {
      
        $data = array('token' => bin2hex($token));

        $this->db->where('mail', $mail);
        return $this->db->update('user', $data);
    }



    /******METHODE DE HACHAGE*******/
    private function hash_passwd($passwd) {

        return password_hash($passwd, PASSWORD_DEFAULT);
    }
}
