<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller {

  function __construct()
  {
    parent::__construct();
      $this->load->model('profile_model');
      $this->load->model('grafik_model');

      $this->load->helper(array('form', 'url'));
  }

  public function index()
  {
    //Ambil data yang sedang login
    $user_groups = $this->ion_auth->get_users_groups()->result();
    $id_user_login =  $this->userData->id; // ID User

    $results = $this->profile_model->get_records($id_user_login);
    $this->template->set('results', $results);
    
    $id_karyawan = $results[0]->id_karyawan; // ID Karyawan
    
    $resultsProyekDetail = $this->profile_model->get_ProyekDetail($id_karyawan);
    $this->template->set('resultsProyekDetail', $resultsProyekDetail);

    $this->template->title('View Profile');
    $this->template->build('profile/view_profile');
    
  }

  public function upload($id_karyawan =0)
  {
    $id_karyawan = (int)$this->uri->segment(3);

    $cek_id_karyawan = $id_karyawan;

    //Sama seperti di index
    $user_groups = $this->ion_auth->get_users_groups()->result();
    $id_user_login =  $this->userData->id; // ID User

    $results = $this->profile_model->get_records($id_user_login);
    $this->template->set('results', $results);
    
    $id_karyawan = $results[0]->id_karyawan; // ID Karyawan

    if($cek_id_karyawan != $id_karyawan){
      Template::set_message('Silahkan Ulangi');
      redirect('profile');
    }

    $this->template->title('Upload Form');
    $this->template->build('profile/upload_form');

    if(isset($_POST['submit']))
    {
      $this->do_upload($id_karyawan);
    }

  }

  public function do_upload($id_karyawan =0)
  {
    $id_karyawan = (int)$this->uri->segment(3);

    $error ='';
    $config['file_name'] = $id_karyawan;
    $config['upload_path'] = './assets/uploads/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
    $config['max_size'] = '2048000'; // Here it is 2 MB(2048 Kb)
    $config['max_width']  = '1920';
    $config['max_height']  = '1080';

    $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload())
      {
        $error = array('error' => $this->upload->display_errors());
        $pesan_error = implode(" ",$error)."<br>";

        Template::set_message($pesan_error,'error');
        redirect('profile/upload/'.$id_karyawan);
      }
      else
      {
        $data = array('upload_data' => $this->upload->data());

        $data1 = $this->upload->data(); // Ambil gambar
        $data['image'] = $data1['file_name'];

        $result = $this->profile_model->update_foto($data['image'], $id_karyawan);

        if($result)
        {
          Template::set_message('Photo has been updated','success');
          redirect('profile');
        }
      }      
  }

  public function buatGrafik3()
  {
    $tahunBaru = $this->input->post('tahunselect');

    $userData    = $this->user_data = $this->ion_auth->user()->row();
    $id_user_login =  $userData->id; // ID User

    $results = $this->profile_model->get_records($id_user_login);
    $this->template->set('results', $results);

    $id_karyawan = $results[0]->id_karyawan; // ID Karyawan

    $resultsIndicator = $this->grafik_model->get_indicator();
    $this->template->set('resultsIndicator', $resultsIndicator);

    $resultsNilaiKaryawan = $this->grafik_model->get_NilaiKaryawan($tahunBaru, $id_karyawan);
    $this->template->set('resultsNilaiKaryawan', $resultsNilaiKaryawan);

      $nn = array();
      if($resultsIndicator) :
        foreach ($resultsIndicator as $pi => $tw) :
          $nn[] =array($tw->nama_indicator); 
        endforeach;
      endif; 
      
    $dataNilai = array(
      'nama_indicator' => array(),
      'skor_akhir' => array()
    );

    $dataNilai['nama_indicator'] = $nn;
    foreach ($resultsNilaiKaryawan as $sa) {
      $dataNilai['skor_akhir'][$sa['nama_indicator']][] = array('skor_akhir' => $sa['skor_akhir']);
    }

    echo json_encode($dataNilai);  
  }

  public function edit()
  {
    $user_groups = $this->ion_auth->get_users_groups()->result();
    $id_user_login =  $this->userData->id; // ID User

    $results = $this->profile_model->get_records($id_user_login);
    $this->template->set('results', $results);
    
    $id_karyawan = $results[0]->id_karyawan; // ID Karyawan

    if(isset($_POST['save']))
    {
      $result = $this->save_data('update', $id_karyawan, $id_user_login);

      if($result)
      {
        Template::set_message('Perubahan telah tersimpan','success');
        redirect('profile');
      }
    }

    unset($_POST['save']);    
    
    $resultsProyekDetail = $this->profile_model->get_ProyekDetail($id_karyawan);
    $this->template->set('resultsProyekDetail', $resultsProyekDetail);

    $data = $this->profile_model->get_edit_data($id_karyawan);
    $this->template->set('data', $data);

    $this->template->title('Edit Data');
    $this->template->build('profile/edit_profile');
  }

  protected function save_data($type='update', $id_karyawan=0, $id_user_login=0)
  {
    $this->form_validation->set_rules('alamat','Alamat','trim|required');
    $this->form_validation->set_rules('email','Email','trim|required|valid_email');

    if (!empty($this->input->post('password')))
    {
      $this->form_validation->set_rules('password','Password','trim|required');
      $this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');
    }

    if($this->form_validation->run() != FALSE)
    {
      $alamat         = $this->input->post('alamat');

      // Users
      $karyawan_id  = $id_karyawan;
      $email        = $this->input->post('email');
      $password     = $this->input->post('password');
      $password2    = $this->input->post('password2');

        // Ion Auth
        $username = $email;
        $password = $password;
        $email    = $email;

        $id_user_login = $id_user_login;
        $dataEdit = array(
          'email'       => $email,
          'password'    => $password
           );

      if($type=='update')
      {
        //Karyawan
        $result = $this->profile_model->update_record($karyawan_id, $alamat);
        
        //Users
        $result2 = $this->ion_auth->update($id_user_login, $dataEdit);
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