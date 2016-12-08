      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Tabel Users</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_users','class'=>'form-horizontal')); ?>
                              <!--ID Users-->
                              <?php if ($this->uri->segment(2) == 'edit') : ?>
                                <div class="form-group">
                                  <label for="id" class="control-label col-md-2">
                                    ID Users
                                  </label>
                                  <div class="col-md-4">
                                    <input type="text" class="form-control" name="id" value="<?= set_value('id', isset($data[0]->id) ? $data[0]->id : '') ?>"
                                    <?php echo ($this->uri->segment(2) == 'edit')  ? 'readonly' : '' ?> >
                                  </div>
                                </div>
                                <?php else : '' ?> 
                              <?php endif; ?>
                              <!--Karyawan ID-->
                              <div class="form-group">
                                <label for="karyawan_id" class="control-label col-md-2">
                                  Karyawan ID
                                </label>
                                <div class="col-md-4">
                                  <!-- Jika Edit -->
                                <?php if($this->uri->segment(2) == 'edit') : ?>
                                  <input type="text" class="form-control" name="karyawan_id" value="<?= set_value('karyawan_id', isset($data[0]->karyawan_id) ? 
                                    $data[0]->karyawan_id : '') ?>" readonly>
                                  <?php else : '' ?>                               
                                <?php endif; ?>
                                </div>
                              </div>                              
                              <!--Name-->
                              <div class="form-group">
                                <label for="first_name" class="control-label col-md-2">
                                  Name
                                </label>
                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="first_name" value="<?= set_value('first_name', isset($data[0]->first_name) ? $data[0]->first_name : '') ?>">
                                </div>
                              </div>
                              <!--Email-->
                              <div class="form-group">
                                <label for="email" class="control-label col-md-2">
                                  Email
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
                                <label for="password" class="control-label col-md-2">Password
                                </label>
                                <div class="col-md-4">
                                  <input type="password" class="form-control" name="password" value="" autocomplete="off">
                                </div>
                              </div>
                              <!--Confirmation Password-->
                              <div class="form-group">
                                <label for="password2" class="control-label col-md-2">Confirmation Password</label>
                                <div class="col-md-4">
                                  <input type="password" class="form-control" name="password2" value="" autocomplete="off">
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

                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('users') ?>">Cancel</a>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->