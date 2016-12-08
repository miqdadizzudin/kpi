<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('penilaian_model');
	}

  public function index()
  {
    // Jika Evaluator (dengan helper)
    check_akses(array(3));

    if(isset($_POST['next']))
    {
      $supervisor_id    = $this->input->post('supervisor_id');
      $departemen_id    = $this->input->post('departemen_id');
      $jabatan_id       = $this->input->post('jabatan_id');
      $tahun            = $this->input->post('tahun');
    }

    unset($_POST['next']);

    $userData    = $this->user_data = $this->ion_auth->user()->row(); // Sedang login
    $id_user_login =  $userData->id;

    $resultsDepartemen = $this->penilaian_model->get_departemen($id_user_login);
    $this->template->set('resultsDepartemen', $resultsDepartemen);

    $resultsSupervisor = $this->penilaian_model->get_supervisor($id_user_login);
    $this->template->set('resultsSupervisor', $resultsSupervisor);

    $resultsJabatan = $this->penilaian_model->get_jabatan();
    $this->template->set('resultsJabatan', $resultsJabatan);

    $resultsKaryawan = $this->penilaian_model->get_karyawan();
    $this->template->set('resultsKaryawan', $resultsKaryawan);

    $resultsIndicator = $this->penilaian_model->get_indicator();
    $this->template->set('resultsIndicator', $resultsIndicator);

    $results = $this->penilaian_model->get_records();
    $this->template->set('results', $results);

    if($resultsSupervisor) :
		  $this->template->title('View Penilaian');
		  $this->template->build('penilaian/form_penilaian'); //Pembuatan view 
    else :
      Template::set_message('Anda belum terdaftar sebagai Penilai, harap hubungi Administrator !');
      redirect('supervisor');
    endif;

  }

  public function create()
  {
    check_akses(array(3));
    
    $supervisor_id    = $this->input->post('supervisor_id');
    $departemen_id    = $this->input->post('departemen_id');
    $jabatan_id       = $this->input->post('jabatan_id');
    $tahun            = $this->input->post('tahun');

    if(isset($_POST['save']))
    {
      if(isset($_POST['confirmCek']))
      {
        $result = $this->save_banyak();
        if($result)
        {
          Template::set_message('Sukses melakukan penilaian', 'success');  
          redirect('penilaian');
        }
      }

      if(!isset($_POST['confirmCek']))
      {
        Template::set_message('Harap centang konfirmasi dibawah','error');
      }

    }

    unset($_POST['save']);

    $userData    = $this->user_data = $this->ion_auth->user()->row(); // Sedang login
    $id_user_login =  $userData->id;

    $resultsSupervisor = $this->penilaian_model->get_supervisor($id_user_login);
    $this->template->set('resultsSupervisor', $resultsSupervisor);

    $resultsDepartemen = $this->penilaian_model->get_departemenCoba($departemen_id);
    $this->template->set('resultsDepartemen', $resultsDepartemen);

    $resultsKaryawan = $this->penilaian_model->get_karyawanCoba($departemen_id, $jabatan_id);
    $this->template->set('resultsKaryawan', $resultsKaryawan);

    $resultsIndicator = $this->penilaian_model->get_indicator();
    $this->template->set('resultsIndicator', $resultsIndicator);

    $results = $this->penilaian_model->get_records();
    $this->template->set('results', $results);

    //Cek jika ada ID yang kosong
    if(empty($supervisor_id) | empty($departemen_id) | empty($departemen_id) | empty($departemen_id))
    {
      Template::set_message('Silahkan ulangi');
      redirect('penilaian');
    }else{
      $this->template->title('Add New');
      $this->template->build('penilaian/form'); //Pembuatan form
    }

  }

  protected function save_banyak()
  {
    $data = array();

    $realisasi        = $this->input->post('realisasi');
    $target_indicator = $this->input->post('target_indicator');
    $bobot            = $this->input->post('bobot');
    $supervisor_id    = $this->input->post('supervisor_id'); 
    $karyawan_id      = $this->input->post('karyawan_id');
    $indicator_id     = $this->input->post('indicator_id');
    $tahun            = $this->input->post('tahun');

    //$key = index
    foreach ($realisasi as $key => $rs) {
      $skor       = ($rs/$target_indicator[$key])*100;
      $skor_akhir = ($skor*$bobot[$key])/100;

      $dt = array(
        'indicator_id'  => $indicator_id[$key],
        'supervisor_id' => $supervisor_id, 
        'karyawan_id'   => $karyawan_id,
        'realisasi'     => $rs, //Realisasi sesuai dengan indicator
        'skor'          => $skor, 
        'skor_akhir'    => $skor_akhir, 
        'tahun'         => $tahun 
        );

      array_push($data, $dt);
      // $data[] =$dt;
    }

    $result = $this->db->insert_batch('indicator_supervisor', $data);
    return $result;
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID','trim|numeric');
    $this->form_validation->set_rules('indicator_id','Indicator','trim|required');
    $this->form_validation->set_rules('supervisor_id','Supervisor','trim|required');
    $this->form_validation->set_rules('karyawaan_id','Karyawan','trim|required');
    $this->form_validation->set_rules('realisasi','Realisasi','trim|required');

    if($this->form_validation->run() != FALSE)
    {
      $id             = $this->input->post('id');
      $indicator_id   = $this->input->post('indicator_id');
      $supervisor_id  = $this->input->post('supervisor_id');
      $karyawaan_id   = $this->input->post('karyawaan_id');
      $realisasi      = $this->input->post('realisasi');
      $tahun          = $this->input->post('tahun');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->departemen_model->set_record($id, $indicator_id, $supervisor_id, $karyawan_id
                        , $skor, $skor_akhir, $tahun);
      }

      return $result;
    }
    else
    {
      Template::set_message(validation_errors(), 'error');
    }
  }


}

?>