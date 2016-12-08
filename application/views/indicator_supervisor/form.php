      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Nilai</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_indicator_supervisor','class'=>'form-horizontal')); ?>
                              <!--ID Indicator_supervisor-->
                              <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'copy') : ' '?>
                              <?php else : ?>
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *ID harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="id" value="<?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>"
                                  <?php echo ($this->uri->segment(2) == 'copy' || $this->uri->segment(2) == 'create')  ? '' :'readonly' ?> >
                                </div>
                              </div>
                              <?php endif; ?>
                              <!--Indicator ID-->
                              <div class="form-group">
                                <label for="indicator_id" class="control-label col-md-2">Indicator</label>
                                <div class="col-md-4">
                                  <select name="indicator_id" class="form-control">
                                    <?php
                                      if($resultsIndicator) :
                                        foreach ($resultsIndicator as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->indicator_id ?>" <?php echo (isset($data[0]->indicator_id) && $rs->indicator_id == $data[0]->indicator_id) ? 'selected': ''?>
                                       >  <?= $rs->nama_indicator ?>
                                    </option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <!--Supervisor ID-->
                              <div class="form-group">
                                <label for="supervisor_id" class="control-label col-md-2">Supervisor</label>
                                <div class="col-md-4">
                                  <select name="supervisor_id" class="form-control">
                                    <?php
                                      if($resultsSupervisor) :
                                        foreach ($resultsSupervisor as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->supervisor_id ?>" <?php echo (isset($data[0]->supervisor_id) && $rs->supervisor_id == $data[0]->supervisor_id) ? 'selected': ''?>
                                       >  <?= $rs->nama_supervisor ?>
                                    </option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <!--Karyawan ID-->
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
                              <!--Realisasi-->
                              <div class="form-group">
                                <label for="realisasi" class="control-label col-md-2">Realisasi</label>
                                <div class="col-md-4">
                                  <input type="number" class="form-control" name="realisasi" value="<?= set_value('realisasi', isset($data[0]->realisasi) ? $data[0]->realisasi : '') ?>">
                                </div>
                              </div>
                              <!--Skor-->
                              <div class="form-group">
                                <label for="skor" class="control-label col-md-2">Skor</label>
                                <div class="col-md-4">
                                  <input type="number" class="form-control" name="skor" value="<?= set_value('skor', isset($data[0]->skor) ? $data[0]->skor : '') ?>">
                                </div>
                              </div>
                              <!--Skor Akhir-->
                              <div class="form-group">
                                <label for="skor_akhir" class="control-label col-md-2">Skor Akhir</label>
                                <div class="col-md-4">
                                  <input type="number" class="form-control" name="skor_akhir" value="<?= set_value('skor_akhir', isset($data[0]->skor_akhir) ? $data[0]->skor_akhir : '') ?>">
                                </div>
                              </div>

                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('indicator_supervisor') ?>">Cancel</a>
                                  </optgroup>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->