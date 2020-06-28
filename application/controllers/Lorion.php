<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * summary
	 */
	class Lorion extends CI_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('domaineModel');
	        $this->load->model('sousDomaineModel');
	        $this->load->model('produit_model');
	        $this->load->model('/authentification/user_model');
	        $this->load->model('discussion_model');
	        $this->load->library('image_lib');
	        $this->load->library('form_validation');
	        $this->load->library('upload');
	        $this->load->library('cart');
	        $this->form_validation->set_error_delimiters('<div class="alert-danger ">','</div>');
	      //  $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
	    }

	    function index($nb_produit = 1)
	    {
	    	
	    	$nb_total = $this->produit_model->total_produit_enregistrer();
			//var_dump($nb_total);
	    	$this->load->library('pagination');

	    	if ($nb_produit > 1){
	    		if ($nb_produit <= $nb_total) {
	    			$nb = intval($nb_produit);
	    		}
	    		else {
	    			$nb = 1;
	    		}
	    	}
	    	else {
	    		$nb = 1;
	    	}
	    	
	    	$config['base_url'] = 'http://localhost/LaboLorion/index.php/Lorion/index';
	    	$config['total_rows'] = $nb_total;
	    	$config['per_page'] = 24;
	    	$config['uri_segment'] = 3;
	    	$config['num_links'] = 3;
	    	$config['full_tag_open'] = '<nav><ul class="pagination">';
	    	$config['full_tag_close'] = '</ul></nav>';
	    	$config['first_link'] = 'First';
	    	$config['first_tag_open'] = '<li class="page-item">';
	    	$config['first_tag_close'] = '</li>';
	    	$config['last_link'] = 'Last';
	    	$config['last_tag_open'] = '<li class="page-item">';
	    	$config['last_tag_close'] = '</li>';
	    	$config['next_link'] = '&gt;';
	    	$config['next_tag_open'] = '<li class="page-item">';
	    	$config['next_tag_close'] = '</li>';
	    	$config['prev_link'] = '&lt;';
	    	$config['prev_tag_open'] = '<li class="page-item">';
	    	$config['prev_tag_close'] = '</li>';
	    	$config['cur_tag_open'] = '<li class="page-item active"> <span class="page-link">';
	    	$config['cur_tag_close'] = '<span class="sr-only">(current)</span> </span> </li>';
	    	//$config['page_query_string'] = TRUE;
	    	$config['attributes'] = array('class' => 'page-link text-center','style' => "width:40px;height:40px;");
	    	
	    	$this->pagination->initialize($config);

	    	$data['pagination'] = $this->pagination->create_links();
	    	$data['produits'] = $this->produit_model->recuperer_liste_produit($config['per_page'],$nb-1);
	    	$data['par_page'] = $config['per_page'];
	    	$data['nb_produit'] = $nb-1;
	    	//var_dump($data);

	    	$this->load->view('/nav/header');
	    	$this->load->view('accueil',$data);
	    	$this->load->view('/nav/footer');
	    }

	    function afficher_domaine()
	    {	
	    	
	    	$this->load->view('/nav/header');
	    	$this->load->view('/admin/admin');
	    	$this->load->view('/nav/footer');
	    }

	    function ajouter()
	    {
	    	$this->form_validation->set_rules('domaine', 'Domaine', 'trim|required|min_length[2]|max_length[255]',
	    										array('required' => 'Le champs %s est requis'));

	    	if ($this->form_validation->run() == FALSE ) {
	    		# code...
	    		echo "L'ajout n'a pas réussi";
	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/admin');
	    		$this->load->view('/nav/footer');
	    	} else {
	    		$data = array('nom_domaine' => html_escape($this->input->post('domaine')));
	    		$this->domaineModel->ajouter($data['nom_domaine']);
	    		//var_dump($this->domaineModel->ajouter($data['nom_domaine']));
	    		
	    			$this->load->view('/nav/header');
	    			$this->load->view('/admin/admin');
	    			$this->load->view('/nav/footer');
	    		
	    	}
	    }
	    function supprimer($id)
	    {
	    	$data = array('id' => $id);
	    	//var_dump($data);
	    	$this->domaineModel->supprimer($data['id']);


	    	$this->load->view('/nav/header');
	    	$this->load->view('/admin/admin',$data);
	    	$this->load->view('/nav/footer');
	    }
	   /* function afficherModalSupprimer()
	    {
	    	$this->load->view('/nav/header');
	    	//$this->load->view('/admin/admin');
	    	$this->load->view('/admin/modalSupprimer');
	    	$this->load->view('/nav/footer');
	    }*/

	    function modifier_domaine($id)
	    {

	    	$this->form_validation->set_rules('modif_domaine', 'modification du domaine', 'trim|required|min_length[2]|max_length[255]',
	    										array('required' => 'Le champs %s est requis','min_length' => 'Le champs %s doit avoir au moins deux lettres'));
	    	if ($this->form_validation->run() == FALSE) {
	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/admin');
	    		$this->load->view('/nav/footer');
	    	} else {
	    		$data = array('nom_domaine' => $this->input->post('modif_domaine'));
	    		$this->domaineModel->modifier_domaine($id,$data['nom_domaine']);

	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/admin');
	    		$this->load->view('/nav/footer');
	    	}
	    }


	    function afficher_sous_domaine()
	    {
	    	$this->load->view('/nav/header');
	    	$this->load->view('/admin/adminSousDomaine');
	    	$this->load->view('/nav/footer');
	    }

	    function ajouter_sous_domaine()
	    {
	    	$this->form_validation->set_rules('sous_domaine', 'Sous domaine', 'trim|required|min_length[2]|max_length[255]',
	    										array('required' => 'Le champs %s est requis'));
	    	if ($this->form_validation->run() == FALSE) {
	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/adminSousDomaine');
	    		$this->load->view('/nav/footer');
	    	} else {
	    		$data = array('nom_sous_domaine' => $this->input->post('sous_domaine'), 'mon_select' => $this->input->post('mon_select'));
	    		$this->sousDomaineModel->ajouter($data['mon_select'],$data['nom_sous_domaine']);
	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/adminSousDomaine');
	    		$this->load->view('/nav/footer');
	    	}
	    }

	    function supprimer_sous_domaine($domaine_id,$sous_domaine)
	    {
	    	$this->sousDomaineModel->supprimer_sous_domaine($domaine_id,$sous_domaine);
	    	$this->load->view('/nav/header');
	    	$this->load->view('/admin/adminSousDomaine');
	    	$this->load->view('/nav/footer');
	    }

	    function modifier_sous_domaine($id)
	    {
	    	$this->form_validation->set_rules('modif_sous_domaine', 'modification sous domaine', 'trim|required|min_length[2]|max_length[255]',array('required' => 'Le champs %s est requis'));
	    	if ($this->form_validation->run() == FALSE) {
	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/adminSousDomaine');
	    		$this->load->view('/nav/footer');
	    	} else {
	    		$data = array('nom_sous_domaine' => $this->input->post('modif_sous_domaine'),'domaine_id' => $this->input->post('modif_select'));
	    		$this->sousDomaineModel->modifier_sous_domaine($id,$data['domaine_id'],$data['nom_sous_domaine']);

	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/adminSousDomaine');
	    		$this->load->view('/nav/footer');
	    	}
	    }

	    function ajouter_produit()
	    {
	    	$this->form_validation->set_rules('nom_produit', 'Produit', 'trim|required|min_length[2]|max_length[255]',
	    										array('required'=>'Le champs %s est requis'));
	    	$this->form_validation->set_rules('prix_vente', 'Prix', 'trim|required|min_length[1]|max_length[12]|integer',array('integer' => 'Le champs %s ne doit contenir que des nombres'));
	    	

	    	$config['upload_path'] = "./assets/upload";
	    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	    	$config['max_size']  = '100000';
	    	$config['max_width']  = '10240';
	    	$config['max_height']  = '7680';
	    	
	    	//$this->load->library('upload', $config);
	    	$this->upload->initialize($config);
	    	
	    	if ( ! $this->upload->do_upload('image_produit')){
	    		$error = array('error' => $this->upload->display_errors());
	    		//echo "Erreur";
	    		//var_dump($this->upload->display_errors());
	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/admin_produit');
	    		$this->load->view('/nav/footer');
	    	}
	    	else{
	    		//$data = array('upload_data' => $this->upload->data());
	    		//echo "success";
	    		//var_dump($this->upload->data());
	    		//var_dump($data);
	    		$page_data = $this->upload->data();

	    		if ($this->form_validation->run() == FALSE) {
	    			$this->load->view('/nav/header');
	    			$this->load->view('/admin/admin_produit');
	    			$this->load->view('/nav/footer');
	    		} else {
	    			$data = array('sous_domaine' => $this->input->post('sous_dom_select'),'nom_produit' => $this->input->post('nom_produit'),'image_produit' => $page_data['file_name'],'prix_vente' => $this->input->post('prix_vente'),'description' => $this->input->post('description'));
	    			//var_dump($data);
	    			$this->produit_model->ajouter_produit($data['sous_domaine'],$data['nom_produit'],$data['image_produit'],$data['prix_vente'],$data['description']);
	    			$this->load->view('/nav/header');
	    			$this->load->view('/admin/admin_produit');
	    			$this->load->view('/nav/footer');
	    		}

	    		
	    	}

	    }

	    function modifier_produit($id)
	    {
	    	$this->form_validation->set_rules('modif_produit', 'modification de nom du produit', 'trim|required|min_length[2]|max_length[255]',
	    										array('required'=>'Le champs %s est requis'));

	    	$config['upload_path'] = './assets/upload';
	    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	    	$config['max_size']  = '100000';
	    	$config['max_width']  = '10240';
	    	$config['max_height']  = '7680';
	    	
	    	//$this->load->library('upload', $config);
	    	$this->upload->initialize($config);
	    	
	    	if ( ! $this->upload->do_upload('image_modif_produit')){
	    		$error = array('error' => $this->upload->display_errors());
	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/admin_produit');
	    		$this->load->view('/nav/footer');
	    	}
	    	else{
	    		$data = array('upload_data' => $this->upload->data());
	    		echo "success";
	    		$page_data = $this->upload->data();
	    		if ($this->form_validation->run() == FALSE) {
	    			$this->load->view('/nav/header');
	    			$this->load->view('/admin/admin_produit');
	    			$this->load->view('/nav/footer');
	    		}
	    		else {
	    			$data = array('sous_domaine' => $this->input->post('sous_dom_modif_select'),'nom_produit' => $this->input->post('modif_produit'),'image_produit' => $page_data['file_name'],'prix_vente' => $this->input->post('prix_vente_modif'),'description' => $this->input->post('description_modif'));
	    			//var_dump($data);
	    			//$this->produit_model->ajouter_produit($data['sous_domaine'],$data['nom_produit'],$data['image_produit']);
	    			$this->produit_model->modifier_produit($id,$data['sous_domaine'],$data['nom_produit'],$data['image_produit'],$data['prix_vente'],$data['description']);

	    			$this->load->view('/nav/header');
	    			$this->load->view('/admin/admin_produit');
	    			$this->load->view('/nav/footer');
	    		}
	    	}
	    }

	    function afficher_liste_produit()// manque d'argument $sous_domaine
	    {
	    	$this->load->view('/nav/header');
	    	$this->load->view('/admin/admin_produit');
	    	$this->load->view('/nav/footer');
	    }

	    function afficher_liste_produit_sous_domaine($sous_domaine,$nb_produit = 1)
	    {
	    	//var_dump($this->produit_model->recuperer_nom_produit($sous_domaine));

	    	$nb_total = $this->produit_model->total_produit_sous_domaine(urldecode($sous_domaine));
	    	//var_dump($nb_total);
	    	$this->load->library('pagination');

	    	if ($nb_produit > 1) {
	    		if ($nb_produit <= $nb_total) {
	    			$nb = intval($nb_produit);
	    		}else {
	    			$nb = 1;
	    		}
	    	} else {
	    		$nb = 1;
	    	}

	    	$this->load->library('pagination');
	    	
	    	$config['base_url'] = base_url("index.php/Lorion/afficher_liste_produit_sous_domaine/$sous_domaine");
	    	$config['total_rows'] = $nb_total;
	    	$config['per_page'] = 24;
	    	$config['uri_segment'] = 4;
	    	$config['num_links'] = 5;
	    	$config['full_tag_open'] = '<nav><ul class="pagination">';
	    	$config['full_tag_close'] = '</ul></nav>';
	    	$config['first_link'] = 'First';
	    	$config['first_tag_open'] = '<li class="page-item">';
	    	$config['first_tag_close'] = '</li>';
	    	$config['last_link'] = 'Last';
	    	$config['last_tag_open'] = '<li class="page-item">';
	    	$config['last_tag_close'] = '</li>';
	    	$config['next_link'] = '&gt;';
	    	$config['next_tag_open'] = '<li class="page-item">';
	    	$config['next_tag_close'] = '</li>';
	    	$config['prev_link'] = '&lt;';
	    	$config['prev_tag_open'] = '<li class="page-item">';
	    	$config['prev_tag_close'] = '</li>';
	    	$config['cur_tag_open'] = '<li class="page-item active"> <span class="page-link">';
	    	$config['cur_tag_close'] = '<span class="sr-only">(current)</span> </span> </li>';
	    	$config['attributes'] = array('class' => 'page-link text-center','style' => "width:40px;height:40px;");
	    	
	    	$this->pagination->initialize($config);
	    	
	    	//echo $this->pagination->create_links();

	    	$data = array('sous_domaine' => $sous_domaine);
	    	$data['pagination'] = $this->pagination->create_links();
	    	//$data['produits'] = $this->produit_model->
	    	$data['par_page'] = $config['per_page'];
	    	$data['nb_produit'] = $nb - 1;

	    	$this->load->view('/nav/header');
	    	$this->load->view('afficher_sous_domaine', $data);
	    	$this->load->view('/nav/footer');
	    }

	    function supprimer_produit($produit,$sous_domaine)
	    {
	    	$this->produit_model->supprimer_produit($produit,$sous_domaine);
	    	$this->load->view('/nav/header');
	    	$this->load->view('/admin/admin_produit');
	    	$this->load->view('/nav/footer');
	    }

	    function afficher_pagination()
	    {
	    	/*$this->load->library('pagination');
	    	
	    	$config['base_url'] = 'http://localhost/LaboLorion/index.php/Lorion/afficher_pagination';
	    	$config['total_rows'] = 10;
	    	$config['per_page'] = 3;
	    	$config['uri_segment'] = 3;
	    	$config['num_links'] = 3;
	    	$config['full_tag_open'] = '<p>';
	    	$config['full_tag_close'] = '</p>';
	    	$config['first_link'] = 'First';
	    	$config['first_tag_open'] = '<div>';
	    	$config['first_tag_close'] = '</div>';
	    	$config['last_link'] = 'Last';
	    	$config['last_tag_open'] = '<div>';
	    	$config['last_tag_close'] = '</div>';
	    	$config['next_link'] = '&gt;';
	    	$config['next_tag_open'] = '<div>';
	    	$config['next_tag_close'] = '</div>';
	    	$config['prev_link'] = '&lt;';
	    	$config['prev_tag_open'] = '<div>';
	    	$config['prev_tag_close'] = '</div>';
	    	$config['cur_tag_open'] = '<b>';
	    	$config['cur_tag_close'] = '</b>';
	    	
	    	$this->pagination->initialize($config);
	    	$this->load->view('/nav/header');
	    	$this->load->view('accueil');
	    	$this->load->view('/nav/footer');
	    	echo $this->pagination->create_links();*/
	    }

	    function attribut_id_modal($nom_domaine)
    	{
        	return "supprModal".$this->domaineModel->recupererIdDomaine($nom_domaine);
    	}

    	function afficher_detail($id)
    	{

    		$data = $this->produit_model->recuperer_detail_produit($id);
    		$page_data['nom_produit'] = $data[0]->nom_produit;
    		$page_data['prix_vente'] = $data[0]->prix_vente;
    		$page_data['description'] = $data[0]->description;
    		$page_data['file_name'] = $data[0]->image_produit;
    		$page_data['sous_domaine'] = $data[0]->sous_domaine_id;
    		$page_data['id'] = $data[0]->id;
    		//var_dump($data);
    		$this->load->view('/nav/header');
    		$this->load->view('afficher_detail',$page_data);
    		$this->load->view('/nav/footer');
    	}

    	function afficher_recherche()
    	{
    		/*$this->form_validation->set_rules('recherche', 'Recherche', 'trim|required|min_length[1]|max_length[255]',array('required'=>'Le champs %s est requis'));

    		if ($this->form_validation->run() == 	FALSE) {
    			$this->load->view('/nav/header');
    			//$this->load->view('afficher_detail',$page_data);
    			$this->load->view('/nav/footer');
    		} else {*/
    			$recherche = htmlspecialchars($this->input->get('recherche'));
    			$data = $this->produit_model->rechercher_produit($recherche);
    			
    			if ($data != NULL) {
    				$page_data['recherche'] = $recherche;
    				$page_data['nom_produit'] = $data;

					//var_dump($page_data);
    				$this->load->view('/nav/header');
    				$this->load->view('afficher_recherche',$page_data);
    				$this->load->view('/nav/footer');
    			}
    			else {
    				$page_data['recherche'] = $recherche;
    				$page_data['nom_produit'] = $data; //"Le mot recherché n'a pas été trouvé!";
    				//var_dump($page_data);
    				$this->load->view('/nav/header');
    				$this->load->view('afficher_recherche',$page_data);
    				$this->load->view('/nav/footer');
    			}
    		//}

    		
    	}

    	public function connection()
    	{
    		$this->load->view('/nav/header');
    		$this->load->view('/authentification/connection');
    		$this->load->view('/nav/footer');
    	}

    	public function enregistrer()
    	{
    		$this->load->view('/nav/header');
    		$this->load->view('/authentification/enregistrement');
    		$this->load->view('/nav/footer');
    	}

    	public function ajouter_admin()
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
				$this->load->view('/admin/list_admin');
				$this->load->view('/nav/footer');
			} else {
				$data = array(
					'nom_user' => $this->input->post('name'),
					'prenom_user' => $this->input->post('prenom'),
					'username' =>  $this->input->post('username'),
					'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
					'email' => $this->input->post('Email'),
					'pwd_code' => random_string('alnum',8),
					'user_access' => 1
				);
					$this->user_model->enregistrer($data);
			}

    		$this->load->view('/nav/header');
    		$this->load->view('/admin/list_admin');
    		$this->load->view('/nav/footer');
    	}

    	public function afficher_liste_admin()
    	{
    		$this->load->view('/nav/header');
			$this->load->view('/admin/list_admin');
			$this->load->view('/nav/footer');
    	}

    	public function supprimer_user($id)
    	{
    		$this->user_model->supprimer_user($id);
    		$this->load->view('/nav/header');
    		$this->load->view('/admin/list_admin');
    		$this->load->view('/nav/footer');
    	}

    	public function modifier_user($id)
    	{
    		$this->form_validation->set_rules('nameModif', 'Nom', 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
			$this->form_validation->set_rules('prenomModif', 'Prénom', 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
			$this->form_validation->set_rules('usernameModif', "Nom d'utilisateur", 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
			$this->form_validation->set_rules('passwordModif', 'Mot de passe', 'trim|required|min_length[2]|max_length[255]',array('required'=> 'Le champs %s doit être rempli') );
			$this->form_validation->set_rules('confirmationModif', 'confirmation du mot de passe ', 'trim|required|min_length[2]|max_length[255]|matches[passwordModif]',array('required'=> 'Le champs %s doit être rempli','matches' => 'Le champs %s doit être strictement égal au champs mot de passe') );
			$this->form_validation->set_rules('EmailModif', 'Email', 'trim|required|min_length[5]|max_length[255]|valid_email');

			if ($this->form_validation->run() ==  FALSE) {
			//redirect('/authentification/enregistrer','refresh');

				$this->load->view('/nav/header');
				$this->load->view('/admin/list_admin');
				$this->load->view('/nav/footer');
			} else {

	    		$data = array(
	    			'nom_user' => $this->input->post('nameModif'),
					'prenom_user' => $this->input->post('prenomModif'),
					'username' =>  $this->input->post('usernameModif'),
					'password' => password_hash($this->input->post('passwordModif'),PASSWORD_DEFAULT),
					'email' => $this->input->post('EmailModif'),
					'pwd_code' => random_string('alnum',8),
					'user_access' => 1
	    		);
	    		$this->user_model->modifier_user($id,$data);
	    		$this->load->view('/nav/header');
	    		$this->load->view('/admin/list_admin');
	    		$this->load->view('/nav/footer');
	    	}
    	}

    	public function ajouter_corbeille($id)
    	{
    		if ($this->session->utilisateur == NULL) {
    			$this->load->view('/nav/header');
    			$this->load->view('/authentification/connection');
    			$this->load->view('/nav/footer');
    		}
    		else {
    			$data = $this->produit_model->recuperer_detail_produit($id);
	    		//var_dump($data);
	    		foreach ($data as $row) {
	    			$page_data = array(
	    				'id' => $row->id,
	    				'qty' => $this->input->post('nombre'),
	    				'price' => $row->prix_vente,
	    				'name' => $row->nom_produit
	    			);
	    		}
	    		
	    		$this->cart->insert($page_data);
	    		//var_dump($this->cart->insert($page_data));
	    		$cart_contents = $this->session->userdata('cart_contents');
	    		$page_data['items'] = $cart_contents['total_items'];
	    		//var_dump($cart_contents);
	    		$this->load->view('/nav/header');
	    		$this->load->view('liste_corbeille',$page_data);
	    		$this->load->view('/nav/footer');
	    		redirect('Lorion/afficher_detail/'.$id);
    		}
    		
    	}
    	public function liste_corbeille()
    	{
    		$this->load->view('/nav/header');
	    	$this->load->view('liste_corbeille');
	    	$this->load->view('/nav/footer');
    	}

    	public function remove_produit($rowid)
    	{
    		$this->cart->remove($rowid);
    		redirect('Lorion/liste_corbeille');	
    	}

	}

?>