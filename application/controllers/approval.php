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
			$crud->set_relation('reserver_id','user','firstname');
			$crud->set_relation('status','reservation_status','status');
			$crud->columns('reserver_id','activity','status');	
			
			$crud->add_action('', '', 'approval/reject', 'reject-icon');
			$crud->add_action('', '', 'approval/approve', 'approve-icon');
			$crud->unset_add();
			$crud->unset_edit();
			//$crud->unset_delete();		
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
        $this->load->view('view_approval.php',$output);    
    }
	
	public function approve($reservation_id = null)
	{
		$this->reservation_model->approve_reservation($reservation_id);
		echo json_encode(array('success' => true , 'success_message' => "The reservation has been successfully approved!"));
	}
	
	
 
}
?>
