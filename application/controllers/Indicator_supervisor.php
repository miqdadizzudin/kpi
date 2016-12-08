<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator_supervisor extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('indicator_supervisor_model');
      $this->load->model('MY_Model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    if(isset($_POST['checked_item']) && is_array($_POST['checked_item']))
    {
      $ids = $this->input->post('checked_item');

      foreach ($ids as $key => $id) {
         $this->indicator_supervisor_model->delete_record($id); //Untuk hapus data sekaligus
      }
    }

    unset($_POST['checked_item']);
    $status="";

    // Jika Evaluator hanya dapat melihat penilaian sendiri
    if($this->ion_auth->in_group(array(3)) ) :
      // Helper
      $resultsUmum = getNilaiSemuanyaSupervisor();
      if($resultsUmum) : 
        $id_supervisor_login = $resultsUmum[0]->id_supervisor_login;

        $results = $this->indicator_supervisor_model->get_recordsEvaluator($id_supervisor_login);
        $this->template->set('results', $results);
      else :
        $results = "";
        $this->template->set('results', $results);
      endif;

    else : // Jika Admin
      $results = $this->indicator_supervisor_model->get_records();
      $this->template->set('results', $results);
    endif;

		$this->template->title('View Indicator_supervisor');
		$this->template->build('indicator_supervisor/view_indicator_supervisor');

    if(isset($_POST['delete']))
    {
      $result = $this->indicator_supervisor_model->delete_record('$rs->id');
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('indicator_supervisor');
      }
    }
  }

  // public function create()
  // {
  //   check_akses(array(1));

  //   if(isset($_POST['save']))
  //   {
  //     $result = $this->save_data('insert');
  //     if($result)
  //     {
  //       Template::set_message('Berhasil menambah satu record','success');
  //       redirect('indicator_supervisor');
  //     }
  //   }

  //   unset($_POST['save']);

  //   $resultsIndicator = $this->indicator_supervisor_model->get_indicator();
  //   $this->template->set('resultsIndicator', $resultsIndicator);

  //   $resultsSupervisor = $this->indicator_supervisor_model->get_supervisor();
  //   $this->template->set('resultsSupervisor', $resultsSupervisor);

  //   $resultsKaryawan = $this->indicator_supervisor_model->get_karyawan();
  //   $this->template->set('resultsKaryawan', $resultsKaryawan);

  //   $results = $this->indicator_supervisor_model->get_records();
  //   $this->template->set('results', $results);

  //   $this->template->title('Add New');
  //   $this->template->build('indicator_supervisor/form');
  // }

  public function edit($id=0)
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3); 

    if(isset($_POST['save']))
    {
      $result = $this->save_data('update', $id);

      if($result)
      {
        Template::set_message('Perubahan telah tersimpan','success');
        redirect('indicator_supervisor'); 
      }
    }

    unset($_POST['save']);
    
    $resultsIndicator = $this->indicator_supervisor_model->get_indicator();
    $this->template->set('resultsIndicator', $resultsIndicator);

    $resultsSupervisor = $this->indicator_supervisor_model->get_supervisor();
    $this->template->set('resultsSupervisor', $resultsSupervisor);

    $resultsKaryawan = $this->indicator_supervisor_model->get_karyawan();
    $this->template->set('resultsKaryawan', $resultsKaryawan);

    $data = $this->indicator_supervisor_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('indicator_supervisor');
    }

    $this->template->title('Edit Data');
    $this->template->build('indicator_supervisor/form');
  }

  // public function copy()
  // {
  //   check_akses(array(1));

  //   $id = (int)$this->uri->segment(3);

  //   if(isset($_POST['save']))
  //   {
  //     $result = $this->save_data('insert');

  //     if($result)
  //     {
  //       Template::set_message('Berhasil menambah satu record','success');
  //       redirect('indicator_supervisor'); 
  //     }
  //   }

  //   unset($_POST['save']);
    
  //   $resultsIndicator = $this->indicator_supervisor_model->get_indicator();
  //   $this->template->set('resultsIndicator', $resultsIndicator);

  //   $resultsSupervisor = $this->indicator_supervisor_model->get_supervisor();
  //   $this->template->set('resultsSupervisor', $resultsSupervisor);

  //   $resultsKaryawan = $this->indicator_supervisor_model->get_karyawan();
  //   $this->template->set('resultsKaryawan', $resultsKaryawan);
    
  //   $data = $this->indicator_supervisor_model->get_edit_data($id);
  //   $this->template->set('data', $data);

  //   //Cek jika url dirubah
  //   if(!$data){
  //     Template::set_message('Silahkan Ulangi');
  //     redirect('indicator_supervisor');
  //   }

  //   $this->template->title('Copy Data');
  //   $this->template->build('indicator_supervisor/form');
  // }

  public function detail()
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['back']))
    {
        redirect('indicator_supervisor'); 
    }

    unset($_POST['back']);
    
    $data = $this->indicator_supervisor_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('indicator_supervisor');
    }

    $this->template->title('Detail Data');
    $this->template->build('indicator_supervisor/detail');
  }

  // public function delete()
  // {
  //   check_akses(array(1));

  //   $id = (int)$this->uri->segment(3);

  //   if(isset($_POST['delete']))
  //   {
  //     $result = $this->indicator_supervisor_model->delete_record($id);
  //     if($result)
  //     {
  //       Template::set_message('Record telah dihapus');
  //       redirect('indicator_supervisor');
  //     }
  //   }

  //   unset($_POST['delete']);

  //   $data = $this->indicator_supervisor_model->get_edit_data($id);
  //   $this->template->set('data', $data);

  //   //Cek jika url dirubah
  //   if(!$data){
  //     Template::set_message('Silahkan Ulangi');
  //     redirect('indicator_supervisor');
  //   }

  //   $this->template->title('Delete Data');
  //   $this->template->build('indicator_supervisor/delete');
  // }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID Indicator_supervisor','trim|numeric');
    $this->form_validation->set_rules('indicator_id','Indicator ID','trim|required|numeric');
    $this->form_validation->set_rules('supervisor_id','Supervisor ID','trim|required|numeric');
    $this->form_validation->set_rules('karyawan_id','Karyawan ID','trim|required|numeric');
    $this->form_validation->set_rules('realisasi','Realisasi','trim|required|numeric|max_length[3]');
    $this->form_validation->set_rules('skor','Skor','trim|required|numeric|max_length[3]');
    $this->form_validation->set_rules('skor_akhir','Skor Akhir','trim|required|numeric|max_length[3]');

    if($this->form_validation->run() != FALSE)
    {
      $id = $this->input->post('id');
      $indicator_id  = $this->input->post('indicator_id');
      $supervisor_id  = $this->input->post('supervisor_id');
      $karyawan_id  = $this->input->post('karyawan_id');
      $realisasi  = $this->input->post('realisasi');
      $skor  = $this->input->post('skor');
      $skor_akhir  = $this->input->post('skor_akhir');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->indicator_supervisor_model->set_record($id, $indicator_id, $supervisor_id, $karyawan_id, 
                        $realisasi, $skor, $skor_akhir);
      }
      else
      {
        //Update Existing Data
        $result = $this->indicator_supervisor_model->update_record($id, $indicator_id, $supervisor_id, $karyawan_id, 
                        $realisasi, $skor, $skor_akhir);
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