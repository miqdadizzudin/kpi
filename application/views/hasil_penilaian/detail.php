			<h3> </h3>		  
			    <div class="row mt">
                  <div class="col-md-12">
                      <div class="x_panel">
                      	<?= form_open('hasil_penilaian/detail/'.$supervisor_id = (int)$this->uri->segment(3). '/'.
                      	$karyawan_id = $this->uri->segment(4).'/'.$TahunLagi = $this->uri->segment(5).'/'.
                      	$tanggalBulanTahun = $this->uri->segment(6).'/'.$jamNilai = $this->uri->segment(7),
                      	array('name'=>'hasil_penilaian'))?>
                      		<div class="x_title">	 
	                      		<div class="col-sm-8">
	                      			<h3> <img src="<?= base_url('assets/img/logo_java_valley.png') ?>"
		                      			width="80" height="80"> Java Valley
		                      		</h3>  
		                      		<div class="col-sm-offset-1">
	                      				<h5>Jalan Sinabung I No 78 Semarang, 024-8508797 </h5>
	                      			</div>
	                      		</div>		  
								<div class="clearfix"></div>
                            </div>
                            	<h3 style="text-align: center">
							  		Hasil Pengukuran Kinerja
							  	</h3>
							  	<h5 style="text-align: center">
							  		Periode : <?= $this->uri->segment(5); ?> <!-- tahun -->
							  	</h5>
							  	<!-- this row will not appear when printing -->
                                <div class="no-print">
                                    <div class="col-md-12">
                                        <button class="btn btn-default" onclick="window.print();"
                                        	data-toggle="tooltip" data-placement="bottom" title="Print or Download PDF">
                                        	<i class="fa fa-print"></i> 
                                        	Print
                                    	</button>
                                        <button class="btn btn-primary pull-right" style="margin-right: 5px;"
                                        	name="download_excel" data-toggle="tooltip" data-placement="bottom" 
                                        	title="Filename.xls"><i class="fa fa-download"></i> 
                                        	Download Excel
                                    	</button>
                                        <!-- <button class="btn btn-success pull-right" style="margin-right: 5px;"
                                        	name="download_pdf"><i class="fa fa-download"></i> Download PDF
                                    	</button> -->
                                    </div>
                                </div>
							  	<div class="col-md-5">
								  	<table style="font-size: 115%;">
								  		<tr>
								  			<td>Nama karyawan </td>
								  			<td>: <?= set_value('nama_karyawan', $data[0]->nama_karyawan) ?> </td>
								  		</tr>
								  		<tr>
								  			<td>Departemen </td>
								  			<td>: <?= set_value('nama_dept', $data[0]->nama_dept) ?> </td>
								  		</tr>
								  		<tr>
								  			<td>Jabatan </td>
								  			<td>: <?= set_value('nama_jabatan', $data[0]->nama_jabatan) ?> </td> 
								  		</tr>
								  	</table>
								</div>
							<div class="x_content">
							  <div class="table-responsive">
			                      <table class="table table-striped table-hover table-bordered jambo_table ">
			                          <thead>
			                          <tr class="headings"> <!--class='info'-->
											<th>No</th>
											<th>Indikator</th>
											<th>Deskripsi</th>
											<th>Bobot</th>
											<th>Target</th>
											<th>Realisasi</th>
											<th>Skor</th>
											<th>Skor Akhir</th>
			                          </tr>
			                          </thead>
			                          <tbody>
			                         	<?php
			                         	$jumlah = 0;
										  if($data) :
										    foreach ($data as $key => $rs) :
										?>
										<tr>
											<td><?= $key+1 ?></td>
											<td><?= $rs->nama_indicator ?></td>
<?php
	// Deskripsi sesuai realisasi
	if($rs->realisasi <= 60)
	{
		$rs->deskripsi_indicator = $rs->deskripsi_indicator;
	}elseif($rs->realisasi <= 80)
	{
		$rs->deskripsi_indicator = $rs->deskripsi_indicator2;
	}elseif($rs->realisasi <= 100)
	{
		$rs->deskripsi_indicator = $rs->deskripsi_indicator3;
	}
?>
											<td><?= $rs->deskripsi_indicator ?></td>
											<td><?= $rs->bobot ?></td>
											<td><?= $rs->target_indicator ?></td>
											<td><?= $rs->realisasi ?></td>
											<td><?= $rs->skor ?></td>
											<td><?= $rs->skor_akhir ?></td>												
											<?php $jumlah =  $jumlah + $rs->skor_akhir; ?>												
										</tr>
										<?php
										    endforeach;
										  endif;
										?>

<?php
	// Skor Huruf
	$skor_huruf ='';
	if($jumlah >= 85){
		$skor_huruf ='A';
	}elseif($jumlah >= 75){
		$skor_huruf ='B';
	}elseif($jumlah >= 65){
		$skor_huruf ='C';
	}else{
		$skor_huruf ='D';
	}
?>
										<tr>
											<td colspan="7" style="text-align: right"> Skor Kumulatif =  </td>
											<td> <?= $jumlah ?> (<?= $skor_huruf ?>)</td>
										</tr>


										</tbody>
			                      </table>
			                     <?= form_close(); ?>
			                    </div><!--/table-responsive-->
	                        <div class="col-sm-4 ">
	                        	*Ket : <br>
	                        	&nbsp;&nbsp;&nbsp; Deskripsi diatas sesuai dengan realisasi per indikator 	<br>
	                        	&nbsp;&nbsp;&nbsp; A = Sangat Baik 	<br>
	                        	&nbsp;&nbsp;&nbsp; B = Baik 		<br>
	                        	&nbsp;&nbsp;&nbsp; C = Cukup		<br>
	                        	&nbsp;&nbsp;&nbsp; D = Kurang Baik	<br>
	                        </div>
	                        <div class="col-sm-3 col-sm-offset-5" style="text-align: justify;">
			                    Semarang , <?= set_value('tanggalS', $data[0]->tanggalS) ?> <br>
			                    Mengetahui Supervisor,  
	                        	<br><br><br><br>
	                        	(
	                        		<?= set_value('nama_supervisor', $data[0]->nama_supervisor) ?>
	                        	)
	                        	<br>
	                        	NIK. <?= set_value('supervisor_id', $data[0]->NIK_supervisor) ?>
	                        </div>                       
	                    </div><!-- /x-content -->
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->