<?php
class Building_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_building($slug = FALSE){
    if ($slug === FALSE)
    {
      $query = $this->db->get('building');
      return $query->result_array();
    }

    $query = $this->db->get_where('building', array('building_id' => $slug));
    return $query->row_array();
  }


}
