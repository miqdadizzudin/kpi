      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Proyek oleh Karyawan</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_karyawan_proyek','class'=>'form-horizontal')); ?>
                              <!--ID Karyawan_proyek-->
                              <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'copy') : ' '?>
                              <?php else : ?> 
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *ID harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="id" value="<?= set_value('id', isset($data[0]->id_karyawan_proyek) ? $data[0]->id_karyawan_proyek : '') ?>"
                                  <?php echo ($this->uri->segment(2) == 'copy' || $this->uri->segment(2) == 'create')  ? '' :'readonly' ?> >
                                </div>
                              </div>
                              <?php endif; ?>                              
                              <!--ID Proyek-->
                              <div class="form-group">
                                <label for="proyek_id" class="control-label col-md-2">Proyek</label>
                                <div class="col-md-4">
                                  <select name="proyek_id" class="form-control">
                                    <?php
                                      if($resultsProyek) :
                                        foreach ($resultsProyek as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->proyek_id ?>" <?php echo (isset($data[0]->proyek_id) && $rs->proyek_id == $data[0]->proyek_id) ? 'selected': ''?>
                                       >  <?= $rs->nama_proyek ?>
                                    </option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <!--ID Karyawan-->
                              <div class="form-group">
                                <label for="karyawan_id" class="control-label col-md-2">Karyawan</label>
                                <div class="col-md-4">
                                  <select name="karyawan_id" class="form-control">
                                    <?php
                                      if($resultsKaryawan) :
                                        foreach ($resultsKaryawan as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->karyawan_id ?>" <?php echo (isset($data[0]->karyawan_id) && $rs->karyawan_id == $data[0]->karyawan_id) ? 'selected': ''?>
                                       >  <?= $rs->nama_karyawan ?>
                                    </option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <!--Durasi-->
                              <div class="form-group">
                                <label for="durasi" class="control-label col-md-2">Durasi (Bulan)</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="durasi" value="<?= set_value('durasi', isset($data[0]->durasi) ? $data[0]->durasi : '') ?>">
                                </div>
                              </div>
                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('karyawan_proyek') ?>">Cancel</a>
                                  </optgroup>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->