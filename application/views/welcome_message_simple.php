    <!-- Calendar -->
    <link href="<?= base_url('assets/css/calendar/fullcalendar.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/calendar/fullcalendar.print.css')?>" rel="stylesheet">

    <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/js/nprogress.js')?>"></script>

<div id="container">
	<div class="row top_tiles">
		<!-- Atas -->
    </div>

   	<div class="row mt">
        <div class="col-md-12">
            <?= form_open('profile/buatGrafik3', array('name'=>'form_grafik_3','id'=>'form_grafik_3'))?>
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-4">
                        <h2>User Report</h2>
                    </div>
                    <div class="col-md-3 col-md-offset-5">
                        <select name="tahunselect" id="dynamic_data_3" class="form-control">
                            <?php
                              for($i=2016; $i>=2014; $i--)
                              {
                                echo '<option value="'.$i.'"> Tahun '.$i.' </option>';
                              }
                            ?> 
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
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

                        <div id="container_grafik_3" style="min-width: 400px; height: 350px; margin: 0 auto;"></div>
                        <!-- End Grafik 1 -->

                    <?= form_close(); ?>
                </div>
            </div>
        </div><!--/col-md-12-->


        <div class="col-md-4"> <!-- View Calendar -->
            <div class="x_panel">
                <div class="x_title">
                    <h2>Calender Events <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id='calendar'></div> <!-- Container Calendar -->
                </div>
            </div>
        </div> <!--/col-md-4-->

        <!-- Start to do list -->
        <div class="col-md-8">
            <div class="x_panel">
                <div class="x_title">
                    <h2>To Do List <small>Projects</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if(!$resultsProyekDetail) : 
                            echo ' Belum menjalankan proyek apapun. '; 
                        else :?>
                        <ul class="to_do">                            
                            <?php
                              if($resultsProyekDetail) :
                                foreach ($resultsProyekDetail as $key => $rs) :
                            ?>
                            <li>
                                <p> <input type="checkbox" class="flat"> <td><?= $rs->nama_proyek ?> </p>
                            </li>
                            <?php
                                endforeach;
                              endif;
                            ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div> <!--/col-md-8-->
        <!-- End to do list -->



        <!-- Start Calender modal -->
        <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">New Calender Entry</h4>
                    </div>
                    <div class="modal-body">
                        <div id="testmodal" style="padding: 5px 20px;">
                            <form id="antoform" class="form-horizontal calender" role="form">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary antosubmit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel2">Edit Calender Entry</h4>
                    </div>
                    <div class="modal-body">
                        <div id="testmodal2" style="padding: 5px 20px;">
                            <form id="antoform2" class="form-horizontal calender" role="form">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="title2" name="title2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

            <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
            <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
        <!-- End Calender modal -->

    <!-- File Calendar JS ada di footer -->




</div> <!-- End File -->