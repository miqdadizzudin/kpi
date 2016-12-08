<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*'))
                      ->from('groups')
                      ->order_by('groups.id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya     
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*'))
                      ->from('groups')
                      ->where('groups.id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $name ='', $description ='')
  {
    $data = array(
      'id'            => $id,
      'name'          => $name,
      'description'   => $description
    );

    $query = $this->db->insert('groups', $data);
    return $query;
  }

  public function update_record($id ='', $name ='', $description ='')
  {
    $data = array(
      'id'            => $id,
      'name'          => $name,
      'description'   => $description
    );

    $this->db->where('id', $id);
    $query = $this->db->update('groups', $data);

    return $query;
  }


}