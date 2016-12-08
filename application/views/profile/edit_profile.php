<div class="row mt">
  <div class="col-md-12">
      <div class="x_panel">
        <?= form_open('profile', array('name'=>'profile'))?>
            <div class="x_title">
                <h4> User Profile </h4>       
            </div>
            <div class="x_content">

                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                        <div class="profile_img">

                            <!-- end of image cropping -->
                            <div id="crop-avatar" data-toggle="tooltip" data-placement="bottom" title="Change Avatar">
                                <!-- Current avatar -->
                                <a href="<?= base_url('profile/upload/'.$results[0]->id_karyawan) ?>">
                                    <div class="avatar-view">
                                        <!-- Foto Profil -->
                                        <?php if(empty($resultsUmum[0]->foto_profil)) : ?>
                                        <img src="<?= base_url('assets/images/picture.jpg')?>" alt="">
                                        <?php else : ?>
                                        <img src="<?= base_url('assets/uploads/'.$results[0]->foto_profil)?>" alt="<?= $resultsUmum[0]->foto_profil ?>">
                                        <?php endif; ?>
                                    </div>
                                </a>

                                <!-- Cropping modal -->
                                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <?php echo form_open_multipart('profile/upload/'.$results[0]->id_karyawan, array('name'=>'form_upload','id'=>'form_upload')); ?>
                                                <div class="modal-header">
                                                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="avatar-body">

                                                        <!-- Upload image and data -->
                                                        <div class="avatar-upload">
                                                            <label for="avatarInput">Local upload</label>
                                                            <input type="file" class="avatar-input" id="avatarInput" name="userfile" />
                                                        </div>

                                                        <div class="row avatar-btns">
                                                            <div class="col-md-3">
                                                                <button class="btn btn-primary btn-block avatar-save" type="submit" name="submit">
                                                                    Done
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php echo form_close(); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->

                                <!-- Loading state -->
                                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                            </div>
                            <!-- end of image cropping -->

                        </div>
                        <h3><?= $results[0]->nama ?> </h3> <!-- Nama -->

                        <ul class="list-unstyled user_data">
                            <li>
                                <i class="fa fa-briefcase user-profile-icon"></i> 
                                <?= $results[0]->nama_jabatan ?> <!-- Jabatan dan Departemen -->
                            </li>
                            <li class="m-top-xs">
                                <i class="fa fa-envelope-o"></i>
                                <a href="mailto:<?= $userData->email ?>" target="_blank"> 
                                    <?= $userData->email ?> <!-- Email -->
                                </a> 
                            </li>
                        </ul>

                        <hr>

                        <!-- start skills -->
                        <h4>Projects</h4>
                        <ul class="list-unstyled user_data">
                            <?php if(!$resultsProyekDetail) : 
                                    echo ' Belum menjalankan proyek apapun. '; 
                                else :?>

                            <?php
                              if($resultsProyekDetail) :
                                foreach ($resultsProyekDetail as $key => $rs) :
                            ?>
                            <li>
                                <!--  -->
                                <p><?= $rs->lokasi_proyek.' (' .$rs->durasi.') ' ?></p>
                                <?php
                                    if($rs->durasi >=12)
                                    {
                                        $rs->durasi = 12;
                                    }
                                ?>
                                <div class="progress progress_sm">
                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?= ($rs->durasi*8.325 ) ?>"></div>
                                </div>  
                            </li>
                            <?php
                                endforeach;
                              endif;
                            ?>

                            <?php endif;?>
                        </ul>
                        <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <?= form_open('profile/edit', array('name'=>'form_edit_profile','id'=>'form_edit_profile'))?>
                        <div class="profile_title">
                            <div class="col-md-6">
                                <h2>Edit Data</h2>
                            </div>
                        </div>
                        <br>
                        <div class="row">
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
                        </div>
                        <br>
                        <div class="row">
                            <!--Password-->
                            <div class="form-group">
                                <label for="password" class="control-label col-md-2">Password</label>
                                <div class="col-md-4">
                                  <input type="password" class="form-control" name="password" value="">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <!--Confirmation Password-->
                            <div class="form-group">
                                <label for="password2" class="control-label col-md-2">Confirmation Password</label>
                                <div class="col-md-4">
                                  <input type="password" class="form-control" name="password2" value="">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <!--Alamat-->
                            <div class="form-group">
                                <label for="alamat" class="control-label col-md-2">Alamat</label>
                                <div class="col-md-4">
                                  <textarea class="form-control" name="alamat"><?= set_value('alamat', isset($data[0]->alamat) ? $data[0]->alamat : '') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <!--Tombol-->
                            <div class="form-group">
                              <div class="col-md-4 col-md-offset-2">
                                <input class="btn btn-success" type="submit" name="save" value="Save">
                                Or
                                <a href="<?= site_url('profile') ?>">Cancel</a>
                                </optgroup>
                              </div>
                            </div>
                        </div>

                    <?= form_close(); ?>
                                
                    </div>





            </div><!-- /x-content -->
      </div><!-- /content-panel -->
  </div><!-- /col-md-12 -->
</div><!-- /row -->
