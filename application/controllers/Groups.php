<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('groups_model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    $results = $this->groups_model->get_records();
    $this->template->set('results', $results);

		$this->template->title('View Groups');
		$this->template->build('groups/view_groups'); //Pembuatan view 
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
        redirect('groups'); //Nama control
      }
    }

    unset($_POST['save']);
    
    $data = $this->groups_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('groups');
    }

    $this->template->title('Edit Data');
    $this->template->build('groups/form');
  }

  public function detail()
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['back']))
    {
        redirect('groups'); //Nama control
    }

    unset($_POST['back']);
    
    $data = $this->groups_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('groups');
    }

    $this->template->title('Detail Data');
    $this->template->build('groups/detail');
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID','trim|numeric');
    $this->form_validation->set_rules('name','Name of group','trim|required');
    $this->form_validation->set_rules('description','Description','trim|required');

    if($this->form_validation->run() != FALSE)
    {
      $id = $this->input->post('id');
      $name  = $this->input->post('name');
      $description  = $this->input->post('description');

      if($type=='insert')
      {
        //Insert New Data
        $result = $this->groups_model->set_record($id, $name, $description);
      }
      else
      {
        //Update Existing Data
        $result = $this->groups_model->update_record($id, $name, $description);
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