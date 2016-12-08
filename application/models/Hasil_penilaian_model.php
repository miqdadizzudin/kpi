<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_penilaian_model extends CI_Model {
  public function __construct()
  {
      parent::__construct();
  }

  public function get_records()
  {
    $data = $this->db->select(array('*', 'indicator_supervisor.id AS id ',
                              "DATE_FORMAT(created_time,'%Y') AS TahunLagi",
                              "DATE_FORMAT(created_time,'%d %b %Y') AS created_time",
                              "DATE_FORMAT(created_time,'%d-%m-%Y') AS tanggalBulanTahun",
                              "DATE_FORMAT(created_time,'%H:%i:%s') AS jamNilai",
                              "indicator_supervisor.tahun AS tahunA",
                              'indicator.id AS indicator_id', 
                              'indicator.nama_indicator AS nama_indicator', 
                              'indicator.deskripsi_indicator AS deskripsi_indicator', 
                              'SUM(indicator_supervisor.skor_akhir) AS skor_akhir', 
                              'supervisor.id AS supervisor_id', 
                              'supervisor.nama_supervisor AS nama_supervisor',
                              'supervisor.karyawan_id AS NIK_supervisor', 
                              'departemen.nama_dept AS nama_dept', 
                              'karyawan.id AS karyawan_id', 
                              'karyawan.nama AS nama_karyawan', 
                              'indicator.bobot AS bobot', 
                              'indicator.target_indicator AS target_indicator', 
                              'jabatan.nama_jabatan AS nama_jabatan'))
                      ->from('indicator_supervisor')
                      ->join('indicator','indicator.id=indicator_supervisor.indicator_id')
                      ->join('supervisor','supervisor.id=indicator_supervisor.supervisor_id')
                      ->join('departemen','departemen.id_supervisor=supervisor.id')
                      ->join('karyawan','karyawan.id=indicator_supervisor.karyawan_id')
                      ->join('jabatan','jabatan.id=karyawan.jabatan_id')
                      ->order_by('indicator_supervisor.tahun', 'asc')
                      ->group_by('created_time')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya   
    return $data;
  }

  public function get_recordsSesuaiKaryawan($id_karyawan_login)
  {
    $data = $this->db->select(array('*', 'indicator_supervisor.id AS id ',
                              "DATE_FORMAT(created_time,'%Y') AS TahunLagi",
                              "DATE_FORMAT(created_time,'%d %b %Y') AS created_time",
                              "DATE_FORMAT(created_time,'%d-%m-%Y') AS tanggalBulanTahun",
                              "DATE_FORMAT(created_time,'%H:%i:%s') AS jamNilai",
                              "indicator_supervisor.tahun AS tahunA",
                              'indicator.id AS indicator_id', 
                              'indicator.nama_indicator AS nama_indicator', 
                              'indicator.deskripsi_indicator AS deskripsi_indicator', 
                              'SUM(indicator_supervisor.skor_akhir) AS skor_akhir', 
                              'supervisor.id AS supervisor_id', 
                              'supervisor.nama_supervisor AS nama_supervisor',
                              'supervisor.karyawan_id AS NIK_supervisor', 
                              'departemen.nama_dept AS nama_dept', 
                              'karyawan.id AS karyawan_id', 
                              'karyawan.nama AS nama_karyawan', 
                              'indicator.bobot AS bobot', 
                              'indicator.target_indicator AS target_indicator', 
                              'jabatan.nama_jabatan AS nama_jabatan'))
                      ->from('indicator_supervisor')
                      ->join('indicator','indicator.id=indicator_supervisor.indicator_id')
                      ->join('supervisor','supervisor.id=indicator_supervisor.supervisor_id')
                      ->join('departemen','departemen.id_supervisor=supervisor.id')
                      ->join('karyawan','karyawan.id=indicator_supervisor.karyawan_id')
                      ->join('jabatan','jabatan.id=karyawan.jabatan_id')
                      ->where('karyawan.id', $id_karyawan_login)
                      ->order_by('indicator_supervisor.tahun', 'asc')
                      ->group_by('created_time')
                      ->get()
                      ->result();
                     // echo $this->db->last_query();  //Untuk mencoba query-nya   
    return $data;
  }

  public function get_edit_data($supervisor_id ='', $karyawan_id ='', $TahunLagi ='', $tanggalBulanTahun ='', $jamNilai ='')
  {
    $data = $this->db->select(array('*', 'indicator_supervisor.id AS id ',
                              'indicator_supervisor.created_time AS created_time ',
                              "DATE_FORMAT(created_time,'%d %m %Y') AS tanggalS", 
                              "indicator_supervisor.tahun AS tahunA",
                              'indicator.id AS indicator_id', 
                              'indicator.nama_indicator AS nama_indicator', 
                              'indicator.deskripsi_indicator AS deskripsi_indicator', 
                              'supervisor.id AS supervisor_id', 
                              'supervisor.nama_supervisor AS nama_supervisor', 
                              'supervisor.karyawan_id AS NIK_supervisor', 
                              'departemen.nama_dept AS nama_dept', 
                              'karyawan.id AS karyawan_id', 
                              'karyawan.nama AS nama_karyawan', 
                              'indicator.bobot AS bobot', 
                              'indicator.target_indicator AS target_indicator', 
                              'jabatan.nama_jabatan AS nama_jabatan'))
                      ->from('indicator_supervisor')
                      ->join('indicator','indicator.id=indicator_supervisor.indicator_id')
                      ->join('supervisor','supervisor.id=indicator_supervisor.supervisor_id')
                      ->join('departemen','departemen.id_supervisor=supervisor.id')
                      ->join('karyawan','karyawan.id=indicator_supervisor.karyawan_id')
                      ->join('jabatan','jabatan.id=karyawan.jabatan_id')
                      ->where('supervisor.id', $supervisor_id)
                      ->where('karyawan.id', $karyawan_id)
                      ->where('tahun', $TahunLagi)
                      ->where("DATE_FORMAT(created_time,'%d-%m-%Y')", $tanggalBulanTahun)
                      ->where("DATE_FORMAT(created_time,'%H:%i:%s')", $jamNilai)
                      ->limit(20)
                      ->get()
                      ->result();
                      // echo $this->db->last_query();  //Untuk mencoba query-nya
    return $data;
  }

  public function dataExcel($supervisor_id ='', $karyawan_id ='', $TahunLagi ='', $tanggalBulanTahun ='', $jamNilai ='')
  {
    $query = $this->db->select(array('indicator.id AS "ID"', 
                              'supervisor.nama_supervisor AS "Nama Supervisor"', 
                              'departemen.nama_dept AS "Departemen"',
                              'karyawan.nama AS "Nama Karyawan"', 
                              'jabatan.nama_jabatan AS "Jabatan"',
                              'indicator.nama_indicator AS "Indicator"', 
                              'indicator.deskripsi_indicator AS "Deskripsi Level 1"',
                              'indicator.deskripsi_indicator2 AS "Deskripsi Level 2"',
                              'indicator.deskripsi_indicator3 AS "Deskripsi Level 3"',
                              'indicator.bobot AS "Bobot"', 
                              'indicator.target_indicator AS "Target"',
                              'indicator_supervisor.skor AS "Skor"',
                              'indicator_supervisor.skor_akhir AS "Skor Akhir"',
                              'indicator_supervisor.tahun AS "tahun"'
                              ))
                      ->from('indicator_supervisor')
                      ->join('indicator','indicator.id=indicator_supervisor.indicator_id')
                      ->join('supervisor','supervisor.id=indicator_supervisor.supervisor_id')
                      ->join('departemen','departemen.id_supervisor=supervisor.id')
                      ->join('karyawan','karyawan.id=indicator_supervisor.karyawan_id')
                      ->join('jabatan','jabatan.id=karyawan.jabatan_id')
                      ->where('supervisor.id', $supervisor_id)
                      ->where('karyawan.id', $karyawan_id)
                      ->where('tahun', $TahunLagi)
                      ->where("DATE_FORMAT(created_time,'%d-%m-%Y')", $tanggalBulanTahun)
                      ->where("DATE_FORMAT(created_time,'%H:%i:%s')", $jamNilai)
                      ->get();
                      echo $this->db->last_query();  //Untuk mencoba query-nya
    return $query;
  }

// Version 2
function to_excel($query, $filename='exceloutput')
{
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below
     $doc_header = '';
   $doc_footer = '';
   $columns = '';
   $k = 1;
     $obj =& get_instance();
     
     $fields = $query->field_data();
     if ($query->num_rows() == 0) {
          echo '<p>The table appears to have no data.</p>';
     } else {
    $doc_header = <<<EOH
      <?xml version="1.0" encoding="UTF-8"?>
      <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
       xmlns:x="urn:schemas-microsoft-com:office:excel"
       xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
       xmlns:html="http://www.w3.org/TR/REC-html40">
       <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
          <Version>12.00</Version>
       </DocumentProperties>
       <Styles>
        <Style ss:ID="Default" ss:Name="Normal">
         <Alignment ss:Vertical="Bottom"/>
         <Borders/>
         <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
         <Interior/>
         <NumberFormat/>
         <Protection/>
        </Style>
       </Styles>
      <Worksheet ss:Name="Table1">
        <Table>
EOH;
      $doc_footer = '</Table></Worksheet></Workbook>';
      $headers .= '<Row>';
      $col_count = count($fields);
          foreach ($fields as $field) {
        if ( $k < $col_count ) {
          $columns .= '<Column ss:AutoFitWidth="0" ss:Width="100"/>';
          $k++;
        }
             $headers .= '<Cell><Data ss:Type="String">'.$field->name.'</Data></Cell>';
          }
      $headers .= '</Row>';
     
          foreach ($query->result() as $row) {
               $line = '<Row>';
               foreach($row as $value) {
                    $line .= '<Cell><Data ss:Type="String">'.$value.'</Data></Cell>';
               }
         $line .= '</Row>';
               $data .= trim($line);
          }
          header("Cache-Control: ");// leave blank to avoid IE errors
      header("Pragma: ");// leave blank to avoid IE errors
      header("Content-type: application/octet-stream");
      header("Content-Disposition: attachment; filename=$filename.xls");
          echo "$doc_header.$columns.$headers.$data.$doc_footer";  
     }
}

}