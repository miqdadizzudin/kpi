			<h3><i class="fa fa-angle-right"></i> Evaluasi</h3>
			  
              <div class="col-md-12">
                  <div class="content-panel">
                  	<div class="row mt">
                      	<?= form_open('penilaian/create', array('name'=>'penilaian'))?>
                      		<h4><i class="fa fa-angle-right"></i> Pilih Periode dan Jabatan</h4>
                      		<br>
                          <div class="form-group">
                            <label for="departemen_id" class="control-label col-md-2">
                            	Periode <br><br><br>
                              Departemen <br><br><br>
            									Jabatan
            								</label>
                            <div class="col-md-4">
                              <!-- Supervisor hidden -->
                              <input type="hidden" name="supervisor_id" value="<?= $resultsSupervisor[0]->supervisor_id?>">
                              <!-- Periode -->
                              <select name="tahun" class="form-control">
                                <?php
                                  for($i=2014; $i<=2016; $i++)
                                  {
                                    echo '<option value="'.$i.'"> '.$i.'</option>';
                                  }
                                ?>                                
                              </select>
                              <br>
                            	<!-- Departemen -->
                                <?php
                                  if($resultsDepartemen) :
                                    foreach ($resultsDepartemen as $key => $rs) :                              
                                      $rs->departemen_id;
                                      $rs->nama_dept;
                                    endforeach;
                                  endif;
                                ?>
                              <input type="hidden" class="form-control" name="departemen_id" value="<?= $rs->departemen_id ?>" 
                              > <!-- /input -->
                              <input type="text" class="form-control" name="departemen_name" value="<?= $rs->nama_dept ?>" readonly 
                              > <!-- /input -->

                                <!-- Jabatan -->
                              <br>
                              <select name="jabatan_id" class="form-control">
                                <?php
                                  if($resultsJabatan) :
                                    foreach ($resultsJabatan as $key => $rs) :
                                      if ($rs->nama_jabatan != "Supervisor") :
                                ?>
                                <option value="<?= $rs->jabatan_id ?>" <?php echo (isset($data[0]->jabatan_id) && $rs->jabatan_id == $data[0]->jabatan_id) ? 'selected': ''?>
                                   >  <?= $rs->nama_jabatan ?>
                                </option>
                                <?php
                                      endif;
                                    endforeach;
                                  endif;
                                ?>
                              </select>
                            </div>
                          </div>
						</div><!-- /row --> 

						<br> 
						<div class="row"> 
                          <!--Tombol-->
                          <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                              <input class="btn btn-success" type="submit" name="next" value="Next">
                              Or
                              <a href="<?= site_url('hasil_penilaian') ?>">Cancel</a>
                              </optgroup>
                            </div>
                          </div>

			                  <?= form_close(); ?>
	                        <br><br>
						<div><!-- /row -->    
						                 
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              