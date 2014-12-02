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

		$query = $this->db->get_where('user', array('user_id' => $slug));
		return $query->row_array();
	}

	function login($email, $password)
	{
	   $this -> db -> select('user_id, email, password, usertype');
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

	function update_user_password()
	{
		$session_data = $this->session->userdata('logged_in');
		$userObject = $this->user_model->get_users($session_data['id']);
		//print_r($userObject); die();
		$data['id'] = $userObject['user_id'];
		$data['email'] = $userObject['email'];
		$data['firstname'] = $userObject['firstname'];
		$data['lastname'] = $userObject['lastname'];
		$this->db->where('user_id', $data['id']);
		$pd = array(
			'password' => MD5($this->input->post('password'))
		);
		return $this->db->update('user', $pd);

	}
}
