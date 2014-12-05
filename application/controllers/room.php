<?php
class Room extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('grocery_CRUD');
	$this->load->model('room_model');
  }

  public function index()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('room');
    $crud->columns('room_id','room_name','floor','size','building_id');
    $output = $crud->render();
    $this->_example_output($output);
  }
  
  public function room_detail($room_id = null)
  {
	$room_detail = $this->room_model->get_room($room_id);
	$data['room_name'] = $room_detail->room_name; 
	$data['floor'] = $room_detail->floor; 
	$data['room_id'] = $room_id; 
	$data['size'] = $room_detail->size; 
	$crud = new grocery_CRUD();
    $crud->set_table('room_equipment');
	$crud->columns('equipment_id','no_item');
	$crud->display_as('equipment_id','Equipment Name');
	$crud->display_as('no_item','No. of Item');
	$crud->set_relation('equipment_id', 'equipment', 'equipment_name');
	$crud->where('room_id', $room_id);
	$crud->unset_add();
	$crud->unset_edit();
	$crud->unset_delete();
	$crud->unset_read();
	$crud->unset_print();
	$crud->unset_export();
	$output = $crud->render();
	$output->data = $data;
    $this->_room_detail_output($output);
  }

  public function _example_output($output = null)
  {
    $this->load->view('room_view.php',$output);
  }
  
  public function _room_detail_output($output = null)
  {
    $this->load->view('room_detail_view.php',$output);
  }

}
