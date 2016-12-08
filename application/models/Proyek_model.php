<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*'))
                      ->from('proyek')
                      ->order_by('nama_proyek', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya     
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*'))
                      ->from('proyek')
                      ->where('id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $nama_proyek ='', $lokasi_proyek ='')
  {
    $data = array(
      'id' => $id,
      'nama_proyek' => $nama_proyek,
      'lokasi_proyek' => $lokasi_proyek
    );

    $query = $this->db->insert('proyek', $data);
    return $query;
  }

  public function update_record($id ='', $nama_proyek ='', $lokasi_proyek ='')
  {
    $data = array(
      'id' => $id,
      'nama_proyek' => $nama_proyek,
      'lokasi_proyek' => $lokasi_proyek
    );

    $this->db->where('id', $id);
    $query = $this->db->update('proyek', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->delete('proyek');

    return $query;
  }

}