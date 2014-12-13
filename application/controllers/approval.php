<?php
session_start(); //we need to call PHP's session object to access it through CI
class Approval extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->library('grocery_CRUD');
	   $this->load->model('reservation_model');
	   $this->load->model('room_model');
	}

	function index()
	{
	   if($this->session->userdata('logged_in'))
	   {
			$crud = new grocery_CRUD();
			$crud->set_table('reservation');
			$crud->columns('reserver_id', 'building_id', 'room_id', 'num_people', 'start_date', 'end_date', 'activity', 'status');
			$crud->unset_columns('reason');
			$crud->set_relation('reserver_id', 'user', 'firstname');
			$crud->set_relation('status', 'reservation_status', 'status');
			$crud->set_relation('room_id', 'room', 'room_name');
			$crud->set_relation('building_id', 'building', 'building_name');

			$crud->display_as('reserver_id', 'Reserver');
			$crud->display_as('room_id', 'Room');
			$crud->display_as('num_people', 'Attendants');
			$crud->display_as('building_id', 'Building');
			//to refresh list; only to show waiting reservations
			$crud->where('reservation.status',1);
			$crud->add_action('', '', 'approval/approve', 'approve-icon');
    		$crud->add_action('', '', 'approval/reject', 'reject-icon');
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();

			$crud->unset_read();
			$output = $crud->render();

			$session_data = $this->session->userdata('logged_in');
			$data['email'] = $session_data['email'];
			$this->_viewApproval($output);
	   }
	   else
	   {
			//If no session, redirect to login page
			redirect('login', 'refresh');
	   }
	}

	function _viewApproval($output = null)
	 {
	    $this->load->view('approval_view.php',$output);
	 }

	public function approve($reservation_id = null)
	{
		echo $this->reservation_model->approve_reservation($reservation_id);
		//echo json_encode(array('success' => true , 'success_message' => "The reservation has been successfully approved!"));
	}

	function reject($reservation_id = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['reservation_id'] = $reservation_id;
		$reservation_id = (isset($_POST['reservation_id'])) ? $_POST['reservation_id'] : '';
		$this->session->set_flashdata('reservation_id',$reservation_id);

		$this->form_validation->set_rules('reason', 'Reason', 'required');
		if ($this->form_validation->run() === FALSE)
		{
	  	$this->load->view('view_reject', $data);
		}
		else
		{
	    $this->reservation_model->set_reason($reservation_id);
	    redirect('approval'.$this->session->flashdata('reservation_id'));
		}
	}


	function history()
	{
	   if($this->session->userdata('logged_in'))
	   {
			$crud = new grocery_CRUD();
			$crud->set_table('reservation');
			$crud->columns('reserver_id', 'building_id', 'room_id', 'num_people', 'start_date', 'end_date', 'activity', 'status', 'reason');
			//$crud->unset_columns('reason');
			$crud->set_relation('reserver_id', 'user', 'firstname');
			$crud->set_relation('status', 'reservation_status', 'status');
			$crud->set_relation('room_id', 'room', 'room_name');
			$crud->set_relation('building_id', 'building', 'building_name');

			$crud->display_as('reserver_id', 'Reserver');
			$crud->display_as('room_id', 'Room');
			$crud->display_as('num_people', 'Attendants');
			$crud->display_as('building_id', 'Building');
			//to refresh list; only to show waiting reservations

			$crud->or_where('reservation.status',2);
			$crud->or_where('reservation.status',3);


			$crud->add_action('', '', 'approval/approve', 'approve-icon');
    		$crud->add_action('', '', 'approval/reject', 'reject-icon');
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();

			$crud->unset_read();
			$output = $crud->render();

			$session_data = $this->session->userdata('logged_in');
			$data['email'] = $session_data['email'];
			$this->_viewHistory($output);
	   }
	   else
	   {
			//If no session, redirect to login page
			redirect('login', 'refresh');
	   }
	}

	function _viewHistory($output = null)
 	{
    	$this->load->view('approvalHistory_view.php',$output);
 	}

}
?>
