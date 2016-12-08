      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Supervisor</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_supervisor','class'=>'form-horizontal')); ?>
                              <!--ID Supervisor-->
                              <?php if ($this->uri->segment(2) == 'create') : ' '?>
                              <?php else : ?> 
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID Supervisor <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *ID harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="id" value="<?= set_value('id_supervisor', isset($data[0]->id_supervisor) ? $data[0]->id_supervisor : '') ?>"
                                  <?php echo ($this->uri->segment(2) == 'copy' || $this->uri->segment(2) == 'create')  ? '' :'readonly' ?> >
                                </div>
                                <h5 data-toggle="tooltip" data-placement="top" title="Supervisor mulai dari 80xx">
                                    <i class="fa fa-info-circle" style="font-size: 18px;"></i>
                                </h5>
                              </div>
                              <?php endif; ?>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="nama_supervisor" class="control-label col-md-2">Nama Supervisor</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="nama_supervisor" value="<?= set_value('nama_supervisor', isset($data[0]->nama_supervisor) ? $data[0]->nama_supervisor : '') ?>">
                                </div>
                              </div>
                              <!--ID Karyawan-->
                              <div class="form-group">
                                <label for="karyawan_id" class="control-label col-md-2">ID Karyawan</label>
                                <div class="col-md-4">
                                  <select name="karyawan_id" class="form-control">
                                    <?php
                                      if($resultsKaryawan) :
                                        foreach ($resultsKaryawan as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->karyawan_id ?>" <?php echo (isset($data[0]->karyawan_id) && $rs->karyawan_id == $data[0]->karyawan_id) ? 'selected': ''?>
                                       >  <?= $rs->karyawan_id.' - '.$rs->nama_karyawan ?>
                                    </option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('supervisor') ?>">Cancel</a>
                                  </optgroup>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->