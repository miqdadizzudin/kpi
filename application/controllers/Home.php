<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
			$this->load->model('grafik_model');
			$this->load->model('profile_model');
	}

	public function index()
	{
		$userData    = $this->user_data = $this->ion_auth->user()->row();
		$id_user_login =  $userData->id; // ID User

		$results = $this->profile_model->get_records($id_user_login);
    	$this->template->set('results', $results);

		$id_karyawan = $results[0]->id_karyawan; // ID Karyawan

		$resultsProyekDetail = $this->profile_model->get_ProyekDetail($id_karyawan);
		$this->template->set('resultsProyekDetail', $resultsProyekDetail);

    	$resultsJumlahKaryawan = $this->profile_model->get_JumlahKaryawan();
    	$this->template->set('resultsJumlahKaryawan', $resultsJumlahKaryawan);

    	$resultsJumlahProyek = $this->profile_model->get_JumlahProyek();
    	$this->template->set('resultsJumlahProyek', $resultsJumlahProyek);

    	$resultsJumlahNilai = $this->profile_model->get_JumlahNilai();
    	$this->template->set('resultsJumlahNilai', $resultsJumlahNilai);

    	$resultsDepartemen = $this->grafik_model->get_departemen();
	    $this->template->set('resultsDepartemen', $resultsDepartemen);

	    if($this->ion_auth->in_group(array(2)) ) :
	    	$this->template->title('Halaman Welcome'); 
			$this->template->build('welcome_message_simple');
	    else :
			$this->template->title('Halaman Welcome'); 
			$this->template->build('welcome_message');
		endif;
	}

	public function buatGrafik1()
  	{
  		$tahunBaru = $this->input->post('tahunselect');

		$results = $this->grafik_model->get_recordsCoba($tahunBaru);
	    $this->template->set('results', $results);

	    $resultsDepartemen = $this->grafik_model->get_departemen();
	    $this->template->set('resultsDepartemen', $resultsDepartemen);

		    $dd = array();
		    if($resultsDepartemen) :
				foreach ($resultsDepartemen as $ny => $ab) :
					$dd[] =array($ab->nama_dept); 
				endforeach;
			endif; 
			
		$dataks = array(
			'dept' => array(),
			'indicator' => array()
		);

		$dataks['dept'] = $dd;
		foreach ($results as $sa) {
			$dataks['indicator'][$sa['indicator']][] = array('skor_akhir' => $sa['skor_akhir']);
		}
		echo json_encode($dataks);	
	}

	public function buatGrafik2()
  	{
  		$deptBaru = $this->input->post('deptselect');

  		$resultsDepartemen = $this->grafik_model->get_departemen();
	    $this->template->set('resultsDepartemen', $resultsDepartemen);

  		$resultsKaryawan = $this->grafik_model->get_karyawan($deptBaru);
	    $this->template->set('resultsKaryawan', $resultsKaryawan);

		$resultsKaryawanProyek = $this->grafik_model->get_KaryawanProyek($deptBaru);
	    $this->template->set('resultsKaryawanProyek', $resultsKaryawanProyek);

	  	  	$kk = array();
		   	if($resultsKaryawan) :
				foreach ($resultsKaryawan as $pi => $tw) :
					$kk[] =array($tw->nama_karyawan); 
				endforeach;
			endif; 
			
		$dataDept = array(
			'nama_karyawan' => array(),
			'jumProyekKaryawan' => array()
		);

		$dataDept['nama_karyawan'] = $kk;
		foreach ($resultsKaryawanProyek as $sa) {
			$dataDept['jumProyekKaryawan'][$sa['nama_karyawan']][] = array('jumProyekKaryawan' => $sa['jumProyekKaryawan']);
		}

		// die(print_r($dataDept));

		echo json_encode($dataDept);	
	}
}

?>
