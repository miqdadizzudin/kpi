<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('karyawan_model');
	}

  public function index()
  {
    // Jika Admin & Evaluator (dengan helper)
    check_akses(array(1,3));

    if(isset($_POST['checked_item']) && is_array($_POST['checked_item']))
    {
      $ids = $this->input->post('checked_item');

      foreach ($ids as $key => $id) {
        $this->karyawan_model->delete_record($id);
        $this->ion_auth->delete_user($id_user);
      }
    }

    $results = $this->karyawan_model->get_records();
    $this->template->set('results', $results);

    $this->template->title('View Karyawan');
    $this->template->build('karyawan/view_karyawan');		

    if(isset($_POST['delete']))
    {
      $result = $this->karyawan_model->delete_record('$rs->id_karyawan');

      $result2 = $this->ion_auth->delete_user('$rs->id_user');
      if($result && $result2)
      {
        Template::set_message('Record telah dihapus');
        redirect('karyawan'); //Nama control
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
        redirect('karyawan'); //Nama control
      }
    }

    unset($_POST['save']);

    $resultsDepartemen = $this->karyawan_model->get_departemen();
    $this->template->set('resultsDepartemen', $resultsDepartemen);

    $resultsJabatan = $this->karyawan_model->get_jabatan();
    $this->template->set('resultsJabatan', $resultsJabatan);

    $resultsGroups = $this->karyawan_model->get_groups();
    $this->template->set('resultsGroups', $resultsGroups);

    // Groups Ion Auth
    $user_groups = $this->ion_auth->get_users_groups()->result();
    $this->template->set('user_groups', $user_groups);

    $this->template->title('Add New');
    $this->template->build('karyawan/form'); 
  }

  public function edit($id=0)
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);
    $id_user = (int)$this->uri->segment(4);

    if(isset($_POST['save']))
    {
      $result = $this->save_data('update', $id);

      if($result)
      {
        Template::set_message('Perubahan telah tersimpan','success');
        redirect('karyawan'); //Nama control
      }
    }

    unset($_POST['save']);

    $resultsDepartemen = $this->karyawan_model->get_departemen();
    $this->template->set('resultsDepartemen', $resultsDepartemen);

    $resultsJabatan = $this->karyawan_model->get_jabatan();
    $this->template->set('resultsJabatan', $resultsJabatan);

    $resultsGroups = $this->karyawan_model->get_groups();
    $this->template->set('resultsGroups', $resultsGroups);

    // Groups Ion Auth
    $user_groups = $this->ion_auth->get_users_groups($id_user)->result();
    $this->template->set('user_groups', $user_groups);
    
    $data = $this->karyawan_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('karyawan');
    }

    $this->template->title('Edit Data');
    $this->template->build('karyawan/form');
  }

  public function copy()
  {
    check_akses(array(1));

    $id = (int)$this->uri->segment(3);
    $id_user = (int)$this->uri->segment(4);

    if(isset($_POST['save']))
    {
      $result = $this->save_data('insert');

      if($result)
      {
        Template::set_message('Berhasil menambah satu record','success');
        redirect('karyawan'); //Nama control
      }
    }

    unset($_POST['save']);

    $resultsDepartemen = $this->karyawan_model->get_departemen();
    $this->template->set('resultsDepartemen', $resultsDepartemen);

    $resultsJabatan = $this->karyawan_model->get_jabatan();
    $this->template->set('resultsJabatan', $resultsJabatan);
    
    $data = $this->karyawan_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('karyawan');
    }

    $resultsGroups = $this->karyawan_model->get_groups();
    $this->template->set('resultsGroups', $resultsGroups);

    // Groups Ion Auth
    $user_groups = $this->ion_auth->get_users_groups($id_user)->result();
    $this->template->set('user_groups', $user_groups);

    $this->template->title('Copy Data');
    $this->template->build('karyawan/form');
  }

  public function detail()
  {
    check_akses(array(1,3));

    $id = (int)$this->uri->segment(3); 
    $id_user = (int)$this->uri->segment(4);
    
    if(isset($_POST['back']))
    {
        redirect('karyawan'); //Nama control
    }

    unset($_POST['back']);

    // Groups Ion Auth
    $user_groups = $this->ion_auth->get_users_groups($id_user)->result();
    $this->template->set('user_groups', $user_groups);

    $data = $this->karyawan_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('karyawan');
    }

    $this->template->title('Detail Data');
    $this->template->build('karyawan/detail');
  }

  public function delete()
  {
    check_akses(array(1));

    $id_karyawan = (int)$this->uri->segment(3);
    $id_user = (int)$this->uri->segment(4);

    if(isset($_POST['delete']))
    {
      $result = $this->karyawan_model->delete_record($id_karyawan);

      $result2 = $this->ion_auth->delete_user($id_user);
      if($result && $result2)
      {
        Template::set_message('Record telah dihapus');
        redirect('karyawan'); //Nama control
      }
    }

    unset($_POST['delete']);

    $id = (int)$this->uri->segment(3);
    $data = $this->karyawan_model->get_edit_data($id);
    $this->template->set('data', $data);

    //Cek jika url dirubah
    if(!$data){
      Template::set_message('Silahkan Ulangi');
      redirect('karyawan');
    }

    $this->template->title('Delete Data');
    $this->template->build('karyawan/delete');
  }

  public function con2mysql($date) {
      $dateTime = new DateTime($date);
      $formatted_date=date_format ( $dateTime, 'Y-m-d' );

      return $formatted_date;
  }

  protected function save_data($type='insert', $id=0)
  {
    $this->form_validation->set_rules('id','ID','trim|numeric');
    $this->form_validation->set_rules('nama','Nama','trim|required');
    $this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','trim|required');
    $this->form_validation->set_rules('alamat','Alamat','trim|required');
    $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','trim|required|max_length[1]');
    $this->form_validation->set_rules('departemen_id','Departemen ID','trim|required|numeric');
    $this->form_validation->set_rules('jabatan_id','Jabatan ID','trim|required|numeric');
    $this->form_validation->set_rules('gaji','Gaji','trim|required|numeric');
    $this->form_validation->set_rules('email','Email','trim|required|valid_email');

    if (!empty($this->input->post('password')))
    {
      $this->form_validation->set_rules('password','Password','trim|required');
      $this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');
    }

    if($this->form_validation->run() != FALSE)
    {
      // $id             = $this->input->post('id');
      $nama           = $this->input->post('nama');
      $tgl_lahir      = $this->input->post('tgl_lahir');
      $alamat         = $this->input->post('alamat');
      $jenis_kelamin  = $this->input->post('jenis_kelamin');
      $departemen_id  = $this->input->post('departemen_id');
      $jabatan_id     = $this->input->post('jabatan_id');
      $gaji           = $this->input->post('gaji');

      // Users
      // $karyawan_id  = $id;
      $first_name   = $nama;
      $last_name    = ' ';
      $email        = $this->input->post('email');
      $password     = $this->input->post('password');
      $password2    = $this->input->post('password2');
      $idGroup      = $this->input->post('idGroup');

        // Ion Auth
        $username = $email;
        $password = $password;
        $email    = $email;
        $additional_data = array(
                    'first_name'  => $first_name,
                    'last_name'   => $last_name,
                    );
        $group = $idGroup;

        // $id = $id;
        $dataEdit = array(
          'username'    => $email,
          'first_name'  => $first_name,
          'last_name'   => $last_name,
          'email'       => $email,
          'group'       => $group,
          'password'    => $password
           );

      if($type=='insert')
      {
        //Karyawan
        $result = $this->karyawan_model->set_record($id, $nama, $tgl_lahir, $alamat, $jenis_kelamin, $departemen_id, 
                  $jabatan_id, $gaji);
        $karyawan_id = $this->db->insert_id();
        //Users
        $result2 = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
        $id = $result2;
        //Update if Insert
        $result3 = $this->karyawan_model->update_when_action($id, $karyawan_id); 
      }
      else
      {
        //Karyawan
        $result = $this->karyawan_model->update_record($id, $nama, $tgl_lahir, $alamat, $jenis_kelamin, $departemen_id, 
                  $jabatan_id, $gaji);

        $data = $this->karyawan_model->get_edit_data($id);
        $this->template->set('data', $data);
        $id_user = $data[0]->id_user; // ID User
        
        //Users
        $result2 = $this->ion_auth->update($id_user, $dataEdit);
        //Update if Edit
        $result3 = $this->karyawan_model->update_when_action($id_user, $karyawan_id);
        // pass NULL to remove user from all groups
        $result4 = $this->ion_auth->remove_from_group(NULL, $id_user);
        $result5 = $this->ion_auth->add_to_group($group, $id_user);
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