<?php
class Reservation extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('grocery_CRUD');
  }

  public function index()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('reservation');
    $crud->columns('reservation_id','reserver_id','room_id','num_people','start_date','end_date','activity','status');
    $output = $crud->render();
    $this->_example_output($output);
  }

  public function _example_output($output = null)
  {
    $this->load->view('example.php',$output);
  }

}
