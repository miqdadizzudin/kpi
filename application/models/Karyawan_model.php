<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*', 'karyawan.id AS id_karyawan', 
                          'karyawan.nama AS nama_karyawan',
                          'departemen.id AS id_departemen',
                          'users.id AS id_user'
                          ))
                      ->from('karyawan')
                      ->join('departemen','departemen.id=karyawan.departemen_id') 
                      ->join('jabatan','jabatan.id=karyawan.jabatan_id') 
                      ->join('users','users.karyawan_id=karyawan.id') 
                      //Default Inner Join
                      ->order_by('karyawan.id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya     
    return $data;
  }

  public function get_departemen()
  {
    $data = $this->db->select(array('*', 'departemen.id AS departemen_id'))
                      ->from('departemen') 
                      ->order_by('departemen.id')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_jabatan()
  {
    $data = $this->db->select(array('*', 'jabatan.id AS jabatan_id'))
                      ->from('jabatan') 
                      ->order_by('jabatan.id')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_groups()
  {
    $data = $this->db->select(array('*', 'groups.id AS groups_id',
                              'groups.name AS nama_group'))
                      ->from('groups') 
                      ->order_by('groups.id')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*', 'karyawan.id AS id_karyawan', 
                                  'karyawan.nama AS nama_karyawan',
                                  'departemen.id AS id_departemen', 
                                  'departemen.nama_dept AS nama_dept', 
                                  'karyawan.jabatan_id AS id_jabatan', 
                                  'jabatan.nama_jabatan AS nama_jabatan',
                                  'users.id AS id_user'))
                      ->from('karyawan')
                      ->join('departemen','departemen.id=karyawan.departemen_id')
                      ->join('jabatan','jabatan.id=karyawan.jabatan_id')
                      ->join('users','users.karyawan_id=karyawan.id') 
                      //Default Inner Join
                      ->where('karyawan.id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function update_when_action($id_user ='', $karyawan_id ='')
  {
    $data = array(
      'id' => $id_user, 
      'karyawan_id' => $karyawan_id
    );

    $this->db->where('id', $id_user);
    $query = $this->db->update('users', $data);

    return $query;
  }

  public function set_record($id='', $nama='', $tgl_lahir='', $alamat='', $jenis_kelamin='', $departemen_id ='', $jabatan_id='', 
                              $gaji='')
  {
    $data = array(
      'id' => $id,
      'nama' => $nama,
      'tgl_lahir' => $tgl_lahir,
      'alamat' => $alamat,
      'jenis_kelamin' => $jenis_kelamin,
      'departemen_id' => $departemen_id,
      'jabatan_id' => $jabatan_id,
      'gaji' => $gaji
    );

    $query = $this->db->insert('karyawan', $data);
    
    return $query;
  }

  public function update_record($id='', $nama='', $tgl_lahir='', $alamat='', $jenis_kelamin='', $departemen_id ='', $jabatan_id='', 
                              $gaji='')
  {
    $data = array(
      'id' => $id,
      'nama' => $nama,
      'tgl_lahir' => $tgl_lahir,
      'alamat' => $alamat,
      'jenis_kelamin' => $jenis_kelamin,
      'departemen_id' => $departemen_id,
      'jabatan_id' => $jabatan_id
    );

    $this->db->where('karyawan.id', $id);
    $query = $this->db->update('karyawan', $data);

    echo $this->db->last_query();

    return $query;
  }

  public function delete_record($id_karyawan='')
  {
    $this->db->where('karyawan.id', $id_karyawan);
    $query = $this->db->delete('karyawan');

    return $query;
  }

}