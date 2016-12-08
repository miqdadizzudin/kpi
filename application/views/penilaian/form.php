 <?php 
    $tahun            = $this->input->post('tahun'); 
    $supervisor_id    = $this->input->post('supervisor_id');
 ?>  

        <h3 style="text-align: center"> Evaluasi</h3>     
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                        <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_users','class'=>'form-horizontal')); ?>
                          <h4 style="text-align: center"> 
                            <!-- Departemen : --> 
                            <?= $resultsDepartemen[0]->nama_dept ?>
                            | Tahun
                            <?= $tahun; ?>
                          </h4>
                          <!-- Periode Hidden -->
                          <div class="col-md-8 col-md-offset-2" style="font-size: 15px; text-align: justify;">
                            <p>
                              Pilih nama karyawan yang akan diberi nilai dan indikator yang sesuai dengan karyawan
                              tersebut. Masukkan nilai pada kolom realisasi. Setelah selesai melakukan penilaian cek kembali data 
                              nilai yang telah dimasukkan lalu tekan Save.
                            </p>
                          </div>
                            <hr>
                              <!-- Tahun hidden -->
                              <input type="hidden" name="tahun" value="<?= $tahun ?>">
                              <!-- Supervisor hidden -->
                              <input type="hidden" name="supervisor_id" value="<?= $supervisor_id ?>">
                              <!--Karyawan ID-->
                              <div class="form-group">
                                <label for="karyawan_id" class="control-label col-md-2 col-md-offset-2">
                                  Karyawan : 
                                </label>
                                <div class="col-md-4">                               
                                  <select name="karyawan_id" class="form-control">
                                    <?php
                                      if($resultsKaryawan) :
                                        foreach ($resultsKaryawan as $key => $rs) :
                                    ?>
                                                                              <!--Fungsi IF Versi singkat-->
                                    <option value="<?= $rs->karyawan_id ?>" <?php echo (isset($data[0]->karyawan_id) && $rs->karyawan_id == $data[0]->karyawan_id) ? 'selected': ''?>
                                       required>  <?= $rs->nama_karyawan ?>
                                    </option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <br>
                              <div class="col-md-2 col-md-offset-2">
                                  Ketentuan: <br>
                                  Level 1 = 0-60 Poin 
                              </div>
                              <div class="col-md-2">
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Level 2 = 61-80 Poin
                              </div>
                              <div class="col-md-2 col-md-offset-1">
                                <br>
                                Level 3 = 81-100 Poin
                              </div>

                              <!--Indicator-->
                              <table class="table table-striped table-hover">
                                <thead>
                                <tr class="info"> <!--class='info'-->

                                    <th>No</th>
                                    <th>Nama Indicator</th>
                                    <th>Level 1</th>
                                    <th>Level 2</th>
                                    <th>Level 3</th>
                                    <th>Target</th>
                                    <th>Bobot</th>
                                    <th>Realisasi</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    if($resultsIndicator) :
                                      foreach ($resultsIndicator as $key => $rs) :
                                  ?>
                                    <tr>
                                      <td><?= $key+1 ?></td>
                                      <td><?= $rs->nama_indicator ?></td>
                                      <td><?= $rs->deskripsi_indicator ?></td>
                                      <td><?= $rs->deskripsi_indicator2 ?></td>
                                      <td><?= $rs->deskripsi_indicator3 ?></td>
                                      <td>
                                        <?= $rs->target_indicator ?>
                                        <input type="hidden" name="target_indicator[]" value="<?= $rs->target_indicator ?>"> 
                                      </td>
                                      <td>
                                        <?= $rs->bobot ?>
                                        <input type="hidden" name="bobot[]" value="<?= $rs->bobot ?>">
                                      </td>                        
                                      <td> 
                                        <input type="number" name="realisasi[]" class="form-control" min="0" 
                                        max="100" title="Input harus angka dari range 0-100" required> 
                                        <input type="hidden" name="indicator_id[]" value ="<?= $rs->indicator_id ?>>">
                                      </td>                        
                                    </tr>

                                  <?php
                                      endforeach;
                                    endif;
                                  ?>
                                </tbody>
                            </table>
                            
                            <div class="col-md-12">
                              <p>
                                <input type="checkbox" class="checked_item tableflat" name="confirmCek" required>
                                Saya telah mengecek kebenaran dari data yang dimasukkan diatas dan bertanggung
                                jawab pada konsekuensi yang akan diterima
                              </p>
                            </div>
                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4">
                                  <input class="btn btn-success" type="submit" name="save" value="Save">
                                  Or
                                  <a href="<?= site_url('penilaian') ?>">Back</a>
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->