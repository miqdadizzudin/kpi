    <!-- Custom styling plus plugins -->
    <link href="css/icheck/flat/green.css<?= base_url('assets/css/maps/jquery-jvectormap-2.0.1.css')?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/floatexamples.css')?>" rel="stylesheet" type="text/css" />

    <!-- Calendar -->
    <link href="<?= base_url('assets/css/calendar/fullcalendar.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/calendar/fullcalendar.print.css')?>" rel="stylesheet">

    <script src="<?= base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/js/nprogress.js')?>"></script>

<div id="container">
	<div class="row top_tiles">
		<!-- Officer -->
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-user-secret"></i>
                </div>
                <div class="count"><?= $resultsJumlahKaryawan[0]->jumlahKaryawan ?></div>

                <h3>Total Officers</h3>
                <p>
                	<a href="<?= site_url('karyawan') ?>">
                		More info <i class="fa fa-hand-o-right"></i>
                	</a>
				</p>
            </div>
        </div>
        <!-- Proyek -->
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-map-o"></i>
                </div>
                <div class="count"> <?= $resultsJumlahProyek[0]->jumlahProyek ?></div>

                <h3>Projects</h3>
                <p>
                	<a href="<?= site_url('proyek') ?>">
                		More info <i class="fa fa-hand-o-right"></i>
                	</a>
				</p>
            </div>
        </div>
        <!-- Assessment -->
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i>
                </div>
                <div class="count"> <?= $resultsJumlahNilai[0]->jumlahNilai?></div>

                <h3>Assesments</h3>
                <p>
                	<a href="<?= site_url('hasil_penilaian') ?>">
                		More info <i class="fa fa-hand-o-right"></i>
                	</a>
				</p>
            </div>
        </div>
        <!-- Calendar -->
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-calendar" style="font-size: 50px;"></i>
                </div>
                <div class="count">
                	<div id="tanggalSaja"></div>
                	<script>
                		$(document).ready(function() {
	                		// Create two variable with the names of the months and days in an array
	                		var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
	                		var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

	                		// Create a newDate() object
	                		var newDate = new Date();
	                		// Extract the current date from Date object
	                		newDate.setDate(newDate.getDate());
                            var hours   = newDate.getHours();
                            var minutes = newDate.getMinutes();
                            var timeString = "" + ((hours > 12) ? hours - 12 : hours);
                                timeString  += ((minutes < 10) ? ":0" : ":") + minutes;
                                timeString  += (hours >= 12) ? " P.M." : " A.M.";
	                		$('#Date').html(monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());
	                		$('#tanggalSaja').html(newDate.getDate());
                            $('#HariNih').html(dayNames[newDate.getDay()]);
                            $('#HariJamMenit').html(dayNames[newDate.getDay()] +', '+ timeString);
	                	});
                	</script>

                </div>
                <h3 id="Date"></h3>
                <p id="HariNih"></p>
            </div>
        </div>
        	
    </div>


   	<div class="row mt">
      	<div class="col-md-8">
          	<div class="x_panel">
          		<?= form_open('home/buatGrafik1', array('name'=>'form_grafik','id'=>'form_grafik'))?>
          		<div class="x_title">
          			<div class="col-md-12">
	              		<h2> KPI Summary <small> Yearly progress</small> </h2>	
	              		<div class="col-md-offset-8">
							<select name="tahunselect" id="dynamic_data" class="form-control">
				                <?php
		                          for($i=2016; $i>=2014; $i--)
		                          {
		                            echo '<option value="'.$i.'"> Tahun '.$i.'</option>';
		                          }
		                        ?> 
				            </select>
				        </div>
				    </div>	  
					<div class="clearfix"></div>
                </div>
				<div class="x_content">

					<link href="<?= base_url('assets/js/highcharts/cake.generic.js') ?>" type="text/css" rel="stylesheet">
			        <script type="text/javascript" src="<?= base_url('assets/js/highcharts/jquery.min.js') ?>"></script>
			        <script type="text/javascript">
						$(document).ready(function() {
							//default
							getGrafik('2016');

							$('#dynamic_data').change(function() {
							    var id = $('#dynamic_data').val();
							    getGrafik(id);
							});   
						});					                

						function getGrafik(id){
							var dataForm = $("#form_grafik").serialize();

							$.ajax({
								url 	: "<?= site_url('home/buatGrafik1')?>",
								type	: "post",
								dataType : "json",
								data    : dataForm,
								id 		: id,
								success : function(result){
									generateGraf(result);
								}

							});
						}

						function generateGraf(result){
							categoryDept = [];
							depart = result['dept'].length;
							for(var i=0; i<depart; i++){
								categoryDept.push(result['dept'][i]);
							}

							var options = {
								series :[]
							};

							var dt 			= [];
							var total		= [];
							var jumlah 		= 0;
							var p 			= 0;
							var totalDept 	= [];
							$.each(result['indicator'], function(i,n){
								var k=1;
								$.each(n, function(j,m){
									dt[j] = parseInt(m['skor_akhir']);
									jumlah = jumlah + parseInt(m['skor_akhir']);
									k++;
								});

								totalDept[p] = jumlah / k; 

								options.series.push({
									type:'column',
									name:i, //category
									data:dt
								});

								dt = [];
								p++;
							});

							//Buat Grafik
							var chart1;
							chart1 = new Highcharts.chart({
								chart: {
									renderTo:'container_grafik'
								},
								title: {
						            text: '' // KPI in PT Java Valley
						        },
						        xAxis: {
						            categories : categoryDept,
						            title : {
						            	text:''// Departemen
						            }
						        },
						        yAxis: {
						        	title : {
						        		text: 'Indicator'
						        	}
						        },
						        plotOptions:{
						        	column: {
						        		dataLabels: {
						        			enabled: true
						        		}
						        	}
						        },
						        	series: options.series
							});

						}
			        </script>
			        <script src="<?= base_url('assets/js/highcharts/highcharts.js') ?>"></script>
			        <script src="<?= base_url('assets/js/highcharts/exporting.js') ?>"></script>
			        <!-- Grafik 1 -->
			        <div class="col-md-9">
		            	<div id="container_grafik" style="width: 650px; height: 430px; margin: 0 auto;"></div>
		            </div>

		        <?= form_close(); ?>
                <br><br>                       
            	</div><!-- /x-content -->
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->

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

    </div><!-- /row -->  
    
    <div class="row">

        <!-- Start to do list -->
        <div class="col-md-4">
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
        </div>
        <!-- End to do list -->

        <div class="col-md-8">
            <div class="x_panel">
                <?= form_open('home/buatGrafik2', array('name'=>'form_grafik_2','id'=>'form_grafik_2'))?>
                <div class="x_title">
                    <div class="col-md-12">
                        <h2> Number of Projects <small>per dept</small></h2>  
                        <div class="col-md-offset-8">
                            <select name="deptselect" id="dynamic_data_2" class="form-control">
                                <?php
                                  if($resultsDepartemen) :
                                    foreach ($resultsDepartemen as $key => $rs) :
                                ?>
                                <option value="<?= $rs->departemen_id ?>"> <?= $rs->nama_dept ?> </option>
                                <?php
                                    endforeach;
                                  endif;
                                ?>
                            </select>
                        </div>
                    </div>    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                <script type="text/javascript">
                    $(document).ready(function() {
                        //default
                        getGrafik_2('3001');

                        $('#dynamic_data_2').change(function() {
                            var id_2 = $('#dynamic_data_2').val();
                            getGrafik_2(id_2);
                        });   
                    });                                 

                    function getGrafik_2(id_2){
                        var dataForm_2 = $("#form_grafik_2").serialize();

                        $.ajax({
                            url     : "<?= site_url('grafik/buatGrafik2')?>",
                            type    : "post",
                            dataType : "json",
                            data    : dataForm_2,
                            id      : id_2,
                            success : function(result2){
                                generateGraf2(result2);
                            }

                        });
                    }

                    function generateGraf2(result2){
                        categoryKar = [];
                        karyaN = result2['nama_karyawan'].length;
                        for(var i=0; i<karyaN; i++){
                            categoryKar.push(result2['nama_karyawan'][i]);
                        }

                        // Kategori
                        var options = {
                            chart: {
                                renderTo: 'container_grafik_2',
                                type: 'column'
                            },
                            title: {
                                text: 'Number of Projects',
                                x: -20 //center
                            },
                            subtitle: {
                                text: 'Per Departmen',
                                x: -20
                            },
                            xAxis: {
                                categories: categoryKar
                            },
                            yAxis: {
                                title: {
                                    text: 'Projects'
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
                                x: -40,
                                y: 100,
                                floating: true,
                                borderWidth: 1,
                                shadow: true
                            },
                            series: []
                        };

                        // Data Grafik
                        var dt2         = [];
                        $.each(result2['jumProyekKaryawan'], function(i,n){

                            $.each(n, function(j,m){
                                dt2[j] = parseInt(m['jumProyekKaryawan']);
                            });

                            options.series.push({
                                name:i, //category
                                data:dt2
                            });

                            dt2 = [];
                        });

                        // Buat Grafik
                        var chart2
                        chart2 = new Highcharts.Chart(options);
                    }
                </script>
                    <!-- Grafik 1 -->
                    <div class="col-md-9">
                        <div id="container_grafik_2" style="width: 650px; height: 380px; margin: 0 auto;"></div>
                    </div>

                <?= form_close(); ?>
                    <br><br>                       
                </div><!-- /x-content -->
            </div><!-- /content-panel -->
        </div><!-- /col-md-8 -->



        

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

    <!-- Worldmap -->
    <script type="text/javascript" src="<?= base_url('assets/js/maps/jquery-jvectormap-2.0.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/maps/gdp-data.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/maps/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/maps/jquery-jvectormap-us-aea-en.js') ?>"></script>
    <script>
        $('#world-map-gdp').vectorMap({
            map: 'world_mill_en',
            backgroundColor: 'transparent',
            zoomOnScroll: false,
            series: {
                regions: [{
                    values: gdpData,
                    scale: ['#E6F2F0', '#149B7E'],
                    normalizeFunction: 'polynomial'
                }]
            },
            onRegionTipShow: function (e, el, code) {
                el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
            }
        });
    </script>


    <!-- File Calendar JS ada di footer -->

    






</div> <!-- End File -->