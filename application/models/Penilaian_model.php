<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*'))
                      ->from('indicator_supervisor')
                      ->order_by('id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya     
    return $data;
  }

  public function get_departemen($id_user_login ='')
  {
    $data = $this->db->select(array('*', 'departemen.id AS departemen_id', 'departemen.nama_dept AS nama_dept'))
                      ->from('departemen') 
                      ->join('supervisor','supervisor.id=departemen.id_supervisor') 
                      ->join('karyawan','karyawan.id=supervisor.karyawan_id')
                      ->join('users','users.karyawan_id=karyawan.id')
                      ->order_by('departemen.id')
                      ->where('users.id',$id_user_login)
                      ->get()
                      ->result();
                      
    return $data;
  }

  public function get_supervisor($id_user_login ='')
  {
    $data = $this->db->select(array('*', 'supervisor.id AS supervisor_id', 'supervisor.nama_supervisor AS nama_supervisor'))
                      ->from('supervisor') 
                      ->join('karyawan','karyawan.id=supervisor.karyawan_id')
                      ->join('users','users.karyawan_id=karyawan.id')
                      ->order_by('supervisor.id')
                      ->where('users.id',$id_user_login)
                      ->get()
                      ->result();
    return $data;
  }

  public function get_jabatan()
  {
    $data = $this->db->select(array('*', 'jabatan.id AS jabatan_id', 'jabatan.nama_jabatan AS nama_jabatan'))
                      ->from('jabatan') 
                      ->order_by('jabatan.id')
                      ->get()
                      ->result();
    return $data;
  }
  
  public function get_Karyawan()
  {
    $data = $this->db->select(array('*', 'karyawan.id AS karyawan_id', 'karyawan.nama AS nama_karyawan'))
                      ->from('karyawan') 
                      ->order_by('karyawan.id')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_karyawanCoba($departemen_id='', $jabatan_id ='')
  {
    $data = $this->db->select(array('*', 'karyawan.id AS karyawan_id', 'karyawan.nama AS nama_karyawan', 
                                'departemen.nama_dept AS nama_dept', 'jabatan.nama_jabatan AS nama_jabatan'))
                      ->from('karyawan')
                      ->join('departemen','departemen.id=karyawan.departemen_id') 
                      ->join('jabatan','jabatan.id=karyawan.jabatan_id') 
                      //Default Inner Join
                      ->order_by('karyawan.id', 'asc')
                      ->where('departemen.id', $departemen_id)
                      ->where('jabatan.id', $jabatan_id)
                      ->get()
                      ->result();
    return $data;
  }

  public function get_departemenCoba($departemen_id='')
  {
    $data = $this->db->select(array('*', 'departemen.id AS id_dept', 
                                'departemen.nama_dept AS nama_dept'))
                      ->from('departemen')
                      //Default Inner Join
                      ->where('departemen.id', $departemen_id)
                      ->get()
                      ->result();
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

  public function set_record($id ='', $indicator_id ='', $supervisor_id ='', $karyawan_id =''
                        , $skor ='', $skor_akhir ='', $tahun ='')
  {
    $data = array(
      'id' => $id,
      'indicator_id' => $indicator_id,
      'supervisor_id' => $supervisor_id,
      'karyawan_id' => $karyawan_id,
      'realisasi' => $realisasi,
      'skor' => $skor,
      'skor_akhir' => $skor_akhir,
      'tahun' => $tahun
    );

    $query = $this->db->insert('indicator_supervisor', $data);
    return $query;
  }

}