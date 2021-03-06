      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Jabatan</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_jabatan','class'=>'form-horizontal')); ?>
                              <!--ID Jabatan-->
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">ID Jabatan</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>
                                  </p>                                
                                </div>
                              </div>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="nama_jabatan" class="control-label col-md-2">Nama Jabatan</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('nama_jabatan', isset($data[0]->nama_jabatan) ? $data[0]->nama_jabatan : '') ?>
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