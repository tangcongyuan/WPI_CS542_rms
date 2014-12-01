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
		$crud = new grocery_CRUD();
		$crud->set_table('room');
		$crud->columns('room_name','floor','size');
		$crud->where('room.building_id',$param);
		$crud->add_action('', '', 'home/room_calendar', 'read-icon');
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
		$data['room_id'] = $room_id;
		$data['room_name'] = $this->room_model->get_room($room_id)->room_name;
		$this->load->view('room_calendar.php', $data);
	}

	function reserve($room_id = null, $start= null, $hourStart= null, $end= null, $hourEnd= null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Reserve a Room';
		$data['room_id'] = $room_id;

		$data['startDate'] = $start." ".$hourStart.":00";
		$data['endDate'] = $end." ".$hourEnd.":00";
		$room_id = (isset($_POST['room_id'])) ? $_POST['room_id'] : '';

		$this->session->set_flashdata('room_id',$room_id);
		$this->form_validation->set_rules('activity', 'Activity', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$data['room_name'] = $this->room_model->get_room($room_id)->room_name;
			$this->load->view('reservation_form', $data);
		}
		else
		{
			$this->reservation_model->set_reservation();
			redirect('home/room_calendar/'.$this->session->flashdata('room_id'));
		}
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
}
?>
