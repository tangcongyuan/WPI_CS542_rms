<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_users($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('user');
			return $query->result_array();
		}

		$query = $this->db->get_where('user', array('id' => $slug));
		return $query->row_array();
	}

	function login($email, $password)
	{
	   $this -> db -> select('user_id, email, password');
	   $this -> db -> from('user');
	   $this -> db -> where('email', $email);
	   $this -> db -> where('password', MD5($password));
	   $this -> db -> limit(1);

	   $query = $this -> db -> get();

	   if($query -> num_rows() == 1)
	   {
		 return $query->result();
	   }
	   else
	   {
		 return false;
	   }
	}

	function check_email($email)
	{
		$this->db->select('user_id, email, password');
		$this->db->from('user');
		$this->db->where('email', $email);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function save_user()
	{
		$data = array(
			'email' => $this->input->post('email'),
			'password' => MD5($this->input->post('password')),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'usertype' => 1
		);
		return $this->db->insert('user', $data);

	}
}
