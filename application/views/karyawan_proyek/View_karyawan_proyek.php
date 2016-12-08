			<h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
			  
			    <div class="row mt">
                  <div class="col-md-12">
                      <div class="x_panel">
                      	<?= form_open('karyawan_proyek', array('name'=>'karyawan_proyek'))?>
                      		<div class="x_title">
	                      		<h4><i class="fa fa-angle-right"></i> Tabel Proyek oleh Karyawan</h4>		  
								<div class="clearfix"></div>
                            </div>
                            	<div class="col-sm-2">
								  	<?php 	
                        			// Jika Admin
									if($this->ion_auth->in_group(array(1)) ) : ?>
									  	<a href="<?= site_url('karyawan_proyek/create') ?>" class="btn btn-primary">
									  		<i class="fa fa-plus"></i> 
									  		Add
									  	</a>
								  	<?php endif; ?>
								</div>
							<div class="x_content">
							  <div class="table-responsive">
			                      <table class="table table-striped table-hover jambo_table example2">
			                          <thead>
			                          <tr class="headings"> <!--class='info'-->
			                          		<?php if($this->ion_auth->in_group(array(1)) ) : ?>
			                          			<th><input type="checkbox" id="checkAll" class="tableflat" name="checkAll"></th>
			                          		<?php endif; ?>
											<th>No</th>
											<th>Proyek</th>
											<th>Karyawan</th>
											<th>Durasi (Bulan)</th>
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
											<?php if($this->ion_auth->in_group(array(1)) ) : ?>
												<td><input type="checkbox" class="checked_item tableflat" name="checked_item[]" value="<?= $rs->id_karyawan_proyek ?>"></td>
											<?php endif; ?>
											<td><?= $key+1 ?></td>
											<td><?= $rs->nama_proyek ?></td>
											<td><?= $rs->nama_karyawan ?></td>
											<td><?= $rs->durasi ?></td>
											<?php 	
	    									if($this->ion_auth->in_group(array(1)) ) : ?>
	    										<td><a class="btn btn-success btn-xs" href="<?= site_url('karyawan_proyek/detail/'.$rs->id_karyawan_proyek) ?>"><i class="fa fa-folder-open"></i> 
	    										Detail </a></td>
	    										<!-- <td><a class="btn btn-info btn-xs" href="<?= site_url('karyawan_proyek/copy/'.$rs->id_karyawan_proyek) ?>"><i class="fa fa-copy"></i> 
	    										Copy </a></td> -->
	    										<td><a class="btn btn-primary btn-xs" href="<?= site_url('karyawan_proyek/edit/'.$rs->id_karyawan_proyek) ?>"><i class="fa fa-pencil"></i> 
	    										Edit </a></td>
	    										<td><a class="btn btn-danger btn-xs" name="delete" href="<?= site_url('karyawan_proyek/delete/'.$rs->id_karyawan_proyek) ?>"><i class="fa fa-trash-o ">
	    											</i> 
	    										Delete </a></td>
											<?php else : ?>
												<td><a class="btn btn-success btn-xs" href="<?= site_url('karyawan_proyek/detail/'.$rs->id_karyawan_proyek) ?>"><i class="fa fa-folder-open"></i> Detail </a></td>
											<?php endif; ?>	
										</tr>

										<?php
										    endforeach;
										  endif;
										?>

										</tbody>
  										<?php 	
      									if($this->ion_auth->in_group(array(1)) ) : ?>
  											<tfoot>
					                          <tr>
											    <td colspan="3"><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>
											   </tr>
											 </tfoot>
  										<?php else : '' ?>
  										<?php endif; ?>
			                      </table>
			                     <?= form_close(); ?>
			                    </div><!--/table-responsive-->
	                        <br><br>                       
	                    </div><!-- /x-content -->
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->