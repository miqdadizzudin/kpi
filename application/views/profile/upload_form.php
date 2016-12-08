<div class="row mt">
  <div class="col-md-12">
      <div class="x_panel">

        <?php echo form_open_multipart($this->uri->uri_string());?>
            <div class="x_title">
                <h4> User Profile </h4>       
            </div>
            <div class="x_content">
            	<div class="col-md-12">
                <div class="row">
                  <div class="col-md-3">
                    <input type="file" name="userfile" size="20" />
                  </div>
                  <a data-toggle="tooltip" data-placement="bottom" title="Hanya gambar berekstensi .gif .jpg .jpeg .png .bmp 
                    dengan ukuran maksimal 2MB">
                    <i class="fa fa-info-circle" style="font-size: 18px;"></i>
                  </a>
                </div>

      					<br>
      					<input type="submit" value="Upload" name="submit" class="btn btn-primary"/>
                Or
                <a href="<?= base_url('profile') ?>">Cancel</a>
				      </div>

		<?php echo form_close(); ?>

			     </div><!-- /x-content -->
      </div><!-- /content-panel -->
  </div><!-- /col-md-12 -->
</div><!-- /row -->