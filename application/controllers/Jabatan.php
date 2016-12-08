<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('jabatan_model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    $results = $this->jabatan_model->get_records();
    $this->template->set('results', $results);

		$this->template->title('View Jabatan');
		$this->template->build('jabatan/view_jabatan'); //Pembuatan view 

    if(isset($_POST['delete']))
    {
      $result = $this->jabatan_model->delete_record('$rs->id');
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('jabatan'); //Nama control
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
        redirect('jabatan'); //Nama control
      }
    }

    unset($_POST['save']);

    $results = $this->jabatan_model->get_records();
    $this->template->set('results', $results);

    $this->template->title('Add New');
    $this->template->build('jabatan/form'); //Pembuatan form 
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
        redirect('jabatan'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $data = $this->jabatan_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('jabatan');
    }

    $this->template->title('Edit Data');
    $this->template->build('jabatan/form');
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
        redirect('jabatan'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $data = $this->jabatan_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('jabatan');
    }

    $this->template->title('Copy Data');
    $this->template->build('jabatan/form');
  }

  public function detail()
  {
    check_akses(array(1,3));
    
    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['back']))
    {
        redirect('jabatan'); //Nama control
    }

    unset($_POST['back']);
    
    $data = $this->jabatan_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('jabatan');
    }

    $this->template->title('Detail Data');
    $this->template->build('jabatan/detail');
  }

  public function delete()
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);

    if(isset($_POST['delete']))
    {
      $result = $this->jabatan_model->delete_record($id);
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('jabatan'); //Nama control
      }
    }

    unset($_POST['delete']);

    $data = $this->jabatan_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('jabatan');
    }

    $this->template->title('Delete Data');
    $this->template->build('jabatan/delete');
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID Jabatan','trim|numeric');
    $this->form_validation->set_rules('nama_jabatan','Nama Jabatan','trim|required');

    if($this->form_validation->run() != FALSE)
    {
      $id = $this->input->post('id');
      $nama_jabatan  = $this->input->post('nama_jabatan');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->jabatan_model->set_record($id, $nama_jabatan);
      }
      else
      {
        //Update Existing Data
        $result = $this->jabatan_model->update_record($id, $nama_jabatan);
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