      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Proyek</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_proyek','class'=>'form-horizontal')); ?>
                              <!--ID Proyek-->
                              <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'copy') : ' '?>
                              <?php else : ?> 
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID Proyek <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *ID harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="id" value="<?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>"
                                  <?php echo ($this->uri->segment(2) == 'copy' || $this->uri->segment(2) == 'create')  ? '' :'readonly' ?> >
                                </div>
                              </div>
                              <?php endif; ?>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="nama_proyek" class="control-label col-md-2">Nama Proyek</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="nama_proyek" value="<?= set_value('nama_proyek', isset($data[0]->nama_proyek) ? $data[0]->nama_proyek : '') ?>">
                                </div>
                              </div>
                              <!--Lokasi-->
                              <div class="form-group">
                                <label for="lokasi_proyek" class="control-label col-md-2">Lokasi</label>
                                <div class="col-md-4">
                                  <textarea name="lokasi_proyek" class="form-control" name="lokasi_proyek"
                                    ><?= set_value('lokasi_proyek', isset($data[0]->lokasi_proyek) ? $data[0]->lokasi_proyek : '') ?>
                                  </textarea>
                                </div>
                              </div>
                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('proyek') ?>">Cancel</a>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->