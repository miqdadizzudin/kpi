			<h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
			  
			    <div class="row mt">
                  <div class="col-md-12">
                      <div class="x_panel">
                      	<?= form_open('indicator', array('name'=>'indicator'))?>
                      		<div class="x_title">
	                      		<h4><i class="fa fa-angle-right"></i> Tabel Indicator</h4>		  
								<div class="clearfix"></div>
                            </div>
                            	<div class="col-sm-2">
								  <?php 	
                        			// Jika Admin
									if($this->ion_auth->in_group(array(1)) ) : ?>
									  	<a href="<?= site_url('indicator/create') ?>" class="btn btn-primary">
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
											<th>Nama Indicator</th>
											<th>Target</th>
											<th>Bobot</th>
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
										<tr style="text-align: justify;">
											<td><?= $key+1 ?></td>
											<td style="text-align: left;"><?= $rs->nama_indicator ?></td>
											<td><?= $rs->target_indicator ?></td>
											<td><?= $rs->bobot ?></td>
											<?php 	
	    									if($this->ion_auth->in_group(array(1)) ) : ?>
	    										<td>
	    											<a class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Detail"
	    												href="<?= site_url('indicator/detail/'.$rs->id) ?>">
	    												<i class="fa fa-folder-open"></i>
	    											</a>
	    										</td>
	    										<!-- <td>
	    											<a class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Copy"
	    											href="<?= site_url('indicator/copy/'.$rs->id) ?>"><i class="fa fa-copy"></i> 
	    											</a>
	    										</td> -->
	    										<td>
	    											<a class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Edit"
	    											href="<?= site_url('indicator/edit/'.$rs->id) ?>"><i class="fa fa-pencil"></i> 
	    											</a>
	    										</td>
	    										<td>
	    											<a class="btn btn-danger btn-xs" name="delete" data-toggle="tooltip" data-placement="bottom" title="Delete"
	    											href="<?= site_url('indicator/delete/'.$rs->id) ?>"><i class="fa fa-trash-o "></i> 
	    											</a>
	    										</td>
											<?php else : ?>
												<td><a class="btn btn-success btn-xs" href="<?= site_url('indicator/detail/'.$rs->id) ?>"><i class="fa fa-folder-open"></i> Detail </a></td>
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