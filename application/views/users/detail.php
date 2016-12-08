      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Detail Users</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_users','class'=>'form-horizontal')); ?>
                              <!--ID Users-->
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID Users
                                </label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Karyawan ID-->
                              <div class="form-group">
                                <label for="karyawan_id" class="control-label col-md-2">
                                  ID Karyawan
                                </label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('karyawan_id', isset($data[0]->karyawan_id) ? $data[0]->karyawan_id : '') ?>
                                  </p>
                                </div>
                              </div>                              
                              <!--Name-->
                              <div class="form-group">
                                <label for="first_name" class="control-label col-md-2">
                                  First Name
                                </label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('first_name', isset($data[0]->first_name) ? $data[0]->first_name : '') ?>
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

                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" href="<?= site_url('users') ?>" type="submit" name="back" value="Back">
                              </div>
                            </div>
                            <?php echo form_close(); ?>
                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->