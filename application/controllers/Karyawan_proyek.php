<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_proyek extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('karyawan_proyek_model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    if(isset($_POST['checked_item']) && is_array($_POST['checked_item']))
    {
      $ids = $this->input->post('checked_item');

      foreach ($ids as $key => $id) {
         $this->karyawan_proyek_model->delete_record($id); //Untuk hapus data sekaligus
      }
    }

    unset($_POST['checked_item']);

    $results = $this->karyawan_proyek_model->get_records();
    $this->template->set('results', $results);

		$this->template->title('View Karyawan_Proyek');
		$this->template->build('karyawan_proyek/view_karyawan_proyek'); //Pembuatan view karyawan_proyek

    if(isset($_POST['delete']))
    {
      $result = $this->karyawan_proyek_model->delete_record($id='$rs->id_karyawan_proyek');
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('karyawan_proyek'); //Nama control
      }
    }
  }

  public function create()
  {
    check_akses(array(1));

    if(isset($_POST['save']))
    {
      $result = $this->save_data('insert');
      if($result)
      {
        Template::set_message('Berhasil menambah satu record','success');
        redirect('karyawan_proyek'); //Nama control
      }
    }

    unset($_POST['save']);

    $resultsKaryawan = $this->karyawan_proyek_model->get_karyawan();
    $this->template->set('resultsKaryawan', $resultsKaryawan);

    $resultsProyek = $this->karyawan_proyek_model->get_proyek();
    $this->template->set('resultsProyek', $resultsProyek);

    $results = $this->karyawan_proyek_model->get_records();
    $this->template->set('results', $results);

    $this->template->title('Add New');
    $this->template->build('karyawan_proyek/form'); //Pembuatan form karyawan_proyek
  }

  public function edit($id=0)
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);

    if(isset($_POST['save']))
    {
      $result = $this->save_data('update', $id);

      if($result)
      {
        Template::set_message('Perubahan telah tersimpan','success');
        redirect('karyawan_proyek'); //Nama control
      }
    }

    unset($_POST['save']);

    $resultsKaryawan = $this->karyawan_proyek_model->get_karyawan();
    $this->template->set('resultsKaryawan', $resultsKaryawan);

    $resultsProyek = $this->karyawan_proyek_model->get_proyek();
    $this->template->set('resultsProyek', $resultsProyek);

    $results = $this->karyawan_proyek_model->get_records();
    $this->template->set('results', $results);
    
    $data = $this->karyawan_proyek_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('karyawan_proyek');
    }

    $this->template->title('Edit Data');
    $this->template->build('karyawan_proyek/form');
  }

  public function copy()
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);

    if(isset($_POST['save']))
    {
      $result = $this->save_data('insert');

      if($result)
      {
        Template::set_message('Berhasil menambah satu record','success');
        redirect('karyawan_proyek'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $resultsKaryawan = $this->karyawan_proyek_model->get_karyawan();
    $this->template->set('resultsKaryawan', $resultsKaryawan);

    $resultsProyek = $this->karyawan_proyek_model->get_proyek();
    $this->template->set('resultsProyek', $resultsProyek);
    
    $data = $this->karyawan_proyek_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('karyawan_proyek');
    }

    $this->template->title('Copy Data');
    $this->template->build('karyawan_proyek/form');
  }

  public function detail()
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['back']))
    {
        redirect('karyawan_proyek'); //Nama control
    }

    unset($_POST['back']);
    
    $data = $this->karyawan_proyek_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('karyawan_proyek');
    }

    $this->template->title('Detail Data');
    $this->template->build('karyawan_proyek/detail');
  }
  
  public function delete()
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);

    if(isset($_POST['delete']))
    {
      $result = $this->karyawan_proyek_model->delete_record($id);
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('karyawan_proyek'); //Nama control
      }
    }

    unset($_POST['delete']);

    $data = $this->karyawan_proyek_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('karyawan_proyek');
    }

    $this->template->title('Delete Data');
    $this->template->build('karyawan_proyek/delete');
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID Karyawan_Proyek','trim|numeric');
    $this->form_validation->set_rules('karyawan_id','Karyawan ID','trim|required|numeric');
    $this->form_validation->set_rules('proyek_id','Proyek ID','trim|required|numeric');
    $this->form_validation->set_rules('durasi','Durasi','trim|required');

    if($this->form_validation->run() != FALSE)
    {
      $id = $this->input->post('id');
      $karyawan_id = $this->input->post('karyawan_id');
      $proyek_id = $this->input->post('proyek_id');
      $durasi = $this->input->post('durasi');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->karyawan_proyek_model->set_record($id, $karyawan_id, $proyek_id, $durasi);
      }
      else
      {
        //Update Existing Data
        $result = $this->karyawan_proyek_model->update_record($id, $karyawan_id, $proyek_id, $durasi);
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