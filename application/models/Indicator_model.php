<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*', 'indicator.id AS id'))
                      ->from('indicator')
                      ->order_by('indicator.id', 'asc')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya   
    return $data;
  }

  public function get_edit_data($id)
  {
    $data = $this->db->select(array('*', 'indicator.id AS id'))
                      ->from('indicator')
                      ->where('indicator.id', $id)
                      ->limit(1)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function set_record($id ='', $nama_indicator ='', $deskripsi_indicator='', $deskripsi_indicator2='', 
                            $deskripsi_indicator3='', $target_indicator ='', $bobot ='')
  {
    $data = array(
      'id' => $id,
      'nama_indicator' => $nama_indicator,
      'deskripsi_indicator' => $deskripsi_indicator,
      'deskripsi_indicator2' => $deskripsi_indicator2,
      'deskripsi_indicator3' => $deskripsi_indicator3,
      'target_indicator' => $target_indicator,
      'bobot' => $bobot
    );

    $query = $this->db->insert('indicator', $data);
    return $query;
  }

  public function update_record($id ='', $nama_indicator ='', $deskripsi_indicator='', $deskripsi_indicator2='', 
                            $deskripsi_indicator3='', $target_indicator ='', $bobot ='')
  {
    $data = array(
      'id' => $id,
      'nama_indicator' => $nama_indicator,
      'deskripsi_indicator' => $deskripsi_indicator,
      'deskripsi_indicator2' => $deskripsi_indicator2,
      'deskripsi_indicator3' => $deskripsi_indicator3,
      'target_indicator' => $target_indicator,
      'bobot' => $bobot
    );

    $this->db->where('id', $id);
    $query = $this->db->update('indicator', $data);

    return $query;
  }

  public function delete_record($id='')
  {
    $this->db->where('id', $id);
    $query = $this->db->delete('indicator');

    return $query;
  }

}