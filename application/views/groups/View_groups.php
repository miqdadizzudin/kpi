			<h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
			  
			    <div class="row mt">
                  <div class="col-md-12">
                      <div class="x_panel">
                      	<?= form_open('groups', array('name'=>'groups'))?>
                      		<div class="x_title">
	                      		<h4><i class="fa fa-angle-right"></i> Tabel Groups</h4>		  
								<div class="clearfix"></div>
                            </div>
                            	<div class="col-sm-2">
								  	
								</div>
							<div class="x_content">
							  <div class="table-responsive">
			                      <table class="table table-striped table-hover jambo_table">
			                          <thead>
			                          <tr class="headings"> <!--class='info'-->
										<th>ID </th>
										<th>Name </th>
										<th>Description</th>
										<?php 	
	                            			// Resize jika Evaluator
	    									if($this->ion_auth->in_group(array(1)) ) : ?>
												<th colspan="2">Action</th>
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
											<td><?= $rs->id ?></td>
											<td><?= $rs->name ?></td>
											<td><?= $rs->description ?></td>
											<?php 	
	    									if($this->ion_auth->in_group(array(1)) ) : ?>
	    										<td><a class="btn btn-success btn-xs" href="<?= site_url('groups/detail/'.$rs->id) ?>"><i class="fa fa-folder-open"></i> Detail </a></td>
	    										<td><a class="btn btn-primary btn-xs" href="<?= site_url('groups/edit/'.$rs->id) ?>"><i class="fa fa-pencil"></i> Edit </a></td>
											<?php else : ?>
												<td><a class="btn btn-success btn-xs" href="<?= site_url('groups/detail/'.$rs->id) ?>"><i class="fa fa-folder-open"></i> Detail </a></td>
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