<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_penilaian extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('hasil_penilaian_model');
      $this->load->model('MY_Model');
	}

  public function index()
  {
    // Jika Evaluator hanya dapat melihat penilaian sendiri
    if($this->ion_auth->in_group(array(2)) ) :
      // Helper
      $resultsUmum = getNilaiSemuanya();
      $id_karyawan_login = $resultsUmum[0]->id_karyawan_login;

      $results = $this->hasil_penilaian_model->get_recordsSesuaiKaryawan($id_karyawan_login);
    else :
      $results = $this->hasil_penilaian_model->get_records();
    endif;    

    $this->template->set('results', $results);

		$this->template->title('View Hasil Penilaian');
		$this->template->build('hasil_penilaian/view_hasil_penilaian'); //Pembuatan view 
  }

  public function detail()
  {
    $supervisor_id      = (int)$this->uri->segment(3);
    $karyawan_id        = (int)$this->uri->segment(4);
    $TahunLagi          = (int)$this->uri->segment(5);
    $tanggalBulanTahun  = (string)$this->uri->segment(6);
    $jamNilai           = (string)$this->uri->segment(7);

    $filename = 'laporan'.$karyawan_id.'-'.$supervisor_id.'-'.$TahunLagi.'-'.$tanggalBulanTahun.'-'.$jamNilai;   

    if(isset($_POST['download_excel']))
    {
      $query = $this->hasil_penilaian_model->dataExcel($supervisor_id, $karyawan_id, $TahunLagi, $tanggalBulanTahun, $jamNilai);
      $this->hasil_penilaian_model->to_excel($query, $filename);

      die(); 
      
    }

    unset($_POST['download_excel']);
    
    $data = $this->hasil_penilaian_model->get_edit_data($supervisor_id, $karyawan_id, $TahunLagi, $tanggalBulanTahun, $jamNilai);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan ulangi');
      redirect('Hasil_penilaian');
    }

    $this->template->title('Detail Data');
    $this->template->build('hasil_penilaian/detail');
  }

  /// END OF FILE ///


}

?>