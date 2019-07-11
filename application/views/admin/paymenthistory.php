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
    <link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/jquery-confirm.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/AdminLTE.min.css" rel="stylesheet" type="text/css">
    <link href="<?php //echo base_url();?>css/establishment/style.css" rel="stylesheet">
   

  </head>
  <body> 
  <div class="wrapper">
    <header id="header">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        
      <div class="container">
           <div class="logo"><a href="#"><img src="<?php echo base_url();?>images/logo.png"></a></div>
        </div><!-- close container -->
    </header><!-- close header -->
    
    
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
          <?php $this->load->view('admin/left');?>
        </section>
        <!-- /.sidebar -->
      </aside>
    
    <div id="content">
       <div class="container">
              <!--<a href="#" class="add-new-event" >new establishments</a>-->
              
              <div class="events">
              <h2 class ="title2"> PAYMENT INFO </h2>
          <?php $this->load->view('admin/paymenthistory_display.php');?>
         </div><!-- close container -->
    </div><!-- close content -->
    
    
  </div><!--close wrapper-->
   
  </body>
  <script type="text/javascript" src="<?php echo base_url();?>js/admin/ajax.js"></script>
   <script src="<?php echo base_url();?>js/admin/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
  	jQuery(document).on("click", ".viewpdf", function(e) {  
// $(".unblock").click(function(){  

    var esid = $(this).attr("data-esid");
    var subsid = $(this).attr("data-subsid");

    if(esid > 0) { 
     
        window.open("<?php echo base_url();?>admin/invoice?esid=" + esid + "&subsid=" + subsid,"_blank")
       
     }
  });
  </script>
  
</html>