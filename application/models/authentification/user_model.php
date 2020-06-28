 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function enregistrer($data)
	{
		if ($this->db->insert('Utilisateurs', $data)) {
			return true;
		}else {
			return false;
		}
	}

	protected function save_session($result)
	{
		$this->clear_session();
		$this->session->utilisateur = $result;
	}

	protected function clear_session()
	{
		$this->session->utilisateur = NULL;
	}

	public function select_user($username)
	{
		$this->db->select('username,password,id,user_access');
		$this->db->where('username' , $username);
		$result = $this->db->get('Utilisateurs')->result();
		//$this->save_session($result);

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
	public function deconnexion()
	{
		$this->clear_session();
	}

	public function select_admin()
	{
		$this->db->select('nom_user,prenom_user,username,password,email,id');
		$this->db->where('user_access', 1);
		$result = $this->db->get('Utilisateurs')->result();

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function select_user_access($username=NULL)
	{
		$this->db->select('user_access');
		$this->db->where('username', $username);
		$result = $this->db->get('Utilisateurs')->result();

		if ($result ) {
			return $result[0]->user_access;
		} else {
			return false;
		}
	}

	public function supprimer_user($id)
	{
		$this->db->delete('Utilisateurs',array('id' => $id));
	}

	public function modifier_user($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('Utilisateurs', $data);
	}

	public function select_list_user()
	{
		$this->db->select('nom_user,prenom_user,username,password,email,id');
		$this->db->where('user_access', 0);
		$result = $this->db->get('Utilisateurs')->result();

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	protected function load_user($username)
	{
		return $this->db->select('id,username,password,user_access')->from('Utilisateurs')->where('username',$username)->get()->first_row();
	}

	public function login($username,$password)
	{
		$user = $this->load_user($username);
		if (($user !== NULL) && password_verify($password,$user->password)) {
			$result = array('id' => $user->id,'username' => $user->username,'password' => $user->password,'user_access' => $user->user_access);
			$this->save_session($result);
		} else {
			$this->deconnexion();
		}
	}

}

/* End of file user_model.php */
/* Location: ./application/models/authentification/user_model.php */