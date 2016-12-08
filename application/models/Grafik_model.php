<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_departemen()
  {
    $query = "  SELECT 
                  departemen.id AS departemen_id,
                  departemen.nama_dept AS nama_dept
                FROM 
                  departemen 
                ORDER BY 
                  departemen.id ASC";
    return $this->db->query($query)->result();
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

  public function get_recordsCoba($tahunBaru ='')
  {
    // $tahunBaru = $this->input->post('tahunselect');
    $query = "  SELECT 
                  departemen.id, 
                  `departemen`.`nama_dept` AS `nama_dept`, 
                  `indicator`.`nama_indicator` AS `indicator`, 
                    ROUND(AVG(skor_akhir)) AS skor_akhir
                FROM 
                  `indicator_supervisor` 
                  INNER JOIN `indicator` ON `indicator`.`id` = `indicator_supervisor`.`indicator_id` 
                  INNER JOIN `supervisor` ON `supervisor`.`id` = `indicator_supervisor`.`supervisor_id` 
                  INNER JOIN `departemen` ON `departemen`.`id_supervisor` = `supervisor`.`id` 
                  INNER JOIN `karyawan` ON `karyawan`.`id` = `indicator_supervisor`.`karyawan_id` 
                WHERE tahun=".$tahunBaru."
                GROUP BY 
                  departemen.id, 
                  indicator.id 
                ORDER BY 
                  `departemen`.`id` ASC"; //Pakai ? pada tahun
    // return $this->db->query($query, array($tahunBaru))->result_array();
    return $this->db->query($query)->result_array();
  }

  public function get_karyawan($deptBaru ='')
  {
    $query = "  SELECT 
                  karyawan.id AS karyawan_id,
                  karyawan.nama AS nama_karyawan
                FROM 
                  karyawan
                  INNER JOIN departemen ON departemen.id = karyawan.departemen_id 
                WHERE 
                  departemen.id=".$deptBaru."
                ORDER BY 
                  karyawan.nama ASC";
    return $this->db->query($query)->result();
  }

  public function get_KaryawanProyek($deptBaru ='')
  {
    $query = "  SELECT 
                  karyawan.nama AS nama_karyawan, 
                  COUNT(proyek.id) AS jumProyekKaryawan 
                FROM 
                  `karyawan_proyek` 
                  INNER JOIN karyawan ON karyawan.id = karyawan_proyek.karyawan_id 
                  INNER JOIN proyek ON proyek.id = karyawan_proyek.proyek_id 
                  INNER JOIN departemen ON departemen.id = karyawan.departemen_id 
                WHERE 
                  departemen.id=".$deptBaru."
                GROUP BY 
                  karyawan.id 
                ORDER BY 
                  `karyawan`.`nama` ASC"; 
    return $this->db->query($query)->result_array();
  }

  public function get_NilaiKaryawan($tahunBaru ='', $id_karyawan='')
  {
    $query = "  SELECT 
                  indicator.nama_indicator AS nama_indicator,
                  indicator_supervisor.skor_akhir AS skor_akhir
                FROM 
                  `indicator_supervisor` 
                  INNER JOIN `indicator` ON `indicator`.`id` = `indicator_supervisor`.`indicator_id` 
                  INNER JOIN `karyawan` ON `karyawan`.`id` = `indicator_supervisor`.`karyawan_id` 
                WHERE 
                  tahun=".$tahunBaru." AND
                  karyawan.id=".$id_karyawan."
                ORDER BY 
                  `indicator`.`nama_indicator` ASC
                LIMIT 
                  8"; 
                  // Limit 8 untuk memperoleh 1 grafik ketika ada 2 penilaian
    return $this->db->query($query)->result_array();
  }

}