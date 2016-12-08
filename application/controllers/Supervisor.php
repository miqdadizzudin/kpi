<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('supervisor_model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    $results = $this->supervisor_model->get_records();
    $this->template->set('results', $results);

		$this->template->title('View Supervisor');
		$this->template->build('supervisor/view_supervisor'); //Pembuatan view 

    if(isset($_POST['delete']))
    {
      $result = $this->supervisor_model->delete_record('$rs->id');
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('supervisor'); //Nama control
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
        redirect('supervisor'); //Nama control
      }
    }

    unset($_POST['save']);

    $resultsKaryawan = $this->supervisor_model->get_karyawan();
    $this->template->set('resultsKaryawan', $resultsKaryawan);

    $results = $this->supervisor_model->get_records();
    $this->template->set('results', $results);

    $this->template->title('Add New');
    $this->template->build('supervisor/form'); //Pembuatan form 
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
        redirect('supervisor'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $resultsKaryawan = $this->supervisor_model->get_karyawan();
    $this->template->set('resultsKaryawan', $resultsKaryawan);

    $data = $this->supervisor_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('supervisor');
    }

    $this->template->title('Edit Data');
    $this->template->build('supervisor/form');
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
        redirect('supervisor'); //Nama control
      }
    }

    unset($_POST['save']);

    $resultsKaryawan = $this->supervisor_model->get_karyawan();
    $this->template->set('resultsKaryawan', $resultsKaryawan);
    
    $data = $this->supervisor_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('supervisor');
    }

    $this->template->title('Copy Data');
    $this->template->build('supervisor/form');
  }

  public function detail()
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['back']))
    {
        redirect('supervisor'); //Nama control
    }

    unset($_POST['back']);
    
    $data = $this->supervisor_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('supervisor');
    }

    $this->template->title('Detail Data');
    $this->template->build('supervisor/detail');
  }

  public function delete()
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);

    if(isset($_POST['delete']))
    {
      $result = $this->supervisor_model->delete_record($id);
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('supervisor'); //Nama control
      }
    }

    unset($_POST['delete']);

    $data = $this->supervisor_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('supervisor');
    }

    $this->template->title('Delete Data');
    $this->template->build('supervisor/delete');
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID Supervisor','trim|numeric');
    $this->form_validation->set_rules('nama_supervisor','Nama Proyek','trim|required');
    $this->form_validation->set_rules('karyawan_id','ID Karyawan','trim|required|numeric');

    if($this->form_validation->run() != FALSE)
    {
      $id = $this->input->post('id');
      $nama_supervisor  = $this->input->post('nama_supervisor');
      $karyawan_id  = $this->input->post('karyawan_id');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->supervisor_model->set_record($id, $nama_supervisor, $karyawan_id);
      }
      else
      {
        //Update Existing Data
        $result = $this->supervisor_model->update_record($id, $nama_supervisor, $karyawan_id);
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