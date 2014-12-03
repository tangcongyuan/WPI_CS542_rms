<?php
class User extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('grocery_CRUD');
  }

  public function index()
  {
    $crud = new grocery_CRUD();
    $crud->set_table('user');
	$crud->set_relation('usertype', 'role', 'role_name');
    $crud->columns('firstname','lastname','email','usertype');
	$crud->field_type('role','dropdown',array('1' => 'active', '2' => 'private','3' => 'spam'));
    $output = $crud->render();
    $this->_example_output($output);
  }

  public function _example_output($output = null)
  {
    $this->load->view('user_view.php',$output);
  }

  public function profile()
  {
    $data['message'] = '';
    $this->load->model('user_model');
    $session_data = $this->session->userdata('logged_in');
    $userObject = $this->user_model->get_users($session_data['id']);
    $data['id'] = $userObject['user_id'];
    $data['email'] = $userObject['email'];
    $data['firstname'] = $userObject['firstname'];
    $data['lastname'] = $userObject['lastname'];
    $this->load->view('user_profile_view', $data);
  }

  public function update_password()
  {
    $this->load->model('user_model');
    $this->load->view('user_profile_view',$data);
  }

  public function changePassword()
  {
    $data['message'] = '';
    $this->load->model('user_model');

    $session_data = $this->session->userdata('logged_in');
    $userObject = $this->user_model->get_users($session_data['id']);
    $data['id'] = $userObject['user_id'];
    $data['email'] = $userObject['email'];
    $data['firstname'] = $userObject['firstname'];
    $data['lastname'] = $userObject['lastname'];

    if($this->input->post('password') != null)
    {
      $data['message'] ='<div class="alert alert-success">Password successfully updated!</div>';
      $this->user_model->update_user_password();
    }
    $this->load->view('changePassword_view', $data);
  }

}
