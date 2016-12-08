<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_proyek_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*', 'karyawan_proyek.id AS id_karyawan_proyek', 
                            'karyawan.nama AS nama_karyawan', 'proyek.nama_proyek AS nama_proyek'))
                      ->from('karyawan_proyek')
                      ->order_by('proyek.nama_proyek', 'asc')
                      ->join('karyawan','karyawan.id=karyawan_proyek.karyawan_id') 
                      ->join('proyek','proyek.id=karyawan_proyek.proyek_id') 
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya     
    return $data;
  }

  public function get_karyawan()
  {
    $data = $this->db->select(array('*', 'karyawan.id AS karyawan_id', 'karyawan.nama AS nama_karyawan'))
                      ->from('karyawan') 
                      ->order_by('karyawan.nama')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_proyek()
  {
    $data = $this->db->select(array('*', 'proyek.id AS proyek_id', 'proyek.nama_proyek AS nama_proyek'))
                      ->from('proyek') 
                      ->order_by('proyek.nama_proyek')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*', 'karyawan_proyek.id AS id_karyawan_proyek', 'karyawan.nama AS nama_karyawan',
                            'proyek.nama_proyek AS nama_proyek'))
                      ->from('karyawan_proyek')
                      ->join('karyawan','karyawan.id=karyawan_proyek.karyawan_id') 
                      ->join('proyek','proyek.id=karyawan_proyek.proyek_id')
                      ->where('karyawan_proyek.id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $karyawan_id ='', $proyek_id ='', $durasi ='')
  {
    $data = array(
      'id' => $id,
      'karyawan_id' => $karyawan_id,
      'proyek_id' => $proyek_id,
      'durasi' => $durasi
    );

    $query = $this->db->insert('karyawan_proyek', $data);
    return $query;
  }

  public function update_record($id ='', $karyawan_id ='', $proyek_id ='', $durasi ='')
  {
    $data = array(
      'id' => $id,
      'karyawan_id' => $karyawan_id,
      'proyek_id' => $proyek_id,
      'durasi' => $durasi
    );

    $this->db->where('id', $id);
    $query = $this->db->update('karyawan_proyek', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->delete('karyawan_proyek');

    return $query;
  }

}