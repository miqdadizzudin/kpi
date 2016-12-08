			<h3><i class="fa fa-angle-right"></i> Hasil</h3>
			  
			    <div class="row mt">
                  <div class="col-md-12">
                      <div class="x_panel">
                      	<?= form_open('hasil_penilaian', array('name'=>'hasil_penilaian'))?>

                      		<script src="<?= base_url('assets/js/jquery.min.js') ?>"> </script>
                      		<div class="x_title" style="text-align: center;">
	                      		<h4> 
	                      			List Penilaian 
	                      			<?php if($this->ion_auth->in_group(array(2)) ) :?>
	                      				 	<b><?= $resultsUmum[0]->nama_karyawan_login ?></b>
	                      			<?php else :?>
	                      					Karyawan
	                      			<?php endif;?>
	                      		</h4>
	                      		<h5> PT Java Valley Technology </h5>		  
								<div class="clearfix"></div>
                            </div>
								
							<div class="x_content">
							  <div class="table-responsive">
			                      <table class="table table-striped table-hover jambo_table example2">
			                          <thead>
			                          <tr class="headings"> 
											<th>No</th>
											<?php if($this->ion_auth->in_group(array(2)) ) :?>
													<th>Nama Supervisor</th>
													<th>Departemen</th>
											<?php else :?>
													<th>Nama</th>
													<th>Departemen</th>
													<th>Jabatan</th>
											<?php endif;?>
											<th>Skor Akhir</th>
											<th>Tanggal</th>
											<th>Periode</th>
											<th>Action</th>
			                          </tr>
			                          </thead>
			                          <tbody>
										<?php
										  if($results) :
										    foreach ($results as $key => $rs) :
										?>
										<tr>
											<td><?= $key+1 ?></td>
											
											<?php if($this->ion_auth->in_group(array(2)) ) :?>
													<td><?= $rs->nama_supervisor ?></td>
													<td><?= $rs->nama_dept ?></td>
											<?php else :?>
													<td><?= $rs->nama_karyawan ?></td>
													<td><?= $rs->nama_dept ?></td>
													<td><?= $rs->nama_jabatan ?></td>
											<?php endif;?>
											<td><?= $rs->skor_akhir ?></td>
											<td><?= $rs->created_time ?></td>
											<td><?= $rs->tahunA ?></td>
											<td><a class="btn btn-success btn-xs" href="<?= site_url('hasil_penilaian/detail/'.$rs->supervisor_id.'/'.
												$rs->karyawan_id.'/'.$rs->tahunA.'/'.$rs->tanggalBulanTahun.'/'.$rs->jamNilai) ?>"><i class="fa fa-folder-open"></i> Detail </a></td>											
										</tr>

										<?php
										    endforeach;
										  endif; // Penutup Results
										?>

										</tbody>
			                      </table>
			                    </div><!--/table-responsive-->
			                <?= form_close(); ?>
			                      
	                        <br><br>                       
	                    </div><!-- /x-content -->
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->