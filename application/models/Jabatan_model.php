<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*'))
                      ->from('jabatan')
                      ->order_by('id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya     
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*'))
                      ->from('jabatan')
                      ->where('id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $nama_jabatan ='')
  {
    $data = array(
      'id' => $id,
      'nama_jabatan' => $nama_jabatan
    );

    $query = $this->db->insert('jabatan', $data);
    return $query;
  }

  public function update_record($id ='', $nama_jabatan ='')
  {
    $data = array(
      'id' => $id,
      'nama_jabatan' => $nama_jabatan
    );

    $this->db->where('id', $id);
    $query = $this->db->update('jabatan', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->delete('jabatan');

    return $query;
  }

}