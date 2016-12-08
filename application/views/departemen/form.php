      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Departemen</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_departemen','class'=>'form-horizontal')); ?>
                              <!--ID Departemen-->
                              <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'copy') : ' '?>
                              <?php else : ?> 
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID Departemen <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *ID harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="id" value="<?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>"
                                  <?php echo ($this->uri->segment(2) == 'copy' || $this->uri->segment(2) == 'create')  ? '' :'readonly' ?> >
                                </div>
                              </div>
                              <?php endif; ?>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="nama_dept" class="control-label col-md-2">Nama Departemen</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="nama_dept" value="<?= set_value('nama_dept', isset($data[0]->nama_dept) ? $data[0]->nama_dept : '') ?>">
                                </div>
                              </div>                              
                              <!--ID Supervisor-->
                              <div class="form-group">
                                <label for="id_supervisor" class="control-label col-md-2">Supervisor</label>
                                <div class="col-md-4">
                                  <select name="id_supervisor" class="form-control">
                                    <?php
                                      if($resultsSupervisor) :
                                        foreach ($resultsSupervisor as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->id_supervisor ?>" <?php echo (isset($data[0]->id_supervisor) && $rs->id_supervisor == $data[0]->id_supervisor) ? 'selected': ''?>
                                       >  <?= $rs->nama_supervisor ?>
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
                                  <a href="<?= site_url('departemen') ?>">Cancel</a>
                                  </optgroup>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->