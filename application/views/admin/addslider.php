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
       		<a class="back-button" href="<?php echo base_url();?>admin/slider">BACK TO  Slider</a>
       		<!--<div class="row2"><h5><small>Establishment: </small>Test venki</h5></div>-->
        	<div class="row">
            <h2 class="title2">Add Slider</h2>
        		<div class="col-lg-6 col-md-6 col-sm-6 box-form">
                <!--<div class="box">-->
                <?php 
                 	 echo form_open(base_url()."admin/addslider/", $attribute_slider['form']);
                     echo form_hidden('caller','Slider');
      			?>
                <br>
                 <span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Slider Name</span></div>
					 	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_input($attribute_slider['slidername']);?>
                        <label for="slidername" style="display:none; color:#F00;" >This is required field</label>
                        </div>
                     </span>
                     
                     <span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">URL </span></div>
                     	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_input($attribute_slider['url']);?>
                        <label for="url" style="display:none; color:#F00;" >This is required field</label>
                        <label for="urltest" style="display:none; color:#F00;" >Invalid URL</label>
                        </div>
                     </span>
                     
                     <span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">Image </span></div>
					 	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_upload($attribute_slider['image']); ?>
                        <label for="image" style="display:none; color:#F00;" >This is required field</label>
                        </div>
                     </span>
                     <?php 
						$error=validation_errors();
                        if(!empty($error)) { echo form_error('image');}
						 ?>
                      <span class="form-row">
                     	<div class="col-lg-3 col-md-6 col-sm-6"><span class="title5">CONTENT </span></div>
					 	<div class="col-lg-9 col-md-6 col-sm-6"><?php echo form_textarea($attribute_slider['desc']);?>
                        <label for="desc" style="display:none; color:#F00;" >This is required field</label>
                        </div>
                     </span>
                        
                   
                     <span class="form-row"><?php echo form_input($attribute_slider['submit']);?></span>
                    
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 box-upload">
                <br/>
                      <?php
							    if(!empty($attribute_slider['current_picture']))
								{
								 //	echo "Current Image<br /><br />";
                                 ?>
								 <img src="<?php echo base_url();?>images/profile/<?php echo $attribute_slider['current_picture'];?>"  />
                                 <?php
                         		 echo form_hidden('current_picture',$attribute_slider['current_picture']);
								} 
								else
								{
								?>
                                <img src="<?php echo base_url();?>images/profile/upload-image.png" id="profile_img" style="width:430px; height:280px;"/>
                                <!--<img src="<?php //echo $imagesrc; ?>" alt="" id="profile_img" style="width:174px; height:174px; border-radius:50%"/>-->
                               <?php //echo form_upload($attribute_slider['image']); ?>
             			 <?php } ?>
                </div>    
                 <?php echo form_close();?>                                
        	</div>
       </div>
    </div>
  </div>
 <script src="<?php echo base_url();?>js/admin/app.min.js" type="text/javascript"></script> 
<script>
 $("#image").change(function(){
    readURL(this);
 });
 
 function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_img').attr('src', e.target.result);
			
			$('#profile_img').attr('position', 'relative');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function form_validate() {
	var sliderror, urlerr, descerr, imgerr;
	if($('#slidername').val() == '')
	{
		$('label[for="slidername"]').show();
		sliderror =1;
	}
	else{
		$('label[for="slidername"]').hide();
		sliderror =0;
	}
	
	var urltest = isUrlValid($('#url').val())
	
	if($('#url').val() == '')
	{
		$('label[for="url"]').show();
		urlerr =1;
	}
	else if(urltest == false) {
		$('label[for="url"]').hide();
		$('label[for="urltest"]').show();
		urlerr =1;
	}
	else{
		$('label[for="urltest"]').hide();
		$('label[for="url"]').hide();
		urlerr =0;
	}
	/*if($('#profile_img').val() == '')
	{
		$('label[for="desc"]').show();
		descerr = 1;
	}
	else{
		$('label[for="desc"]').hide();
		descerr =0;
	}*/
	
	if($('#desc').val() == '')
	{
		$('label[for="desc"]').show();
		descerr = 1;
	}
	else{
		$('label[for="desc"]').hide();
		descerr =0;
	}
	if((sliderror ==1) || (urlerr ==1) || (descerr == 1))
	{return false;}
	
}

function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}
</script>    

</body>
</html>      