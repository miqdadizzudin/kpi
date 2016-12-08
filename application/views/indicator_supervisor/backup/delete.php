<h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
  
    <div class="row mt">
      <div class="col-md-12">
          <div class="x_panel">
          	<?= form_open($this->uri->uri_string(), array('name'=>'indicator_supervisor'))?>
          		<div class="x_title">
              		<h4><i class="fa fa-angle-right"></i> Hapus Data</h4>		  
					<div class="clearfix"></div>
                </div>
                	
				<div class="x_content">
					<div class="col-sm-10">
						<h5>
							Yakin akan menghapus data "<?= set_value('indicator_supervisor', 
							$data[0]->nama_indicator.'" dari supervisor "'.$data[0]->nama_supervisor) ?>"
						</h5>
						    <input type="submit" name="delete" value="Yes" class="btn btn-danger">
						    <a href="<?= site_url('indicator_supervisor') ?>" class="btn btn-default">No</a>

			<?php echo form_close(); ?>

					</div>
				</div><!-- /x-content -->
          </div><!-- /content-panel -->
      </div><!-- /col-md-12 -->
  </div><!-- /row -->