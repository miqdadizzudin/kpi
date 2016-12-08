      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Detail Supervisor</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_supervisor','class'=>'form-horizontal')); ?>
                              <!--ID Supervisor-->
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">ID Supervisor</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
                                		<?= set_value('id_supervisor', isset($data[0]->id_supervisor) ? $data[0]->id_supervisor : '') ?>
                                	</p>
                                </div>
                              </div>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="nama_supervisor" class="control-label col-md-2">Nama Supervisor</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
                                		<?= set_value('nama_supervisor', isset($data[0]->nama_supervisor) ? $data[0]->nama_supervisor : '') ?>
                                	</p>
                                </div>
                              </div>
                              <!--ID Karyawan-->
                              <div class="form-group">
                                <label for="karyawan_id" class="control-label col-md-2">ID Karyawan</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
                                		<?= set_value('karyawan_id', isset($data[0]->karyawan_id) ? 
                                    $data[0]->karyawan_id : '') ?>
                                	</p>
                                </div>
                              </div>
                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" href="<?= site_url('supervisor') ?>" type="submit" name="back" value="Back">
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->