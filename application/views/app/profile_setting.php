<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<title>sportshub</title>
<link rel="icon" type="images/favicon" href="images/favicon.ico" />
<!-- Bootstrap -->
<link href="<?php echo base_url();?>css/admin/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/admin/bootstrap-theme.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/establishment/style.css" rel="stylesheet">
<!--<link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">-->
<!--<link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">-->
<link href="<?php echo base_url();?>css/establishment/AdminLTE.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/jquery-confirm.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/establishment/jquery.timepicker.css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/establishment/form_validation.js"></script>
<script src="<?php echo base_url();?>js/admin/ajax.js"></script>
<script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/establishment/jquery.timepicker.js"></script>
<script src="http://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>
<?php include('google_analytics.php')?>
</head>
<body>
<div class="wrapper appwrapper">
	<?php $this->load->view('app/header');?>  
	<?php $this->load->view('app/left-menu');?>
<div id="content" class="appcontent">
  
  
  <div  class="col-md-10">
    <div class="container appcontainer"> 
      <!--<a href="<?php echo base_url();?>admin/user" class="back-button">BACK TO  USER</a>-->
      <div class="row2">
        <h5><small>ACCOUNT E-MAIL: </small><?php echo $user['email']; ?></h5>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 box-form"> 
          <!--<div class="box">-->
          <h2 class="title">User Details</h2>
          </br>
          <?php 
					 $user_ref = $this->uri->segment(3);
                 	 echo form_open(base_url()."app/profile_setting", $attribute_user['form']);
                     echo form_hidden('caller','User');
      			?>
          <span class="form-row">
          <div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">First name</span></div>
          <div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_input($attribute_user['firstname']);?></div>
          </span> <span class="form-row">
          <div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Last name</span></div>
          <div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_input($attribute_user['lastname']);?></div>
          </span> <span class="form-row">
          <div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Email</span></div>
          <div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_input($attribute_user['email']);?></div>
          </span> <span class="form-row">
          <div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Gender</span></div>
          <div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_dropdown($attribute_user['gender'], $attribute_user['gender_option'], $attribute_user['gender_selected']);?></div>
          </span> <span class="form-row">
          <div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Country</span></div>
          <div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_dropdown($attribute_user['country'],$attribute_user['country_option'], $attribute_user['country_selected']);?></div>
          </span> <span class="form-row" ><?php echo form_input($attribute_user['submit']);?></span> <?php echo form_close();?> </div>
        <div class="col-lg-6 col-md-6 col-sm-6 box-form">
          <div class="box">
            <h2 class="title">Change password</h2>
            <div class="box-inner">
              <h3>change user password:</h3>
              <?php
                            echo form_open(base_url()."app/profile_setting/",$attribute['form']);
                            echo form_hidden('caller','Send');
?>
              <span class="form_box"> <?php echo form_input($attribute['password']);?> <?php echo form_input($attribute['re_password']);?> </span>
              <div class="change_pwd_content"> <?php echo form_error('password', '<div class="error">', '</div>').$msg; ?> <?php echo form_error('re_password', '<div class="error">', '</div>'); ?> </div>
              <?php echo form_input($attribute['submit']);?> <?php echo form_close();?> </div>
            <!-- close box-inner --> 
          </div>
          <!-- close box --> 
          
        </div>
      </div>
      <div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=728570660f5af2d6335&width=728&height=90"></script></div>
    </div>
  </div>
  
  
  <?php 
  $ad_random1 = rand(1,10);
  $ad_random2 = rand(1,10);
  $ad_random3 = rand(1,10);
  ?>
  <div class="col-md-2">
    <div class="row table-overflow">
        <div class="col-md-12 right-sidebar">
       <!-- /32361281/DFP_BEHRENTZ_SPORTSHUB_160X600_1 -->
                    <div id='div-gpt-ad-1505826037322-0' style='height:600px; width:160px;'>
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1505826037322-0'); });
                    </script>
                    </div>    
	</div>
    </div>
  </div>
  
  
 </div> 
</div>
<script src="<?php echo base_url();?>js/admin/app.min.js" type="text/javascript"></script>
<?php $this->load->view('establishment/cookie_include');?>
</body>
</html>
