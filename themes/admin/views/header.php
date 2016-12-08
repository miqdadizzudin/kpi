<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Key Performance Indicator in Java Valley, Semarang. Created by Miqdad Izzudin.">
    <meta name="author" content="Miqdad Izzudin">
    <meta name="keyword" content="KPI, Key Performance Indicator, Java Valley, Semarang">

    <!-- Icon -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo_java_valley.png') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/img/logo_java_valley.png') ?>" type="image/x-icon">

    <title>KPI | Java Valley</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

    <!--External css-->
    <link href="<?= base_url('assets/font-awesome/css/font-awesome.css')?>" rel="stylesheet" />
    <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/animate.min.css')?>" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?= base_url('assets/css/custom.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/icheck/flat/green.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/datatables/tools/css/dataTables.tableTools.css')?>" rel="stylesheet">
    <style>
      .infoMessage{color: #FF0000;}
    </style>
    
    <!-- Untuk hilangkan ketika print -->
    <style type="text/css" media="print">
    .no-print, .no-print *
    {
        display: none !important;
    }

    </style>   

    <style type="text/css" media="display">
        @media (max-width: 50px) {
            .table-responsive {
                width: 100% !important;
                margin-bottom: 15px !important;
                overflow-y: hidden !important;
                overflow-x: scroll !important;
                -ms-overflow-style: -ms-autohiding-scrollbar !important;
                border: 1px solid #DDD !important;
                -webkit-overflow-scrolling: touch !important;
            }
        }
    </style> 

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= base_url('')?>" class="site_title"> 
                            <img src="<?= base_url('assets/img/logo_java_valley.png') ?>"width="35" height="35">
                            <span><b> Java Valley </b></span>
                        </a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile no-print">
                        <div class="profile_pic">
                            <a href="<?= base_url('profile')?>">

                                <!-- Foto Profil -->
                                <?php if(empty($resultsUmum[0]->foto_profil)) : ?>
                                <img src="<?= base_url('assets/images/picture.jpg')?>" alt="" class="img-circle profile_img">
                                <?php else : ?>
                                <img src="<?= base_url('assets/uploads/'.$resultsUmum[0]->foto_profil)?>" alt="" class="img-circle profile_img">
                                <?php endif; ?>

                            </a>
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <!-- Nama User yang sedang login -->
                            <h2><?= $resultsUmum[0]->nama_karyawan_login ?></h2> 
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3> <?= $resultsJabatan_Umum[0]->nama_jabatan ?> </h3> <!-- Jabatan -->
                            <ul class="nav side-menu">
                                <li><a href="<?= base_url('')?>" ><i class="fa fa-television"></i> 
                                        Home <span class="fa fa-chevron-right"></span>
                                    </a>
                                </li>
                            <?php
                                // If Evaluator & Admin
                                if($this->ion_auth->in_group(array(1,3)) ) :
                            ?>
                                <li><a><i class="fa fa-university"></i> Officers <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url('karyawan')?>">Karyawan</a>
                                        </li>
                                        <li><a href="<?= base_url('supervisor')?>">Supervisor</a>
                                        </li>
                                        <li><a href="<?= base_url('jabatan')?>">Jabatan</a>
                                        </li>
                                        <li><a href="<?= base_url('departemen')?>">Departemen</a>
                                        </li> 
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i> Our Works <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url('proyek')?>">Proyek</a>
                                        </li>
                                        <li><a href="<?= base_url('karyawan_proyek')?>">Proyek oleh Karyawan</a>
                                        </li>                               
                                    </ul>
                                </li>

                                <?php
                                    // If Evaluator
                                    if($this->ion_auth->in_group(array(3)) ) :
                                ?>
                                    <li><a href="<?= base_url('groups')?>"><i class="fa fa-group"></i> 
                                        Groups <span class="fa fa-chevron-right"></span></a>
                                    </li>
                                <?php else : ?>
                                    <li><a><i class="fa fa-group"></i> Accounts <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?= base_url('users')?>">Users</a>
                                            </li>
                                            <li><a href="<?= base_url('groups')?>">Groups</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <li><a><i class="fa fa-balance-scale"></i> Assessment Data <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url('indicator')?>">Indikator</a>
                                        </li>
                                        <li><a href="<?= base_url('indicator_supervisor')?>">Tabel Nilai</a>
                                        </li>
                                    </ul>
                                </li>

                                <?php
                                    // If Evaluator
                                    if($this->ion_auth->in_group(array(3)) ) :
                                ?>
                                <li><a><i class="fa fa-sort-amount-asc"></i> Employee Assessment <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url('penilaian')?>">Penilaian</a>
                                        </li>
                                        <li><a href="<?= base_url('hasil_penilaian')?>">Lihat Hasil Penilaian</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php endif; ?>

                                <?php
                                    // If Admin
                                    if($this->ion_auth->in_group(array(1))) :
                                ?>
                                    <li><a href="<?= base_url('hasil_penilaian')?>"><i class="fa fa-sort-amount-asc"></i> 
                                            Result Assessment <span class="fa fa-chevron-right"></span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li><a href="<?= base_url('grafik')?>"><i class="fa fa-bar-chart-o"></i> 
                                        Data Presentation <span class="fa fa-chevron-right"></span>
                                    </a>
                                </li>
                            <?php endif; ?> <!-- End Evaluator & Admin -->

                            <?php
                                // If Members
                                if($this->ion_auth->in_group(array(2))) :
                            ?>
                                <li><a href="<?= base_url('hasil_penilaian')?>"><i class="fa fa-sort-amount-asc"></i> 
                                        Result Assessment <span class="fa fa-chevron-right"></span>
                                    </a>
                                </li>
                            <?php endif; ?> <!-- End Members -->
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                    <script>
                            // Untuk Full Screen
                            document.addEventListener("toolFullScreen", function(e) {
                              if (e.keyCode == 13) {
                                toggleFullScreen();
                              }
                            }, false);
                            function toggleFullScreen() {
                              if (!document.fullscreenElement &&    // alternative standard method
                                  !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
                                if (document.documentElement.requestFullscreen) {
                                  document.documentElement.requestFullscreen();
                                } else if (document.documentElement.msRequestFullscreen) {
                                  document.documentElement.msRequestFullscreen();
                                } else if (document.documentElement.mozRequestFullScreen) {
                                  document.documentElement.mozRequestFullScreen();
                                } else if (document.documentElement.webkitRequestFullscreen) {
                                  document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                                }
                              } else {
                                if (document.exitFullscreen) {
                                  document.exitFullscreen();
                                } else if (document.msExitFullscreen) {
                                  document.msExitFullscreen();
                                } else if (document.mozCancelFullScreen) {
                                  document.mozCancelFullScreen();
                                } else if (document.webkitExitFullscreen) {
                                  document.webkitExitFullscreen();
                                }
                              }
                            }
                        </script>
                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small no-print">
                        <a href="<?= site_url('profile') ?>" data-toggle="tooltip" data-placement="top" title="Profile">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"> <i class=""></i></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen" id="toolFullScreen" 
                            onclick="toggleFullScreen()">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a href="" data-toggle="tooltip" data-placement="top" title="Refresh">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        </a>
                        <a type="button" data-toggle="modal" data-target="#logoutModal">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"
                                data-toggle="tooltip" data-placement="top" title="Logout">
                            </span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- Modal -->
              <div class="modal fade" id="logoutModal" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"> <span class="fa fa-sign-out"></span> <strong>Log Out</strong> ?
                            </h4>
                        </div>
                        <div class="modal-body">
                            <h5> Are you sure want to logout? <br>
                                Press No if you want to continue work. Press Yes to logout current user. 
                            </h5>
                        </div>
                        <div class="modal-footer">
                            <a type="button" href="<?= site_url('auth/logout') ?>" class="btn btn-default"> Yes </a>
                            <button type="button" data-dismiss="modal" class="btn btn-primary" autofocus> No </button>
                        </div>
                    </div>
                </div>
              </div>

            <!-- top navigation -->
            <div class="top_nav no-print">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    
                                    <!-- Foto Profil -->
                                    <?php if(empty($resultsUmum[0]->foto_profil)) : ?>
                                    <img src="<?= base_url('assets/images/picture.jpg')?>" alt="">
                                    <?php else : ?>
                                    <img src="<?= base_url('assets/uploads/'.$resultsUmum[0]->foto_profil)?>" alt="">
                                    <?php endif; ?>

                                    <!-- Nama User yang sedang login -->
                                    <?= $resultsUmum[0]->nama_karyawan_login ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?= site_url('') ?>"> Home </a>
                                    </li>
                                    <li><a href="<?= site_url('profile') ?>"> Profile </a>
                                    </li>
                                    <li>
                                        <a type="button" data-toggle="modal" 
                                            data-target="#logoutModal" href="#">
                                            <i class="fa fa-sign-out pull-right"></i> 
                                            Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">