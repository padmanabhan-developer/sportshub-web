<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>sportshub</title>
    <link rel="icon" type="<?php echo base_url();?>images/favicon" href="images/favicon.ico" />
    <!-- Bootstrap -->
    
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/style_promotion.css" rel="stylesheet">
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
  
       <div id="banner">
          <div class="container">
               <div class="banner-text">
                    <div class="logo"><a href="#"><img src="<?php echo base_url();?>images/logo1.png"></a></div>
                      <h2>get more customers in your bar!</h2>
                      <h3>Right now people are looking for a bar where they can watch sports and have a good time.  Sportshub365 connects sportslovers with bars that shows sports.</h3>
                      <div class="single-page-nav">
            <ul>
                <li><a href="#signup" class="banner-button single-page-nav">SIGN UP FOR A FREE ACCOUNT</a></li>
                
            </ul>
        </div>
                 </div>
            </div><!--close container-->
       </div><!--close banner-->
       
       
       
       <div id="content">
           
               <div class="inner">
                   <div class="row1">
                      <div class="container">
                      <div class="logo2"><a href="#"><img src="<?php echo base_url();?>images/logo2.png"></a></div>
                        <a href="mailto:info@sportshub365.com" class="contact_us">contact us</a>
                        
                        <div class="full-width">
                        <div class="row">
                           <div class="col-lg-7 col-md-7 col-sm-7 left">
                                <h2>what is sportshub365?</h2>
                                  <p class="about_bold">Welcome to Sportshub365 a worldwide sports bar finder App, by being part of this new venture holiday makers and business people will locate your bar to watch there favourite sport via there mobile phone or tablet.</p>

                                  <p class="about_regular">
Have you ever forgotten that Monday night game or that early Grand Prix start? with sportshub365 clients can set there reminders and follow the map straight to your bar.<br>
<br>
With sportshub365 you can list special offers on a daily basis and holidaymakers could be cheering on there favourite team enjoying the best promotions in town at YOUR bar!<br>
<br>
Clients never have to arrive at an out of town location and start asking around to find out where to watch the big fight or the F.A. Cup final, they can preset there location and sportshub365 will give them your bar details and what sports you will be showing and what promotion you are offering. 

</p>
<p class="about_bold_italic">
When the registration page is ready you will be asked to fill out your details following a simple procedure, tell us what systems you have and we will tell you what sport you could be showing. </p>
                             </div>
                             
                             <div class="col-lg-5 col-md-5 col-sm-5 right"><img src="<?php echo base_url();?>images/img1.png"></div>
                        </div>
                        </div>
                        </div><!--close container-->
                   </div>
                   
                   <div class="row2">
                    <div class="container">
                   <h1>be ready when we launch</h1>
                   <h5>We hope to launch the app very soon. <br>
Sign up now and be apart of the first to try it for free.</h5>
                   <?php
				   $action_url = base_url()."promotion";
				   echo form_open($action_url,$attribute['form']);
                   echo form_hidden('caller','Send');
                 ?>
                 <div class="signup_box" id="signup"> 


                        <h2>Sign up here</h2>


                        <span class="form_box"><?php echo form_input($attribute['name']);?>
                          <div class="form_error"><?php echo form_error('name', '<div class="error">', '</div>'); ?></div>
                        </span>
                        
                        <span class="form_box"><?php echo form_input($attribute['address']);?>
                          <div class="form_error"><?php echo form_error('address', '<div class="error">', '</div>'); ?></div>
                        </span>
                        <span class="form_box"><?php echo form_input($attribute['email']);?>
                          <div class="form_error"><?php echo form_error('email', '<div class="error">', '</div>'); ?></div>
                        </span>
                        <span class="form_box"><?php echo form_input($attribute['password']);?>
                          <div class="form_error"><?php echo form_error('password', '<div class="error">', '</div>'); ?></div>
                        </span>

                        <?php echo form_input($attribute['submit']);?>
                        <h6>We will send you an e-mail before launch.</h6>


                   </div><!--close signup_box-->
                   <?php echo form_close();?>


                   
                   </div><!--close row2-->
               </div><!--close inner-->
           
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
  </body>
</html>