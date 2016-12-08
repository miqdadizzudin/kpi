<h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
  
    <div class="row mt">
      <div class="col-md-12">
          <div class="x_panel">
          		<div class="x_title">
              		<h4><i class="fa fa-angle-right"></i> Tabel Users</h4>		  
					<div class="clearfix"></div>
                </div>
                	<div class="col-sm-4">
					  	
					</div>
				<div class="x_content">
				  <div class="table-responsive">
				  	<?= form_open('users', array('name'=>'users'))?>
                      <table class="table table-striped table-hover jambo_table example2">
                          <thead>
                          <tr class="headings"> <!--class='info'-->
								<th>No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Groups</th>
								<th colspan="4">Action</th>
                          </tr>
                          </thead>
                          <tbody>
							<?php
							  if($results) :
							    foreach ($results as $key => $rs) :
							?>
							<tr>
								<td><?= $key+1 ?></td>
								<td><?= $rs->first_name ?></td>
								<td><?= $rs->email ?></td>
								<td>
									<?php 
										echo $rs->group_name;
									?>
								</td>
								<td><a class="btn btn-success btn-xs" href="<?= site_url('users/detail/'.$rs->id__user_) ?>"><i class="fa fa-folder-open"></i> Detail </a></td>
								<!-- <td><a class="btn btn-info btn-xs" href="<?//= site_url('users/copy/'.$rs->id__user_) ?>"><i class="fa fa-copy"></i> Copy </a></td> -->
								<td><a class="btn btn-primary btn-xs" href="<?= site_url('users/edit/'.$rs->id__user_) ?>"><i class="fa fa-pencil"></i> Edit </a></td>
								<td><a class="btn btn-danger btn-xs buttonDelete" name="delete" href="<?= site_url('users/delete/'.$rs->id__user_) ?>"><i class="fa fa-trash-o ">
									</i> Delete </a></td>													
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