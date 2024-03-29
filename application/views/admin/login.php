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
  </head>
  <body class="signup">
  <div class="wrapper">
       
       <div class="header2">
          <div class="container">
               <div class="logo2"><a href="#"><img src="<?php echo base_url();?>images/logo2.png"></a></div>
            </div>
       </div>
       
       <div class="signup_box">
          <h2>Sign in here</h2>
          <?php
                   echo form_open(base_url()."admin/login",$attribute['form']);
                   echo form_hidden('caller','Send');
                 ?>
            <span class="form_box"><?php echo form_input($attribute['email']);?>
               <h4 style="color:red;"><?php echo form_error('email', '<div class="error">', '</div>')."".$errormsg; ?> </h4></span>
            <span class="form_box"><?php echo form_input($attribute['password']);?>
             <h4 style="color:red;"><?php echo form_error('password', '<div class="error">', '</div>'); ?></h4></span>
            <?php echo form_input($attribute['submit']);?>
            <?php echo form_close();?>


           
       </div><!--close signup_box-->
    
    
  </div><!--close wrapper-->
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="js/establishment/zebra_datepicker.js"></script>
<script type="text/javascript" src="js/establishment/core.js"></script>

<!-- jQuery 2.1.3 -->
    <script src="js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    
    <!-- AdminLTE App -->
    <script src="js/establishment/app.min.js" type="text/javascript"></script>
  <!-- common script-->
  </body>
</html>