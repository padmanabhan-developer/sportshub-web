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
    <link href="<?php echo base_url();?>css/establishment/modal.css" rel="stylesheet">
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
		<?php
  		  			$reset=0;
					$pwd="";
		  			if(isset($errormsg)){
						$pos = strpos($errormsg, 'success-');
						if($pos === false) {}else{$reset=1;
						$pwd = str_replace("success-","",$errormsg);
						}
					}
		?>
<a class="js-open-modal btn" href="#" data-modal-id="popup1" style="display:none;"> ...</a>  </div>
<div id="popup1" class="modal-box">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3> Password Reset </h3>
  </header>
  <div class="modal-body">
   <!-- <p><h4><?php //echo $pwd ?></h4></p>
    <br />-->
    <p>Your temporary password has been sent to your registered email id.</p>
  </div>
  <footer> <a href="#" class="btn btn-small js-modal-close">Close</a> </footer>
</div>
  <div class="wrapper">
       
       <div class="header2">
          <div class="container">
               <div class="logo2"><a href="<?php echo base_url();?>app"><img src="<?php echo base_url();?>images/logo2.png"></a></div>
            </div>
       </div>
       
       <div class="signup_box">
          <h2>Reset your Password</h2>
          <?php
                   echo form_open(base_url()."app/forgot",$attribute['form']);
                   echo form_hidden('caller','Send');
                 ?>
            <span class="form_box"><?php echo form_input($attribute['email']);?>
               <?php if ($pos === false) {?>
               <h4 style="color:red;"><?php echo form_error('email', '<div class="error">', '</div>')."".$errormsg; ?> </h4>
               <?php }?>
               </span>
               
            <?php echo form_input($attribute['submit']);?>
            <?php echo form_close();?>
			<h6>Already have account?  <a href="<?php echo base_url();?>app/login">login</a></h6>
            <h6>Don´t have an account?  <a href="<?php echo base_url();?>app/signup">Sign up here for FREE</a></h6>
           <!-- <a href="<?php echo base_url();?>establishment/login_facebook" class="facebook-button"><span class="facebook-icon"></span>Sign in with facebook</a>-->
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
<!-- sometime later, probably inside your on load event callback -->
<script>
var Example = (function() {
    "use strict";

    var elem,
        hideHandler,
        that = {};

    that.init = function(options) {
        elem = $(options.selector);
    };

    that.show = function(text) {
        clearTimeout(hideHandler);

        elem.find("span").html(text);
        elem.fadeIn();

        hideHandler = setTimeout(function() {
            that.hide();
        }, 4000);
    };

    that.hide = function() {
        elem.fadeOut();
    };

    return that;
}());
</script> 
<script>
$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

	$('a[data-modal-id]').click(function(e) {
		e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());
	});  
  
  
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
    });
 
});
 
$(window).resize(function() {
    $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
    });
});
 
$(window).resize();
 
});
$(document).ready(function(){
   <?php if($reset===1){?>
   $('email').val('');
    $('a[data-modal-id]').trigger("click");
   <?php }?>
});
</script></body>
</html>