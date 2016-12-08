    <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        <style>
          .infoMessage{color: #FF0000;}
        </style>
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Detail Karyawan</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_karyawan','class'=>'form-horizontal')); ?>
                              <!--ID-->
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">ID Karyawan</label>
                                <p class="form-control-static">
                                	&nbsp;&nbsp; <?= set_value('id_karyawan', isset($data[0]->id_karyawan) ? $data[0]->id_karyawan : '') ?>
                                </p>
                              </div>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="nama" class="control-label col-md-2">Nama</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
	                                	<?= set_value('nama', isset($data[0]->nama) ? $data[0]->nama : '') ?>
	                                </p>
                                </div>
                              </div>
                              <!--Tgl_lahir-->
                              <div class="form-group">
                                <label for="tgl_lahir" class="control-label col-md-2">Tanggal Lahir</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
	                                	<?= set_value('tgl_lahir', isset($data[0]->tgl_lahir) ? $data[0]->tgl_lahir : '') ?>
	                                </p>
                                </div>
                              </div>
                              <!--Email-->
                              <div class="form-group">
                                <label for="email" class="control-label col-md-2">
                                  Email
                                </label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('email', isset($data[0]->email) ? $data[0]->email : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Alamat-->
                              <div class="form-group">
                                <label for="alamat" class="control-label col-md-2">Alamat</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
	                                	<?= set_value('alamat', isset($data[0]->alamat) ? $data[0]->alamat : '') ?></textarea>
	                                </p>
                                </div>
                              </div>
                              <!--Jenis_kelamin-->
                              <div class="form-group">
                                <label for="jenis_kelamin" class="control-label col-md-2">Jenis Kelamin</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
                                		<?= set_value('jenis_kelamin', isset($data[0]->jenis_kelamin) ? $data[0]->jenis_kelamin : '') ?>
                                	</p>
                                </div>
                              </div>
                              <!--Departemen_id-->                          
                              <div class="form-group">
                                <label for="departemen_id" class="control-label col-md-2">Departemen</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
                                		<?= set_value('departemen_id', isset($data[0]->departemen_id) ? $data[0]->departemen_id : '') ?>
                                		- <?= set_value('nama_dept', isset($data[0]->nama_dept) ? $data[0]->nama_dept : '') ?>
                                	</p>
                                </div>
                              </div>
                              <!--Jabatan_id-->
                              <div class="form-group">
                                <label for="jabatan_id" class="control-label col-md-2">Jabatan</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
                                		<?= set_value('jabatan_id', isset($data[0]->jabatan_id) ? $data[0]->jabatan_id : '') ?>
                                		- <?= set_value('nama_jabatan', isset($data[0]->nama_jabatan) ? $data[0]->nama_jabatan : '') ?>
                                	</p>
                                </div>
                              </div>
                              <!-- Account Groups -->
                              <div class="form-group">
                                <label for="idGroup[]" class="control-label col-md-2">Account Groups</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?php 
                                      foreach ($user_groups as $yy => $user) {
                                        echo $user->name .' ';
                                      }
                                    ?>
                                  </p>
                                </div>
                              </div>
                              <!--Gaji-->
                              <div class="form-group">
                                <label for="gaji" class="control-label col-md-2">Gaji</label>
                                <div class="col-md-4">
                                	<p class="form-control-static">
	                                	<?= set_value('gaji', isset($data[0]->gaji) ? $data[0]->gaji : '') ?>
	                                </p>
                                </div>
                              </div>

                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" href="<?= site_url('karyawan') ?>" type="submit" name="back" 
                                  	value="Back">
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->