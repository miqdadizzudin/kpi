      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Detail Indicator</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_indicator','class'=>'form-horizontal')); ?>
                              <!--ID Indicator-->
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">ID Indicator</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Nama Indicator-->
                              <div class="form-group">
                                <label for="nama_indicator" class="control-label col-md-2">Nama Indicator</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('nama_indicator', isset($data[0]->nama_indicator) ? $data[0]->nama_indicator : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Deskripsi Indicator-->
                              <div class="form-group">
                                <label for="deskripsi_indicator" class="control-label col-md-2">Deskripsi Level 1</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('deskripsi_indicator', isset($data[0]->deskripsi_indicator) ? $data[0]->deskripsi_indicator : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Deskripsi Indicator 2-->
                              <div class="form-group">
                                <label for="deskripsi_indicator2" class="control-label col-md-2">Deskripsi Level 2</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('deskripsi_indicator2', isset($data[0]->deskripsi_indicator2) ? $data[0]->deskripsi_indicator2 : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Deskripsi Indicator 3-->
                              <div class="form-group">
                                <label for="deskripsi_indicator3" class="control-label col-md-2">Deskripsi Level 2</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('deskripsi_indicator3', isset($data[0]->deskripsi_indicator3) ? $data[0]->deskripsi_indicator3 : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Target indicator-->
                              <div class="form-group">
                                <label for="target_indicator" class="control-label col-md-2">Target</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('target_indicator', isset($data[0]->target_indicator) ? $data[0]->target_indicator : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Bobot-->
                              <div class="form-group">
                                <label for="bobot" class="control-label col-md-2">Bobot</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('bobot', isset($data[0]->bobot) ? $data[0]->bobot : '') ?>
                                  </p>
                                </div>
                              </div>

                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" href="<?= site_url('indicator') ?>" type="submit" name="back" value="Back">
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->