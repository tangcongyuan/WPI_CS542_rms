<?php
class Room_equipment extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('grocery_CRUD');
  }

  public function index()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('room_equipment');
	$crud->set_relation('room_id', 'room', 'room_name');
	$crud->set_relation('equipment_id', 'equipment', 'equipment_name');
    $crud->columns('room_id','equipment_id','no_item');
    $output = $crud->render();
    $this->_example_output($output);
  }

  public function _example_output($output = null)
  {
    $this->load->view('room_equipment_view.php',$output);
  }

}
