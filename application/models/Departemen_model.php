<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*', 'departemen.id AS id' , 
                        'departemen.id_supervisor AS id_supervisor', 'supervisor.nama_supervisor AS 
                        nama_supervisor'))
                      ->from('departemen')
                      ->join('supervisor','supervisor.id=departemen.id_supervisor') 
                      ->order_by('departemen.id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya     
    return $data;
  }

  public function get_supervisor()
  {
    $data = $this->db->select(array('*', 'supervisor.id AS id_supervisor', 'supervisor.nama_supervisor AS nama_supervisor'))
                      ->from('supervisor') 
                      ->order_by('supervisor.nama_supervisor')
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya 
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*', 'departemen.id AS id' , 
                        'departemen.id_supervisor AS id_supervisor', 'supervisor.nama_supervisor AS 
                        nama_supervisor'))
                      ->from('departemen')
                      ->join('supervisor','supervisor.id=departemen.id_supervisor') 
                      ->where('departemen.id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $nama_dept ='', $id_supervisor ='')
  {
    $data = array(
      'id' => $id,
      'nama_dept' => $nama_dept,
      'id_supervisor' => $id_supervisor
    );

    $query = $this->db->insert('departemen', $data);
    return $query;
  }

  public function update_record($id ='', $nama_dept ='', $id_supervisor ='')
  {
    $data = array(
      'id' => $id,
      'nama_dept' => $nama_dept,
      'id_supervisor' => $id_supervisor
    );

    $this->db->where('id', $id);
    $query = $this->db->update('departemen', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->delete('departemen');

    return $query;
  }

}