<?php
class Room_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_room($room_id = FALSE){
    if ($room_id === FALSE)
    {
      $query = $this->db->get('room');
      return $query->result_array();
    }

    $query = $this->db->get_where('room', array('room_id' => $room_id));
    return $query->row();
  }
  
  public function get_building($room_id = FALSE){
    $query = $this->db->get_where('room', array('room_id' => $room_id));
    return $query->row();
  }


}
