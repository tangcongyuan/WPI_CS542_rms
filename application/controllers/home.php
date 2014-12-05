<?php
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

	function __construct()
	{
	   parent::__construct();
	   $this->load->model('reservation_model');
	   $this->load->library('grocery_CRUD');
	   $this->load->model('reservation_model');
	   $this->load->model('room_model');
	}

	function index()
	{
	   if($this->session->userdata('logged_in'))
	   {
			$crud = new grocery_CRUD();
			$crud->set_table('building');
			$crud->columns('building_name','location');
			$crud->add_action('', '', 'home/room', 'forward-icon');
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
		$crud = new grocery_CRUD();
		$crud->set_table('room');
		$crud->columns('room_name','floor','size');
		$crud->where('room.building_id',$param);
		$crud->add_action('', '', 'home/room_calendar', 'forward-icon');
		$crud->add_action('', '', 'room/room_detail', 'read-icon');
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
        $this->load->view('home_view.php',$output);
    }

	function logout()
	{
	   $this->session->unset_userdata('logged_in');
	   session_destroy();
	   redirect('home', 'refresh');
	}

	function calendar($room = null)
	{
		$this->load->library('calendar');
		$data['test'] = array(
               3  => '<a href="adsf" >adsfadsf</a><br /><a href="adsf" >adf test</a>',
               7  => 'http://example.com/news/article/2006/07/',
               13 => 'http://example.com/news/article/2006/13/',
               26 => 'http://example.com/news/article/2006/26/'
             );
		$var = $this->calendar->generate();
		$this->load->view('calendar.php',$data);
	}

	function room_calendar($room_id = null)
	{
		$message = '';
		$data['room_id'] = $room_id;
		$message = $this->session->flashdata('message');
		$data['message'] = $this->session->flashdata('message');
		
		$data['room_name'] = $this->room_model->get_room($room_id)->room_name;
		$this->load->view('room_calendar.php', $data);
	}

	function reserve()
	{
			$room_id = (isset($_POST['room_id'])) ? $_POST['room_id'] : '';
			$this->session->set_flashdata('room_id',$room_id);
			$result = $this->reservation_model->set_reservation();
			
			$data['message']=$result;
			if($result)
			{
				$this->session->set_flashdata('message',$result);
				//$this->load->view("room_calendar/room_id", $data);
				//$this->session->set_flashdata('message',$result);
				redirect('home/room_calendar/'.$room_id);
				//redirect('home/cancel', $data)
			}
			else
			{
				redirect('home/room_calendar/'.$room_id);
			}
	}

	function formReservation()
	{
		$this->load->view('reservation_form.php');
	}

	function saveData()
	{
		$data['activity'] = $_POST['activity'];
		$data['num_people'] = $_POST['num_people'];
		$this->reservation_model->add($data);
	}

	function getJson($room_id = null)
	{
		echo $this->reservation_model->get_reservation($room_id);
	}

	public function about()
	{
		$this->load->view('about.php');
	}
	
	function history()
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
			$crud->or_where('reservation.status',2);
			$crud->or_where('reservation.status',3);
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
		$this->load->view('res_history_view.php',$output);
	}
	
	function cancel()
	{
	   if($this->session->userdata('logged_in'))
	   {
			$session_data = $this->session->userdata('logged_in');
			$crud = new grocery_CRUD();
			$crud->set_table('reservation');
			$crud->columns('reserver_id', 'building_id', 'room_id', 'num_people', 'start_date', 'end_date', 'activity', 'status');
			$crud->unset_columns('reason');
			$crud->set_relation('reserver_id', 'user', 'firstname');
			$crud->set_relation('status', 'reservation_status', 'status');
			$crud->set_relation('room_id', 'room', 'room_name');
			$crud->set_relation('building_id', 'building', 'building_name');
			$crud->add_action('', '', 'home/cancel_reservation', 'cancel-icon');
			$crud->display_as('reserver_id', 'Reserver');
			$crud->display_as('room_id', 'Room');
			$crud->display_as('num_people', 'Attendants');
			$crud->display_as('building_id', 'Building');
			$crud->where('reservation.status',1);
			$crud->where('reservation.reserver_id',$session_data['id']);
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_delete();
			
			$crud->unset_read();
			$output = $crud->render();

			
			$data['email'] = $session_data['email'];
			$this->_viewCancel($output);
	   }
	   else
	   {
			//If no session, redirect to login page
			redirect('login', 'refresh');
	   }
	}
	
	function _viewCancel($output = null)
	{
		$this->load->view('cancel_view.php',$output);
	}
	
	public function cancel_reservation($reservation_id = null)
	{
		$this->reservation_model->cancel_reservation($reservation_id);
		echo json_encode(array('success' => true , 'success_message' => "The reservation has been successfully canceled!"));
	}
}
?>
