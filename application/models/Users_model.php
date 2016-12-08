<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*', 'karyawan.nama AS nama_karyawan', 'users.id AS id'
                              , 'karyawan.nama AS nama_karyawan'))
                      ->from('users')
                      ->join('karyawan','karyawan.id=users.karyawan_id','right') 
                      // ->join('karyawan','karyawan.id=users.karyawan_id','right') 
                      ->order_by('karyawan.id', 'asc')
                      ->get()
                      ->result();
    return $data;
  }

  public function getKelompok()
  {
    $query= " SELECT *, users.id AS id__user_, 
                      karyawan.nama AS nama_karyawan, 
                      (SELECT
                        GROUP_CONCAT(name
                          SEPARATOR ', ')
                      FROM groups 
                          JOIN users_groups ON users_groups.group_id=groups.id
                      WHERE users_groups.user_id=id__user_) AS group_name
              FROM users
                    JOIN karyawan ON karyawan.id=users.karyawan_id
              ORDER BY karyawan.id ASC";

    return $this->db->query($query)->result();
  }

  //Seleksi data yang sudah terdaftar
  public function get_karyawanEdit()
  {
    $data = $this->db->select(array('*', 'karyawan.id AS karyawan_id', 'karyawan.nama AS nama_karyawan'))
                      ->from('karyawan') 
                      ->where('karyawan.id NOT IN (select karyawan_id FROM users)')
                      ->order_by('karyawan.id')
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
    $data = $this->db->select(array('*', 'karyawan.nama AS nama_karyawan', 
                            'users.id AS id',
                            'karyawan.nama AS nama_karyawan',
                            'users_groups.id AS groups_id'
                            ))
                      ->from('users')
                      ->join('karyawan','karyawan.id=users.karyawan_id','right')
                      ->join('users_groups','users_groups.user_id=users.id','left') 
                      // ->join('groups','groups.id=users_groups.group_id','right') 
                      ->where('users.id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $karyawan_id ='', $first_name ='',
          $last_name ='', $email ='', $password ='', $password2 ='')
  {
    $data = array(
      'id' => $id, 
      'karyawan_id' => $karyawan_id, 
      'first_name' => $first_name,
      'last_name' => $last_name, 
      'email' => $email, 
      'password' => $password
    );

    $query = $this->db->insert('users', $data);
    return $query;
  }

  public function update_record($id ='', $karyawan_id ='', $first_name ='',
          $last_name ='', $email ='', $password ='', $password2 ='')
  {
    $data = array(
      'id' => $id, 
      'karyawan_id' => $karyawan_id, 
      'first_name' => $first_name,
      'last_name' => $last_name, 
      'email' => $email, 
      'password' => $password
    );

    $this->db->where('id', $id);
    $query = $this->db->update('users', $data);

    return $query;
  }

  public function update_namaKaryawan($karyawan_id='', $nama='')
  {
    $data = array(
      'id' => $karyawan_id,
      'nama' => $nama
    );

    $this->db->where('karyawan.id', $karyawan_id);
    $query = $this->db->update('karyawan', $data);

    return $query;
  }

  public function update_when_action($id ='', $karyawan_id ='')
  {
    $data = array(
      'id' => $id, 
      'karyawan_id' => $karyawan_id
    );

    $this->db->where('id', $id);
    $query = $this->db->update('users', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->delete('users');

    return $query;
  }

}