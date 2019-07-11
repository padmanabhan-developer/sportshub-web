<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>sportshub</title>
    <link rel="icon" type="images/favicon" href="images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/establishment/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/establishment/AdminLTE.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php include('google_analytics.php')?>
  </head>
  <body class="signup">
  <div class="wrapper">
       
       <div class="header2">
          <div class="container">
               <div class="logo2"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo2.png"></a></div>
            </div>
       </div>
      <?php
      echo form_open(base_url()."establishment/signup",$attribute['form']);
      echo form_hidden('caller','Send');
      ?>

      <div class="signup_box" id="signup"> 
      <h2>Sign up here</h2>
      <span class="mailspn">
      	<span class="form_box"><?php echo form_input($attribute['email']);?></span>
      	<?php echo form_error('email', '<div class="error">', '</div>'); ?>
      </span>      
      <span class="passspn">
      	<span class="form_box"><?php echo form_input($attribute['password']);?>
      		<?php echo form_input($attribute['re_password']);?>
	  	</span>
        
      	<?php echo form_error('password', '<div class="error">', '</div>').'<div class="error">'. $msg.'</div>' ?>
      	<?php echo form_error('re_password', '<div class="error">', '</div>'); ?>
      
      </span>

      <?php echo form_input($attribute['submit']);?>

  <h6>Already have an account?  <a href="<?php echo base_url();?>establishment">Sign in here</a></h6>

</div><!--close signup_box-->
<?php echo form_close();?>

    
  </div><!--close wrapper-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="js/zebra_datepicker.js"></script>
	<script type="text/javascript" src="js/core.js"></script>

<!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script>
  <!-- common script-->
  </body>
</html>