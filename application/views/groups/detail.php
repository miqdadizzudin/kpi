      <h3><i class="fa fa-angle-right"></i> Pengolahan Data</h3>
        
          <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Detail Groups</h4>
                            <hr>
                            <?php echo form_open($this->uri->uri_string(),array('name' => 'frm_groups','class'=>'form-horizontal')); ?>
                              <!--ID-->
                              <?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'copy') : ' '?>
                              <?php else : ?> 
                              <div class="form-group">
                                <label for="id" class="control-label col-md-2">
                                  ID Groups 
                                </label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('id', isset($data[0]->id) ? 
                                    $data[0]->id : '') ?>
                                  </p>
                                </div>
                              </div>
                              <?php endif; ?>
                              <!--Nama-->
                              <div class="form-group">
                                <label for="name" class="control-label col-md-2">Name</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('name', isset($data[0]->name) ? 
                                    $data[0]->name : '') ?>
                                  </p>
                                </div>
                              </div>                              
                              <!--ID Groups -->
                              <div class="form-group">
                                <label for="description" class="control-label col-md-2">Description</label>
                                <div class="col-md-4">
                                  <p class="form-control-static">
                                    <?= set_value('description', isset($data[0]->description) ? 
                                    $data[0]->description : '') ?>
                                  </p>
                                </div>
                              </div>
                              <!--Tombol-->
                              <div class="form-group">
                                <div class="col-md-4 col-md-offset-2">
                                  <input class="btn btn-success" href="<?= site_url('groups') ?>" type="submit" name="back" value="Back">
                                </div>
                              </div>
                            <?php echo form_close(); ?>

                    </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->