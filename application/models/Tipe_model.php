<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*'))
                      ->from('tipe')
                      ->order_by('id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya   
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*'))
                      ->from('tipe')
                      ->where('id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $nama_tipe ='', $deskripsi='')
  {
    $data = array(
      'id' => $id,
      'nama_tipe' => $nama_tipe,
      'deskripsi' => $deskripsi
    );

    $query = $this->db->insert('tipe', $data);
    return $query;
  }

  public function update_record($id ='', $nama_tipe ='', $deskripsi='')
  {
    $data = array(
      'id' => $id,
      'nama_tipe' => $nama_tipe,
      'deskripsi' => $deskripsi
    );

    $this->db->where('id', $id);
    $query = $this->db->update('tipe', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->delete('tipe');

    return $query;
  }

}