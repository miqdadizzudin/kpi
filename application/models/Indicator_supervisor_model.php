<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator_supervisor_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*', 'indicator_supervisor.id AS id ',
                              "DATE_FORMAT(created_time,'%d-%b-%Y') AS tanggalBulanTahun",
                              "DATE_FORMAT(created_time,'%H:%i:%s') AS jamNilai", 
                              'indicator.id AS indicator_id', 
                              'indicator.nama_indicator AS nama_indicator', 
                              'supervisor.id AS supervisor_id', 
                              'supervisor.nama_supervisor AS nama_supervisor', 
                              'karyawan.id AS karyawan_id', 
                              'karyawan.nama AS nama_karyawan', 
                              'indicator.bobot AS bobot', 
                              'indicator.target_indicator AS target_indicator'))
                      ->from('indicator_supervisor')
                      ->join('indicator','indicator.id=indicator_supervisor.indicator_id')
                      ->join('supervisor','supervisor.id=indicator_supervisor.supervisor_id')
                      ->join('karyawan','karyawan.id=indicator_supervisor.karyawan_id')
                      ->order_by('indicator_supervisor.id', 'asc')
                      ->get()
                      ->result();  
    return $data;
  }

  public function get_recordsEvaluator($id_supervisor_login)
  {
    $data = $this->db->select(array('*', 'indicator_supervisor.id AS id ',
                              "DATE_FORMAT(created_time,'%d-%b-%Y') AS tanggalBulanTahun",
                              "DATE_FORMAT(created_time,'%H:%i:%s') AS jamNilai", 
                              'indicator.id AS indicator_id', 
                              'indicator.nama_indicator AS nama_indicator', 
                              'supervisor.id AS supervisor_id', 
                              'supervisor.nama_supervisor AS nama_supervisor', 
                              'karyawan.id AS karyawan_id', 
                              'karyawan.nama AS nama_karyawan', 
                              'indicator.bobot AS bobot', 
                              'indicator.target_indicator AS target_indicator'))
                      ->from('indicator_supervisor')
                      ->join('indicator','indicator.id=indicator_supervisor.indicator_id')
                      ->join('supervisor','supervisor.id=indicator_supervisor.supervisor_id')
                      ->join('karyawan','karyawan.id=indicator_supervisor.karyawan_id')
                      ->where('supervisor.id', $id_supervisor_login)
                      ->order_by('indicator_supervisor.id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya   
    return $data;
  }

  public function get_indicator()
  {
    $data = $this->db->select(array('*', 'indicator.id AS indicator_id', 'indicator.nama_indicator AS nama_indicator'))
                      ->from('indicator') 
                      ->order_by('indicator.id')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_supervisor()
  {
    $data = $this->db->select(array('*', 'supervisor.id AS supervisor_id', 'supervisor.nama_supervisor AS nama_supervisor'))
                      ->from('supervisor') 
                      ->order_by('supervisor.id')
                      ->get()
                      ->result();
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
    $data = $this->db->select(array('*', 'indicator_supervisor.id AS id ', 'indicator.id AS indicator_id', 
                              'indicator.nama_indicator AS nama_indicator', 'supervisor.id AS supervisor_id', 
                              'supervisor.nama_supervisor AS nama_supervisor', 'karyawan.id AS karyawan_id', 
                              'karyawan.nama AS nama_karyawan', 'indicator.bobot AS bobot', 
                              'indicator.target_indicator AS target_indicator'))
                      ->from('indicator_supervisor')
                      ->join('indicator','indicator.id=indicator_supervisor.indicator_id')
                      ->join('supervisor','supervisor.id=indicator_supervisor.supervisor_id')
                      ->join('karyawan','karyawan.id=indicator_supervisor.karyawan_id')
                      ->where('indicator_supervisor.id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $indicator_id ='', $supervisor_id ='', $karyawan_id ='', 
                        $realisasi ='', $skor ='', $skor_akhir ='')
  {
    $data = array(
      'id' => $id,
      'indicator_id' => $indicator_id,
      'supervisor_id' => $supervisor_id,
      'karyawan_id' => $karyawan_id,
      'realisasi' => $realisasi,
      'skor' => $skor,
      'skor_akhir' => $skor_akhir
    );

    $query = $this->db->insert('indicator_supervisor', $data);
    return $query;
  }

  public function update_record($id ='', $indicator_id ='', $supervisor_id ='', $karyawan_id ='', 
                        $realisasi ='', $skor ='', $skor_akhir ='')
  {
    $data = array(
      'id' => $id,
      'indicator_id' => $indicator_id,
      'supervisor_id' => $supervisor_id,
      'karyawan_id' => $karyawan_id,
      'realisasi' => $realisasi,
      'skor' => $skor,
      'skor_akhir' => $skor_akhir
    );

    $this->db->where('id', $id);
    $query = $this->db->update('indicator_supervisor', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $result = $this->db->delete('indicator_supervisor');

    return $result;
  }

}