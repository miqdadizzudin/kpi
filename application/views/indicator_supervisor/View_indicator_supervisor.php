			<h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
			  
			    <div class="row mt">
                  <div class="col-md-12">
                      <div class="x_panel">
                      	<?= form_open('indicator_supervisor', array('name'=>'indicator_supervisor'))?>
                      		<div class="x_title">
	                      		<h4><i class="fa fa-angle-right"></i> 
	                      			Tabel Nilai 
	                      			<?php 	
	    							if($this->ion_auth->in_group(array(3)) ) : ?> 
	    								oleh <b><u><?= $resultsUmum[0]->nama_karyawan_login ?></u></b>
	    								<a data-toggle="tooltip" data-placement="top" title="Informasi lebih lanjut hubungi Administrator">
	    								    <i class="fa fa-info-circle" style="font-size: 18px;"></i>
	    								</a>
	    							<?php else : ' '?>
	    							<?php endif; ?>
	                      		</h4>		  
								<div class="clearfix"></div>
                            </div>
                            	<!-- <div class="col-sm-2">
								  	<?php 	
                        			// Jika Admin
									if($this->ion_auth->in_group(array(1)) ) : ?>
									  	<a href="<?= site_url('indicator_supervisor/create') ?>" class="btn btn-primary">
									  		<i class="fa fa-plus"></i> 
									  		Add
									  	</a>
								  	<?php endif; ?>
								</div> -->
							<div class="x_content">
							  <div class="table-responsive">
			                      <table class="table table-striped table-hover jambo_table example2">
			                          <thead>
			                          <tr class="headings"> <!--class='info'-->
			                          		<!-- <th>
			                          			<input type="checkbox" id="checkAll" class="tableflat" name="checkAll"> </th> -->
											<th>No</th>
											<th>Indicator</th>
											<?php 	
	    									if($this->ion_auth->in_group(array(1)) ) : ?>
												<th>Supervisor</th>
											<?php endif; ?>
											<th>Karyawan</th>
											<th>Realisasi</th>
											<th>Tanggal</th>
	                            			<th colspan="2">Action</th>
			                          </tr>
			                          </thead>
			                          <tbody>
										<?php
											if(!$resultsUmum) : " " ?>

										<?php else :?>

										<?php  if($results) :
										    foreach ($results as $key => $rs) :
										?>
										<tr>
											<!-- <td><input type="checkbox" class="checked_item tableflat" name="checked_item[]" value="<?= $rs->id ?>"></td> -->
											<td><?= $key+1 ?></td>
											<td><?= $rs->nama_indicator ?></td>
											<?php 	
											if($this->ion_auth->in_group(array(1)) ) : ?>
												<td><?= $rs->nama_supervisor ?></td>
											<?php endif; ?>
											<td><?= $rs->nama_karyawan ?></td>
											<td><?= $rs->realisasi ?></td>
											<td><?= $rs->tanggalBulanTahun.' '.$rs->jamNilai ?></td>
											<?php 	
												if($this->ion_auth->in_group(array(1)) ) : ?>
													<td>
														<a class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Detail"
															href="<?= site_url('indicator_supervisor/detail/'.$rs->id) ?>">
															<i class="fa fa-folder-open"></i>
														</a>
													</td>
													<!-- <td>
														<a class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Copy"
														href="<?= site_url('indicator_supervisor/copy/'.$rs->id) ?>"><i class="fa fa-copy"></i> 
														</a>
													</td> -->
													<td>
														<a class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
														href="<?= site_url('indicator_supervisor/edit/'.$rs->id) ?>"><i class="fa fa-pencil"></i> 
														</a>
													</td>
													<!-- <td>
														<a class="btn btn-danger btn-xs" name="delete" data-toggle="tooltip" data-placement="bottom" title="Delete"
														href="<?= site_url('indicator_supervisor/delete/'.$rs->id) ?>"><i class="fa fa-trash-o "></i> 
														</a>
													</td> -->
											<?php else : ?>
													<td>
														<a class="btn btn-success btn-xs" href="<?= site_url('indicator_supervisor/detail/'.$rs->id) ?>">
															<i class="fa fa-folder-open"></i> Detail
														</a>
													</td>
													<td>
														<a class="btn btn-primary btn-xs" href="<?= site_url('indicator_supervisor/edit/'.$rs->id) ?>">
															<i class="fa fa-pencil"></i> Edit
														</a>
													</td>
											<?php endif; ?>
																							
										</tr>

										<?php
										    endforeach;
										  endif;
										endif; // Status Kosong
										?>

										<!-- </tbody>
										<?php 	
                            			// Jika Evaluator tidak bisa hapus
    									if($this->ion_auth->in_group(array(1)) ) : ?>
				                          	<tfoot>
				                          		<tr>
										    		<td colspan="3"><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>
										    	</tr>
										  	</tfoot>
										<?php endif; ?> -->
			                      </table>
			                     <?= form_close(); ?>
			                    </div><!--/table-responsive-->  
	                        <br><br>                       
	                    </div><!-- /x-content -->
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->