      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        <style>
          .infoMessage{color: #FF0000;}
        </style>
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Karyawan</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_karyawan','class'=>'form-horizontal')); ?>
                              <!--ID-->
                              <?php if ($this->uri->segment(2) == 'create') : ' '?>
                              <?php else : ?>
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID Karyawan <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *ID harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="id" value="<?= set_value('id', isset($data[0]->id_karyawan) ? $data[0]->id_karyawan : '') ?>"
                                  <?php echo ($this->uri->segment(2) == 'copy' || $this->uri->segment(2) == 'create')  ? '' :'readonly' ?> > <!-- /input -->
                                </div>
                              </div>
                              <?php endif; ?>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="nama" class="control-label col-md-2">Nama</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="nama" value="<?= set_value('nama', isset($data[0]->nama) ? $data[0]->nama : '') ?>">
                                </div>
                              </div>
                              <!--Email-->
                              <div class="form-group">
                                <label for="email" class="control-label col-md-2">
                                  Email
                                  <!-- Jika Copy  -->
                                  <?php echo ($this->uri->segment(2) == 'copy') ? '<div class="infoMessage"> *Email harap diganti dengan yang unik</div>' : '' ?>
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="email" value="<?= set_value('email', isset($data[0]->email) ? $data[0]->email : '') ?>">
                                </div>
                                <h5 data-toggle="tooltip" data-placement="top" title="Email digunakan untuk login">
                                  <i class="fa fa-info-circle" style="font-size: 18px;"></i>
                                </h5>
                              </div>
                              <!--Password-->
                              <div class="form-group">
                                <label for="password" class="control-label col-md-2">Password</label>
                                <div class="col-md-4">
                                  <input type="password" class="form-control" name="password" value="">
                                </div>
                              </div>
                              <!--Confirmation Password-->
                              <div class="form-group">
                                <label for="password2" class="control-label col-md-2">Confirmation Password</label>
                                <div class="col-md-4">
                                  <input type="password" class="form-control" name="password2" value="">
                                </div>
                              </div>
                             <!-- Account Groups -->
                              <div class="form-group">
                                <label for="idGroup[]" class="control-label col-md-2">Account Groups</label>
                                <div class="col-md-4">
                                  <?php
                                    if($resultsGroups) :
                                      foreach ($resultsGroups as $key => $rs) :
                                        $a ='';
                                        foreach ($user_groups as $yy => $user) {
                                          if ($rs->groups_id == $user->id)
                                          {
                                            $a = 'checked';
                                            break;
                                          }
                                        }
                                  ?>
                                    <div class="radio">
                                      <input type="radio" name="idGroup[]" value="<?= $rs->groups_id ?>" class="flat"
                                        <?php echo $a; ?>
                                        > <!-- /input -->
                                        <?= $rs->nama_group ?> 
                                    </div>
                                  <?php
                                      endforeach;
                                    endif;
                                  ?>
                                </div>
                                <h5 data-toggle="tooltip" data-placement="top" title="Admin dapat melakukan CRUD, Evaluator dapat melakukan penilaian">
                                  <i class="fa fa-info-circle" style="font-size: 18px;"></i>
                                </h5>
                              </div>

                              <!--Tgl_lahir-->
                              <div class="form-group">
                                <label for="tgl_lahir" class="control-label col-md-2">Tanggal Lahir</label>
                                <div class="col-md-4">
                                  <div class="col-md-10">
                                    <input type="text" name="tgl_lahir" id="tanggal"
                                      value="<?= set_value('tgl_lahir', isset($data[0]->tgl_lahir) ? $data[0]->tgl_lahir : '') ?>"/>
                                  </div>
                                </div>
                              </div>
                              <!--Alamat-->
                              <div class="form-group">
                                <label for="alamat" class="control-label col-md-2">Alamat</label>
                                <div class="col-md-4">
                                  <textarea class="form-control" name="alamat"><?= set_value('alamat', isset($data[0]->alamat) ? $data[0]->alamat : '') ?></textarea>
                                </div>
                              </div>
                              <!--Jenis_kelamin-->
                              <div class="form-group">
                                <label for="jenis_kelamin" class="control-label col-md-2">Jenis Kelamin</label>
                                <div class="col-md-4">
                                  <select name="jenis_kelamin" class="form-control">
                                    <option value="L" <?php echo (isset($data[0]->jenis_kelamin) && $data[0]->jenis_kelamin == 'L' ) ? 'selected': ''?>
                                       > Laki-laki
                                    </option>
                                    <option value="P" <?php echo (isset($data[0]->jenis_kelamin) && $data[0]->jenis_kelamin == 'P' ) ? 'selected': ''?>
                                       > Perempuan
                                    </option>
                                  </select>
                                </div>

                              </div>
                              <!--Departemen_id-->                          
                              <div class="form-group">
                                <label for="departemen_id" class="control-label col-md-2">Departemen</label>
                                <div class="col-md-4">
                                  <select name="departemen_id" class="form-control">
                                    <?php
                                      if($resultsDepartemen) :
                                        foreach ($resultsDepartemen as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->departemen_id ?>" <?php echo (isset($data[0]->departemen_id) && $rs->departemen_id == $data[0]->departemen_id) ? 'selected': ''?>
                                       >  <?= $rs->nama_dept ?>
                                    </option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                  </select>
                                </div>
                              </div>                            
                              <!--Jabatan_id-->
                              <div class="form-group">
                                <label for="jabatan_id" class="control-label col-md-2">Jabatan</label>
                                <div class="col-md-4">
                                  <select name="jabatan_id" class="form-control">
                                    <?php
                                      if($resultsJabatan) :
                                        foreach ($resultsJabatan as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->jabatan_id ?>" <?php echo (isset($data[0]->jabatan_id) && $rs->jabatan_id == $data[0]->jabatan_id) ? 'selected': ''?>
                                       >  <?= $rs->nama_jabatan ?>
                                    </option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <!--Gaji-->
                              <div class="form-group">
                                <label for="gaji" class="control-label col-md-2">Gaji</label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="gaji" value="<?= set_value('gaji', isset($data[0]->gaji) ? $data[0]->gaji : '') ?>">
                                </div>
                              </div>

                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('karyawan') ?>">Cancel</a>
                                  </optgroup>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->