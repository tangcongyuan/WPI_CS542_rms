<?php
class Reservation extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('grocery_CRUD');
  }

  public function index($room_id)
  {
    $crud = new grocery_CRUD();
    $crud->set_subject('Reservation');
    $crud->where('room_id', $room_id);
    //$new_date = mdate('%Y-%m-%d - %h:%i:%s', strtotime($date));
    //$new_date = mdate('%Y-%m-%d', strtotime($date));
    //echo $new_date;
    //echo $date;
    //$crud->where('end_date>', $date);
    //$crud->where('start_time<', $date);
    $crud->set_table('reservation');
    $crud->columns('reservation_id','reserver_id','room_id','num_people','start_date','end_date','activity','status');
    //$crud->edit_fields('num_people','start_date','end_date','activity');
    $output = $crud->render();
    $this->_example_output($output);
  }

  public function _example_output($output = null)
  {
    $this->load->view('example.php',$output);
  }

}
