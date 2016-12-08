<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function update_foto($data ='', $id_karyawan ='')
  {
    $data_foto = array(
      'foto_profil' => $data
    );

    $this->db->where('id', $id_karyawan);
    $result = $this->db->update('karyawan', $data_foto);

    return $result;
  }

  public function get_records($id_user_login)
  {
    $data = $this->db->select(array('*', 'karyawan.id AS id_karyawan', 
                          "DATE_FORMAT(tgl_lahir,'%d-%b-%Y') AS tanggalLahir",
                          'departemen.id AS id_departemen',
                          'users.id AS id_user'
                          ))
                      ->from('karyawan')
                      ->join('departemen','departemen.id=karyawan.departemen_id') 
                      ->join('jabatan','jabatan.id=karyawan.jabatan_id') 
                      ->join('users','users.karyawan_id=karyawan.id') 
                      ->where('users.id', $id_user_login)
                      ->order_by('karyawan.id', 'asc')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_ProyekDetail($id_karyawan)
  {
    $data = $this->db->select(array('*', 'karyawan.id AS id_karyawan',
                            'karyawan.nama AS nama_karyawan',  
                            'proyek.nama_proyek AS nama_proyek',
                            //'LEFT(proyek.nama_proyek, 25) AS nama_ProyekSingkat',
                            'proyek.lokasi_proyek AS lokasi_proyek',
                            'karyawan_proyek.durasi AS durasi'
                            ))
                      ->from('karyawan_proyek')
                      ->join('karyawan','karyawan.id=karyawan_proyek.karyawan_id') 
                      ->join('proyek','proyek.id=karyawan_proyek.proyek_id')
                      ->where('karyawan.id', $id_karyawan)
                      ->order_by('proyek.nama_proyek')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_JumlahKaryawan()
  {
    $data = $this->db->select(array('*', 'COUNT(karyawan.id) AS jumlahKaryawan'))
                      ->from('karyawan') 
                      ->get()
                      ->result();
    return $data;
  }

  public function get_JumlahProyek()
  {
    $data = $this->db->select(array('*', 'COUNT(proyek.id) AS jumlahProyek'))
                      ->from('proyek') 
                      ->get()
                      ->result();
    return $data;
  }

  public function get_JumlahNilai()
  {
    $data = $this->db->select(array('*', 'COUNT(indicator_supervisor.created_time) AS jumlahNilai'))
                      ->from('indicator_supervisor')
                      ->group_by('indicator_id')
                      ->get()
                      ->result();
    return $data;
  }

  public function get_edit_data($id_karyawan ='')
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
                      ->where('karyawan.id', $id_karyawan)
                      ->limit(1)
                      ->get()
                      ->result();
    return $data;
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

  public function update_record($karyawan_id='', $alamat='')
  {
    $data = array(
      'id' => $karyawan_id,
      'alamat' => $alamat
    );

    $this->db->where('karyawan.id', $karyawan_id);
    $query = $this->db->update('karyawan', $data);

    // echo $this->db->last_query();

    return $query;
  }

}