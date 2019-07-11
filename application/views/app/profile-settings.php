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
    	 <div class="container">
         	  <div class="profile-setting">
              	   
				        
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
                         <a class="yellow-button align-center" href="<?php echo base_url();?>establishment/profile_image">Go to image gallery</a>
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
                           <span class="form-row"><?php echo form_input($attribute_profile['title']);?></span>
                           
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
									for( var i = 1; i < addr.length; i++ ) {
									baladd = baladd+', '+addr[i];
									}
									//alert(addr[0]);alert(addr[1]);alert(addr[2]);
									var newadd = $('#profile-address').val();
									if(newadd =='') newadd = addr[0];
									$('#us2-address').val(newadd+baladd);

								 },
								 enableAutocomplete: true
                                });
                            </script>	</span>
                             <span class="form-row" ><?php echo form_textarea($attribute_profile['short_description']);?></span>
                        <span class="form-row" >
						<?php echo form_input($attribute_profile['submit']);?></span>
                       <?php echo form_close();?> 
                        
                     </div><!-- close box-form -->
                   </div><!-- close row -->
                   
                   <div class="row">
                   		<div class="col-lg-6 col-md-6 col-sm-6 leftbar">
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
                                                <span class="input-box">
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
                                           <li class="li-submit"><span ><input class="change-now" type="submit" value="Save" name="form_submit"></span></li>
                                            
                                           
                                       </ul>
                                  	   
                                       
                                  </div><!-- close box-inner -->
                                </form>
                             </div><!-- close box -->
                             <?php } ?>
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
                                                <span class="input-box">
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
                                            <li class="list-submit"><span ><input class="change-now" type="submit" value="Save" name="form_submit"></span></li>
                                            
                                            
                                           
                                       </ul>
                                  	   
                                       
                                  </div><!-- close box-inner -->
                                  <?php echo form_close();?>
                                  <?php } ?>
                             </div><!-- close box -->
                        
                        	 <div class="box">
                                <h2 class="title">Change password</h2>
                                  <div class="box-inner">
                                       <h3>change your password:</h3>
                                       <?php
                                    echo form_open(base_url()."establishment/profile_settings",$attribute['form']);
                                    echo form_hidden('caller','Send');
      ?>
                                       <span class="form_box">
                                     
                                        <?php echo form_input($attribute['password']);?>
                                        <?php echo form_input($attribute['re_password']);?> 
                                        </span> <div class="change_pwd_content">
                                        <?php echo form_error('password', '<div class="error">', '</div>').$msg; ?>
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
                                      if($facility['type']=='check'){?>
                                  <span class="checkbox-box3">
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
                                   <span class="checkbox-box3">
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

                            <li class="facility-submit"><input class="change-now" type="submit" value="Save" name="form_submit"></li>
                                    
                              </ul>

                        <?php echo form_close();?>
                         </div><!-- close box-inner -->
                             </div><!-- close box -->
                             
                             
                        </div><!-- close rightbar -->
                   </div><!-- close row -->
                   
              </div><!-- close profile-setting -->
         </div><!-- close container -->
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