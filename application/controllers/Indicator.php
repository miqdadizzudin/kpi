<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('indicator_model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    if(isset($_POST['checked_item']) && is_array($_POST['checked_item']))
    {
      $ids = $this->input->post('checked_item');

      foreach ($ids as $key => $id) {
         $this->indicator_model->delete_record($id); //Untuk hapus data sekaligus
      }
    }

    unset($_POST['checked_item']);

    $results = $this->indicator_model->get_records();
    $this->template->set('results', $results);

		$this->template->title('View Indicator');
		$this->template->build('indicator/view_indicator'); //Pembuatan view 

    if(isset($_POST['delete']))
    {
      $result = $this->indicator_model->delete_record('$rs->id');
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('indicator');
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
        redirect('indicator'); 
      }
    }

    unset($_POST['save']);

    $results = $this->indicator_model->get_records();
    $this->template->set('results', $results);

    $this->template->title('Add New');
    $this->template->build('indicator/form'); //Pembuatan form 
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
        redirect('indicator','refresh');
      }
    }

    unset($_POST['save']);

    $data = $this->indicator_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('indicator');
    }

    $this->template->title('Edit Data');
    $this->template->build('indicator/form');
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
        redirect('indicator'); 
      }
    }

    unset($_POST['save']);
    
    $data = $this->indicator_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('indicator');
    }

    $this->template->title('Copy Data');
    $this->template->build('indicator/form');
  }

  public function detail()
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3); 
    
    if(isset($_POST['back']))
    {
        redirect('indicator');
    }

    unset($_POST['back']);
    
    $data = $this->indicator_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('indicator');
    }

    $this->template->title('Detail Data');
    $this->template->build('indicator/detail');
  }

  public function delete()
  {
    check_akses(array(1));
    
    $id = (int)$this->uri->segment(3);

    if(isset($_POST['delete']))
    {
      $result = $this->indicator_model->delete_record($id);
      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('indicator'); 
      }
    }

    unset($_POST['delete']);

    $data = $this->indicator_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('indicator');
    }

    $this->template->title('Delete Data');
    $this->template->build('indicator/delete');
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID Indicator','trim|numeric');
    $this->form_validation->set_rules('nama_indicator','Nama Indicator','trim|required');
    $this->form_validation->set_rules('deskripsi_indicator','Deskripsi Indicator','trim|required');
    $this->form_validation->set_rules('deskripsi_indicator2','Deskripsi Indicator 2','trim|required');
    $this->form_validation->set_rules('deskripsi_indicator3','Deskripsi Indicator 3','trim|required');
    $this->form_validation->set_rules('target_indicator','Target Indicator','trim|required|numeric|max_length[3]');
    $this->form_validation->set_rules('bobot','Bobot','trim|required|numeric|max_length[3]');

    if($this->form_validation->run() != FALSE)
    {
      $id = $this->input->post('id');
      $nama_indicator  = $this->input->post('nama_indicator');
      $deskripsi_indicator  = $this->input->post('deskripsi_indicator');
      $deskripsi_indicator2  = $this->input->post('deskripsi_indicator2');
      $deskripsi_indicator3  = $this->input->post('deskripsi_indicator3');
      $target_indicator  = $this->input->post('target_indicator');
      $bobot  = $this->input->post('bobot');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->indicator_model->set_record($id, $nama_indicator, $deskripsi_indicator, $deskripsi_indicator2, 
          $deskripsi_indicator3, $target_indicator, $bobot);
      }
      else
      {
        //Update Existing Data
        $result = $this->indicator_model->update_record($id, $nama_indicator, $deskripsi_indicator, $deskripsi_indicator2, 
          $deskripsi_indicator3, $target_indicator, $bobot);
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