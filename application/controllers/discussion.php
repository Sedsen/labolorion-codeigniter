 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussion extends CI_Controller {

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
        $this->form_validation->set_error_delimiters('<div class="alert-danger ">','</div>');
	}

	public function index()
	{

		if ($this->session->utilisateur == FALSE || $this->session->utilisateur == NULL) {
			$this->load->view('/nav/header');
			$this->load->view('/authentification/connection');
			$this->load->view('/nav/footer');
		} else {
			/*$admins = $this->user_model->select_admin();
			foreach ($admins as $admin) {
						$data = array(
							'user_id' => $this->session->utilisateur[0]->username,
							'message' => $this->input->post('message'),
							'admin_id' => $admin->username
						);
						var_dump($this->select_chat_id($admin->username));
				}*/
				//var_dump($this->select_chat_id_admin("momo"));
				$admins = $this->user_model->select_admin();
				$chat_id = $this->discussion_model->select_chat_id($admins[0]->username)[0]->id;
				$this->discussion_model->discussion_read_admin($chat_id,$admins[0]->username);
			$this->load->view('/nav/header');
			$this->load->view('/discussion/discussion_user');
			$this->load->view('/nav/footer');
		}
		
	}

	protected function select_chat_id($admin_id)
	{
		$this->db->select('id');
		$this->db->where('user_id', $this->session->utilisateur['username']);
		$this->db->where('admin_id', $admin_id);
		$result = $this->db->get('Chats')->result();
		if ($result) {
			return $result;
		} else{
			return NULL;
		}
	}

	public function select_chat_id_admin($user)
	{
		$this->db->select('id');
		$this->db->where('admin_id', $this->session->utilisateur['username']);
		$this->db->where('user_id', $user);
		$result = $this->db->get('Chats')->result();
		if ($result) {
			return $result;
		} else{
			return NULL;
		}
	}

	public function add_message()
	{
		$this->form_validation->set_rules('message', 'Message', 'required|min_length[2]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('/nav/header');
			$this->load->view('/discussion/discussion_user');
			$this->load->view('/nav/footer');
		} else {
			if ($this->session->utilisateur['username'] != NULL ) {
				if ( $this->session->utilisateur['username'] == FALSE) {
					redirect('authentification/index');
				}else {

					$admins = $this->user_model->select_admin();
					foreach ($admins as $admin) {
						$data = array(
							'user_id' => $this->session->utilisateur['username'],
							'message' => $this->input->post('message'),
							'chats_id' => $this->select_chat_id($admin->username)[0]->id
						);

						$this->discussion_model->add_message($data);
					}
										
					redirect('discussion/index');
				}
				
			}
			else {
				redirect('discussion/index');
			}
			
		}	
	}

	public function list_admin_discussion()
	{
		$this->load->view('/nav/header');
		$this->load->view('/discussion/discussion_admin');
		$this->load->view('/nav/footer');
	}

	public function afficher_admin_discussion($username)
	{
		$data = array('username' => $username);
		$this->discussion_model->discussion_read($username);
		$this->load->view('/nav/header');
		$this->load->view('/discussion/admin_message',$data);
		$this->load->view('/nav/footer');
	}

	public function add_admin_message($username)
	{
		$this->form_validation->set_rules('reponse', 'Message', 'trim|required|min_length[2]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('/nav/header');
			$this->load->view('/discussion/admin_message');
			$this->load->view('/nav/footer');
		} else {
			$data = array(
				'user_id' => $this->session->utilisateur['username'],
				'message' => $this->input->post('reponse'),
				'chats_id' => $this->select_chat_id_admin($username)[0]->id
			);

			$this->discussion_model->add_message($data);

			$this->load->view('/nav/header');
			$this->load->view('/discussion/admin_message');
			$this->load->view('/nav/footer');
		}
	}

}

/* End of file discussion.php */
/* Location: ./application/controllers/discussion.php */