<?php
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {
 
	function __construct()
	{
	   parent::__construct();
	   $this->load->library('grocery_CRUD');
	}
	 
	function index()
	{
	   if($this->session->userdata('logged_in'))
	   {
			$crud = new grocery_CRUD();
			$crud->set_table('building');
			$crud->columns('building_name','location');	
			$crud->add_action('', '', 'home/room', 'read-icon');
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();		
			$crud->unset_read();
			$output = $crud->render();
		   
			$session_data = $this->session->userdata('logged_in');
			$data['email'] = $session_data['email'];
			$this->_tes($output);
	   }
	   else
	   {
			//If no session, redirect to login page
			redirect('login', 'refresh');
	   }
	}
	
	function room($param = null)
	{
		//echo $param; die();
		$crud = new grocery_CRUD();
		$crud->set_table('room');
		$crud->columns('room_name','floor','size');	
		$crud->where('room.building_id',$param);
		$crud->add_action('', '', 'home/calendar', 'read-icon');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->unset_read();
		$output = $crud->render();
		$this->load->view('choose_room.php',$output);   
		
	}
	
	function test()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('user');
		$crud->columns('email','firstname','lastname');
	 
		$output = $crud->render();
	 
		$this->_tes($output);
	}
	
	function _tes($output = null)
 
    {
        $this->load->view('test.php',$output);    
    }
	 
	function logout()
	{
	   $this->session->unset_userdata('logged_in');
	   session_destroy();
	   redirect('home', 'refresh');
	}
 
}
?>
