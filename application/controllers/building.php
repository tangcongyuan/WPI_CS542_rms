<?php
class Building extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('building_model');
  }

  public function index()
  {
    $data['building'] = $this->building_model->get_building();
    $data['location'] = 'location';

    $this->load->view('templates/header', $data);
    $this->load->view('building/index', $data);
    $this->load->view('templates/footer');
  }

  public function view($slug)
  {
    $data['building_item'] = $this->building_model->get_building($slug);

    if (empty($data['building_item']))
    {
      show_404();
    }

    $data['title'] = $data['building_item']['building_name'];

    $this->load->view('templates/header', $data);
    $this->load->view('building/view', $data);
    
    $this->load->view('templates/footer');
  }
}
