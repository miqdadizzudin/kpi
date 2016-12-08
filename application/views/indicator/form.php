      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Indicator</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_indicator','class'=>'form-horizontal')); ?>
                              <!--ID Indicator-->
                              <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'copy') : ' '?>
                              <?php else : ?>
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID Indicator <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *ID harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="id" value="<?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>"
                                  <?php echo ($this->uri->segment(2) == 'copy' || $this->uri->segment(2) == 'create')  ? '' :'readonly' ?> >
                                </div>
                              </div>
                              <?php endif; ?>
                              <!--Nama Indicator-->
                              <div class="form-group">
                                <label for="nama_indicator" class="control-label col-md-2">Nama Indicator</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="nama_indicator" value="<?= set_value('nama_indicator', isset($data[0]->nama_indicator) ? $data[0]->nama_indicator : '') ?>">
                                </div>
                              </div>
                              <!--Deskripsi Indicator-->
                              <div class="form-group">
                                <label for="deskripsi_indicator" class="control-label col-md-2">Deskripsi Level 1</label>
                                <div class="col-md-4">
                                  <textarea class="form-control" name="deskripsi_indicator"><?= set_value('deskripsi_indicator', isset($data[0]->deskripsi_indicator) ? $data[0]->deskripsi_indicator : '') ?>
                                  </textarea>
                                </div>
                              </div>
                              <!--Deskripsi Indicator 2-->
                              <div class="form-group">
                                <label for="deskripsi_indicator2" class="control-label col-md-2">Deskripsi Level 2</label>
                                <div class="col-md-4">
                                  <textarea class="form-control" name="deskripsi_indicator2"><?= set_value('deskripsi_indicator2', isset($data[0]->deskripsi_indicator2) ? $data[0]->deskripsi_indicator2 : '') ?>
                                  </textarea>
                                </div>
                              </div>
                              <!--Deskripsi Indicator 3-->
                              <div class="form-group">
                                <label for="deskripsi_indicator3" class="control-label col-md-2">Deskripsi Level 3</label>
                                <div class="col-md-4">
                                  <textarea class="form-control" name="deskripsi_indicator3"><?= set_value('deskripsi_indicator3', isset($data[0]->deskripsi_indicator3) ? $data[0]->deskripsi_indicator3 : '') ?>
                                  </textarea>
                                </div>
                              </div>
                              <!--Target indicator-->
                              <div class="form-group">
                                <label for="target_indicator" class="control-label col-md-2">Target</label>
                                <div class="col-md-4">
                                  <input type="number" class="form-control" name="target_indicator" value="<?= set_value('target_indicator', isset($data[0]->target_indicator) ? $data[0]->target_indicator : '') ?>">
                                </div>
                              </div>
                              <!--Bobot-->
                              <div class="form-group">
                                <label for="bobot" class="control-label col-md-2">Bobot</label>
                                <div class="col-md-4">
                                  <input type="number" class="form-control" name="bobot" value="<?= set_value('bobot', isset($data[0]->bobot) ? $data[0]->bobot : '') ?>">
                                </div>
                              </div>

                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('indicator') ?>">Cancel</a>
                                  </optgroup>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->