<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>sportshub</title>
     <link href="<?php echo base_url();?>css/establishment/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/AdminLTE.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/establishment/jquery.timepicker.css" />
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/establishment/form_validation.js"></script>
  <script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
     <script src="<?php echo base_url();?>js/establishment/jquery.timepicker.js"></script>
    <script src="<?php echo base_url();?>js/establishment/datepair.js"></script>
    <?php include('google_analytics.php')?>
  </head>
  <body>
  <div class="wrapper barwrapper">
    <?php $this->load->view('establishment/header');?>
         <?php $this->load->view('establishment/left-menu');?>
        
    
    <div id="content">
       <div class="container">
            <div class="front-page">
           <div class="add_4"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=8255706607fc613d355&width=728&height=90"></script></div>        
           <!--<div class="red-box">
                      <h2>Welcome to Sportshub365. Please setup your profile.</h2>
                      <a href="<?php //echo base_url();?>establishment/upgrade" class="black-button">Go  there</a
                       <a href="<?php //echo base_url();?>establishment/profile_settings" class="black-button">Go  there</a>
                   </div>--><!-- close red-box -->
                   
                   <div class="row">
                      <div class="one_fifth">
                           <a href="<?php echo base_url();?>establishment/profile_settings">
                           <span class="icon1"></span>
                           <h2>Profile settings</h2>
                             </a>
                        </div><!-- close one_fifth -->
                        
                        <div class="one_fifth">
                           <a href="<?php echo base_url();?>establishment/schedule">
                           <span class="icon2"></span>
                           <h2>Schedule</h2>
                             </a>
                        </div><!-- close one_fifth -->
                        
                        <div class="one_fifth">
                           <a href="<?php echo base_url();?>establishment/events">
                           <span class="icon3"></span>
                           <h2>Events</h2>
                             </a>
                        </div><!-- close one_fifth -->
                        
                        <div class="one_fifth">
                           <a href="<?php echo base_url();?>establishment/offers">
                           <span class="icon4"></span>
                           <h2>Offers</h2>
                             </a>
                        </div><!-- close one_fifth -->
                        
                        <div class="one_fifth">
                           <a href="<?php echo base_url();?>establishment/logout">
                           <span class="icon5"></span>
                           <h2>LOGOUT</h2>
                             </a>
                        </div><!-- close one_fifth -->
                   </div><!-- close row -->
                   
                   
              </div><!-- close front-page -->
         </div><!-- close container -->
    </div><!-- close content -->
    
    
    
    
    
    
  </div><!--close wrapper-->

   
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script>
  <!-- common script-->
  <?php $this->load->view('establishment/footer_include');?>
<?php $this->load->view('establishment/cookie_include');?>
<?php //include('info_links.php')?>
  </body>
</html>