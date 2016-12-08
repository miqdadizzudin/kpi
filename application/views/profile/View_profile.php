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

                        <a href="<?= site_url('profile/edit') ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                        <br />

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
                        <?= form_open('profile/buatGrafik3', array('name'=>'form_grafik_3','id'=>'form_grafik_3'))?>
                        <div class="profile_title">
                            <div class="col-md-6">
                                <h2>User Report</h2>
                            </div>
                            <div class="col-md-4 col-md-offset-4">
                                <select name="tahunselect" id="dynamic_data_3" class="form-control">
                                    <?php
                                      for($i=2016; $i>=2014; $i--)
                                      {
                                        echo '<option value="'.$i.'"> Tahun '.$i.' </option>';
                                      }
                                    ?> 
                                </select>
                            </div>
                        </div>
                        <br>
                        
                        <!-- Start Grafik 1 -->
                        <link href="<?= base_url('assets/js/highcharts/cake.generic.js') ?>" type="text/css" rel="stylesheet">
                        <script type="text/javascript" src="<?= base_url('assets/js/highcharts/jquery.min.js') ?>"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                //default
                                getGrafik_3('2016');

                                $('#dynamic_data_3').change(function() {
                                    var id_3 = $('#dynamic_data_3').val();
                                    getGrafik_3(id_3);
                                });   
                            });                                 

                            function getGrafik_3(id_3){
                                var dataForm_3 = $("#form_grafik_3").serialize();

                                $.ajax({
                                    url     : "<?= site_url('profile/buatGrafik3')?>",
                                    type    : "post",
                                    dataType : "json",
                                    data    : dataForm_3,
                                    id      : id_3,
                                    success : function(result3){
                                        generateGraf3(result3);
                                    }

                                });
                            }

                            function generateGraf3(result3){
                                categoryInd = [];
                                karyaN = result3['nama_indicator'].length;
                                for(var i=0; i<karyaN; i++){
                                    categoryInd.push(result3['nama_indicator'][i]);
                                }

                                // Kategori
                                var options = {
                                    chart: {
                                        renderTo: 'container_grafik_3',
                                        type: 'column'
                                    },
                                    title: {
                                        text: '', // Number of Projects
                                        x: -20 //center
                                    },
                                    subtitle: {
                                        text: '', // Per Departmen
                                        x: -20
                                    },
                                    xAxis: {
                                        categories: categoryInd
                                    },
                                    yAxis: {
                                        title: {
                                            text: 'Indicators'
                                        },
                                        plotLines: [{
                                                value: 0,
                                                width: 1,
                                                color: '#808080'
                                            }]
                                    },
                                    tooltip: {
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> of total<br/>'
                                    },
                                    plotOptions: {
                                        series: {
                                            borderWidth: 0,
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.y}'
                                            }
                                        }
                                    },
                                    legend: {
                                        layout: 'vertical',
                                        align: 'right',
                                        verticalAlign: 'top',
                                        x: -0,
                                        y: 30,
                                        floating: true,
                                        borderWidth: 1,
                                        shadow: true
                                    },
                                    series: []
                                };

                                var dt3         = [];
                                $.each(result3['skor_akhir'], function(i,n){
                                    // console.log(n);

                                    $.each(n, function(j,m){
                                        dt3[j] = parseInt(m['skor_akhir']);
                                    });

                                    options.series.push({
                                        name:i, //category
                                        data:dt3
                                    });

                                    dt3 = [];
                                });

                                // Buat Grafik
                                var chart3
                                chart3 = new Highcharts.Chart(options);

                            }
                        </script>
                        <script src="<?= base_url('assets/js/highcharts/highcharts.js') ?>"></script>
                        <script src="<?= base_url('assets/js/highcharts/exporting.js') ?>"></script>

                        <div id="container_grafik_3" style="min-width: 400px; height: 400px; margin: 0 auto;"></div>
                        <!-- End Grafik 1 -->

                    <?= form_close(); ?>


                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <div class="tabs-left">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4><i class="fa fa-flag" style="font-size: 20px;"></i> 
                                                NIK. <?= $results[0]->id_karyawan ?> <!-- ID Karyawan -->
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4><i class="fa fa-facebook-square" style="font-size: 20px;"></i> 
                                                <?= $userData->first_name ." ". $userData->last_name; ?> <!-- Facebook -->
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4><i class="fa fa-university" style="font-size: 20px;"></i> 
                                                <?= $results[0]->nama_dept ?> <!-- Departemen -->
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4><i class="fa fa-map-marker user-profile-icon" style="font-size: 20px;"></i> 
                                                Lives in <?= $results[0]->alamat.', Indonesia' ?> <!-- Alamat -->
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4><i class="fa fa-birthday-cake" style="font-size: 20px;"></i> 
                                                Born in <?= $results[0]->tanggalLahir ?> <!-- Tanggal Lahir -->
                                            </h4>
                                        </div>
                                    </div>                                    
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="projects-tab">

                                    <!-- start user projects -->
                                    <?php if(!$resultsProyekDetail) : 
                                            echo ' Belum menjalankan proyek apapun. '; 
                                        else :?>
                                    <table class="data table table-striped no-margin">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Project Name</th>
                                                <th>Location</th>
                                                <th class="hidden-phone">Duration (month)</th>
                                                <th>Visualization</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              if($resultsProyekDetail) :
                                                foreach ($resultsProyekDetail as $key => $rs) :
                                            ?>
                                            <tr>
                                                <td><?= $key+1 ?></td>
                                                <td><?= $rs->nama_proyek ?></td>
                                                <td><?= $rs->lokasi_proyek ?></td>
                                                <td class="hidden-phone"><?= $rs->durasi ?></td>
                                                <?php
                                                    if($rs->durasi >=12)
                                                    {
                                                        $rs->durasi = 12;
                                                    }
                                                ?>
                                                <td class="vertical-align-mid">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" data-transitiongoal="<?= ($rs->durasi*8.325 ) ?>"></div>
                                                    </div>
                                                </td>                                        
                                            </tr>
                                            <?php
                                                endforeach;
                                              endif;
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                    <!-- end user projects -->

                                </div> <!-- /tab-panel -->
                                
                            </div>
                        </div>
                    </div>




            </div><!-- /x-content -->
      </div><!-- /content-panel -->
  </div><!-- /col-md-12 -->
</div><!-- /row -->
