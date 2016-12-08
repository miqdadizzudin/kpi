<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('proyek_model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    $results = $this->proyek_model->get_records();
    $this->template->set('results', $results);

		$this->template->title('View Proyek');
		$this->template->build('proyek/view_proyek'); //Pembuatan view 

    if(isset($_POST['delete']))
    {
      $result = $this->proyek_model->delete_record('$rs->id');
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('proyek'); //Nama control
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
        redirect('proyek'); //Nama control
      }
    }

    unset($_POST['save']);

    $results = $this->proyek_model->get_records();
    $this->template->set('results', $results);

    $this->template->title('Add New');
    $this->template->build('proyek/form'); //Pembuatan form 
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
        redirect('proyek'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $data = $this->proyek_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('proyek');
    }

    $this->template->title('Edit Data');
    $this->template->build('proyek/form');
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
        redirect('proyek'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $data = $this->proyek_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('proyek');
    }

    $this->template->title('Copy Data');
    $this->template->build('proyek/form');
  }

  public function detail()
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['back']))
    {
        redirect('proyek'); //Nama control
    }

    unset($_POST['back']);
    
    $data = $this->proyek_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('proyek');
    }

    $this->template->title('Detail Data');
    $this->template->build('proyek/detail');
  }

  public function delete()
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);

    if(isset($_POST['delete']))
    {
      $result = $this->proyek_model->delete_record($id);
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('proyek'); //Nama control
      }
    }

    unset($_POST['delete']);

    $data = $this->proyek_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('proyek');
    }

    $this->template->title('Delete Data');
    $this->template->build('proyek/delete');
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID Proyek','trim|numeric');
    $this->form_validation->set_rules('nama_proyek','Nama Proyek','trim|required');
    $this->form_validation->set_rules('lokasi_proyek','Lokasi Proyek','trim|required');

    if($this->form_validation->run() != FALSE)
    {
      $id = $this->input->post('id');
      $nama_proyek  = $this->input->post('nama_proyek');
      $lokasi_proyek  = $this->input->post('lokasi_proyek');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->proyek_model->set_record($id, $nama_proyek, $lokasi_proyek);
      }
      else
      {
        //Update Existing Data
        $result = $this->proyek_model->update_record($id, $nama_proyek, $lokasi_proyek);
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