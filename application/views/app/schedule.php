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
<div class="wrapper appwrapper">
	<?php $this->load->view('app/header');?>  
	<?php $this->load->view('app/left-menu');?>
  <div id="content" class="appcontent">
  
  <div  class="col-md-10">
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
      <div class="add"><!--<script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=728570660f5af2d6335&width=728&height=90"></script>--></div>
    </div>
    <!-- close container --> 
    </div>
     <?php 
  $ad_random1 = rand(1,10);
  $ad_random2 = rand(1,10);
  $ad_random3 = rand(1,10);
  $ad_random4 = rand(1,10);
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
    <div class="col-md-2 table-overflow">
      <div class="row">
        <div class="col-md-12 right-bar">
        <!-- /32361281/DFP_BEHRENTZ_SPORTSHUB_160X600_2 -->
            <div id='div-gpt-ad-1505826037322-1' style='height:600px; width:160px;'>
            <script>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1505826037322-1'); });
            </script>
            </div>      
        
        </div>
        <div class="col-md-12 right-bar">
        <!-- /32361281/DFP_BEHRENTZ_SPORTSHUB_160X600_3_STICKY -->
            <div id='div-gpt-ad-1505826037322-2' style='height:600px; width:160px;'>
            <script>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1505826037322-2'); });
            </script>
            </div>
       
        
        </div>
        
        
      </div>
    </div>
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
<?php $this->load->view('establishment/cookie_include');?>
</body>
</html>