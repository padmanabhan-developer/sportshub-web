<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>sportshub</title>
    <link rel="icon" type="images/favicon" href="images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php include('google_analytics.php')?>
  </head>
  <body>
  <div class="wrapper">
  
      <div>
          
       </div><!--close banner-->
       
       <div id="content">
           <div class="container">
               <div class="inner">
                   <div class="row1" style="margin:0 0 40px">
                      <div class="logo2"><a href="#"><img src="<?php echo base_url();?>images/logo2.png"></a></div>
                     

                   </div>

                  <div class="signup_box">
          <h2>Sign in here</h2>
          <?php
                   echo form_open(base_url()."promotion/authenticate",$attribute['form']);
                   echo form_hidden('caller','Send');
                 ?>
            <span class="form_box"><?php echo form_input($attribute['pro_email']);?>
               <h4 style="color:red;"><?php echo form_error('pro_email', '<div class="error">', '</div>')."".$errormsg; ?> </h4></span>
            <span class="form_box"><?php echo form_input($attribute['password']);?>
             <h4 style="color:red;"><?php echo form_error('password', '<div class="error">', '</div>'); ?></h4></span>
            <?php echo form_input($attribute['submit']);?>
            <?php echo form_close();?>

           
           
       </div><!--close signup_box-->
    
                        
         </div><!-- close container -->
    </div><!-- close content -->
               </div><!--close inner-->
           </div><!--close container-->
       </div><!--close content-->
    
  </div><!--close wrapper-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="jquery-1.9.1.min.js"><\/script>')</script>
        <script src="<?php echo base_url();?>js/jquery.singlePageNav.min.js"></script>
        <script>

            // Prevent console.log from generating errors in IE for the purposes of the demo
            if ( ! window.console ) console = { log: function(){} };

            // The actual plugin
            $('.single-page-nav').singlePageNav({
                offset: $('.single-page-nav').outerHeight(),
                filter: ':not(.external)',
                updateHash: true,
                beforeStart: function() {
                    console.log('begin scrolling');
                },
                onComplete: function() {
                    console.log('done scrolling');
                }
            });
        </script>
        <?php //include('info_links.php')?>
  </body>
</html>