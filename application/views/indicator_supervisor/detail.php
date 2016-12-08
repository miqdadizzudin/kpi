      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Detail Nilai</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_indicator_supervisor','class'=>'form-horizontal')); ?>
                              <!--ID Indicator_supervisor-->
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">ID</label>
                                <div class="col-md-4">
                                  <p class="form-control-static"> <?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?> </p>
                                </div>
                              </div>
                              <!--Indicator ID-->
                              <div class="form-group">
                                <label for="indicator_id" class="control-label col-md-2">Indicator</label>
                                <div class="col-md-4">
                                  <p class="form-control-static"> <?= set_value('indicator_id', isset($data[0]->indicator_id) ? 
                                      $data[0]->indicator_id .' - '. $data[0]->nama_indicator : '') ?> </p>
                                </div>
                              </div>
                              <!--Supervisor ID-->
                              <div class="form-group">
                                <label for="supervisor_id" class="control-label col-md-2">Supervisor</label>
                                <div class="col-md-4">
                                  <p class="form-control-static"> 
                                    <?= set_value('supervisor_id', isset($data[0]->supervisor_id) ? 
                                      $data[0]->supervisor_id .' - '. $data[0]->nama_supervisor  : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Karyawan ID-->
                              <div class="form-group">
                                <label for="karyawan_id" class="control-label col-md-2">Karyawan</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('karyawan_id', isset($data[0]->karyawan_id) ? 
                                      $data[0]->karyawan_id .' - '. $data[0]->nama_karyawan : '') ?>
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
                               <!--Target Indicator-->
                              <div class="form-group">
                                <label for="target_indicator" class="control-label col-md-2">Target Indicator</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('target_indicator', isset($data[0]->target_indicator) ? $data[0]->target_indicator : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Realisasi-->
                              <div class="form-group">
                                <label for="realisasi" class="control-label col-md-2">Realisasi</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('realisasi', isset($data[0]->realisasi) ? $data[0]->realisasi : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Skor-->
                              <div class="form-group">
                                <label for="skor" class="control-label col-md-2">Skor</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('skor', isset($data[0]->skor) ? $data[0]->skor : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Skor Akhir-->
                              <div class="form-group">
                                <label for="skor_akhir" class="control-label col-md-2">Skor Akhir</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('skor_akhir', isset($data[0]->skor_akhir) ? $data[0]->skor_akhir : '') ?>
                                  </p>
                                </div>
                              </div>

                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" href="<?= site_url('indicator_supervisor') ?>" type="submit" name="back" value="Back">
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->