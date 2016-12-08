      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Jabatan</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_jabatan','class'=>'form-horizontal')); ?>
                              <!--ID Jabatan-->
                              <?php if ($this->uri->segment(2) == 'create') : ' '?>
                              <?php else : ?>
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID Jabatan <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *ID harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="id" value="<?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>"
                                  <?php echo ($this->uri->segment(2) == 'copy' || $this->uri->segment(2) == 'create')  ? '' :'readonly' ?> >
                                </div>
                                <h5 data-toggle="tooltip" data-placement="top" title="Jabatan mulai dari 20xx">
                                    <i class="fa fa-info-circle" style="font-size: 18px;"></i>
                                </h5>
                              </div>
                              <?php endif; ?>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="nama_jabatan" class="control-label col-md-2">Nama Jabatan</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="nama_jabatan" value="<?= set_value('nama_jabatan', isset($data[0]->nama_jabatan) ? $data[0]->nama_jabatan : '') ?>">
                                </div>
                              </div>
                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('Jabatan') ?>">Cancel</a>
                                  </optgroup>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->