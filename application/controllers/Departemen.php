<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('departemen_model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    $results = $this->departemen_model->get_records();
    $this->template->set('results', $results);

		$this->template->title('View Departemen');
		$this->template->build('departemen/view_departemen'); //Pembuatan view 

    if(isset($_POST['delete']))
    {
      $result = $this->departemen_model->delete_record('$rs->id');
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('departemen'); //Nama control
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
        redirect('departemen'); //Nama control
      }
    }

    unset($_POST['save']);

    $resultsSupervisor = $this->departemen_model->get_supervisor();
    $this->template->set('resultsSupervisor', $resultsSupervisor);

    $results = $this->departemen_model->get_records();
    $this->template->set('results', $results);

    $this->template->title('Add New');
    $this->template->build('departemen/form'); //Pembuatan form 
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
        redirect('departemen'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $resultsSupervisor = $this->departemen_model->get_supervisor();
    $this->template->set('resultsSupervisor', $resultsSupervisor);
    
    $data = $this->departemen_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('departemen');
    }

    $this->template->title('Edit Data');
    $this->template->build('departemen/form');
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
        redirect('departemen'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $resultsSupervisor = $this->departemen_model->get_supervisor();
    $this->template->set('resultsSupervisor', $resultsSupervisor);
    
    $data = $this->departemen_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('departemen');
    }

    $this->template->title('Copy Data');
    $this->template->build('departemen/form');
  }

  public function detail()
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['back']))
    {
        redirect('departemen'); //Nama control
    }

    unset($_POST['back']);
    
    $data = $this->departemen_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('departemen');
    }

    $this->template->title('Detail Data');
    $this->template->build('departemen/detail');
  }

  public function delete()
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);

    if(isset($_POST['delete']))
    {
      $result = $this->departemen_model->delete_record($id);
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('departemen'); //Nama control
      }
    }

    unset($_POST['delete']);

    $data = $this->departemen_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('departemen');
    }

    $this->template->title('Delete Data');
    $this->template->build('departemen/delete');
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','Departemen ID','trim|numeric');
    $this->form_validation->set_rules('nama_dept','Nama Departemen','trim|required');
    $this->form_validation->set_rules('id_supervisor','ID Supervisor','trim|required');

    if($this->form_validation->run() != FALSE)
    {
      $id = $this->input->post('id');
      $nama_dept  = $this->input->post('nama_dept');
      $id_supervisor  = $this->input->post('id_supervisor');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->departemen_model->set_record($id, $nama_dept, $id_supervisor);
      }
      else
      {
        //Update Existing Data
        $result = $this->departemen_model->update_record($id, $nama_dept, $id_supervisor);
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