<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussion_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function add_message($data)
	{
		if ($this->db->insert('Discussion', $data)) {
			return true;
		}else {
			return false;
		}
	}

	public function select_user($user_id/*,$admin_id = "admin"*/)
	{
		$this->db->select('message,created_at');
		$this->db->where('user_id', $user_id);
		//$this->db->where('admin_id', $admin_id);
		$result = $this->db->get('Discussion')->result();

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function add_chat($user,$admin)
	{
		$data = array(
			'user_id' => $user,
			'admin_id' => $admin
		);
		if ($this->db->insert('Chats', $data))
		{
			return true;
		} else {
			return false;
		}
	}

	public function select_message($chat_id)
	{
		$this->db->select('message,created_at,user_id')->order_by('id','DESC');
		//$this->db->where('user_id', $user_id);
		$this->db->where('chats_id', $chat_id);
		$result = $this->db->get('Discussion')->result();

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
	public function select_chat_id_admin($user)
	{
		$this->db->select('id');
		$this->db->where('admin_id', $this->session->utilisateur['username']);
		$this->db->where('user_id', $user);
		//var_dump($this->session->utilisateur['username']);
		$result = $this->db->get('Chats')->result();
		if ($result) {
			return $result;
		} else{
			return NULL;
		}
	}
	public function select_chat_id($admin_id)
	{
		$this->db->select('id');
		$this->db->where('user_id', $this->session->utilisateur['username']);
		//$this->db->where('admin_id', $admin_id);
		$result = $this->db->get('Chats')->result();
		if ($result) {
			return $result;
		} else{
			return NULL;
		}
	}
	public function select_chat_id_user($chat_id)
	{
		$this->db->select('message,created_at,user_id');
		//$this->db->where('admin_id', $this->session->utilisateur[0]->username);
		$this->db->where('chats_id', $chat_id)->order_by('id','DESC');
		$result = $this->db->get('Discussion')->result();
		if ($result) {
			return $result;
		} else{
			return NULL;
		}
	}
	public function discussion_unread($user_id)
	{
		$this->db->select('*')->from('Discussion');
		$this->db->where('user_id', $user_id)->order_by('id','DESC');
		$this->db->where('is_read', 0);
		return $this->db->count_all_results();
	}
	public function discussion_read($user_id)
	{
		$data = array('is_read' => 1);
		$this->db->where('user_id', $user_id)->order_by('id','DESC');
		$this->db->update('Discussion', $data);
	}

	public function discussion_unread_admin($chat_id,$user_id)
	{
		//$chat_id =  
		$this->db->select('*')->from('Discussion');
		$this->db->where('chats_id', $chat_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('is_read', 0);
		return $this->db->count_all_results();
	}
	public function discussion_read_admin($chat_id,$user_id)
	{
		$data = array('is_read' => 1);
		$this->db->where('chats_id', $chat_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('Discussion', $data);
	}

}

/* End of file discussion_model.php */
/* Location: ./application/models/discussion_model.php */