<?php
class Report extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('grocery_CRUD');
    $this->load->model('reservation_model');
  }

  public function index()
  {
   $this->load->view('report_view.php');
  }

}