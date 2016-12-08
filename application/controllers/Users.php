<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('users_model');
	}

  public function index()
  {
    // Jika Admin (dengan helper)
    check_akses(array(1));

    $results = $this->users_model->getKelompok();
    $this->template->set('results', $results);

    // Groups Ion Auth
    $user_groups = $this->ion_auth->get_users_groups('$rs->id')->result();
    $this->template->set('user_groups', $user_groups);

		$this->template->title('View Users');
		$this->template->build('users/view_users');

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
        redirect('users');
      }
    }

    unset($_POST['save']);

    $data = $this->users_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('users');
    }

    $resultsGroups = $this->users_model->get_groups();
    $this->template->set('resultsGroups', $resultsGroups);

    // Groups Ion Auth
    $user_groups = $this->ion_auth->get_users_groups($id)->result();
    $this->template->set('user_groups', $user_groups);

    $this->template->title('Edit Data');
    $this->template->build('users/form');
  }

  public function detail()
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['back']))
    {
        redirect('users');
    }

    unset($_POST['back']);
    
    $data = $this->users_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('users');
    }

    // Groups Ion Auth
    $user_groups = $this->ion_auth->get_users_groups($id)->result();
    $this->template->set('user_groups', $user_groups);

    $this->template->title('Detail Data');
    $this->template->build('users/detail');
  }

  public function delete()
  {
    check_akses(array(1));
    
    $id = (int)$this->uri->segment(3);
    
    if(isset($_POST['delete']))
    {
      $result = $this->ion_auth->delete_user($id);

      if($result)
      {
        Template::set_message('Record telah dihapus');
        redirect('users');
      }
    }

    unset($_POST['delete']);
    
    $data = $this->users_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('users');
    }

    $this->template->title('Delete Data');
    $this->template->build('users/delete');
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','Users ID','trim|numeric');
    $this->form_validation->set_rules('karyawan_id','Karyawan ID','trim|numeric');
    $this->form_validation->set_rules('first_name','First Name','trim|required');
    $this->form_validation->set_rules('email','Email','trim|required|valid_email');

    if (!empty($this->input->post('password')))
    {
      $this->form_validation->set_rules('password','Password','trim|required');
      $this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');
    }

    if($this->form_validation->run() != FALSE)
    {
      $id           = $this->input->post('id');
      $karyawan_id  = $this->input->post('karyawan_id');
      $first_name   = $this->input->post('first_name');
      $nama         = $first_name;
      $email        = $this->input->post('email');
      $password     = $this->input->post('password');
      $password2    = $this->input->post('password2');
      $idGroup      = $this->input->post('idGroup');

        // Ion Auth
        $username = $email;
        $password = $password;
        $email    = $email;
        $additional_data = array(
                    'first_name'  => $first_name
                    );
        // $group = array('1','2'); // Sets user to admin, member
        $group = $idGroup;

        $id = $id;
        $data = array(
          'username'    => $email,
          'first_name'  => $first_name,
          'email'       => $email,
          'group'       => $group,
          'password'    => $password
           );

          if (!empty($password))
          {
            $data['password'] = $password;
          }

      if($type=='insert')
      {
        // Insert New Data
        $result = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
        $id = $result;

        // Update if Insert
        $result2 = $this->users_model->update_when_action($id, $karyawan_id);
      }
      else
      {
        // Update Existing Data
        $result = $this->ion_auth->update($id, $data);
        //Karyawan
        $result2 = $this->users_model->update_namaKaryawan($karyawan_id, $nama);

        // Update if Edit
        $result3 = $this->users_model->update_when_action($id, $karyawan_id);
        // pass NULL to remove user from all groups
        $result4 = $this->ion_auth->remove_from_group(NULL, $id);
        $result5 = $this->ion_auth->add_to_group($group, $id);
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