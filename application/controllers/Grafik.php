<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
    	$this->load->model('grafik_model');
	}

  	public function index()
  	{
  		$resultsDepartemen = $this->grafik_model->get_departemen();
	    $this->template->set('resultsDepartemen', $resultsDepartemen);

		$this->template->title('View Grafik');
		$this->template->build('grafik/view_highchart1'); 

	}

  	public function buatGrafik()
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