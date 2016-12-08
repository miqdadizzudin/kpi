<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_jabatan($id_user_login ='')
  {
    $data = $this->db->select(array('*', 'jabatan.id AS jabatan_id', 'jabatan.nama_jabatan AS nama_jabatan'))
                      ->from('jabatan') 
                      ->join('karyawan','karyawan.jabatan_id=jabatan.id')
                      ->join('users','users.karyawan_id=karyawan.id')
                      ->order_by('jabatan.id')
                      ->where('users.id',$id_user_login)
                      ->get()
                      ->result();
    return $data;
  }

  public function get_recordsUmum($id_user_login ='')
  {
    $data = $this->db->select(array('*', 'karyawan.id AS id_karyawan_login',
                                      'karyawan.nama AS nama_karyawan_login'))
                      ->from('karyawan') 
                      ->join('users','users.karyawan_id=karyawan.id')
                      ->order_by('karyawan.nama')
                      ->where('users.id',$id_user_login)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();
    return $data;
  }

  public function get_recordsUmumSupervisor($id_user_login ='')
  {
    $data = $this->db->select(array('*', 'supervisor.id AS id_supervisor_login',
                                        'karyawan.id AS id_karyawan_login'))
                      ->from('karyawan') 
                      ->join('users','users.karyawan_id=karyawan.id')
                      ->join('supervisor','supervisor.karyawan_id=karyawan.id','right')
                      ->order_by('karyawan.nama')
                      ->where('users.id',$id_user_login)
                      ->get()
                      ->result();
    return $data;
  }

  
 
}