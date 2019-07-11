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
	<link href="<?php echo base_url();?>css/admin/AdminLTE.min.css" rel="stylesheet" type="text/css">
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
          <!-- sidebar menu: : style can be found in sidebar.less -->
           <?php $this->load->view('admin/left');?>
        </section>
        <!-- /.sidebar -->
    </aside>
    <div id="content">
       <div class="container">
       		<a href="<?php echo base_url();?>admin/rating_comment" class="back-button">BACK TO  Ratings</a>
       		<div class="row2"><h5><small>Establishment: </small><?php echo $rating['title']; ?></h5></div>
        	<div class="row">
        		<div class="col-lg-6 col-md-6 col-sm-6 box-form">
                <!--<div class="box">-->
                <h2 class="title2">Edit Rating/Comment</h2>
                </br>
                <?php 
					 $user_ref = $this->uri->segment(3);
                 	 echo form_open(base_url()."admin/rating_edit/$user_ref", $attribute_rating['form']);
                     echo form_hidden('caller','Rating');
      			?>
                	
                     <span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Establishment</span></div>
					 	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_input($attribute_rating['title']);?></div>
                     </span>
                     
                     <span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">User</span></div>
                     	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_input($attribute_rating['user']);?></div>
                     </span>
                     
                      <span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Rating</span></div>
					 	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_dropdown($attribute_rating['rating'], $attribute_rating['rating_option'], $attribute_rating['rating_selected']);?></div>
                     </span>
                        
                     <span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Comments</span></div>
					 	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_textarea($attribute_rating['comment']);?></div>
                     </span>
                     
                    
                     
                     <!--<span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Country</span></div>
					 	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_dropdown($attribute_rating['country'],$attribute_rating['country_option'], $attribute_rating['country_selected']);?></div>-->
                     </span>
                     <span class="form-row"><?php echo form_input($attribute_rating['submit']);?></span>
                     
                     <?php echo form_close();?> 
                </div>
        	</div>
       </div>
    </div>
  </div>
 <script src="<?php echo base_url();?>js/admin/app.min.js" type="text/javascript"></script>    
</body>
</html>      