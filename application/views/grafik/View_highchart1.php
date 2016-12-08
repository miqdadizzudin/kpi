   <div class="row mt">
      <div class="col-md-12">
          <div class="x_panel">
          	<?= form_open('grafik/buatGrafik', array('name'=>'form_grafik','id'=>'form_grafik'))?>
          		<div class="x_title">
              		<h4><i class="fa fa-angle-right"></i> Grafik 1 </h4>		  
					<div class="clearfix"></div>
                </div>
				<div class="x_content">
              		<div class="col-md-2">
						<select name="tahunselect" id="dynamic_data" class="form-control">
			                <?php
	                          for($i=2016; $i>=2014; $i--)
	                          {
	                            echo '<option value="'.$i.'"> Tahun '.$i.' </option>';
	                          }
	                        ?> 
			            </select>
			        </div>

                    <!-- Start Grafik 1 -->
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
								url 	: "<?= site_url('grafik/buatGrafik')?>",
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
							// console.log(totalDept);

							// options.series.push({
							// 	type:'spline',
							// 	name:'Indicator', 
							// 	data:totalDept
							// });
							

							//Buat Grafik
							var chart1;
							chart1 = new Highcharts.chart({
								chart: {
									renderTo:'container_grafik'
								},
								title: {
						            text: 'KPI in PT Java Valley'
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
						        		},
						        		spline: {
						        			dataLabels: {
						        				enabled: true
						        			}
						        		}
						        	}
						        },
						        	series: options.series
							});

						}
			        </script>
			        <script src="<?= base_url('assets/js/highcharts/highcharts.js') ?>"></script>
			        <script src="<?= base_url('assets/js/highcharts/exporting.js') ?>"></script>

		            <div id="container_grafik" style="min-width: 400px; height: 400px; margin: 0 auto;"></div>
                    <!-- End Grafik 1 -->

		        <?= form_close(); ?>
                <br><br>                       
            </div><!-- /x-content -->
        </div><!-- /content-panel -->
    </div><!-- /col-md-12 -->

    <div class="col-md-12">
            <div class="x_panel">
                <?= form_open('grafik/buatGrafik2', array('name'=>'form_grafik_2','id'=>'form_grafik_2'))?>
                <div class="x_title">
                    <div class="col-md-12">
                        <h4><i class="fa fa-angle-right"></i> Grafik 2 </h4> 
                    </div>    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-3">
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
                    <br>
                    <br>
                    <br>

                <!-- Start Grafik 2 -->
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
                    <div class="col-md-9">
                        <div id="container_grafik_2" style="width: 1000px; height: 400px; margin: 0 auto;"></div>
                    </div>
                    <!-- End Grafik 2 -->

                <?= form_close(); ?>
                    <br><br>                       
                </div><!-- /x-content -->
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->

</div><!-- /row -->

