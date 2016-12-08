<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*', 'supervisor.id AS id_supervisor', 'karyawan.id AS karyawan_id', 
                              'karyawan.nama AS nama_karyawan'))
                      ->from('supervisor')
                      ->join('karyawan','karyawan.id=supervisor.karyawan_id')
                      ->order_by('supervisor.id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya     
    return $data;
  }

  public function get_karyawan()
  {
    $data = $this->db->select(array('*', 'karyawan.id AS karyawan_id', 'karyawan.nama AS nama_karyawan'))
                      ->from('karyawan') 
                      ->order_by('karyawan.id')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*', 'supervisor.id AS id_supervisor', 'karyawan.id AS karyawan_id', 
                              'karyawan.nama AS nama_karyawan'))
                      ->from('supervisor')
                      ->join('karyawan','karyawan.id=supervisor.karyawan_id')
                      ->where('supervisor.id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $nama_supervisor ='', $karyawan_id ='')
  {
    $data = array(
      'id' => $id,
      'nama_supervisor' => $nama_supervisor,
      'karyawan_id' => $karyawan_id
    );

    $query = $this->db->insert('supervisor', $data);
    return $query;
  }

  public function update_record($id ='', $nama_supervisor ='', $karyawan_id ='')
  {
    $data = array(
      'id' => $id,
      'nama_supervisor' => $nama_supervisor,
      'karyawan_id' => $karyawan_id
    );

    $this->db->where('id', $id);
    $query = $this->db->update('supervisor', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->delete('supervisor');

    return $query;
  }

}