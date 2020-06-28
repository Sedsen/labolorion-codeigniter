<?php 		
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('domaineModel');
        $this->load->model('sousDomaineModel');
        $this->load->model('produit_model');
        $this->load->model('/authentification/user_model');
        $this->load->model('discussion_model');
        $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->form_validation->set_error_delimiters('<div class="alert-danger ">','</div>');
	}
	public function index()
	{
		$this->load->view('/nav/header');
		$this->load->view('/authentification/connection');
		$this->load->view('/nav/footer');
	}
	public function connection() //connexion
	{
		$this->form_validation->set_rules('username', "Nom d'utilisateur", 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
		$this->form_validation->set_rules('password', "mot de passe", 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('/nav/header');
			$this->load->view('/authentification/connection');
			$this->load->view('/nav/footer');
		} else {
			$data = array();
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->user_model->login($username,$password);

			if ($this->session->utilisateur == NULL) {
				$data['login_error'] =  "le nom d'utilisateur ou le mot de passe est incorrect";
				$this->load->view('/nav/header');
				$this->load->view('/authentification/connection',$data);
				$this->load->view('/nav/footer');
			} 

			$this->load->view('/nav/header');
			$this->load->view('/authentification/connection',$data);
			$this->load->view('/nav/footer');

			//$hash = password_hash($password,PASSWORD_DEFAULT);
			/*$data = $this->user_model->select_user($username);

			var_dump(password_verify($password,$data[0]->password));
			$this->session->utilisateur = $data;
			if ($data != FALSE || $data != NULL) {
				foreach ($data as $row) {
					if ($username == $row->username && password_verify($password,$row->password)) {
						
				    	$page_data = array('username' => $username, 'password' => $password);

						$this->load->view('/nav/header');
						//$this->load->view('accueil',$data);
						$this->load->view('/authentification/echec_connection',$page_data);
						$this->load->view('/nav/footer');
					}
					/*else {
						//$this->session->utilisateur = NULL;
						//echo "Revérifier le mot de passe";
						var_dump($this->session->utilisateur);
						//redirect('authentification');
						$this->load->view('/nav/header');
						$this->load->view('/authentification/echec_connection');
						$this->load->view('/nav/footer');
					}*
				} 
			
			} else {
				//var_dump($this->session->utilisateur);

				//$user = array('user_session' => $this->session->utilisateur);
				//echo $user['user_session'];
				$this->load->view('/nav/header');
				$this->load->view('/authentification/echec_connection');
				$this->load->view('/nav/footer');
				//redirect('authentification/deconnexion');
			}*/
			
		}
	}

	public function deconnexion()
	{
		$this->user_model->deconnexion();
		redirect('authentification/index');

	}

	public function enregistrer()
	{
		$this->load->view('/nav/header');
		$this->load->view('/authentification/enregistrement');
		$this->load->view('/nav/footer');
	}

	public function ajouter_user()
	{
		$this->form_validation->set_rules('name', 'Nom', 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
		$this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
		$this->form_validation->set_rules('username', "Nom d'utilisateur", 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
		$this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
		$this->form_validation->set_rules('confirmation', 'confirmation du mot de passe ', 'trim|required|min_length[2]|max_length[255]|matches[password]',array('required'=> 'Le champs %s doit être rempli','matches' => 'Le champs %s doit être strictement égal au champs mot de passe') );
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|min_length[5]|max_length[255]|valid_email');

		if ($this->form_validation->run() ==  FALSE) {
			//redirect('/authentification/enregistrer','refresh');

			$this->load->view('/nav/header');
			$this->load->view('/authentification/enregistrement');
			$this->load->view('/nav/footer');
		} else {
			$data = array(
				'nom_user' => $this->input->post('name'),
				'prenom_user' => $this->input->post('prenom'),
				'username' =>  $this->input->post('username'),
				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'email' => $this->input->post('Email'),
				'pwd_code' => random_string('alnum',8)
			);
			$this->user_model->enregistrer($data);

			$admins = $this->user_model->select_admin();
			foreach ($admins as $admin) {
				$chat_data = array(
					'user_id' => $data['username'],
					'admin_id' => $admin->username
				);
				$this->discussion_model->add_chat($chat_data['user_id'],$chat_data['admin_id']);
			}
			
		}
		
	}

}

/* End of file authentification.php */
/* Location: ./application/controllers/authentification.php */