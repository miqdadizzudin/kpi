      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Proyek oleh Karyawan</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_karyawan_proyek','class'=>'form-horizontal')); ?>
                              <!--ID Karyawan_proyek-->
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID 
                                </label>
                                <p class="form-control-static">
                                  &nbsp; <?= set_value('id', isset($data[0]->id_karyawan_proyek) ? $data[0]->id_karyawan_proyek : '') ?>
                                </p>
                              </div>
                              <!--ID Karyawan-->
                              <div class="form-group">
                                <label for="karyawan_id" class="control-label col-md-2">Karyawan</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('karyawan_id', isset($data[0]->karyawan_id) ? 
                                        $data[0]->karyawan_id .' - '. $data[0]->nama_karyawan : '') ?>
                                  </p>
                                </div>
                              </div>                              
                              <!--ID Supervisor-->
                              <div class="form-group">
                                <label for="proyek_id" class="control-label col-md-2">Proyek</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('proyek_id', isset($data[0]->proyek_id) ? 
                                        $data[0]->proyek_id .' - '. $data[0]->nama_proyek : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Durasi-->
                              <div class="form-group">
                                <label for="durasi" class="control-label col-md-2">Durasi (Bulan)</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('durasi', isset($data[0]->durasi) ? $data[0]->durasi : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" href="<?= site_url('karyawan_proyek') ?>" type="submit" name="back" value="Back">
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->