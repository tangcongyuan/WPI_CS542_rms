<?php

class Verifyregister extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
  }

  function check_database($email, $password)
  {
    //Field validation succeeded.  Validate against database
    $email = $this->input->post('email');

    //query the database
    $result = $this->user_model->check_email($email);
    if($result == false)
    {
      return true;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'User already registered!');
      return false;
    }
  }

  function index()
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_check_database');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

    if($this->form_validation->run() == false)
    {
      //User already exist.
      $this->load->view('sign_up');
    }
    else
    {
      // Save user inputs, which is user's personal informaiton
      $this->user_model->save_user();
      $this->load->view('login_view');
    }

  }
}
?>
