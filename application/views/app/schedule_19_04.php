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
<link href="<?php echo base_url();?>css/jquery.phancy.css" rel="stylesheet" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/app/ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/app/schedule.js"></script>
<?php include('google_analytics.php')?>
</head>
<body >
<div class="wrapper">
  <header id="header"> <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
    <div class="container">
      <div class="logo"><a href="#"><img src="<?php echo base_url();?>images/logo.png"></a></div>
    </div>
    <!-- close container --> 
  </header>
  <!-- close header -->
  
  <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
      <?php $this->load->view('app/left-menu');?>
    </section>
    <!-- /.sidebar --> 
  </aside>
  <div id="content">
    <div class="container">
      <div class="buttons_div">
        <div class="button_row">
          <?php if(count($selected_channel_list)>0) { ?>
          <div class="col3"><a href="#" class="button_left show1">CHOOSE CHANNELS</a></div>
          <?php } ?>
          <div class="col3"><a href="<?php echo base_url();?>app/tv_provider_channel" class="button_middle">CHOOSE TV PROVIDER</a></div>
          <div class="col3"><a href="<?php echo base_url();?>app/my_tv_schedule" class="button_right">Go to my tv schedule</a></div>
        </div>
      </div>
      <div class="schedule" id="channel_search">
        <?php $this->load->view('app/channel-schedule');?>
      </div>
      <div class="add"><img src="<?php echo base_url();?>images/add.png"></div>
    </div>
    <!-- close container --> 
    
  </div>
  <!-- close content --> 
  
</div>
<!--close wrapper--> 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script> 
<script type="text/javascript" >
$(document).ready(function() {
default_load_function();
});
</script> 
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script> 
<script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
  });
  
  function resetCustomInput()
  {
    $('input').customInput();
  }
  </script> 

<!-- AdminLTE App --> 
<script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>js/jquery.simplePopup.js" type="text/javascript"></script> 
<script type="text/javascript">

$(document).ready(function(){

    $('.show1').click(function(){
	$('#pop1').simplePopup();
    });
  
    $('.show2').click(function(){
	$('#pop2').simplePopup();
    });  
  
});
</script>
</body>
</html>