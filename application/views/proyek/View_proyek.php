			<h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
			  
			    <div class="row mt">
                  <div class="col-md-12">
                      <div class="x_panel">
                      	<?= form_open('proyek', array('name'=>'proyek'))?>
                      		<div class="x_title">
	                      		<h4><i class="fa fa-angle-right"></i> Tabel Proyek</h4>		  
								<div class="clearfix"></div>
                            </div>
                            	<div class="col-sm-2">
								  	<?php 	
                        			// Jika Admin
									if($this->ion_auth->in_group(array(1)) ) : ?>
									  	<a href="<?= site_url('proyek/create') ?>" class="btn btn-primary">
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
											<th>No</th>
											<!-- <th>ID Proyek</th> -->
											<th>Nama Proyek</th>
											<th>Lokasi</th>
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
											<!-- <td><?= $rs->id ?></td> -->
											<td><?= $rs->nama_proyek ?></td>
											<td><?= $rs->lokasi_proyek ?></td>
											<?php 	
	                            			// Resize jika Evaluator
	    									if($this->ion_auth->in_group(array(1)) ) : ?>
	    										<td><a class="btn btn-success btn-xs" href="<?= site_url('proyek/detail/'.$rs->id) ?>"><i class="fa fa-folder-open"></i> 
	    										Detail </a></td>
	    										<!-- <td><a class="btn btn-info btn-xs" href="<?= site_url('proyek/copy/'.$rs->id) ?>"><i class="fa fa-copy"></i> 
	    										Copy </a></td> -->
	    										<td><a class="btn btn-primary btn-xs" href="<?= site_url('proyek/edit/'.$rs->id) ?>"><i class="fa fa-pencil"></i> 
	    										Edit </a></td>
	    										<td><a class="btn btn-danger btn-xs" name="delete" href="<?= site_url('proyek/delete/'.$rs->id) ?>">
	    											<i class="fa fa-trash-o "></i> 
	    										Delete </a></td>
											<?php else : ?>
												<td><a class="btn btn-success btn-xs" href="<?= site_url('proyek/detail/'.$rs->id) ?>"><i class="fa fa-folder-open"></i> Detail </a></td>
											<?php endif; ?>													
										</tr>

										<?php
										    endforeach;
										  endif;
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