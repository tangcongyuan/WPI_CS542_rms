<?php
class Reservation_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_reservation($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('reservation');
			return $query->result_array();
		}

		$query = $this->db->get_where('reservation', array('room_id' => $id))->result();

		$jsonevents = array();
		foreach ($query as $entry)
		{
			$jsonevents[] = array(
				'id' => $entry->reservation_id,
				'title' => $entry->activity,
				'start' => $entry->start_date,
				'allDay' => false,
				'end' => $entry->end_date
			);
		}
		return json_encode($jsonevents);
	}

	public function set_reservation()
	{
		$this->load->helper('url');

		$slug = url_title($this->input->post('title'), 'dash', TRUE);
		$session_data = $this->session->userdata('logged_in');

		$data = array(
			'activity' => $this->input->post('activity'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'num_people' => $this->input->post('num_people'),
			'room_id' => $this->input->post('room_id'),
			'status' => 1,
			'reserver_id' => $session_data['id'],
			'building_id' => $this->room_model->get_room($this->input->post('room_id'))->building_id
		);

		$this->session->set_flashdata('room_id',$this->input->post('room_id'));
		
		
		if(!$this->db->insert('reservation', $data))
		{
			$err = $this->db->conn_id;
			return "<div class='alert alert-danger'>".$err->error."</div>"; 	
		}
		else return "<div class='alert alert-success'>You have successfully reserved the room</div>";
		
	}

	public function approve_reservation($reservation_id)
	{
		$data = array(
               'status' => 2
            );

		$this->db->where('reservation_id', $reservation_id);
		if(!$this->db->update('reservation', $data))
		{
			//$err = $this->db->conn_id;
			//return "<div class='alert alert-danger'>You cannot approve reservation in the past!</div>"; 	
			return json_encode(array('success' => false , 'error_message' => "The reservation in the past cannot be approved!"));
		}
		else return json_encode(array('success' => true , 'success_message' => "The reservation has been successfully approved!")); //return "<div class='alert alert-success'>The reservation has been approved!</div>";
	}
	
	public function cancel_reservation($reservation_id)
	{
		return $this->db->delete('reservation', array('reservation_id' => $reservation_id)); ;
	}

	function add($data)
    {
        $this->db->insert('reservation', $data);
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

	public function set_reason($reservation_id)
	{
		$data = array(
		'status' => 3,
		'reason' => $this->input->post('reason')
		);

		$this->db->where('reservation_id', $reservation_id);
		return $this->db->update('reservation', $data);
	}
}
