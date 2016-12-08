			<h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
			  
			    <div class="row mt">
                  <div class="col-md-12">
                      <div class="x_panel">
                      	<?= form_open('karyawan', array('name'=>'karyawan'))?>
                      		<div class="x_title">
	                      		<h4><i class="fa fa-angle-right"></i> Tabel Karyawan</h4>		  
								<div class="clearfix"></div>
                            </div>
                            	<div class="col-sm-2">
                            		<?php 	
                        			// Jika Admin
									if($this->ion_auth->in_group(array(1)) ) : ?>
									  	<a href="<?= site_url('karyawan/create') ?>" class="btn btn-primary">
									  		<i class="fa fa-user-plus"></i> 
									  		Add 
									  	</a>
								  	<?php endif; ?>
								</div>
							<div class="x_content">
							  <div class="table-responsive">
			                      <table class="table table-striped table-hover jambo_table example2">
			                          <thead>
			                          <tr class="headings">
											<th>No</th>
											<th>Nama</th>
											<th>Tanggal Lahir</th>
											<th>Alamat</th>
											<th>Jenis Kelamin</th>
											<th>Departemen</th>
											<th>Jabatan</th>
											<?php 	
	                            			// Resize jika Evaluator
	    									if($this->ion_auth->in_group(array(1)) ) : ?>
												<th colspan="4">Action</th>
											<?php else : ?>
												<th>Action</th>
											<?php endif; ?>
			                          </tr>
			                          </thead>
			                          <tbody>
										<?php
										  if($results) :
										    foreach ($results as $key => $rs) :
										?>
										<tr>
											<td><?= $key+1 ?></td>
											<td><?= $rs->nama ?></td>
											<td><?= $rs->tgl_lahir ?></td>
											<td><?= $rs->alamat ?></td>
											<td><?= $rs->jenis_kelamin ?></td>
											<td><?= $rs->nama_dept ?></td>
											<td><?= $rs->nama_jabatan ?></td>
											<?php 	
	                            			// View pada Evaluator hanya membaca
	    									if($this->ion_auth->in_group(array(1)) ) :?>
												<td>
													<a class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Detail"
														href="<?= site_url('karyawan/detail/'.$rs->id_karyawan.'/'.$rs->id_user) ?>">
														<i class="fa fa-folder-open"></i>
													</a>
												</td>
												<!-- <td>
													<a class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Copy"
													href="<?= site_url('karyawan/copy/'.$rs->id_karyawan.'/'.$rs->id_user) ?>"><i class="fa fa-copy"></i> 
													</a>
												</td> -->
												<td>
													<a class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
													href="<?= site_url('karyawan/edit/'.$rs->id_karyawan.'/'.$rs->id_user) ?>"><i class="fa fa-pencil"></i> 
													</a>
												</td>
												<td>
													<a class="btn btn-danger btn-xs" name="delete" data-toggle="tooltip" data-placement="bottom" title="Delete"
													href="<?= site_url('karyawan/delete/'.$rs->id_karyawan.'/'.$rs->id_user) ?>"><i class="fa fa-trash-o "></i> 
													</a>
												</td>
											<?php else : ?>
												<td>
													<a class="btn btn-success btn-xs" href="<?= site_url('karyawan/detail/'.$rs->id_karyawan.'/'.$rs->id_user) ?>">
														<i class="fa fa-folder-open"></i>
														Detail
													</a>
												</td>	
											<?php endif; ?>												
										</tr>

										<?php
										    endforeach;
										  endif; // tutup Results
										?>

										</tbody>
			                      </table>
			                     <?= form_close(); ?>
			                    </div><!--/table-responsive-->
	                        <br><br>                       
	                    </div><!-- /x-content -->
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->