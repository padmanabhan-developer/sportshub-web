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
    <script src="http://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>
    <style type="text/css">
  

.tooltip_span {
    z-index:10;
    padding:14px 20px;
    margin-top:-30px;
    margin-left:28px;
    width:300px;
    line-height:16px;
    background: #d5b421;
}

.tooltip-inner {
    max-width: 400px;
    text-align: left;    box-shadow: 0px 0px 5px 0px #182847;
    background-color: #d5b421;    font-family: 'FjallaOneRegular';
}

.tooltip.left .tooltip-arrow {
    border-left-color: #d8ba36;
}

.tooltip.top .tooltip-arrow {
    border-top-color: #d8ba36;
}


.tooltip.top {
    padding: 5px 0;
    margin-top: 30px;
}

.tooltip.left {
    padding: 0 5px;
      margin-left: -10px;
}

.tooltip.left .tooltip-arrow {
    top: 50%;
    right: -15px;
    margin-top: -15px;
    border-width: 15px 0 15px 25px;
}


.tooltip.bottom .tooltip-arrow {
    border-bottom-color: #d8ba36;
}

.tooltip.right .tooltip-arrow {
    border-right-color: #d8ba36;
}


.tooltip.bottom .tooltip-arrow {
    top: -10px;
    left: 50%;
    margin-left: -15px;
    border-width: 0 20px 20px;
}

.tooltip.bottom {
    margin-top: 10px;
}

.tooltip.right .tooltip-arrow {
    top: 50%;
    left: -8px;
    margin-top: -17px;
    border-width: 20px 15px 20px 0;
}

.tooltip.right {
    padding: 0 5px;
    margin-left: 10px;
}


.wizard {
    margin: 20px auto;
    background: #d5b522;
    color: white;
        font-family: 'FjallaOneRegular';
}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
            padding-left: 30px;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #182847;
    position: absolute;
    width: 61%;
    margin: 0 auto;
    left: -15px;
    right: 0;
    top: 78%;
    z-index: 1;
}

.nav-tabs 
{
    border-bottom: 0px solid #ddd;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 25px;
    height: 25px;
    line-height: 22px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 15px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 1px solid #182847;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 16%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;

    margin: 0 auto;

}

.wizard .nav-tabs > li a {
        width: 25px;
    height: 25px;
    margin: 10px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 15px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
		border-color: #00000;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}

#ok
{
    color: white;
    background-color: #182847;
	border-color: #ffffff;
	font-size: 12px;
}

    </style>
    <?php include('google_analytics.php')?>
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
          <!-- Sidebar user panel -->
          <!--<div class="user-panel">
            <div class="pull-left image">
              <img src="./index_files/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Admin</p>

              <a href="http://onlydental.eu/dkready/admin/dashboard.php#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>-->
          <!-- search form -->
          <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
           <?php $this->load->view('establishment/left-menu');?>
        </section>
        </section>
        <!-- /.sidebar -->
      </aside>
    
    
    <div id="content">
    	 <div class="col-md-10" style="
    margin-top: -40px;">

               <?php 

                if((!empty($profile_detail['address'])) && (!empty($profile_detail['title'])))
                {
                    $step_1 = 2;
                }
                else
                {
                      $step1 = '';
                      $step_1 = 1;                    
                }
                
                 ?>


                 <?php
                     if(!empty($attribute_upload['current_picture']))
                      {
                        $step_2 = 2;
                      }
                      else
                      {
                        $step_2 = 1;
                      }
                    ?>

                 




                  <?php
                  $opcount1 = 0;
                    foreach ($opening_hours as $w => $v) {
                      $opcount = $v['from_time'];
                      if($opcount != '')
                      {
                        $opcount1 = 1;
                      }
                    }
                     if($opcount1 == 1)
                      {
                    $step_3 = 2;
                    }
                    else
                    {
                          $step_3 = 1;
                    }
                  ?>

                 

                 <?php
                  $hpcount1 = 0;
                    foreach ($happy_hours as $h => $vh) {
                      $hpcount = $vh['from_time'];
                      if($hpcount != '')
                      {
                        $hpcount1 = 1;
                      }
                    }
                     if($hpcount1 == 1)
                      {
                          $step_4 = 2;
                      }
                      else
                      {
                            $step_4 = 1;
                      }
                  ?>



                 

                  <?php
                  $vfcount1 = 0;
                    foreach ($facilities as $f => $vf) {
                      $vfcount = $vf['is_checked'];
                      if($vfcount == 'true')
                      {
                            $vfcount1 = 1;
                      }
                    }
                     if($vfcount1 == 1)
                      {
                            $step_5 = 2;
                      }
                      else
                      {
                            $step_5 = 1;
                      }
                  ?>

                  

                  <?php 
                   if($step_1 == 2 && $step_2 == 2 && $step_3 == 2 && $step_5 == 2 )
                   {
                     
                      ?>

                    <div align="center" style="    padding: 20px;
    background: #e1c124;
    margin-bottom: 25px;
    color: white;
    font-weight: bold;
    margin-top: 40px;">
         <h2 align="center">Congratulations!</h2>
         <h5 align="center" style="margin-top: 10px; font-family: 'FjallaOneRegular';">You have successfully set up your Profile Settings. To Complete your account go to schedule and follow the steps.</h5>
         <br>
         <center><a href="<?php echo base_url();?>establishment/tv_provider_channel" class="btn btn-primary" style="background: #1b80de;">GO TO SCHEDULE</a></center>
       </div>
                    <?php
                  
                   }
                 ?>


      <?php 
       if($step_1 == 1 || $step_2 == 1 || $step_3 == 1 || $step_5 == 1 )
       {

       
       ?>

       <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist" style="border: 1px solid #182847;">


                    <li role="presentation" class="active" style=" margin-left: 66px;">


                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 1</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Add Basic Venue</p>
                            </div>
                        </div>

                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            
                             <?php 
                               if($step_1 == 1)
                               {
                                  ?>
                                  <span class="round-tab">
                                    <i class=""></i>
                                </span>

                                <?php
                               } else {
                             ?>

                                <span class="round-tab" id="ok">
                                    <i class="fa fa-check" id="ok"></i>
                                </span>
                                
                                <?php
                               }
                             ?>
                        </a>
                    </li>

                    <li role="presentation" class="active">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 2</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Add Image</p>
                            </div>
                        </div>

                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <?php 
                               if($step_2 == 1)
                               {
                                  ?>
                                  <span class="round-tab">
                                    <i class=""></i>
                                </span>

                                <?php
                               } else {
                             ?>

                                <span class="round-tab" id="ok">
                                    <i class="fa fa-check" id="ok"></i>
                                </span>
                                
                                <?php
                               }
                             ?>
                        </a>
                    </li>
                    <li role="presentation" class="active">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 3</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Add Opening Hours</p>
                            </div>
                        </div>

                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <?php 
                               if($step_3 == 1)
                               {
                                  ?>
                                  <span class="round-tab">
                                    <i class=""></i>
                                </span>

                                <?php
                               } else {
                             ?>

                                <span class="round-tab" id="ok">
                                    <i class="fa fa-check" id="ok"></i>
                                </span>
                                
                                <?php
                               }
                             ?>
                        </a>
                    </li>
                    <li role="presentation" class="active">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 4</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Add Happy Hours</p>
                            </div>
                        </div>

                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <?php 
                               if($step_4 == 1)
                               {
                                  ?>
                                  <span class="round-tab">
                                    <i class=""></i>
                                </span>

                                <?php
                               } else {
                             ?>

                                <span class="round-tab" id="ok">
                                    <i class="fa fa-check" id="ok"></i>
                                </span>
                                
                                <?php
                               }
                             ?>
                        </a>
                    </li>
                    <li role="presentation" class="active">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 5</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Choose Facilities</p>
                            </div>
                        </div>

                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <?php 
                               if($step_5 == 1)
                               {
                                  ?>
                                  <span class="round-tab">
                                    <i class=""></i>
                                </span>

                                <?php
                               } else {
                             ?>

                                <span class="round-tab" id="ok">
                                    <i class="fa fa-check" id="ok"></i>
                                </span>
                                
                                <?php
                               }
                             ?>
                        </a>
                    </li>
					

                    
                </ul>
            </div>

 
        </div>
        <?php
      }
       ?>
          
          </div>
           <div class="col-md-2">
              <div class="row">
                <div class="col-md-12" style="background: #182847; margin-top: 5px; height: 200px;">&nbsp;</div>
              </div>
            </div>
         	  <div style="margin-top: 30px;" class="col-md-10">
              	   
				        
              <?php 
             
             //echo "<br>".$exp_date = date('Y-m-d', strtotime($premium_date. ' - 7 days'));


              $current_date = new DateTime(date('Y-m-d'));
              $premium_date_o = new DateTime($premium_date);
               $interval = $current_date->diff($premium_date_o);
               //echo $interval->days;
              /*if(empty($premium_date))
              {?>    
           <div class="darkblue-box">
            <h2>Get more visitors! Try premium account already today...</h2>
              <a href="<?php echo base_url();?>establishment/upgrade" class="yellow-button" >Upgrade here</a>
              
              <div class="js-dialog  modal  dialog" >
              <span class="modal-close-btn"></span>
             <?php $this->load->view('establishment/upgrade-popup');?>

            </div>
                        
                        
          </div><!-- close darkblue-box -->


           <?php } 
           elseif(strtotime(date('Y-m-d')) > strtotime($premium_date))
              {?>    
           <div class="darkblue-box">
            <h2>Your premium account has expired. Renew today...</h2>
              <a href="<?php echo base_url();?>/establishment/upgrade" class="yellow-button" >Upgrade here</a>
              
              <div class="js-dialog  modal  dialog" >
              <span class="modal-close-btn"></span>
             <?php $this->load->view('establishment/upgrade-popup');?>

            </div>
                        
                        
          </div><!-- close darkblue-box -->


                 <?php } 


              elseif($interval->days<=7)
              {?>    
           <div class="darkblue-box">
            <h2>
           Your premium account is going to expire. Renew now...
             </h2>
              <a href="<?php echo base_url();?>/establishment/upgrade" class="yellow-button" >Upgrade here</a>
              
              <div class="js-dialog  modal  dialog" >
              <span class="modal-close-btn"></span>
             <?php $this->load->view('establishment/upgrade-popup');?>

            </div>
                        
                        
          </div><!-- close darkblue-box -->

          
                 <?php } */


                 ?>  <!-- close darkblue-box -->
                   
                   <div class="row">
                    <?php
                                    echo form_open_multipart(base_url()."establishment/profile_settings",$attribute_upload['form']);
                                    echo form_hidden('caller','Upload');
      ?>
                      <div class="col-lg-6 col-md-6 col-sm-6 box-upload">
                          
                          
                         
                         <?php
							    if(!empty($attribute_upload['current_picture']))
								{
								 //	echo "Current Image<br /><br />";
                                 ?>
								 <img src="<?php echo base_url();?>images/profile/<?php echo $attribute_upload['current_picture'];?>"  />
                                 <?php
                         		 echo form_hidden('current_picture',$attribute_upload['current_picture']);
								} 
								else
								{
								?>
                                <img src="<?php echo base_url();?>images/profile/upload-image.png"  />
                                
             			 <?php }
						 ?>
                         <div class="uploadContent" style="text-align:center;">
                         <?php if($step_1 == 2){ if($step_2 == 1){ ?> <a class="yellow-button align-center" href="<?php echo base_url();?>establishment/profile_image" id="step_2_tooltips" data-toggle="tooltip" data-placement="bottom" data-original-title="<span style='cursor: pointer;' class='hidetooltip2 pull-right'>x</span><b>STEP 2 </b> <br> <span style='text-transform: uppercase;'> Click Here to Enter the Image Gallery and Upload Images of your establishment.</span>">Go to image gallery</a> <?php } else { ?> 

                          <a class="yellow-button align-center" href="<?php echo base_url();?>establishment/profile_image">Go to image gallery</a> <?php } } else { ?>
							 
							 <a class="yellow-button align-center" href="<?php echo base_url();?>establishment/profile_image">Go to image gallery</a> <?php }  ?>

                         <?php if($step_2 == 2){ ?>  <img class="" src="<?php echo base_url();?>img/dashboard/icon.png" style="width: 20px;"> <?php } ?>
                         <?php if($step_1 == 2){ if($step_2 == 1)
                          {?>
                          <script type="text/javascript">
                            $(function () {
                              $('#step_2_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('show');
                              });

                            $(function () {
                              $('.hidetooltip2').on('click', function () {
                                $('#step_2_tooltips').tooltip('hide');
                              });
                            });
                          </script>
                        <?php }

                         }
                        ?>
                         </div>
                         
                          	<!--<div class="uploadContent">
                             
                         <div  class="fileUpload btn1 btn-primary1 " style="float:left;"> <span>Browse</span>
  <?php
                        	
                         //echo form_upload($attribute_upload['picture']); ?>
                         </div>
                         <div ><?php
						// echo form_input($attribute_upload['submit']);?>
                         </div>
                         <div style="clear:both;"></div>
                        <div class="uploadpicturecontent">
                        <?php 
						// $errors=validation_errors();
                        // if(!empty($errors)) { echo form_error('picture');}
						 ?>
                         </div>
                         </div>-->
                        <?php echo form_close();?>
                        
                        
                        </div><!-- close box-upload -->
      <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    <script src="<?php echo base_url();?>js/locationpicker.jquery.js"></script>
                      
                        <div class="col-lg-6 col-md-6 col-sm-6 box-form">
                           <?php
						   //print_r($profile_detail);
						   $profilAddress = (!empty($profile_detail['address'])) ? $profile_detail['address'] : '';
               $phone = (!empty($profile_detail['phone'])) ? $profile_detail['phone'] : '';
               $website = (!empty($profile_detail['website'])) ? $profile_detail['website'] : '';
						   $email = (!empty($profile_detail['email'])) ? $profile_detail['email'] : '';
						   $profilecity = (!empty($profile_detail['city'])) ? $profile_detail['city'] : '';
						   $profilezip = (!empty($profile_detail['zip'])) ? $profile_detail['zip'] : '';
						   $profilecountry = (!empty($profile_detail['country'])) ? $profile_detail['country'] : '';
						   $profilelat = (!empty($profile_detail['geo_lat'])) ? $profile_detail['geo_lat'] : '';
						   $profilelang = (!empty($profile_detail['geo_lang'])) ? $profile_detail['geo_lang'] : '';
						   $maplat = (!empty($profilelat)) ? $profilelat : '40.46366700000001';
						   $maplang = (!empty($profilelang)) ? $profilelang : '-3.7492200000000366';
                                    echo form_open(base_url()."establishment/profile_settings",$attribute_profile['form']);
                                    echo form_hidden('caller','Profile');
      ?>  
      <?php if($step_1 == 1)
      {?>

      <script type="text/javascript">
        $(function () {
          $('#step_1_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('show');
          });

        $(function () {
          $('.hidetooltip').on('click', function () {
            $('#step_1_tooltips').tooltip('hide');
          });
        });
      </script>

    <?php } else {
    ?>

     <script type="text/javascript">
        $(function () {
          $('#step_1_tooltips').tooltip({html: true, trigger: 'manual'});
          });

        $(function () {
          $('.hidetooltip').on('click', function () {
            $('#step_1_tooltips').tooltip('hide');
          });
        });
      </script>
<?php } 
    ?>
                           <span class="form-row" id="step_1_tooltips" data-toggle="tooltip" data-placement="left" title="<span style='cursor: pointer;' class='hidetooltip pull-right'>x</span><b>STEP 1 </b> <br> <span style='text-transform: uppercase;'> Add Name, Address and a short description of your venue, please make sure to save the before moving to step 2.</span>"><?php echo form_input($attribute_profile['title']);?></span>
                           
                             <span class="form-row ">
               <input class="input" type="address" placeholder="Address:" value="<?php echo $profilAddress;?>" name="address" id="us2-address" >
                             <input type="hidden" name="profile-address" id="profile-address" value="<?php echo $profilAddress;?>">
               <span class="address" id="address-locator" style="cursor:pointer;"></span></span>
                             <span class="form-row "><input id="profile-city"  type="hidden" value="<?php echo $profilecity;?>" name="city">
                             <input id="profile-zip" type="hidden" value="<?php echo $profilezip;?>" name="zip">
                             <input id="profile-country" type="hidden" name="country" value="<?php echo $profilecountry;?>">
                           <!--  <span class="form-row "><input id="profile-country" class="input" type="text" placeholder="Country:" value="" name="country"></span>-->
                          <input type="hidden" id="us2-radius" value="0"/>
                            <div id="us2" style="width: 100%; height: 300px;"></div>        
                           <input id="us2-lat" type="hidden" name="geo_lat"/><input id="us2-lon" type="hidden" name="geo_lang"/>
                            <script>$('#us2').locationpicker({
                                location: {latitude: <?php echo $maplat;?>, longitude: <?php echo $maplang;?>},	
                                radius: 0,
                                inputBinding: {
                                    latitudeInput: $('#us2-lat'),
                                    longitudeInput: $('#us2-lon'),
                                    radiusInput: $('#us2-radius'),
                                    locationNameInput: $('#us2-address')
                                },
								onchanged: function (currentLocation, radius, isMarkerDropped) {
													var addressComponents = $(this).locationpicker('map').location.addressComponents;
													updateControls(addressComponents);
								},
								 oninitialized: function(component) {
									var fulladd = $('#us2-address').val();
									var addr = fulladd.split(",");
									var baladd = '';
									/*for( var i = 1; i < addr.length; i++ ) {
									baladd = baladd+', '+addr[i];
									}*/
									//alert(addr[0]);alert(addr[1]);alert(addr[2]);
									var newadd = $('#profile-address').val();
									if(newadd =='') newadd = addr[0];
									$('#us2-address').val(newadd+baladd);

								 },
								 enableAutocomplete: true
                                });
                            </script>	</span>
                             <span class="form-row" ><?php echo form_textarea($attribute_profile['short_description']);?></span>
                             
               <span class="form-row ">
               <input class="input" type="text" placeholder="PHONE NUMBER" value="<?php echo $phone;?>" name="phone" id="us2-phone" ></span>
               <span class="form-row ">
               <input class="input" type="text" placeholder="EMAIL" value="<?php echo $email; ?>" name="email" id="us2-email" ></span>
               <span class="form-row ">
               <input class="input" type="text" placeholder="WEBSITE" value="<?php echo $website;?>" name="website" id="us2-website" ></span>
                        <span class="form-row" >
						<?php echo form_input($attribute_profile['submit']);?>  <?php if($step_1 == 2){ ?><img class="" src="<?php echo base_url();?>img/dashboard/icon.png" style="width: 20px;"> <?php } ?></span>
                       <?php echo form_close();?> 
                        
                     </div><!-- close box-form -->
                   </div><!-- close row -->
                   
                   <div class="row">
                   		<div class="col-lg-6 col-md-6 col-sm-6 leftbar">
                      <?php if($step_2 != 1){ if($step_3 == 1)
                          {?>

                          <script type="text/javascript">
        $(function () {
          $('#step_3_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('show');
          });

        $(function () {
          $('.hidetooltip3').on('click', function () {
            $('#step_3_tooltips').tooltip('hide');
          });
        });
      </script>

      <?php } else{
                        ?>
                          <script type="text/javascript">
        $(function () {
          $('#step_3_tooltips').tooltip({html: true, trigger: 'manual'});
          });

        $(function () {
          $('.hidetooltip3').on('click', function () {
            $('#step_3_tooltips').tooltip('hide');
          });
        });
      </script>

                        <?php } }
                        ?>
                        	 <?php if(count($opening_hours)>0)
                           {
                            ?>
                              <div class="box">
                             	  <h2 class="title">OPENING HOURS</h2>
                                <div id="errorDiv5" class="openhours-error"> </div>
                                <form id="opening_frm" 
                                accept-charset="utf-8" 
                                method="post" name="opening_frm" 
                                action="<?php echo base_url();?>establishment/profile_settings"
                                onsubmit="return ValidateOpeningHoursForm();"
                                >
                                <input type="hidden" 
                                value="OpeningHours" name="caller">
                                <input type="hidden" 
                                value="<?php echo count($opening_hours);?>" 
                                name="total_opening" id="total_opening">
                                  <div class="box-inner">
                                  	   
                                       <ul class="list2">
                                       		<?php 
                                          $k=0;
                                          foreach($opening_hours as $week)
                                          {
                                             $k++;
                                            ?>
                                          <li id="open<?php echo $k?>">
                                            	<span class="title4"><?php echo $week['name'];?></span>
                                                <span class="input-box">
                                                  <input 
                                                  name="<?php echo strtolower($week['name'])."_from";?>" 
                                                  type="text" class="input1 time start ui-timepicker-input"
                                                  value="<?php echo $week['from_time'];?>" 
                                                  id="from_<?php echo $k;?>"
                                                  autocomplete="off"
                                                  >
                                                </span>
                                                <span class="devider2">-</span>
                                                <?php  if($k == 1){ ?>
                                                <span class="input-box" id="step_3_tooltips" data-toggle="tooltip" data-placement="right" data-original-title="<span style='cursor: pointer;' class='hidetooltip3 pull-right'>x</span><b>STEP 3 </b> <br> <span style='text-transform: uppercase;'> Enter You Opening Hours Here and Please Remember to Save.</span>">
                                                <?php } else { ?> <span class="input-box"> <?php } ?>
                                                  <input name="<?php echo strtolower($week['name'])."_to";?>" 
                                                  type="text" class="input1 time end ui-timepicker-input"
                                                  value="<?php echo $week['to_time'];?>"
                                                  id="to_<?php echo $k;?>"
                                                  autocomplete="off" 
                                                  >
                                                </span>
                                            </li>
                                            <script>
												$('#open<?php echo $k?> .time').timepicker({
													'showDuration': true,
													'timeFormat': 'H:i'
												});
												var timeOnlyE<?php echo $k?> = document.getElementById('open<?php echo $k?>');
												var timeOnlyDatepair<?php echo $k?> = new Datepair(timeOnlyE<?php echo $k?>);
								
											</script>
                                           <?php } ?>
                                           <li class="li-submit"><span ><input class="change-now" type="submit" value="Save" name="form_submit"> <?php if($step_3 == 2){ ?><img class="" src="<?php echo base_url();?>img/dashboard/icon.png" style="width: 20px;"> <?php } ?></span></li>
                                            
                                           
                                       </ul>
                                  	   
                                       
                                  </div><!-- close box-inner -->
                                </form>
                             </div><!-- close box -->
                             <?php } ?>
                               
                                  <?php if($step_3 != 1){ if($step_4 == 1)
                          {?>
                               <script type="text/javascript">
        $(function () {
          $('#step_4_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('show');
          });

        $(function () {
          $('.hidetooltip4').on('click', function () {
            $('#step_4_tooltips').tooltip('hide');
          });
        });
      </script>

      <?php } else{
                        ?>
                          <script type="text/javascript">
        $(function () {
          $('#step_4_tooltips').tooltip({html: true, trigger: 'manual'});
          });

        $(function () {
          $('.hidetooltip4').on('click', function () {
            $('#step_4_tooltips').tooltip('hide');
          });
        });
      </script>
                        <?php } }
                        ?>
                             <div class="box">

                              <?php if(count($happy_hours)>0)
                              {
                               ?>
                             	  <h2 class="title">happy hour</h2>
                                <div id="errorDiv2" class="happyhours-error"> </div>
                                <form id="happy_frm" 
                                accept-charset="utf-8" 
                                method="post" name="happy_frm" 
                                action="<?php echo base_url();?>establishment/profile_settings"
                                onsubmit="return ValidateHappyHoursForm();"
                                >

                                <input type="hidden" 
                                value="HappyHours" name="caller">
                                <input type="hidden" 
                                value="<?php echo count($happy_hours);?>" 
                                name="total_happy_hours" id="total_happy_hours">

                                  <div class="box-inner">
                                  	   
                                       <ul class="list2 list3">
                                       	  <?php 
                                          $l=0;
                                          foreach($happy_hours as $week)
                                          {
                                           $l++;
                                           ?>	
                                            <li id="happy<?php echo $l?>">
                                            	<span class="checkbox-box3">
                                                <input 
                                                type="checkbox"  
                                                name="<?php echo strtolower($week['name'])."_is_active";?>"  
                                                id="<?php echo strtolower($week['name'])."_is_active";?>" 
                                                value="1" 
                                                <?php if($week['is_active']=='1'){?>
                                                checked="checked"
                                                <?php } ?>
                                                />
                                                <label for="<?php echo strtolower($week['name'])."_is_active";?>"></label>
                                              </span>
                                            	<span class="title4"><?php echo $week['name'];?></span>
                                                <span class="input-box">
                                                 <input 
                                                  name="<?php echo strtolower($week['name'])."_frm";?>" 
                                                  type="text" class="input1 time start ui-timepicker-input"
                                                  value="<?php echo $week['from_time'];?>" 
                                                  id="frm_<?php echo $l;?>"
                                                  autocomplete="off" 
                                                  >
                                                </span>
                                                <span class="devider2">-</span>

                                                <?php if($l == 1) { ?>
                                                <span class="input-box" id="step_4_tooltips" data-placement="right" data-original-title="<span style='cursor: pointer;' class='hidetooltip4 pull-right'>x</span><b>STEP 4 (OPTIONAL) </b> <br> <span style='text-transform: uppercase;'> Enter You Happy Hours Here and If Any Please Remember to Save.</span>">
                                                <?php } else { ?>
                                                <span class="input-box">
                                                  <?php } ?>
                                                  <input name="<?php echo strtolower($week['name'])."_t";?>" 
                                                  type="text" class="input1 time end ui-timepicker-input"
                                                  value="<?php echo $week['to_time'];?>"
                                                  id="t_<?php echo $l;?>" 
                                                  autocomplete="off" 
                                                  >
                                                </span>
                                            </li>
                                            <script>
												$('#happy<?php echo $l?> .time').timepicker({
													'showDuration': true,
													'timeFormat': 'H:i'
												});
												var timeOnlyH<?php echo $l?> = document.getElementById('happy<?php echo $l?>');
												var timeOnlyDatepairH<?php echo $l?> = new Datepair(timeOnlyH<?php echo $l?>);
								
											</script>
                                          <?php } ?>
                                            <li class="list-submit"><span ><input class="change-now" type="submit" value="Save" name="form_submit"> <?php if($step_4 == 2){ ?><img class="" src="<?php echo base_url();?>img/dashboard/icon.png" style="width: 20px;"> <?php } ?></span></li>
                                            
                                            
                                           
                                       </ul>
                                  	   
                                       
                                  </div><!-- close box-inner -->
                                  <?php echo form_close();?>
                                  <?php } ?>

                             </div><!-- close box -->
                        
                        	 <div class="box">
                                <h2 class="title">Change Email/password</h2>
                                  <div class="box-inner">
                                       <h3>change your email/password:</h3>
                                       <?php
                                    echo form_open(base_url()."establishment/profile_settings",$attribute['form']);
                                    echo form_hidden('caller','Send');
      ?>
                                       <span class="form-row">
                                       	<?php echo form_input($attribute['email']);?>
                                         <?php echo form_error('email', '<div class="error">', '</div>').'<div class="error">'.$msg_email.'</div>'; ?>
                                       </span>
                                       <span class="form-row">
                                       </span>
                                       <br/>
                                       <span class="form_box">
                                        <?php echo form_input($attribute['password']);?>
                                        <?php echo form_input($attribute['re_password']);?> 
                                        </span>
                                         <div class="change_pwd_content">
                                        <?php echo form_error('password', '<div class="error">', '</div>').'<div class="error">'.$msg.'</div>'; ?>
                                       <?php echo form_error('re_password', '<div class="error">', '</div>'); ?>
                                        </div>
                                       <?php echo form_input($attribute['submit']);?>
                                       <?php echo form_close();?>
                                  </div><!-- close box-inner -->
                             </div><!-- close box -->
                        </div><!-- close leftbar -->
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 rightbar">
                        	 <div class="box">
                             	  <h2 class="title">Your account:?<span class="free">
                                  <?php if(!empty($premium_date))
                                  {?> PREMIUM <?php } else {?>FREE <?php } ?></span></h2>
                                  <div class="box-inner">
                                        <?php if(empty($premium_date)){?>
                                        <!--<a href="<?php echo base_url();?>establishment/upgrade" class="yellow-button align-center" >Upgrade now</a>-->
                                        <a href="javascript:void(0);" class="yellow-button align-center" style="cursor:none; background:#D1D1D1;" >Upgrade now</a>
                                        <?php } ?>
                                       <div class="js-dialog  modal  dialog" id="popup2" style="text-align: center;">
			<span class="modal-close-btn"></span>
			<div class="popup-box">


                   <?php
                      echo form_open(base_url()."establishment/profile_settings",$attribute_update_card['form']);
                      echo form_hidden('caller','Update Card');
                    ?>
                   <h2>Please update your<br>payment details here</h2>
                                      <div id="errorDiv1" style=" <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?>       </div>

                   
                   <span class="popup-form">
                       <span class="form-box1"><?php echo form_input($attribute_update_card['first_name']);?></span>
                       
                       <span class="form-box1"><?php echo form_input($attribute_update_card['last_name']);?></span>
                   </span>
                   
                   <span class="popup-form"><?php echo form_input($attribute_update_card['card_number']);?></span>
                 
                   <span class="popup-form">
                       <span class="form-box2"><?php echo form_input($attribute_update_card['exp_month']);?></span>
                       <span class="devider"></span>
                       <span class="form-box2"><?php echo form_input($attribute_update_card['exp_year']);?></span><span class="devider"></span>
                       <span class="form-box2"><?php echo form_input($attribute_update_card['code']);?></span>
                      
                   </span>
                   <span class="button-row"><span class="visa"><img src="<?php echo base_url();?>images/visa.png"></span>


                  <?php echo form_submit($attribute_update_card['submit']);?>
             <?php echo form_close();?>
              </div><!-- close popup-box -->

		</div>
                                       
                                       
                                       
                                  </div><!-- close box-inner -->
                             </div><!-- close box -->
                             
                             <div class="box">
                                <h2 class="title">Payment options<span class="edit"><!--<a data-cta-target="#popup2" href="#">edit</a>--></span></h2>
                                  <div class="box-inner" style="background:#D1D1D1;">
                                       <?php if(!empty($card_info['card_number'])) { ?> <span class="card-detail">Visa x - <?php echo substr($card_info['card_number'],1,4);?> - xxxx - xxxx - xxxx</span>
                                       <?php }
									   else
									   { ?>
                                       <span class="card-detail">Visa x - 1236 - xxxx - xxxx - xxxx</span>
                                       <?php } ?>
                                       <span class="view-account-history"><!--<a href="<?php echo base_url();?>establishment/account_history">View account history</a>--></span>
                                  </div><!-- close box-inner -->
                             </div><!-- close box -->
                             
                             <?php if($step_3 != 1){ if($step_5 == 1)
                          {?>
                             
                               <script type="text/javascript">
        $(function () {
          $('#step_5_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('show');
          });

        $(function () {
          $('.hidetooltip5').on('click', function () {
            $('#step_5_tooltips').tooltip('hide');
          });
        });
      </script>

      <?php } else{
                        ?>
                          <script type="text/javascript">
        $(function () {
          $('#step_5_tooltips').tooltip({html: true, trigger: 'manual'});
          });

        $(function () {
          $('.hidetooltip5').on('click', function () {
            $('#step_5_tooltips').tooltip('hide');
          });
        });
      </script>

                        <?php } }
                        ?>
                             <div class="box">
                             	  <h2 class="title">Choose facilities here</h2>
                                  <div class="box-inner">
                                  	   <div class="list">
                                    <form id="facility_frm" accept-charset="utf-8"
                                     method="post" name="facility_frm" action="<?php echo base_url();?>establishment/profile_settings">
                                     <input type="hidden" name="caller" value="facility" />
                               <ul>  

                              <?php      
                              $i=0;                    
                              foreach($facilities as $facility)
                              {
                                  $i++;

                              ?>
                                <li>

                                    <?php //
                                      if($facility['type']=='check'){ ?>
                                      <?php if($i == 1) { if($step_5 == 1) { ?>
                                  <span class="checkbox-box3" id="step_5_tooltips" data-toggle="tooltip" data-placement="right" data-original-title="<span style='cursor: pointer;' class='hidetooltip5 pull-right'>x</span><b>STEP 5 </b> <br> <span style='text-transform: uppercase;'> Choose the different facilities you have available in your venue.</span>">

                                  <?php } else {

                                    ?>
                                      <span class="checkbox-box3">
                                    <?php
                                    } } else { ?>
                                                <span class="checkbox-box3">
                                                  <?php } ?>

                                        <input 
                                          type="checkbox" 
                                          name="facility[]" 
                                          id="<?php echo $facility['icon'];?>"   
                                          value="<?php echo $facility['id'];?>" 
                                          <?php 
                                            if( $facility['is_checked'] == 'true'){ 
                                              ?> 
                                              checked="checked"
                                              <?php 
                                          } ?>  
                                     />
                                     <label for="<?php echo $facility['icon'];?>" ></label>
                                 </span>
                                  
                                  <span class="<?php echo $facility['icon'];?>"></span>
                                  <?php echo $facility['name'];?>

                                    <?php } 
                                      if($facility['type']=='text'){?>
                                      <?php if($i == 1) { ?>
                                   <span class="checkbox-box3" id="step_5_tooltips" data-toggle="tooltip" data-placement="right" title="<span style='cursor: pointer;' class='hidetooltip5 pull-right'>x</span><b>STEP 5 </b> <br> <span style='text-transform: uppercase;'> Choose the different facilities you have available in your venue.</span>">

                                    <?php } else { ?>
                                                <span class="checkbox-box3">
                                                  <?php } ?>

                                        <input 
                                          type="checkbox" 
                                          id="<?php echo $facility['icon'];?>"   
                                          <?php 
                                            if( $facility['is_checked'] != ''){ 
                                              ?> 
                                              checked="checked"
                                              <?php 
                                          } ?>  
                                     />
                                     </span>   
                                  <span class="<?php echo $facility['icon'];?>"></span>
                                  <span class="txtfac"><?php echo $facility['name'];?></span>
                                
                                        <input 
                                          type="text" 
                                          name="<?php echo $facility['name'];?>" 
                                          id="<?php echo $facility['icon'];?>"   
                                          class= "facility_text"
                                          size="8"
                                          value="<?php echo $facility['is_checked'];?>" 
                                     />
                                     <label for="<?php echo $facility['icon'];?>" ></label>
                              
                                  
                                   <?php } 
									
									?>
                                </li>
                                    
                               <?php } ?>
<!--                                end of loop     -->                                    

                            <li class="facility-submit"><input class="change-now" type="submit" value="Save" name="form_submit"> <?php if($step_5 == 2){ ?><img class="" src="<?php echo base_url();?>img/dashboard/icon.png" style="width: 20px;"> <?php } ?></li>
                                    
                              </ul>

                        <?php echo form_close();?>
                         </div><!-- close box-inner -->
                             </div><!-- close box -->
                             
                             
                        </div><!-- close rightbar -->
                   </div><!-- close row -->
                   <div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=8255706607fc613d355&width=728&height=90"></script></div>
              </div><!-- close profile-setting -->
         </div><!-- close container -->
  
    <div class="col-md-2">
      <div class="row">
        <div class="col-md-12" style="background: #182847; margin-top: 15px; height: 300px;">&nbsp;</div>
        <div class="col-md-12" style="background: #182847; margin-top: 15px; height: 300px;">&nbsp;</div>
        <div class="col-md-12" style="background: #182847; margin-top: 15px; height: 300px;">&nbsp;</div>
        <div class="col-md-12" style="background: #182847; margin-top: 15px; height: 300px;">&nbsp;</div>
        <div class="col-md-12" style="background: #182847; margin-top: 15px; height: 300px;">&nbsp;</div>
        <div class="col-md-12" style="background: #182847; margin-top: 15px; height: 300px;">&nbsp;</div>
      </div>
    </div>
    
    
    
    
    
  </div><!--close wrapper-->
    
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/establishment/core.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
  });
  </script>
    
    <!-- jQuery 2.1.3 -->
    
    <!-- jQuery UI 1.11.2 -->
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script>
  <!-- common script-->
    
     <script src="<?php echo base_url();?>js/establishment/cta.js"></script>
   <script>
    var closeFn;
    function closeShowingModal() {
      var showingModal = document.querySelector('.modal.show');
      if (!showingModal) return;
      showingModal.classList.remove('show');
      document.body.classList.remove('disable-mouse');
      if (closeFn) {
        closeFn();
        closeFn = null;
      }
    }
    document.addEventListener('click', function (e) {
      var target = e.target;
      if (target.dataset.ctaTarget) {
        closeFn = cta(target, document.querySelector(target.dataset.ctaTarget), { relativeToWindow: true }, function showModal(modal) {
          modal.classList.add('show');
          document.body.classList.add('disable-mouse');
        });
      }
      else if (target.classList.contains('modal-close-btn')) {
        closeShowingModal();
      }
    });
    document.addEventListener('keyup', function (e) {
      if (e.which === 27) {
        closeShowingModal();
      }
    });
	
	function updateControls(addressComponents) {
		
    $('#profile-address').val(addressComponents.addressLine1);
	//alert(addressComponents.streetNumber);
    $('#profile-city').val(addressComponents.city);
    $('#profile-zip').val(addressComponents.postalCode);
    $('#profile-country').val(addressComponents.country);
	}
	$( document ).ready(function() {
		
		 
	});
	$('#us2-address').keydown(function (e) {
	  if (e.which == 13 && $('.pac-container:visible').length) return false;
	});

	/* $(function() {
	$('#address-locator').click(function(){
		var mapstatus =$('span#show-map').css("display");
		alert(mapstatus);
		if(mapstatus =='none'){$('span#show-map').css("display", "block");setTimeout(function(){ $('#us2').locationpicker('autosize');}, 300);}
		else $('span#show-map').css("display", "none");
		});
		 });*/
    </script>
  </body>
</html>