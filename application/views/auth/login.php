<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Key Performance Indicator in Java Valley, Semarang. Created by Miqdad Izzudin.">
    <meta name="author" content="Miqdad Izzudin">
    <meta name="keyword" content="Login, KPI, Key Performance Indicator, Java Valley, Semarang">

    <!-- Icon -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo_java_valley.png') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/img/logo_java_valley.png') ?>" type="image/x-icon">

    <title>KPI | Halaman login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.css')?>" rel="stylesheet">
    <!--external css-->
    <link href="<?= base_url('assets/font-awesome/css/font-awesome.css')?>" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/style.css')?>" rel="stylesheet">

    <style>
      .infoMessage{color: #FF0000;}

      body {
          background-image: url(<?= base_url('assets/background/Stripes.jpg')?>) !important;
          background-repeat: no-repeat;
          background-position: center;
      }
      .background-login {
          background-image: url(<?= base_url('assets/background/Abstract-Blue.jpg')?>) !important;
          background-repeat: no-repeat;
          background-position: center;
      }
      .img-opacity{
        background: #e6f3ff !important;
      }
    </style>

  </head>

  <body>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

    <div id="login-page">
      <div class="container">
      
            <?php echo form_open("auth/login", array('name' => 'frm_karyawan','class'=>'form-login'));?>
            <h2 class="form-login-heading background-login">
              Login
            </h2>
            <div class="login-wrap img-opacity">
                <?php echo form_input($identity);?>
                <br>
                <?php echo form_input($password);?>
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Remember me

                <!-- ini pesan error -->
                <div class="infoMessage"><?php echo $message;?></div> 
                <label class="checkbox">
                    <span class="pull-right">
                        <a href="forgot_password"> Forgot Password?</a>
                    </span>
                </label>
                <button class="btn btn-theme btn-block background-login" name="submit" type="submit"><i class="fa fa-lock"></i> 
                  SIGN IN
                </button>
                <br>
                <br>
                
                <small>&copy; 2016 KPI by Miqdad Izzudin</small> 
            </div>

    
          <?php echo form_close();?>    
      
      </div>
    </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>


  </body>
</html>
