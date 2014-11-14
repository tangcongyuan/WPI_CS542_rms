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
    $crud->columns('equipment_id','room_id');
    $output = $crud->render();
    $this->_example_output($output);
  }

  public function _example_output($output = null)
  {
    $this->load->view('example.php',$output);
  }

}
