<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<!-- Bootstrap -->
<link href="<?php echo base_url();?>css/promotion/aditional-style.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/tv_schedule.js"></script>
<script src="<?php echo base_url();?>js/establishment/form_validation.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/tv_schedule.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<title> Sportshub</title>
<!--navigation-->
<?php $this->load->view('promotion/head');?>
<?php $this->load->view('promotion/google_analytics');?>

 <script>
function showButton(){
  $("#sub_btn1").removeClass('deactive');
  $("#form_id_1").removeClass('deactive');

   initialize_map();
}

function showButtonabout(){
  $("#sub_btn_about").removeClass('deactive');
  //$("#form_input").removeClass('deactive');
}
function showButtoncontact(){
  $("#sub_btn_contact").removeClass('deactive');
  //$("#form_input").removeClass('deactive');
}



function showButtonoffer(){

  $("#sub_btn_offer").removeClass('deactive');
  //$("#form_input").removeClass('deactive');
}

function showButtonEvent(){

  $("#sub_btn_event").removeClass('deactive');
  //$("#form_input").removeClass('deactive');
}

function showButtonopeninghour(){

  $("#openinghour_").removeClass('deactive');
  $("#oldopening_").addClass('deactive');
  
  
}

function showButtonhappyhour(){

  $("#happyhr_show").removeClass('deactive');
  $("#happyhr_hide").addClass('deactive');
 
}

function funmaphidden(){

  $("#happyhr_show").removeClass('deactive');
  $("#happyhr_hide").addClass('deactive');
 
}

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#button_event").click(function(e){
    $("#form_input_event").removeClass('deactive');
    e.preventDefault();         
    })
 });

</script>

<style type="text/css">
  vertical-align: baseline;
  span { vertical-align: none;}
</style>
</head>


<body> 

   <?php
  $date_t=date("Y-m-d H:i:s");
  $date_t=date("Y-m-d");
  $do_from = $date_t." 00:00:00";
   //echo $date_t;

   $sync_date = gmdate("Y-m-d H:i:s", strtotime($date_t.'+ 1 hour'));
   $sync_do_date = gmdate("Y-m-d H:i:s", strtotime($do_from));
  // echo $sync_do_date;
  $this->load->model('Promotion_model');
    $this->load->model('Establishment_model');
    $id=$this->session->userdata('email');
        $user_ids=$this->Establishment_model->GetUserId($id);
        $est_ref_ids=$user_ids[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_ids = $this->Establishment_model->GetEstId($est_ref_ids);
        $est_ref_ids=$est_info_ids[0]->id;
        //echo json_encode($est_ref_ids);

         $print_message=$this->Promotion_model->printschedule($est_ref_ids, $sync_date);
                           // echo json_encode($print_message);

         //$print_message = $this->db->select('*')->from('establishment_schedule')->where('establishment_ref', $est_ref_ids)->limit(1)->get()->row(); 
   ?>

 <input type="hidden" name="est_ref_ids" id="est_ref_ids" value="<?php echo $est_ref_ids?>">
   <input type="hidden" name="sync_date" id="sync_date" value="<?php echo $sync_date?>">



<?php 
 $this->load->model('Establishment_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_user_ref_id=$user_id[0]->id;
        $establishmentuser_id=$this->Establishment_model->GetUseresiinfoId($est_user_ref_id);
        $user_est_info=$establishmentuser_id[0]->id;
        $user_data=$this->Establishment_model->GetUserSubs($user_est_info);

        foreach ($user_data as $key => $value) {

          $first_date=$value->created_on;
          $subscription_end_date=$value->subscription_end;
        }

        $current_date=date('Y-m-d');
        
		// Enabled 
		$end_date=date('Y-m-d  H:i:s',strtotime('+30 days',strtotime($first_date)));

		// Disable payment method: modified by Bagyaraj Sekar on Sep, 06 2018. To enable Payment method, comment the following 2 lines.
       
		$end_date=date('Y-m-d  H:i:s',strtotime('+30 days',strtotime($current_date)));
		$subscription_end_date =date('Y-m-d  H:i:s',strtotime('+30 days',strtotime($current_date)));
?>



<div class="preloader">
  <div class="status">
    
  </div>
</div>

<?php if($rav_=="24"){ ?>
<div class="thanku-popup">

<div class="modal-content_2" >
      <p align="center" style="font-size: 20px;">Thank you for signing up! <br/> To publish your bar on 
    
    Sportshub<span style="color:#e1c124; font-size: bold;">365</span><br/> Edit and save the two required option.<br/></p>
  <p align="center" id="button" style="position: relative;top: 20px; "><span class="close_1" style="font-size: 48px; ">&times;</span></p>
   <br/>
<span id="num" style="text-align:center;font-size: 15px;line-height: 25px;">
<span id="countdowntimer" class="countdowntimer" style=" -moz-border-radius: 50px/50px; -webkit-border-radius: 50px 50px; border-radius: 50px/50px; border: solid 1px #fff; width: 25px; height: 25px; text-align:center;" >5 </span>
</span>
  </div>
 
</div>
 <?php } ?>
<div id="wrapper">
<?php if($this->session->userdata('email'))
 { 
  $this->load->view('promotion/profile_update_header');
 }
?>


 <script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAGpWnddDz6h7aXstNioOfjj8s4SqXKYXY'></script>
 <script src="<?php echo base_url();?>js/locationpicker.jquery.js"></script>

 <?php
               //print_r($profile_detail);
               $titleA = (!empty($profile_detail['title'])) ? $profile_detail['title'] : '';
               $profilAddress = (!empty($profile_detail['address'])) ? $profile_detail['address'] : '';
               $phone = (!empty($profile_detail['phone'])) ? $profile_detail['phone'] : '';
               $website = (!empty($profile_detail['website'])) ? $profile_detail['website'] : '';
               $contact_email = (!empty($profile_detail['contact_email'])) ? $profile_detail['contact_email'] : '';
               $profilecity = (!empty($profile_detail['city'])) ? $profile_detail['city'] : '';
               
               $profiledesc = (!empty($profiledetails['short_description'])) ? $profiledetails['short_description'] : '';

               $profilezip = (!empty($profile_detail['zip'])) ? $profile_detail['zip'] : '';
               $profilecountry = (!empty($profile_detail['country'])) ? $profile_detail['country'] : '';
               $profilelat = (!empty($profile_detail['geo_lat'])) ? $profile_detail['geo_lat'] : '';
               $profilelang = (!empty($profile_detail['geo_lang'])) ? $profile_detail['geo_lang'] : '';
               $maplat = (!empty($profilelat)) ? $profilelat : '40.46366700000001';
               $maplang = (!empty($profilelang)) ? $profilelang : '-3.7492200000000366';
                                   
     ?> 

     

          
     <?php



        $this->load->model('Establishment_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Establishment_model->GetEstId($est_ref_id);
        $bar_id_=$est_info_id[0]->id;
        $est_user_image_ref_id=$est_info_id[0]->id;
        //echo json_encode($est_ref_id);exit;
        //echo json_encode($est_user_image_ref_id);exit;
        $establishment_banner_id=$this->Establishment_model->GetUseresbanneriinfoId($est_user_image_ref_id);
       
              if($establishment_banner_id){

                foreach ($establishment_banner_id as $key => $value) {
                  if($value->default_image==1){

                    if($value->picture){
                    //echo $value->picture;
               ?>
               
             <div style="float: left; width: 100%; background:url(<?php echo base_url();?>/images/profile/<?php echo $value->picture;?>) no-repeat scroll center 0 /cover; min-height: 297px; position: relative; text-align: center; box-shadow: inset 200px 200px 200px 200px rgba(0, 0, 0, 0.6); ">
              <?php } } } }else{?>
               <div style="float: left; width: 100%; background:url(<?php echo base_url();?>/images/profile/default.jpg) no-repeat scroll center 0 / cover; min-height: 297px; position: relative; text-align: center; box-shadow: inset 200px 200px 200px 200px rgba(0, 0, 0, 0.6); ">
              <?php } ?>


        <div class="layer">
               <div class="container">
                       <div class="slider_text5">
                         <h2><?php  if(isset($profiledetails['title'])) echo $profiledetails['title'];?></h2>
                         <?php //if($gamedetails){?>
                         <!--<h4><span class="yellow"><?php //echo $gamedetails['team1name'];?> vs. <?php //echo $gamedetails['team2name'];?>
                         </span>-->
                       <!-- <span class="yellow"><?php //echo $gamedetails['date_time'];?> - <?php //echo $gamedetails['cname'];?> 
                        </span>
                        </h4> -->
                         <?php //}
             //else{?>
             <?php //if(count($schedules1) > 0){?>
                          <!--<h4><span class="yellow"><?php echo $schedules1[0]['team1'];?> vs. <?php echo $schedules1[0]['team2'];?></span>
                         <br /><span class="yellow">-->
                         <?php //echo $schedules1[0]['date_time'];?>-<!--<?php //echo $schedules1[0]['competition_name'];?></span></h4>-->
                         <?php //} ?>
                         <?php // } ?>
                    </div>
               </div>
          </div>



           <?php if($this->session->userdata('email'))
           { ?>

             <a class="tooltip1 btn1 btn-info btn-lg show_banner_form" >
             Upload Bar photo's
                     <span class="tooltiptext1 tooltip-bottom1 ">
             <span style="color:yellow; font: bold;">PRO TIP: </span>Make sure your banner image shows the entrance <br/>it will make it easier for customer to find you.</span>
                    </a>
           <?php } ?>



           <!-- add section start-->
             
           <!-- add section end-->
          <!--<div class="banner_bottom">
               <div class="container">
                  <span class="prev"><a href="<?php echo base_url();?>venue">VENUES</a></span>
                    <span class="next"><a href="<?php echo base_url();?>sportsfans">SPORTS LOVERS</a></span>
               </div>
          </div>--><!--close banner_bottom-->
     </div></div><!--close banner-->
     
     <div id="content">
     <div class="section8">
               <div class="container">
                  <div class="address1">
                       <h4>ADDRESS <span>
                          <?php
                          if($this->session->userdata('email'))
                            {?>
                        <button type="button" onclick="showButton()" class="btn2 btn-info button_div">Edit</button><span id="sub_btn1" class="deactive"><?php echo form_submit('submit', 'Save', "class='submit1 btn2 btn-info1'"); ?></span>&nbsp;&nbsp;<?php if(isset($profiledetails['address'])=='') {?><span style="color:red; font-size:12px;"><?php echo "*Required"; ?></span><?php } }?> </span></h4>

                         <div id="old_details">
                         <p>
                        <?php if(isset($profiledetails['address']))echo $profiledetails['address'];?><br/>
                        <?php if(isset($profiledetails['city']))echo $profiledetails['city'];?><br/>
                        <?php if(isset($profiledetails['zip']))echo $profiledetails['zip'];?><br/>
                        
                        </p>
                        </div>

                        <div id="form_id_1" class="deactive">
                        <div id="form_input" class="">            
                       <span class="form-row " id="form_id" style="margin-top:10px;">
                         
           <input class="input testadd" type="address" placeholder="Address:" value="<?php echo $profilAddress; ?>" name="address" id="us2-address">
                             <input type="hidden" name="profile-address" id="profile-address" value="<?php echo $profilAddress;?>">
                            <span class="address" id="address-locator"></span></span>
                             <span class="form-row "><input id="profile-city"  type="hidden" value="<?php echo $profilecity;?>" name="city">
                             <input id="profile-zip" type="hidden" value="<?php echo $profilezip;?>" name="zip">
                             <input id="profile-country" type="hidden" name="country" value="<?php echo $profilecountry;?>">
                           <!--  <span class="form-row "><input id="profile-country" class="input" type="text" placeholder="Country:" value="" name="country"></span>-->
                          <input type="hidden" id="us2-radius" value="0"/>
                          <div style="height:100%; width:100%;">


                    
                            <div id="us2"></div>
                        


                            </div>
                           <input id="us2-lat" type="hidden" name="geo_lat"/><input id="us2-lon" type="hidden" name="geo_lang"/>
                           
                            <style>
                                .pac-container {
                                    z-index: 10000 !important;
                                }
                            </style>
                            <script>
                            function initialize_map(){
                            $('#us2').locationpicker({
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
                          }
                            </script> </span>


                  
                      </div>
                     
                      <!--<input id="profile_address_form" class="change-now" name="form_submit" value="Save" type="button">-->
                      <?php echo form_close(); ?>
                      </div>
                        <script type="text/javascript">
                                       
                                    
                        // Ajax post
                        $(document).ready(function() {
                        $(".submit1").click(function(event) {
                        event.preventDefault();
                    
                        var address_ = $("input#us2-address").val();
                        var city_ = $("input#profile-city").val();
                        var zip_ = $("input#profile-zip").val();
                        var country_ = $("input#profile-country").val();
                        var geo_lat_ = $("input#us2-lat").val();
                        var geo_lang_ = $("input#us2-lon").val();
                        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/updateAddress",
                        dataType: 'json',
                        data: {address: address_, city: city_, zip: zip_, geo_lat: geo_lat_, geo_lang: geo_lang_},
                        success: function() {
                        $("#old_details").load("LiveBar/loadaddress");
                        $("#latitude_map").load("LiveBar/loadmapdata");
                        }
                        });
                        });
                        });
                        </script>

                        <script type="text/javascript">
                          $(document).ready(function(){
                            $("#button_div").click(function(e){
                            //$("#form_input").removeClass('deactive');
                            //$("#sub_btn1").removeClass('deactive');
                                 e.preventDefault();         
                            })
                        });
                        </script>

                         <script>
                                 $(document).ready(function(){
                                $(".btn-info1").hide();
                                $("#form_input").hide();
                                $(".button-info1").hide();
                            
                                $(".button_div").click(function(){
                                $("#old_details").hide();
                                $(".btn-info1").show();
                                $("#form_input").show();
                                $(".button_div").hide();
                                });

                                $(".btn-info1").click(function(){
                                $("#old_details").show();
                                $(".btn-info1").hide();
                                $("#form_input").hide();
                                $(".button_div").show();
                                
                            });
                        });
                        </script> 
                        <p>
                          
                        <?php echo "<span id='address'> </span>";?><br/>
                        <?php  echo "<span id='city'> </span>";?><br/>
                        <?php echo "<span id='zip'> </span>";?>
                        
                        </p>
                        


           <div id="latitude_map">

            <?php if(isset($profiledetails['geo_lat']) && isset($profiledetails['geo_lang'])){ ?>
                    <a href="http://maps.google.com/?q=<?php echo $profiledetails['geo_lat'];?>,<?php echo $profiledetails['geo_lang'];?>" target="_blank"><span class="yellow1" style="color: #777777;">Find on map view</span></a><span class="spanmore3" style="color: #777777;">></span>
                         <?php } ?>
                         </div>

                       <br/><br/>

                          <?php if ($this->session->userdata('email')){?>
                         <a href="" target="_blank"><span class="yellow1">ADVANCE SETTING</span></a><span class="spanmore3">></span>
                  
                             <li><a style="color: #585858;"  href="<?php echo base_url();?>establishment/my_tv_schedule/" target="_blank">
                             <span class="set-li"> - PRINT SCHEDULE</span></a></li>
                             <li><a style="color: #585858;"  href="<?php echo base_url();?>establishment/tv_provider_channel/" target="_blank">
                             <span class="set-li"> - PERSONALIZE CHANNEL</span></a></li>
                             <li><a style="color: #585858;"  href="<?php echo base_url();?>establishment/schedule/" target="_blank">
                             <span class="set-li"> - PERSONALIZE SCHEDULE</span></a></li>
                             <li><a style="color: #585858;"  href="<?php echo base_url();?>establishment/profile_settings/" target="_blank">
                             <span class="set-li"> - AND OTHER</span></a></li>
                             <?php }?>
                    </div>


  <div id="sub_btn_a" class="modal_" style=" background-color: rgba(24, 40, 70, 0.53);z-index: 4;">

  <!-- Modal content -->
  <div class="modal-content_2">
    <p align="center"><span class="close_1" style="font-size: 40px;margin-bottom: 20px;">&times;</span></p>
    <p align="center" style="font-size: 30px;font-family: 'FjallaOneRegular';"></p>
    <p align="center" style="font-family: 'FjallaOneRegular';">Your Bar is live on Sportshub<span style="color:#e1c124;font-family: 'FjallaOneRegular'; font-size: bold;">365</span></p>
   <p></p>
   <div type="button" class="tooltip1 btn1 btn-info btn-lg popup-btn" ><a href="<?php echo base_url();?>promotion/bar/<?=$bar_id_?>/" target="_blank"><span style="color: #fff;">Visit Site</span></a> </div>

  </div>

</div>

                    
                    <div class="address2">
                    <h4>ABOUT
                    <span> <?php
                      if($this->session->userdata('email'))
                            {?>
                   <button type="button" onclick="showButtonabout()" id="button_about" class="btn2 btn-info button_div_about button_about button_lg_edit">
                   Edit</button>
                   <span id="sub_btn_about" class="deactive"><?php echo form_submit('submit', 'Save', "class='submit_about button_lg_edit btn2 btn-info2 btn-about'"); ?></span>
           <?php if(!isset($profiledetails['short_description'])){?>
                   <span style="color:red;font-size: 12px;"><?php echo "*Required"; ?></span><?php }
           else{ ?><span style="color:black;font-size: 12px; "></span>
           <?php } }?> 
                   </span></h4>

                    <?php //print_r($profiledetails);?>
                     <div id="old_about">
                    <?php if(isset($profiledetails['short_description'])){?>
                    <?php echo $profiledetails['short_description'];?>
                    <?php } 
                      else{
                        ?>
                    <?php } ?></div>

                        <div id="form_input5" class="deactive">            
                       <span class="form-row" style="margin-top:10px;">
                       
                       <textarea id="description" name="short_description" required="required"><?php echo $profiledesc;?></textarea>
              
                   <script>
                CKEDITOR.replace( 'description' );
              </script>
             </span>
                          
            
                        
                      <!--<?php// echo form_input($attribute_profile['submit']);?> --> 
                      
                      <!--<input id="profile_address_form" class="change-now" name="form_submit" value="Save" type="button">-->
                      <?php echo form_close(); ?>
                      
                        <script type="text/javascript">
                                       
                                    
                        // Ajax post
                        $(document).ready(function() {
                        $(".submit_about").click(function(event) {
                        event.preventDefault();
                        var short_description1_ = $("#description").val();
                       
                      var short_description1_ = CKEDITOR.instances.description.getData(); 
                      btn1.onclick = function() {
                          modal_2.style.display = "block";
                          };  
                      jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/updateAbout",
                        dataType: 'json',
                        data: {short_description: short_description1_},
                        success: function(res) {
                           modal_2.style.display = "block";
                           $("#old_about").load("LiveBar/loadabout"); 
                        },
                        error: function(xhr) { // if error occured
                          $('.preloader').hide();
                          //alert('All Field Required')
                          
                          //err_msg_box.style.display = "block";
                          
                        },
                        complete: function() {
                          // btn1.onclick = function() {
                          modal_2.style.display = "block";
                         // };
                        },


                        }).done(function(data) {
                               // btn1.onclick = function() {
                          //modal_2.style.display = "block";
                     // };
                              });
                        });
                        });
                        </script>

                        <script type="text/javascript">
                          $(document).ready(function(){
                            $("#button_about").click(function(e){
                            $("#form_input5").removeClass('deactive');
                                 e.preventDefault();         
                            })
                        });
                        </script>

                         <script>
                                $(document).ready(function(){
                                $(".btn-about").hide();
                                $("#form_input5").hide();
                            
                                $("#button_about").click(function(){
                                $("#old_about").hide();
                                $(".btn-about").show();
                                $("#form_input5").show();
                                $("#button_about").hide();
                                
                            });

                                $(".btn-about").click(function(){
                                $("#old_about").show();
                                $(".btn-about").hide();
                                $("#form_input5").hide();
                                $("#button_about").show();
                                
                            });


                        });
                        </script> 
                       
                        <?php echo "<span id='short_description'> </span><br/>";?>
                      
</div>


<div class="contact-div">

                    <h4>Contact <span style="font-size: 12px;"> <?php
                      if($this->session->userdata('email'))
                            {?>
                        <button type="button" onclick="showButtoncontact()" id="button_contact" class="btn2 btn-info button_div_contact button_lg_edit">Edit</button><span id="sub_btn_contact" class="deactive"><?php echo form_submit('submit', 'Save', "class='submit_contact btn2 button_lg_edit btn-info2 btn-contact'"); ?></span>&nbsp;&nbsp;( Optional )<?php  }?> </span></h4>

                     <div>
                        <div id="form_input6" class="deactive">            
                       
                                             
                      <span class="form-row ">
                       <input class="input" type="tel" placeholder="PHONE NUMBER" value="<?php echo $phone;?>" name="phone" id="phone" required></span>
                      <span class="form-row ">
                 <input class="input" type="email" placeholder="EMAIL" value="<?php echo $contact_email; ?>" name="contact_email" id="contact_email" ></span>
                       <span class="form-row ">
                       <input class="input" type="website" placeholder="WEBSITE" value="<?php echo $website;?>" name="website" id="website" ></span>

            
                        
                      <!--<?php// echo form_input($attribute_profile['submit']);?> --> 
                      </div>
                      <!--<input id="profile_address_form" class="change-now" name="form_submit" value="Save" type="button">-->
                      <?php echo form_close(); ?>
                      </div>

                      <div id="old_contact" class="loadcontactdetails">

                    <p>Phone:         <?php if(isset($profiledetails['phone'])){echo $profiledetails['phone']; }else {echo "--";}?><br/>
                    Mail:              <?php if(isset($profiledetails['contact_email'])){echo $profiledetails['contact_email']; }else {echo "--";}?>  <br/>
                    Website:      <?php if(isset($profiledetails['website'])){echo $profiledetails['website']; }else {echo "--";}?></p>
                  </div>

                  <script type="text/javascript">
                    $('[type=tel]').on('change', function(e) {
                      $(e.target).val($(e.target).val().replace(/[^\d]/g, ''))
                    })
                    $('[type=tel]').on('keypress', function(e) {
                      keys = ['0','1','2','3','4','5','6','7','8','9']
                      return keys.indexOf(event.key) > -1
                    })


                    $(document).ready(function() {

                    $('#contact_email').focusout(function(){

                    $('#contact_email').filter(function(){
                   var emil=$('#contact_email').val();
                   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                   if( !emailReg.test( emil ) ) {
                    alert('Please enter valid email');
                    } 
                    })
                });
             });
                  </script>



                        <script type="text/javascript">
                                       
                                    
                        // Ajax post
                        $(document).ready(function() {
                        $(".submit_contact").click(function(event) {
                        event.preventDefault();
                        var phone_ = $("input#phone").val();
                        var contact_email_ = $("input#contact_email").val();
                        var website_ = $("input#website").val();

                        jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/updateContact",
                        dataType: 'json',
                        data: {phone: phone_, contact_email: contact_email_, website: website_},
                        success: function() {

                          $("#old_contact").load("LiveBar/loadcondetails");
                        }
                        });
                        });
                        });
                        </script>

                        <script type="text/javascript">
                          $(document).ready(function(){
                            $("#button_contact").click(function(e){
                            $("#form_input6").removeClass('deactive');
                                 e.preventDefault();         
                            })
                        });
                        </script>

                         <script>
                                $(document).ready(function(){
                                $(".btn-contact").hide();
                                $("#form_input6").hide();
                            
                                $("#button_contact").click(function(){
                                $("#old_contact").hide();
                                $(".btn-contact").show();
                                $("#form_input6").show();
                                $("#button_contact").hide();
                                
                            });

                                $(".btn-contact").click(function(){
                                $("#old_contact").show();
                                $(".btn-contact").hide();
                                $("#form_input6").hide();
                                $("#button_contact").show();
                                
                            });
                        });
                        </script> 
                       
</div>

                  </div>
               </div><!--close container-->
          </div>


  <div id="save_sch_model" class="modal_">

  <!-- Modal content -->
  <div class="modal-content_">
  <p align="left" style="display: inline-block;">Your Details Submitted Successfuly.</p>
    <p align="right" style="display: inline-block; margin-left: 50%;"><span align="right" class="close_">&times;</span>
    
  </div>

</div>


  <div id="err_msg_box" class="error_model">

  <!-- Modal content -->
  <div class="modal_error_content">
  <p align="left" style="display: inline-block;">All Field Required.</p>
    <p align="right" style="display: inline-block; margin-left: 50%;"><span align="right" class="close_">&times;</span>
    
  </div>

</div>
     

     <?php
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //echo json_encode( $bar_id);

?>
<?php
$this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //echo json_encode($bar_id);

?>



          <div class="section-bar" style="background-color: #f0f1f5;" id="jumptosearch">


            <div class="container" id="barmatches1">
             <h2>Set upcoming schedule</h2>
            
           <span style="text-align:center"> (Optional)</span>
           
            
            
            <div class="toggle-content1">

            

           <div class="col-sm-12" style="margin-top: 40px;" >
                        <div class="locationinput">
                                <div class="inputnew"> 
                                  <form name="findmatch" action="LiveBar" id="findmatch" method="get">
                                    <input class="banner_search"  id="banner_search" name="banner_search" placeholder="Search for teams, league or sports...  " type="text" value="<?php echo $banner_search?>"><label for="name"  id="formsubmit"><!--<i class="fa fa-map-marker" aria-hidden="true"></i>-->SEARCH</label> 
                                        <input type="hidden" name="findval" id="findval" value="<?php echo $findval?>" />
                                        <input type="hidden" name="displayval" id="displayval" value="<?php echo $displayval?>" />
                                        <input type="hidden" name="findid" id="findid" value="<?php echo $typeid?>" />
                                        <input type="hidden" name="findtype" id="findtype" value="<?php echo $type?>" />
                                        <input type="hidden" name="float" id="float1" value="0" />
                                        <input type="hidden" name="searchapi" id="searchapi1" value="0" />
                                         
                                    </form>
                                </div>
                        </div>
              </div>

              <h2 class="title_text">
                <?php if($banner_search!=''){
            echo 'Search results for "'.$banner_search.'"';}
            else{
            echo 'Upcoming fixtures';}?>
                </h2>
<?php $m=1;?>

            <div class="sec_menu">
                <?php
        $today =  date("d-m-Y",time());
        $tomorrow = date("d-m-Y", strtotime("+1 day"));
        $third = date("d-m-Y", strtotime("+2 days"));
        $fourth = date("d-m-Y", strtotime("+3 days"));
        $fifth = date("d-m-Y", strtotime("+4 days"));
        $sixth = date("d-m-Y", strtotime("+5 days"));
        $seventh = date("d-m-Y", strtotime("+6 days"));
        ?>
                    <ul>


                        <li onclick="gototab1()" id="tab1"><a href="#tabs-1" class="active">All</a></li>
                        <li onclick="gototab2()" id="tab2"><a href="#tabs-2">TODAY</a></li>
                        <li onclick="gototab3()" id="tab3"><a href="#tabs-3">TOMORROW</a></li>
                        <li onclick="gototab4()" id="tab4"><a href="#tabs-4"><?php echo date("D d", strtotime("+2 days"))?>.</a></li>
                        <li onclick="gototab5()" id="tab5"><a href="#tabs-5"><?php echo date("D d", strtotime("+3 days"))?>.</a></li>
                        <li onclick="gototab6()" id="tab6"><a href="#tabs-6"><?php echo date("D d", strtotime("+4 days"))?>.</a></li>
                        <li onclick="gototab7()" id="tab7"><a href="#tabs-7"><?php echo date("D d", strtotime("+5 days"))?>.</a></li>
                        <li onclick="gototab8()" id="tab8"><a href="#tabs-8"><?php echo date("D d", strtotime("+6 days"))?>.</a></li>
                    </ul>
               <!-- <?php //print_r($schedules);?>-->
              </div>
                <h3 class="schedule">Add to schedule</h3>
                <h3 class="Channels">Channels</h3>
                 <div id="tabs-1" class="tabcontent">       
                     <div id="tab1result">
                    
                           <?php 
                            $count =1;
                            $i=7;
                            ?>
                            
                          
                    </div>
                     <input type="hidden" name="count_name" id="count_name" value="<?php echo $i; ?>" />
                   </form>
                   <?php $x=1;?>

                     <span id="nomorefixture1">No More Fixture</span> 
                     <span id="noschedule1">please tick games to add to your schedule</span> 
                 
                   <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <div class="load-buttons"><span id="loadMorebutton1"> <a id="loadMore1" href="javascript:;" class="button loadMore1_">LOAD MORE</a></span>
                             <span id="NoMorebutton1"><a id="loadMore1" href="javascript:;" class="button loadMore1">NO MORE FIXTURE </a></span> 
                            </div>
                            <div class="load-buttons" id="clickprint" onclick="gotoprint()" align="center"> <label  class="button butoon_print">Print</label></div> 
                           
                        </div>
                    </div>
                </div>
</div>

           
 
              
    
    <?php 
$count =1;
for ($x = 1; $x <= 8; $x++) {?>
<?php $count.'<?php echo $x?>'.'='."1"; ?>

    
  <div id="tabs-<?=$x?>" class="tabcontent" style="display: none;">
  <div id="tab<?=$x?>result">

        <?php
         $i2=0;

        foreach($schedules as $schedule){

          $i2++;
                        $channel=$schedule['id'];
                        //$channel123=$schedule['compid'];
                        //echo json_encode($channel123);
                        $this->load->model('Establishment_model');
                        $channel_info=$this->Establishment_model->GetFixChannel($channel,$bar_id);
                        //echo json_encode($schedules);
                        $competition_id_sports=$schedule['compid'];
                        //echo json_encode($competition_id_sports);
                        $sport_rel_id=$this->Establishment_model->GetSportRelId($competition_id_sports);
                        //echo json_encode($sport_rel_id);               
                        ?>

                        <?php $schedule_info=$this->Establishment_model->GetCheckSchedule($bar_id);
                        //echo json_encode($schedule_info);
                        //echo json_encode($schedule);?>
                      <?php if($schedule['actualdate'] == date("d-m-Y", strtotime(0))){
                                ?>

                         <div class="blog blogtab<?=$x?> allsearch_sch" >
                        <div class="blog-4">

                         <?php  
                          $result = $this->db->select('fixture_ref')->from('establishment_schedule')->where('fixture_ref', $schedule['fixture_id'])->where('establishment_ref', $bar_id)->limit(1)->get()->row();
                           if($result){
                            $result1 = $x.$j;
                            echo json_encode($result1);
                           ?><input type="checkbox" name="sp_schedule<?=$x?><?=$i2?>" onclick="gotosubmit_weak('<?=$x?>','<?=$i?>')" id="sp_schedule<?=$x?><?=$i2?>" checked/><?php
                          }else{
                           ?><input type="checkbox" name="sp_schedule<?=$x?><?=$i2?>" onclick="gotosubmit_weak('<?=$x?>','<?=$i?>')" id="sp_schedulesp_schedule<?=$x?><?=$i2?>"/><?php
                          }

                        ?>
                        
                             <input type="hidden" name="fixture_id<?=$x?><?=$i2?>" id="fixture_id<?=$x?><?=$i2?>" value="<?php echo $schedule['fixture_id']; ?>" />
                             <input type="hidden" name="establishment_ref<?=$x?><?=$i2?>" id="establishment_ref<?=$x?><?=$i2?>" value="<?php if($bar_id) echo $bar_id  ?>" />
                             <input type="hidden" name="sport_id<?=$x?><?=$i2?>" id="sport_id<?=$x?><?=$i2?>" value="<?php echo $schedule['sport_id'] ?>" />
                             <input type="hidden" name="competition_ref_id<?=$x?><?=$i2?>" id="competition_ref_id<?=$x?><?=$i2?>" value="<?php echo $schedule['compid'] ?>" />

                           

                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>

                          <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                    
                         <div class=" blog-42"><nav class=" scroll" id="style-7">
                          <div class="example">
                          <ul>
                         <?php foreach($channel_info as $channel_){?>
                          <li class="listscroll">
                            <span><?php echo $channel_->channel_name;?></span>
                          </li>
                          <?php } ?>
                         
                           
                          </ul> 
                          </div>
                          
                          </nav></div>
                    </div>

                    

                    <?php }?> 


        <?php
                        
          //if($count==5)break;
          }?>   

           <input type="hidden" name="counti2" id="counti2" value="<?php echo $i2?>" />


         
                </div>

                
                <div class="col-12" >
                <?php if(($end_date>=$current_date) || ($subscription_end_date>=$current_date)){
                 
                     }else
                  { ?>

                     <a href="javascript:void(0);" class="yellow-button align-center show_payment_form" >Upgrade now</a>      


               <?php 
                 }
                 ?>
                </div>
                  <?php if(($end_date>=$current_date) || ($subscription_end_date>=$current_date)){
            ?>     

         
                  
                 <span id="nomorefixture<?=$x?>">No More Fixture</span> 
                 <span id="noschedule<?=$x?>">please tick games to add to your schedule</span>
                 
                   
                                 
                 <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <div class="load-buttons"><span id="loadMorebutton<?=$x?>"><a id="loadMore<?=$x?>" href="javascript:;" class="button loadMore<?=$x?>_">LOAD MORE</a></span>

                            <span id="NoMorebutton<?=$x?>"><a id="loadMore__<?=$x?>" href="javascript:;" class="button loadMore__<?=$x?>_">NO MORE FIXTURE </a></span>
                            </div>
                            
                            <div class="load-buttons" id="clickprint" onclick="gotoprint()" align="center"> <label  class="button butoon_print">Print</label></div> 
                            
                           
                        </div>
                    </div>
                </div>
        <?php }?>
                </div>

                <?php } ?>

</div><!--close toggle-content-->
<div class="toggle-icon1"><img src="http://dev.sportshub365.com/images/toggle-icon1.png" alt="" id="image1"/></div>
           
           
           
           
           
           
       
       
           
           
           
           
           
           
           
           
        </div><!--close container-->
   </div><!--close section-bar-->












     
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/establishment/jquery.timepicker.css" />
  
<script src="<?php echo base_url();?>js/establishment/jquery.timepicker.js"></script>
<script src="<?php echo base_url();?>js/establishment/datepair.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script>

     
     <!--<?php //print_r($happyhours); ?>-->
        <div class="section-bar" >
            <div class="container">

            <form id="opening_frm_facility"
                  onclick="frm_facility()" 
                  accept-charset="utf-8" 
                  name="opening_frm_facility">
            
                                
            <h2>Set Facility options <span class="deactive" id="save_facility">
            <input type="submit"  align="left" class="save-btn" style="display: inline-block;" value="Save" name="form_submit"/>
                </span></h2>
                 <span style="text-align:center"> (Optional)</span>
                 
                 <div class="toggle-content2">
                 <div class="facil">
                 
                  

                  
                            <input type="hidden" name="caller" value="facility" />
                            <ul>  
                              <?php      
                              $i=0;                    
                              foreach($facility_schedule as $facility)
                              {
                                  $i++;

                              ?>
                              <li>

                                        <?php //
                                        if($facility['type']=='check'){ ?>

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
                                     <label for="<?php echo $facility['icon'];?>" style="display:none;"></label>
                               
                                   <?php } ?>
                                </li>
                                    
                               <?php } ?>
<!--                                end of loop     --> 

                              </ul>
                             
</form>
                      
                        
                   </div></div>          
<div class="toggle-icon2"><img src="http://dev.sportshub365.com/images/toggle-icon2.png" alt=""  id="image2"/></div>
                 
                
           </div></div>
            
           
            
            
            
            
            
            
            <div class="section-bar" style="background-color: #f0f1f5;">
            <div class="container">
             <h2>Set opening hours and happy hours
            </h2>
 <span style="text-align:center"> (Optional)</span>
 
 <div class="toggle-content3">

<div class="address1" id="oldopening_"> 
<h2 class="title">Opening hour <span><button type="button" id="opp_button" onclick="showButtonopeninghour()" style="display: inline-block;" class="save-btn">Edit</button></span></h2>
              
                 <?php 
          $openinghourscount  = 0;
          foreach($openinghours as $openinghour){
            if(($openinghour['from_time'] !='') && ($openinghour['to_time'] !='')){
                $openinghourscount  = 1;break;
              }
          }
          ?>
                  <?php if($openinghourscount == 1)
          {?>
                               
 
          <?php } ?>
                    <?php 
            foreach($openinghours as $openinghour){?>                    
            <?php
              if(($openinghour['from_time'] !='') && ($openinghour['to_time'] !='')){
              ?>
              <li> 
                <div class="days"><?php echo substr($openinghour['name'],0,3);?>:</div>
                                <div class="days"><?php echo $openinghour['from_time'];?> - <?php echo $openinghour['to_time'];?></div>
              </li>
              <?php
              }?>
                    <?php 
            }?>
                  
      </div>
      
      
      <div class="address1 deactive" id="openinghour_"> 
         <?php if(count($opening_hours)>0)
                           {
                            ?>
                              
                                <div id="errorDiv5" class="openhours-error"> </div>
                                <form id="opening_frm"
                                onclick="opening_form()" 
                                accept-charset="utf-8" 
                                 name="opening_frm" 
                                onsubmit="return ValidateOpeningHoursForm();"
                                >

                                <h2 class="title">Opening hour<span>
                                <input type="submit" align="left" class="save-btn" style="display: inline-block;" value="Save" name="form_submit"/>
                                </span></h2>
                                <div id="errorDiv2" class="happyhours-error"> </div>
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
                                              <span class="titlehappyhour"><?php echo $week['name'];?></span>
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
                                                
                                                <?php } else { ?> 
                                                
                                                
                                                 <?php } ?>
                                                 <span class="input-box"> <input name="<?php echo strtolower($week['name'])."_to";?>" 
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
                                           
                       </ul>
                       </div><!-- close box-inner -->
                      </form>       
                      <?php } ?>                 
                
               
                                

      </div>
      


       <div class="address2" id="happyhr_hide">
                 
          <h2 class="title">happy hour <span><button type="button" id="happ_button" onclick="showButtonhappyhour()" style="display: inline-block;" class="save-btn">Edit</button></span></h2>
              
                  <?php 
          $happyhourscount  = 0;
          foreach($happyhours as $happyhour){
            if(($happyhour['from_time'] !='') && ($happyhour['to_time'] !='') && ($happyhour['is_active']==1))
              {
                $happyhourscount  = 1;break;
              }
          }
          ?>
                  <?php if($happyhourscount ==1){?>

                 

                   <?php } ?>
                    <?php foreach($happyhours as $happyhour){?>                    
            <?php
              if(($happyhour['from_time'] !='') && ($happyhour['to_time'] !='') && ($happyhour['is_active']==1))
              {
              ?>
              <li> 
                <div class="days"><?php echo substr($happyhour['name'],0,3);?>:</div>
                <div class="days"><?php echo $happyhour['from_time'];?> - <?php echo $happyhour['to_time'];?> </div>
              </li>
                        <?php
              }?>
                    <?php }?>
                
                </div>                  
            



                <div class="address2 deactive" id="happyhr_show">
                  
                   <?php if(count($happy_hours)>0)
                              {
                               ?>
                                <div id="errorDiv2" class="happyhours-error"> </div>
                                 <form id="happy_frm" 
                                onclick="happy_form()" 
                                accept-charset="utf-8" 
                                name="happy_frm" 
                                onsubmit="return ValidateHappyHoursForm();"
                                >

                                 <h2 class="title">happy hour<span><input type="submit" align="left" class="save-btn" style="display: inline-block;" value="Save" name="form_submit"/></span></h2>

                                <input type="hidden" 
                                value="HappyHours" name="caller">
                                <input type="hidden" 
                                value="<?php echo count($happy_hours);?>" 
                                name="total_happy_hours" id="total_happy_hours">

                                  <div class="box-inner">
                                       
                                       <ul class="list1_ list3">
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
                                              <span class="titlehappyhour"><?php echo $week['name'];?></span>
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
                                  
                      </ul>                                    
                                       
                      </div><!-- close box-inner -->
                      <?php echo form_close();?>
                      </form>
                      <?php } ?>



                </div>


                 </div>   
                <div class="toggle-icon3"><img src="http://dev.sportshub365.com/images/toggle-icon2.png" alt=""  id="image3"/></div>            

      </div><!--close container-->
        </div><!--close section-bar-->
        
        <div class="section-bar" >
            <div class="container">
              <h2>Set offers and events
            </h2>
            <span style="text-align:center"> (Optional)</span>
 
            <div class="toggle-content4">
                <div class="address1">
<h4>Offers
                 <?php if(($end_date>=$current_date) || ($subscription_end_date>=$current_date)){?>
                  
                  <button type="button" onclick="showButtonoffer()" id="button_offer" class="btn2 btn-info button_div_contact button_lg_edit">Add</button>
                 <?php  }else
                  { ?>
                  <a href="javascript:void(0);" class="save-btn align-center show_payment_form" >Add</a></h4> 
                  <?php } ?>
                  <span id="sub_btn_offer" class="deactive"><?php echo form_submit('submit', 'Save', "class='submit_offer btn2 button_lg_edit btn-info2 btn-offer'"); ?></span>
                 

                
                 <div id="form_input_offer" class="deactive" style=" margin-top: 20px;">  
                 <span class="form-row ">
                 <input class="input title" type="text"  placeholder="Title:" value="" name="title" id="title" required="required"/>
                 </span>

                 <span class="form-row ">
                 <textarea id="offer_description" rows="6" cols="10" class="input" name="description" placeholder="Description" required="required" style="margin: 0px 0px 20px; width: 85%; height: 50%;"></textarea>
                 </span>

                 <span class="form-row ">
                 <input type="text" class="input" name="price_discount" id="price_discount" placeholder="Price Discount" value="" required="required">
                 </span>

                 <span class="form-row ">  
                 <input type="text" class="input" name="promo_code" id="promo_code" placeholder="Promocode" value="" required="required">
                 </span>
                
                 <input type="checkbox" value="1" id="check-14" 
                            name="isactive" 
                            class="checkedFocus" <?php if(isset($isactive) && $isactive==1) {?>checked="checked" <?php } ?> onclick="checkfuntion();">
                 <label class="<?php if(isset($isactive) && $isactive==1) {?>checked<?php } ?>" for="check-14" name="chk14"> Active</label>
                 
                 </div>
                 

                 <script type="text/javascript">                   
                        // Ajax post
                        $(document).ready(function() {
                        $(".submit_offer").click(function(event) {
                        event.preventDefault();
                        var title_ = $("input#title").val();
                        var description_ = $("#offer_description").val();
                        var price_discount_ = $("input#price_discount").val();
                        var promo_code_ = $("input#promo_code").val();
                        var check_ = $("input#check-14").val();
                        jQuery.ajax({
                        type: "post",
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/updateOffer",
                        dataType: 'json',
                        data: {title: title_, description: description_, price_discount: price_discount_, promo_code: promo_code_, check:check_,},
                         beforeSend: function(){
                           $('.preloader').show();
                        },
                        success: function(res) {
                           $('.preloader').hide();
                          $("#old_offer").load("LiveBar/loadoffer");
                        
                        },
                        error: function(xhr) { // if error occured
                          $('.preloader').hide();
                          alert('All Field Required');
                          
                          //err_msg_box.style.display = "block";
                          
                        },
                        complete: function() {
                           $('.preloader').hide();
                        },

                        }).done(function(res) {
                        $('.preloader').hide();
                         });;
                        });
                        });
                        </script>

                        <script type="text/javascript">
                          $(document).ready(function(){
                            $("#button_offer").click(function(e){
                            $("#form_input_offer").removeClass('deactive');
                                 e.preventDefault();         
                            })
                        });
                        </script>

                         <script>
                                $(document).ready(function(){
                                $(".btn-offer").hide();
                                $("#form_input_offer").hide();
                            
                                $("#button_offer").click(function(){
                                $("#old_offer").hide();
                                $(".btn-offer").show();
                                $("#form_input_offer").show();
                                $("#button_offer").hide();
                                
                            });

                                $(".btn-offer").click(function(){
                                $("#old_offer").show();
                                $(".btn-offer").hide();
                                $("#form_input_offer").hide();
                                $("#button_offer").show();
                                
                            });
                        });
                        </script> 
                        
                          
                        <?php echo "<span id='title' class='yellow'> </span>";?><br/>
                        <?php  echo "<span id='description'> </span>";?><br/>
                        <?php echo "<span id='promo_code'> </span>";?>
                        
                      


                  
                   <div id="old_offer">  
                   <?php foreach($offers as $offer){?>
                    <h3><span class="yellow"><?php echo $offer['title'];?> <?php if($offer['price_or_discount']){?> - <?php echo $offer['price_or_discount']?><?php } ?></span> </h3>
                    <p>- <?php echo $offer['description']?>
                   <?php if($offer['promo_code']){?><br />
                   Use this code - <?php echo $offer['promo_code']?>
                    <?php }?></p>
                    <?php } ?>
                    <a type="button" href="<?php echo base_url();?>establishment/offers/" target="_blank" class="btn2 btn-info button_div">More</a>
                    
                    </div>
                </div>
                <div class="address2">
                 <h4>Events
                  <?php if(($end_date>=$current_date) || ($subscription_end_date>=$current_date)){?>

                   <button type="button" onclick="showButtonEvent()" id="button_event" class="btn2 btn-info button_div_event button_lg_edit">Add</button>

                   <?php  }else
                  { ?>
                  
                  <a href="javascript:void(0);" class="save-btn align-center show_payment_form" >Add</a> 
                  
                  <?php } ?>

                    <span id="sub_btn_event" class="deactive"><?php echo form_submit('submit', 'Save', "class='submit_event btn2 button_lg_edit btn-info2 btn-event'"); ?></span></h4>

                   

                    <div id="form_input_event" class="deactive" style="margin-top: 20px;">  
                    <span class="form-row ">
                    <input class="input" type="text" class="titleD" placeholder="Title:/Description" value="" name="titleD" id="titleD">
                    </span>

                    
                    <span class="form-row ">
                    <input type="text" class="input" name="date" id="datepicker" placeholder="Date:DD-MM-YYYY" value="">
                    </span>

                    <span class="form-row ">   
                    <input type="text" class="input" name="time" id="time" placeholder="Time:HH:MM AM/PM" value="">
                    </span>
                    
                    <span class="form-row ">   
                    <input type="text" class="input" name="duration" id="duration" placeholder="duration:HH" value="">
                    </span>
                    
                    </div>
                  </div>
                    <script type="text/javascript">
                    $("#datepicker").datepicker({
                   minDate : 0,
                    dateFormat: 'dd-mm-yy'
                    });
                     var dateOnlyH3 = document.getElementById('datepicker');
                        var dateOnlyDatepairH3 = new Datepair(dateOnlyH3);
                
          



                        $('#time').timepicker({
                          'showDuration': true,
                          'timeFormat': 'H:i'
                        });
                        var timeOnlyH3 = document.getElementById('time');
                        var timeOnlyDatepairH3 = new Datepair(timeOnlyH3);
                
                    </script>

                     <script type="text/javascript">
                                           
                                    
                        // Ajax post
                        $(document).ready(function() {
                        $(".submit_event").click(function(event) {
                        event.preventDefault();
                        var title_ = $("input#titleD").val();
                        var date_ = $("input#datepicker").val();
                        var time_ = $("input#time").val();
                        var duration_ = $("input#duration").val();
                       

                        jQuery.ajax({
                        type: "post",
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/updateEvent",
                        dataType: 'json',
                        data: {title: title_, date: date_, time: time_, duration:duration_},
                             beforeSend: function(){
                           $('.preloader').show();
                        },
                        success: function(res) {
                          $("#old_event").load("LiveBar/loadevent");
                       
                        },
                        error: function(xhr) { // if error occured
                          $('.preloader').hide();
                          alert('All Field Required')
                          
                          //err_msg_box.style.display = "block";
                          
                        },
                        complete: function() {
                           $('.preloader').hide();
                        },

                        }).done(function(data) {
                         $('.preloader').hide();
                        });
                        });
                        });
                        </script>

                        <script type="text/javascript">
                          $(document).ready(function(){
                            $("#button_event").click(function(e){
                            $("#form_input_event").removeClass('deactive');
                                 e.preventDefault();         
                            })
                        });
                        </script>

                         <script>
                                $(document).ready(function(){
                                $(".btn-event").hide();
                                $("#form_input_event").hide();
                            
                                $("#button_event").click(function(){
                                $("#old_event").hide();
                                $(".btn-event").show();
                                $("#form_input_event").show();
                                $("#button_event").hide();
                                
                            });

                                $(".btn-event").click(function(){
                                $("#old_event").show();
                                $(".btn-event").hide();
                                $("#form_input_event").hide();
                                $("#button_event").show();
                                
                            });
                        });
                        </script> 
                        
                        <?php echo "<span id='title' class='yellow'> </span>";?><br/>
                        <?php  echo "<span id='date'> </span>";?><br/>
                        <?php echo "<span id='time'> </span>";?>
                        <?php echo "<span id='duration'></span>";?>
                      



                    <div id="old_event"> 
                    <?php foreach($events as $event){?>
                    <h3><span class="yellow"><?php echo $event['title'];?></span> </h3>
                    <p>- The <?php echo $event['date']?>, <?php echo date('H:i', strtotime($event['time']))?> - <?php echo $date = date('H:i', strtotime($event['time'])+(3600*$event['duration'])); ?></p><br/>
                    <?php } ?>
                     <a type="button" href="<?php echo base_url();?>establishment/events/" target="_blank"  class="btn2 btn-info button_div">More</a>
                    </div>
                </div>
            </div>
            <div class="toggle-icon4"><img src="http://dev.sportshub365.com/images/toggle-icon2.png" alt=""  id="image4"/></div>
            </div><!--close container-->
        </div><!--close section-bar-->
     
     <div class="section5">
               
                  <span class="prev2"><a href="<?php echo base_url();?>venue">BARS</a></span>
                    <span class="next2"><a href="<?php echo base_url();?>sportsfans">Sports Fans</a></span>
          </div>
     </div><!--close content-->



     <div class="simplePopup popup-box" id="show_payment_form">
    <h2>SH365 Subscription</h2><br/>
    <h4>Subscribe now to get your full weekly tv listing! Promote your bar with a higher placement on our Sport finder App and web.  Here you can create events and Special offers, which will send out notifications to users in your area.</h4>
    <br/>
    
    <div id="payment_form">
    <form action="/your-charge-code" method="POST" id="payment-form" class="form-inline">
    <span class="payment-errors"></span>
    <span class="popup-form">
      <div class="plan_div">
            <input type="radio" class="subscribe_plan" value="standard_monthly_plan" name="plan" data-amount="1000"/ >
            <label>€10 / Month</label>
            
            </div>
            
            
            <div class="plan_div">
            <input type="radio" class="subscribe_plan" value="standard_yearly_plan" name="plan" checked="checked"  data-amount="6000"/>
            <label>€60 / Year</label>
            
            </div> 
    </span>
    <span class="popup-form">
      <input type="text" pattern="\d+" size="20" minlength="16" maxlength="16" class="popup-input1" data-stripe="number" placeholder="Card Number" required>
    </span>
     <span class="popup-form">
       <span class="form-box21">
          <span class="form-box2">
            <input type="text" size="2" class="popup-input-1" data-stripe="exp_month" placeholder="Exp. month (MM)" required>
            <span class="small_devider"> / </span>
            <input type="text" size="2" class="popup-input-1" data-stripe="exp_year"placeholder="Exp. Year (YY)" required>
            </span>
            <span class="devider"></span>
            </span>
            <span class="form-box22">
              <input type="text" size="4" class="popup-input1" data-stripe="cvc" placeholder="CVC" required>
            </span>
            </span>
         <span class="button-row">
         <input type="hidden" name="subscribe_amount" id="subscribe_amount" value="6000" />
         <input type="submit" id="submit_pay" class="submit popup-button" value="Submit Payment">
         </span>
         <span class="stripe-logo button-row">
         <img src="<?php echo base_url('img'); ?>/stripe_cc_powered_logo.png" >
         </span>
      
  </form>
   </div>
   <div id="payment_update" style="display: none;">
      <h3 id="payment_update_text"></h3>
      <a class="change-now"> href="<?php echo base_url('establishment/profile_settings'); ?>">CLOSE</a>
   </div>

  </div>
  </div>
                                        </div>
 <div class="simplePopupBanner popup-box" id="show_banner_form">
 
          <h2 class="modal-title">Set Banner Image</h2>
          <?php echo $this->session->flashdata('success_msg'); ?>
          <?php echo $this->session->flashdata('error_msg'); ?>
          <?php echo form_open_multipart('LiveBar/do_upload_banner');?>
           
                      <div class="form-group">
                       <img id="banner_img" src="#" style="width:60%;" alt="Select banner image" />
                       <br/>
                      
                          <input type="file" onclick="readURL(this);" id="disply_banner" name="picture" required="required" />
                      </div>
                       <div class="form-group">
                          <input type="submit" class="btn btn-warning" name="userSubmit" value="Add">
                      </div>
          <?php echo "</form>"?>
     </div>
                                                   
                                        
<?php $this->load->view('promotion/footer');?>
</div>





</div><!--close wrapper-->
<?php $this->load->view('promotion/footer_includes');?>
            
  <script type="text/javascript">
  
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#banner_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#disply_banner").change(function(){
        readURL(this);
    });
</script>



   <script type="text/javascript">
   function validateaddressform(){
    _w=$('#us2-website');
    _e=$('#us2-email');

  var werror=true,eerror=true;

    
  if(_e.val()!='' && (_e.val().indexOf("@",0)==-1 || _e.val().indexOf(".",0)==-1))
    {
      _e.addClass('error');
      eerror= false;
    } 
    else{
      _e.removeClass('error');
      eerror= true;
    }
  var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
  
  if(_w.val()!=''){
    if(!re.test(_w.val())) {
      _w.addClass('error');
      werror= false;
    } else {
      _w.removeClass('error');
      werror= true;
  }
   }
  if((eerror == true) && (werror == true))
  {
    $('#profile_frm').submit();
    return true;
  }else{
    return false;
  }   
  
   }
   $(function(){
      $('#us2-phone').keyup(function() {
    $(this).val($(this).val().replace(/\D/, ''));
  });

   });

    function validateaddressform_about(){
    _w=$('#us2-website');
    _e=$('#us2-email');

  var werror=true,eerror=true;

    
  if(_e.val()!='' && (_e.val().indexOf("@",0)==-1 || _e.val().indexOf(".",0)==-1))
    {
      _e.addClass('error');
      eerror= false;
    } 
    else{
      _e.removeClass('error');
      eerror= true;
    }
  var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
  
  if(_w.val()!=''){
    if(!re.test(_w.val())) {
      _w.addClass('error');
      werror= false;
    } else {
      _w.removeClass('error');
      werror= true;
  }
   }
  if((eerror == true) && (werror == true))
  {
    $('#profile_frm_about').submit();
    return true;
  }else{
    return false;
  }   
  
   }

   function validateaddressform_contact(){
    _w=$('#us2-website');
    _e=$('#us2-email');

  var werror=true,eerror=true;

    
  if(_e.val()!='' && (_e.val().indexOf("@",0)==-1 || _e.val().indexOf(".",0)==-1))
    {
      _e.addClass('error');
      eerror= false;
    } 
    else{
      _e.removeClass('error');
      eerror= true;
    }
  var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
  
  if(_w.val()!=''){
    if(!re.test(_w.val())) {
      _w.addClass('error');
      werror= false;
    } else {
      _w.removeClass('error');
      werror= true;
  }
   }
  if((eerror == true) && (werror == true))
  {
    $('#profile_frm_contact').submit();
    return true;
  }else{
    return false;
  }   
  
   }

</script> 
   <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<script src="<?php echo base_url();?>js/establishment/jq.mousewheel.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/establishment/scrollbar.js" type="text/javascript"></script>

<script>
$(function(){
  $('.example').makeScroll();
});
</script>


    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
  });
  function resetCustomInput(){
    $('input').customInput();}
  
  </script>
    
   <script>
   
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
    </script>


<script>
$.widget( "custom.catcomplete", $.ui.autocomplete, {
    
     _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
     _renderMenu: function( ul, items ) {
         var that = this,
        currentCategory = "";
         $.each( items, function( index, item ) {
            var li;
            if ( item.category != currentCategory ) {
                ul.append( "<li class='ui-autocomplete-category " + item.category + "'>" + item.category + "</li>" );
                currentCategory = item.category;
            }
            li = that._renderItemData( ul, item );
            /*if ( item.category ) {
                li.attr( "aria-label", item.category + " : " + item.label );
            }*/
        });
    },
     
     _renderItem: function( ul, item ) {
    var regexp = new RegExp('(' + this.term + ')', 'gi'),
            classString = this.options.highlightClass ?  ' class="' + this.options.highlightClass + '"' : '',
            label = item.label.replace(regexp, '<strong' + classString + '>$1</strong>');

        return $('<li><a href="#">' + label + '</a></li>').appendTo(ul);
  }
});

      
$(function() {
      
      $("#banner_search").catcomplete({
        source: '<?php echo base_url();?>promotion/availablelists',
        minLength: 3,
        focus: function(event, ui) {
          // prevent autocomplete from updating the textbox
          event.preventDefault();
          // manually update the textbox
          $(this).val(ui.item.labeloriginal);
          if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $("#findval").val(ui.item.labeloriginal);
            $("#displayval").val(ui.item.label);
            $("#findid").val(ui.item.value);
            $("#findtype").val(ui.item.category);
            $("#searchapi1").val('1');
            $('#findmatch').submit();
          }
        },select: function(event, ui) {
          // prevent autocomplete from updating the textbox
          event.preventDefault();
          // manually update the textbox and hidden field
          $(this).val(ui.item.labeloriginal);
          //alert(ui.item.label);
            $("#findval").val(ui.item.labeloriginal);
            $("#displayval").val(ui.item.label);
            $("#findid").val(ui.item.value);
            $("#findtype").val(ui.item.category);
            $("#searchapi1").val('1');
            $('#findmatch').submit();
        },
        highlightClass: 'ui-autocomplete-hightlight'
      });
      $("#header_search").catcomplete({
        source: '<?php echo base_url();?>promotion/availablelists',
        minLength: 3,
        focus: function(event, ui) {
          // prevent autocomplete from updating the textbox
          event.preventDefault();
          // manually update the textbox
          $(this).val(ui.item.labeloriginal);
          if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $("#findvalheader").val(ui.item.labeloriginal);
            $("#displayvalheader").val(ui.item.label);
            $("#findidheader").val(ui.item.value);
            $("#findtypeheader").val(ui.item.category);
            $("#searchapi").val('1');
            $('#findmatchfloat').submit();
          }
        },select: function(event, ui) {
          // prevent autocomplete from updating the textbox
          event.preventDefault();
          // manually update the textbox and hidden field
          $(this).val(ui.item.labeloriginal);
          $("#findvalheader").val(ui.item.labeloriginal);
          $("#displayvalheader").val(ui.item.label);
          $("#findidheader").val(ui.item.value);
          $("#findtypeheader").val(ui.item.category);
          $("#searchapi").val('1');
          $('#findmatchfloat').submit();
        },
        highlightClass: 'ui-autocomplete-hightlight'
      });
    });
  </script>






  <script type="text/javascript">

     $(document).ready(function() {
      $('#noschedule1').hide();
       $('#noschedule2').hide();
       $('#noschedule3').hide();
       $('#noschedule4').hide();
       $('#noschedule5').hide();
       $('#noschedule6').hide();
       $('#noschedule7').hide();
       $('#noschedule8').hide();
                        
     });

      $("#noschclick1").click(function(event) {
    $('#noschedule1').show();
    });

    $("#noschclick2").click(function(event) {
    $('#noschedule2').show();
    });
    $("#noschclick3").click(function(event) {
    $('#noschedule3').show();
    });
    $("#noschclick4").click(function(event) {
    $('#noschedule4').show();
    });
    $("#noschclick5").click(function(event) {
    $('#noschedule5').show();
    });
    $("#noschclick6").click(function(event) {
    $('#noschedule6').show();
    });
    $("#noschclick7").click(function(event) {
    $('#noschedule7').show();
    });
    $("#noschclick8").click(function(event) {
    $('#noschedule8').show();
    });

          
    

   </script>


<script type="text/javascript">
$(document).ready(function () {
/*    size_li1 = $("#tabs-1 .blogtab1").size();
  //alert(size_li);
  
    x1=5;
    if(x1 >= size_li1){
      $('#loadMore1').show();
      $('#nomore1').hide();
    }
    $('#tabs-1 .blogtab1:lt('+x1+')').show();
    $('#loadMore1').click(function () {
        x1= (x1+5 <= size_li1) ? x1+5 : size_li1;
        $('#tabs-1 .blogtab1:lt('+x1+')').slideDown(1000);
    if(x1 >= size_li1){
      $('#loadMore1').show();
      $('#nomore1').hide();
    }
    });*/


   // size_li2 = $("#tabs-2 .blogtab2").size();
   sum3=0;
  size_li3 = $('#tabs-3 .allsearch_sch').length +7;
    x3=7;
    if(x3 > size_li3){
      $('#loadMore3').hide();
      $('#NoMorebutton3').show();
      $('#nomorefixture3').show();
    }else{

      $('#loadMore3').show();
       $('#NoMorebutton3').hide();
       $('#nomorefixture3').hide();

    }

    $('#tab3').click(function () {
     sum3=0;

     size_li3 =7;
     //alert(size_li3);
    x3=7;
    //alert(x3);
       if(sum3 <= size_li3){

     $('#loadMorebutton3').show();

     $('#nomorefixture3').hide();
     $('#NoMorebutton3').hide();

    }
    if(sum3 > size_li3){
     //alert("no more fixture")
      $('#loadMorebutton3').hide();
      $('#nomorefixture3').show();
      $('#NoMorebutton3').show();

    }
    });



    $('#loadMore3').click(function () {
      size_li3 = $('#tabs-3 .allsearch_sch').length;
       sum3=sum3 + 7;
       
    if(sum3 <= size_li3){

     $('#nomorefixture3').hide();
     $('#NoMorebutton3').hide();

    }
    if(sum3 > size_li3){
     //alert("no more fixture")
      $('#loadMorebutton3').hide();
      $('#nomorefixture3').show();
      $('#NoMorebutton3').show();

    }
    });



   sum4=0;
  size_li4 = $('#tabs-4 .allsearch_sch').length +7;
    x4=7;
    if(x4 > size_li4){
      $('#loadMore4').hide();
      $('#NoMorebutton4').show();
      $('#nomorefixture4').show();
    }else{

      $('#loadMore4').show();
       $('#NoMorebutton4').hide();
       $('#nomorefixture4').hide();

    }


    $('#tab4').click(function () {
     sum4=0;
     size_li4 =7;
    x3=7;
       if(sum4 <= size_li4){

     $('#loadMorebutton4').show();
     $('#nomorefixture4').hide();
     $('#NoMorebutton4').hide();

    }
    if(sum4 > size_li4){
     //alert("no more fixture")
      $('#loadMorebutton4').hide();
      $('#nomorefixture4').show();
      $('#NoMorebutton4').show();

    }
    });

    $('#loadMore4').click(function () {
      size_li4 = $('#tabs-4 .allsearch_sch').length;
       sum4=sum4 + 7;
       
    if(sum4 <= size_li4){
     $('#nomorefixture4').hide();
     $('#NoMorebutton4').hide();

    }
    if(sum4 > size_li4){
     //alert("no more fixture")
      $('#loadMorebutton4').hide();
      $('#nomorefixture4').show();
      $('#NoMorebutton4').show();

    }
    });

  sum11=0;
  size_li11 = $('#tabs-1 .allsearch_sch').length +7;
    x11=7;
    if(x11 > size_li11){
      $('#loadMore1').hide();
      $('#NoMorebutton1').show();
      $('#nomorefixture1').show();
    }else{

      $('#loadMore1').show();
       $('#NoMorebutton1').hide();
       $('#nomorefixture1').hide();

    }


   $('#tab1').click(function () {
     sum11=0;
     size_li11 =7;
    x11=7;
       if(sum11 <= size_li11){

     $('#loadMorebutton1').show();
     $('#nomorefixture1').hide();
     $('#NoMorebutton1').hide();

    }
    if(sum11 > size_li11){
     //alert("no more fixture")
      $('#loadMorebutton1').hide();
      $('#nomorefixture1').show();
      $('#NoMorebutton1').show();

    }
    });

    $('#loadMore1').click(function () {
      size_li11 = $('#tabs-1 .allsearch_sch').length;
     // alert(size_li11);
       sum11=sum11 + 7;
       
    if(sum11 <= size_li11){
     $('#nomorefixture1').hide();
     $('#NoMorebutton1').hide();

    }
    if(sum11 > size_li11){
     //alert("no more fixture")
      $('#loadMorebutton1').hide();
      $('#nomorefixture1').show();
      $('#NoMorebutton1').show();

    }
    });



  sum5=0;
  size_li5 = $('#tabs-5 .allsearch_sch').length +7;
    x5=7;
    if(x5 > size_li5){
      $('#loadMore5').hide();
      $('#NoMorebutton5').show();
      $('#nomorefixture5').show();
    }else{

      $('#loadMore5').show();
       $('#NoMorebutton5').hide();
       $('#nomorefixture5').hide();

    }


    $('#tab5').click(function () {
     sum5=0;
     size_li5 =7;
    x5=7;
       if(sum5 <= size_li5){

     $('#loadMorebutton5').show();
     $('#nomorefixture5').hide();
     $('#NoMorebutton5').hide();

    }
    if(sum5 > size_li5){
     //alert("no more fixture")
      $('#loadMorebutton5').hide();
      $('#nomorefixture5').show();
      $('#NoMorebutton5').show();

    }
    });

    $('#loadMore5').click(function () {
      size_li5 = $('#tabs-5 .allsearch_sch').length;
       sum5=sum5 + 7;
       
    if(sum5 <= size_li5){
     $('#nomorefixture5').hide();
     $('#NoMorebutton5').hide();

    }
    if(sum5 > size_li5){
     //alert("no more fixture")
      $('#loadMorebutton5').hide();
      $('#nomorefixture5').show();
      $('#NoMorebutton5').show();

    }
    });


  sum6=0;
  size_li6 = $('#tabs-6 .allsearch_sch').length +7;
    x6=7;
    if(x6 > size_li6){
      $('#loadMore6').hide();
      $('#NoMorebutton6').show();
      $('#nomorefixture6').show();
    }else{

      $('#loadMore6').show();
       $('#NoMorebutton6').hide();
       $('#nomorefixture6').hide();

    }


    $('#tab6').click(function () {
     sum6=0;
     size_li6 =7;
    x6=7;
       if(sum6 <= size_li6){

     $('#loadMorebutton6').show();
     $('#nomorefixture6').hide();
     $('#NoMorebutton6').hide();

    }
    if(sum6 > size_li6){
     //alert("no more fixture")
      $('#loadMorebutton6').hide();
      $('#nomorefixture6').show();
      $('#NoMorebutton6').show();

    }
    });

    $('#loadMore6').click(function () {
      size_li6 = $('#tabs-6 .allsearch_sch').length;
       sum6=sum6 + 7;
       
    if(sum6 <= size_li6){
     $('#nomorefixture6').hide();
     $('#NoMorebutton6').hide();

    }
    if(sum6 > size_li6){
     //alert("no more fixture")
      $('#loadMorebutton6').hide();
      $('#nomorefixture6').show();
      $('#NoMorebutton6').show();

    }
    });

  sum7=0;
  size_li7 = $('#tabs-7 .allsearch_sch').length +7;
    x7=7;
    if(x7 > size_li7){
      $('#loadMore7').hide();
      $('#NoMorebutton7').show();
      $('#nomorefixture7').show();
    }else{

      $('#loadMore7').show();
       $('#NoMorebutton7').hide();
       $('#nomorefixture7').hide();

    }

       $('#tab7').click(function () {
     sum7=0;
     size_li7 =7;
    x7=7;
       if(sum7 <= size_li7){

     $('#loadMorebutton7').show();
     $('#nomorefixture7').hide();
     $('#NoMorebutton7').hide();

    }
    if(sum7 > size_li7){
     //alert("no more fixture")
      $('#loadMorebutton7').hide();
      $('#nomorefixture7').show();
      $('#NoMorebutton7').show();

    }
    });

    $('#loadMore7').click(function () {
      size_li7 = $('#tabs-7 .allsearch_sch').length;
       sum7=sum7 + 7;
       
    if(sum7 <= size_li7){
     $('#nomorefixture7').hide();
     $('#NoMorebutton7').hide();

    }
    if(sum7 > size_li7){
     //alert("no more fixture")
      $('#loadMorebutton7').hide();
      $('#nomorefixture7').show();
      $('#NoMorebutton7').show();

    }
    });

      sum8=0;
  size_li8 = $('#tabs-8 .allsearch_sch').length +7;
    x8=7;
    if(x8 > size_li8){
      $('#loadMore8').hide();
      $('#NoMorebutton8').show();
      $('#nomorefixture8').show();
    }else{

      $('#loadMore8').show();
       $('#NoMorebutton8').hide();
       $('#nomorefixture8').hide();

    }


       $('#tab8').click(function () {
     sum8=0;
     size_li8 =7;
    x8=7;
       if(sum8 <= size_li8){

     $('#loadMorebutton8').show();
     $('#nomorefixture8').hide();
     $('#NoMorebutton8').hide();

    }
    if(sum8 > size_li8){
     //alert("no more fixture")
      $('#loadMorebutton8').hide();
      $('#nomorefixture8').show();
      $('#NoMorebutton8').show();

    }
    });

    $('#loadMore8').click(function () {
      size_li8 = $('#tabs-8 .allsearch_sch').length;
       sum8=sum8 + 7;
       
    if(sum8 <= size_li8){
     $('#nomorefixture8').hide();
     $('#NoMorebutton8').hide();

    }
    if(sum8 > size_li8){
     //alert("no more fixture")
      $('#loadMorebutton8').hide();
      $('#nomorefixture8').show();
      $('#NoMorebutton8').show();

    }
    });


      sum2=0;
  size_li2 = $('#tabs-2 .allsearch_sch').length +7;
    x2=7;
    if(x2 > size_li2){
      $('#loadMore2').hide();
      $('#NoMorebutton2').show();
      $('#nomorefixture2').show();
    }else{

      $('#loadMore2').show();
       $('#NoMorebutton2').hide();
       $('#nomorefixture2').hide();

    }


       $('#tab2').click(function () {
     sum2=0;
     size_li2 =7;
    x2=7;
       if(sum2 <= size_li2){

     $('#loadMorebutton2').show();
     $('#nomorefixture2').hide();
     $('#NoMorebutton2').hide();

    }
    if(sum2 > size_li2){
     //alert("no more fixture")
      $('#loadMorebutton2').hide();
      $('#nomorefixture2').show();
      $('#NoMorebutton2').show();

    }
    });

     $('#loadMore2').click(function () {
      size_li2 = $('#tabs-2 .allsearch_sch').length;
       sum2=sum2 + 7;
       
    if(sum2 <= size_li2){
    $('#nomorefixture2').hide();
     $('#NoMorebutton2').hide();

    }
    if(sum2 > size_li2){
     //alert("no more fixture")
      $('#loadMorebutton2').hide();
      $('#nomorefixture2').show();
      $('#NoMorebutton2').show();

    }
    });









/*
    size_li3 = $("#tabs-3 .blogtab3").size();
  //alert(size_li);
    x3=5;
    if(x3 >= size_li3){
      $('#loadMore3').show();
      $('#nomore3').hide();
    }
    $('#tabs-3 .blogtab3:lt('+x3+')').show();
    $('#loadMore3').click(function () {
        x3= (x3+5 <= size_li3) ? x3+5 : size_li3;
        $('#tabs-3 .blogtab3:lt('+x3+')').slideDown(1000);
    if(x3 >= size_li3){
      $('#loadMore3').show();
      $('#nomore3').hide();
    }
    });


    size_li4 = $("#tabs-4 .blogtab4").size();
  //alert(size_li);
    x4=5;
    if(x4 >= size_li4){
      $('#loadMore4').show();
      $('#nomore4').hide();
    }
    $('#tabs-4 .blogtab4:lt('+x4+')').show();
    $('#loadMore4').click(function () {
        x4= (x4+5 <= size_li4) ? x4+5 : size_li4;
        $('#tabs-4 .blogtab4:lt('+x4+')').slideDown(1000);
    if(x4 >= size_li4){
      $('#loadMore4').show();
      $('#nomore4').hide();
    }
    });


    size_li5 = $("#tabs-5 .blogtab5").size();
  //alert(size_li);
   x5=5;
    if(x5 >= size_li5){
      $('#loadMore5').show();
      $('#nomore5').hide();
    }
    $('#tabs-5 .blogtab5:lt('+x5+')').show();
    $('#loadMore5').click(function () {
        x5= (x5+5 <= size_li5) ? x5+5 : size_li5;
        $('#tabs-5 .blogtab5:lt('+x5+')').slideDown(1000);
    if(x5 >= size_li5){
      $('#loadMore5').show();
      $('#nomore5').hide();
    }
    });


    size_li6 = $("#tabs-6 .blogtab6").size();
  //alert(size_li);
    x6=5;
    if(x6 >= size_li6){
      $('#loadMore6').show();
      $('#nomore6').hide();
    }
    $('#tabs-6 .blogtab6:lt('+x6+')').show();
    $('#loadMore6').click(function () {
        x6= (x6+5 <= size_li6) ? x6+5 : size_li6;
        $('#tabs-6 .blogtab6:lt('+x6+')').slideDown(1000);
    if(x6 >= size_li6){
      $('#loadMore6').show();
      $('#nomore6').hide();
    }
    });


    size_li7 = $("#tabs-7 .blogtab7").size();
  //alert(size_li);
   x7=5;
    if(x7 >= size_li7){
      $('#loadMore7').show();
      $('#nomore7').hide();
    }
    $('#tabs-7 .blogtab7:lt('+x7+')').show();
    $('#loadMore7').click(function () {
        x7= (x7+5 <= size_li7) ? x7+5 : size_li7;
        $('#tabs-7 .blogtab7:lt('+x7+')').slideDown(1000);
    if(x7 >= size_li7){
      $('#loadMore7').show();
      $('#nomore7').show();
    }
    });

*/
/*    size_li8 = $("#tabs-8 .blogtab8").size();
  //alert(size_li);
    x8=5;
    if(x8 >= size_li8){
      $('#loadMore8').show();
      $('#nomore8').hide();
    }
    $('#tabs-8 .blogtab8:lt('+x8+')').show();
    $('#loadMore8').click(function () {
        x8= (x8+5 <= size_li8) ? x8+5 : size_li8;
        $('#tabs-8 .blogtab8:lt('+x8+')').slideDown(1000);
    if(x8 >= size_li8){
      $('#loadMore8').show();
      $('#nomore8').hide();
    }
    });*/
});
$(document).ready(function(){
    $("#barmatches1 li a").click(function(e){
    $("#barmatches1 li a").removeClass('active');
        e.preventDefault();
        var showIt =  $(this).attr('href');
        $(".tabcontent").hide();
        $(showIt).show();
    $(this).addClass('active');          
    });
  $('#formsubmit').click(function(){
    //alert('dd');
    //if($('#banner_search').val()==''){
      $('#findval').val($('#banner_search').val());
      $('#displayval').val($('#banner_search').val());
      $('#findid').val('');
      $('#findtype').val('Search');
    //}
    $('#findmatch').submit();
  });
  $('#formsubmitheader').click(function(){
    //if($('#header_search').val()==''){
      $('#findvalheader').val($('#header_search').val());
      $('#displayvalheader').val($('#header_search').val());
      $('#findidheader').val('');
      $('#findtypeheader').val('Search');
    //}
    $('#findmatchfloat').submit();
  });
  

  $("#banner_search").keypress(function(event) {
      if (event.which == 13) {
      event.preventDefault();
      $('#findval').val($('#banner_search').val());
      $('#displayval').val($('#banner_search').val());
      $('#findid').val('');
          $('#findtype').val('Search');
        $('#findmatch').submit();
    }
  });

  $("#header_search").keypress(function(event) {
    if (event.which == 13) {
      event.preventDefault();
      $('#findvalheader').val($('#header_search').val());
      $('#displayvalheader').val($('#header_search').val());
      $('#findidheader').val('');
      $('#findtypeheader').val('Search');
      $('#findmatchfloat').submit();
    }
  });


});
</script>

<script type="text/javascript">
//$(document).ready(function(){
    //$("#save_facility").click(function(e){
      //window.location.href=window.location.href;
     // alert("Facility Updated Successfully");

     // });
    //$("#save_sc_details").click(function(e){
      //window.location.href=window.location.href;
      //alert("Schedule  Updated Successfully");
     // });
    
 // });
  

</script>

<script>
// Get the modal

var modal_2 = document.getElementById('sub_btn_a');

var btn1 = document.getElementById("sub_btn_about");

var span2 = document.getElementsByClassName("close_1")[0];

// When the user clicks on the button, open the modal 


// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    modal_2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal_2) {
        modal_2.style.display = "none";
    }
}


</script>


<script>

$(document).ready(function(){
   $("#image1").click(function(){ 
if($("#image1").attr("src") == "http://dev.sportshub365.com/images/toggle-icon1.png"){
$("#image1").attr("src", "http://dev.sportshub365.com/images/toggle-icon2.png");
}
 else{
$("#image1").attr("src", "http://dev.sportshub365.com/images/toggle-icon1.png");
}
});
}); 

$(document).ready(function(){
   $("#image2").click(function(){ 
if($("#image2").attr("src") == "http://dev.sportshub365.com/images/toggle-icon1.png"){
$("#image2").attr("src", "http://dev.sportshub365.com/images/toggle-icon2.png");
}
 else{
$("#image2").attr("src", "http://dev.sportshub365.com/images/toggle-icon1.png");
}
});
}); 



$(document).ready(function(){
   $("#image3").click(function(){ 
if($("#image3").attr("src") == "http://dev.sportshub365.com/images/toggle-icon1.png"){
$("#image3").attr("src", "http://dev.sportshub365.com/images/toggle-icon2.png");
}
 else{
$("#image3").attr("src", "http://dev.sportshub365.com/images/toggle-icon1.png");
}
});
}); 


$(document).ready(function(){
   $("#image4").click(function(){ 
if($("#image4").attr("src") == "http://dev.sportshub365.com/images/toggle-icon1.png"){
$("#image4").attr("src", "http://dev.sportshub365.com/images/toggle-icon2.png");
}
 else{
$("#image4").attr("src", "http://dev.sportshub365.com/images/toggle-icon1.png");
}
});
}); 




$(document).ready(function(){
  
  $(".toggle-content1").slideToggle();
  $("#save_schedule").removeClass('deactive');

   $(".toggle-icon1").click(function(e){
     $(".toggle-content1").slideToggle();
     $("#save_schedule").toggleClass('deactive');
   });
   
   $(".toggle-icon2").click(function(e){
     $(".toggle-content2").slideToggle();
     //$("#save_facility").removeClass('deactive');
     $("#save_facility").toggleClass('deactive');
   });
   
    $(".toggle-icon3").click(function(e){
     $(".toggle-content3").slideToggle();
   });
   
   $(".toggle-icon4").click(function(e){
     $(".toggle-content4").slideToggle();
   });
  });

</script>



 <script type="text/javascript">
          
    function checkfuntion(){
    
    if($("#check-14").is(':checked') == true)
      {$('label[for="check-14"]').addClass('checked');}
    else 
    {$('label[for="check-14"]').removeClass('checked');}
    }                 
  </script>

   </script>
         <script type="text/javascript">
          
          function happy_form(e){
            $('#happy_frm').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url:'LiveBar',
                    type:'post',
                    data:$('#happy_frm').serialize(),
                     beforeSend: function(){
                           $('.preloader').show();
                        },
                    success:function(){
                      $('.preloader').hide();
                    $("#happyhr_hide").load("LiveBar/happyhour");
                    }
                }).done(function(data) {
                                $('.preloader').hide();
                              });
                $("#happyhr_show").addClass('deactive');
                $("#happyhr_hide").removeClass('deactive');
                $("#happ_button").show();
                $("#opp_button").show();
                
            });
        }
        </script>

        <script type="text/javascript">
          
          function frm_facility(e){
            $('#opening_frm_facility').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url:'LiveBar',
                    type:'post',
                    data:$('#opening_frm_facility').serialize(),
                     beforeSend: function(){
                           $('.preloader').show();
                        },
                    success:function(){
                        $('.preloader').hide();
                    },
                    error: function(xhr) { // if error occured
                          $('.preloader').hide();
                          //alert('All Field Required')
                          
                          //err_msg_box.style.display = "block";
                          
                        },
                        complete: function() {
                           $('.preloader').hide();
                        },


                }).done(function(data) {
                                $('.preloader').hide();
                              });
                
            });
        }
        </script>

        <script type="text/javascript">
          
          function opening_schedule(e){
            $('#opening_schedule1').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url:'LiveBar/sschedule',
                    type:'post',
                    data:$('#opening_schedule1').serialize(),
                    success:function(){
                       //$("#oldopening_").load("LiveBar/opening");
                        //alert("success");
                       // $('#address1').load("LiveBar/opening");
                    }
                });
          
            });
           
        }
        </script>





      
        <script type="text/javascript">

                       $(document).ready(function() {
                       var today= '';
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+0 day")); ?>";
                        var datet_id_end= "<?php echo date("Y-m-d", strtotime("+360 day")); ?>";
                         var all= 365;
                        //alert(datet_id);
                         var offset_id = 0;
                         var increment=7; 
                        var total_count=offset_id+increment;
                        //alert(total_count);
                        document.getElementById("counti2").value =total_count;
                        var tbl=1+offset_id;

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1,all_:all, searchapi2:searchapi_2,date_end:datet_id_end, banner_search:banner_search },
                         url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },

                        success: function(responsedata) {
                        $('.preloader').hide();
                        //  alert('sd');
                        $('#tab1result').empty().append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            //$("#apend").after("LiveBar/tab1loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        });
       


                        $(".loadMore1_").click(function() {
                        //var offset_id1 = document.getElementById('count1');
                        $('#onpagelodetab1').hide();

                         var today= '';
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+0 day")); ?>";
                        var datet_id_end= "<?php echo date("Y-m-d", strtotime("+360 day")); ?>";
                         var all= 365;
                        //alert(datet_id);
                         var offset_id = $('#tabs-1 .allsearch_sch').length;
                        // alert(offset_id);
                         var increment=300; 
                        var total_count=offset_id+increment;
                        //alert(total_count);
                        document.getElementById("counti2").value =total_count;
                        var tbl=1+offset_id+increment;

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1,all_:all, searchapi2:searchapi_2,date_end:datet_id_end, banner_search:banner_search },
                         url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },

                        success: function(responsedata) {
                        $('.preloader').hide();
                        //  alert('sd');
                        $('#tab1result').append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            $("#apend").after("LiveBar/tab1loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        });
       



          
                         $(".loadMore2_").click(function() {
                        //var offset_id1 = document.getElementById('count1');
                        $('#onpagelodetab2').hide();

                         var today= '';
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+0 day")); ?>";
                        var datet_id_end= "<?php echo date("Y-m-d", strtotime("+1 day")); ?>";
                        //alert(datet_id);
                         var offset_id = $('#tabs-2 .allsearch_sch').length;
                         var increment=2000; 
                        var total_count=offset_id+increment;
                        //alert(total_count);
                        document.getElementById("counti2").value =total_count;
                        var tbl=2+offset_id+increment;

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2,date_end:datet_id_end, banner_search:banner_search },
                         url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },

                        success: function(responsedata) {
                        $('.preloader').hide();
                        //  alert('sd');
                        $('#tab2result').append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            $("#apend").after("LiveBar/tab1loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        });
        </script>




        <script type="text/javascript">

        $(".loadMore3_").click(function(event) {
                            var today= "<?php echo date("Y-m-d", strtotime(" +1 day")) ?>";

                         var datet_id= "<?php echo date("Y-m-d", strtotime(" +1 day")) ?>";
                         var offset_id = $('#tabs-3 .allsearch_sch').length;
                         var increment=3000; 
                        var total_count=offset_id+increment;
                        //alert(datet_id);
                        document.getElementById("counti2").value =total_count;
                        var tbl=3+offset_id+increment;

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                         url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },

                        success: function(responsedata) {
                        $('.preloader').hide();
                        //  alert('sd');
                        $('#tab3result').append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            //$("#apend").after("LiveBar/tab1loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        });


        $(".loadMore4_").click(function(event) {
                        //var offset_id1 = document.getElementById('count1');

                        var offset_id = $('#tabs-4 .allsearch_sch').length;
                        var increment=4000; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=4+offset_id+increment;
                        
                         var today= "<?php echo date("Y-m-d", strtotime(" +2 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+2 day")); ?>";

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                          $('.preloader').hide();

                        //  alert('sd');
                        $('#tab4result').append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            //$("#apend").after("LiveBar/tab1loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        });

        $(".loadMore5_").click(function(event) {
                        //var offset_id1 = document.getElementById('count1');

                        var offset_id = $('#tabs-5 .allsearch_sch').length;
                        var increment=5000; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=5+offset_id+increment;
                         var today= "<?php echo date("Y-m-d", strtotime(" +3 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+3 day")); ?>";

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                        data: {tbl_:tbl,offset_:offset_id,date_:datet_id,  today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                          $('.preloader').hide();
                        //  alert('sd');
                        $('#tab5result').append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                       $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            // $("#apend").after("LiveBar/tab1loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        });

         $(".loadMore6_").click(function(event) {
                        //var offset_id1 = document.getElementById('count1');

                        var offset_id = $('#tabs-6 .allsearch_sch').length;
                        var increment=6000; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=7+offset_id+increment;
                          var today= "<?php echo date("Y-m-d", strtotime(" +4 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+4 day")); ?>";
                          var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                        data: {tbl_:tbl,offset_:offset_id,date_:datet_id,  today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                         beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                          $('.preloader').hide();
                        //  alert('sd');
                        $('#tab6result').append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            //$("#apend").after("LiveBar/tab1loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        });

                        $(".loadMore7_").click(function(event) {
                        //var offset_id1 = document.getElementById('count1');

                        var offset_id = $('#tabs-7 .allsearch_sch').length;
                        var increment=7000; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=7+offset_id+increment;
                        var today= "<?php echo date("Y-m-d", strtotime(" +5 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+5 day")); ?>";
                          var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                       // alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                        $('.preloader').hide();
                        $('#tab7result').append(responsedata).slideDown(1000);
                        $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        });



                         
                        $(".loadMore8_").click(function(event) {
                        //var offset_id1 = document.getElementById('count1');

                        var offset_id = $('#tabs-8 .allsearch_sch').length;
                        
                        var increment=8000; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=8+offset_id+increment;
                          var today= "<?php echo date("Y-m-d", strtotime(" +6 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+6 day")); ?>";
                          var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                        data: {tbl_:tbl,offset_:offset_id,date_:datet_id,  today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                               $('.preloader').hide();
                           
                        //  alert('sd');
                        $('#tab8result').append(responsedata);
                        $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                      });
                    });

        </script>


            <script type="text/javascript">

                        $(document).ready(function() {


                       

                        
                       });
                          


                    function gototab4(){
                      $('#noschedule4').hide();

                      var offset_id = 0;
                      var increment=0; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=4+offset_id;
                          var today= "<?php echo date("Y-m-d", strtotime(" +2 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+2 day")); ?>";

                          var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                          $('.preloader').hide();
                        //  alert('sd');
                        $('#tab4result').empty().append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        
                        
                    }

                    function gototab5(){
                      $('#noschedule5').hide();

                      var offset_id =0;
                      var increment=0; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=5+offset_id;
                        var today= "<?php echo date("Y-m-d", strtotime(" +3 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+3 day")); ?>";

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                        data: {tbl_:tbl,offset_:offset_id,date_:datet_id,  today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                         beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                          $('.preloader').hide();

                        //  alert('sd');
                        $('#tab5result').empty().append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                       

                      
                    }

                    function gototab6(){
                      $('#noschedule6').hide();

                      var offset_id = 0;
                      var increment=0; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=6+offset_id;
                      var today= "<?php echo date("Y-m-d", strtotime(" +4 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+4 day")); ?>";
                          var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                       // alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                        data: {tbl_:tbl,offset_:offset_id,date_:datet_id,  today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                           $('.preloader').hide();
                        //  alert('sd');
                        $('#tab6result').empty().append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                     });
                        


                    }

                    function gototab7(){
                      $('#noschedule7').hide();

                         var offset_id = 0;
                        var increment=0; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=7+offset_id;
                       var today= "<?php echo date("Y-m-d", strtotime(" +5 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+5 day")); ?>";
                          var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                       // alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,offset_:offset_id,date_:datet_id,  today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                        $('.preloader').hide();
                        $('#tab7result').empty().append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                      

                    }

                    function gototab8(){
                      $('#noschedule8').hide();

                        var offset_id = 0;
                        var increment=0; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=8+offset_id;
                       var today= "<?php echo date("Y-m-d", strtotime(" +6 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+6 day")); ?>";
                          var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                       // alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,offset_:offset_id,date_:datet_id,  today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                        $('.preloader').hide();
                        $('#tab8result').empty().append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        $("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                      

                    }

                    
                    function gototab2(){
                        $('#onpagelodetab2').hide();
                        $('#noschedule2').hide();

                        var offset_id = 0;
                        //alert($('#tabs-1 .allsearch_sch').length);
                        //alert(offset_id);
                        var today= '';
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+0 day")); ?>";
                        var increment=0; 
                        var total_count=offset_id+increment;
                        //document.getElementById("counti2").value =total_count;
                        var tbl=2+offset_id;
                        //alert(total_count);

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                         url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },

                        success: function(responsedata) {
                          $('.preloader').hide();
                        //  alert('sd');
                        $('#tab2result').empty().append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow q')
                            //alert('done');
                        }
                                        });
                        
                    }

                     function gototab1(){
                        $('#onpagelodetab1').hide();

                         var today= '';
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+0 day")); ?>";
                        var datet_id_end= "<?php echo date("Y-m-d", strtotime("+360 day")); ?>";
                         var all= 365;
                        //alert(datet_id);
                         var offset_id = 0;
                        // alert(offset_id);
                         var increment=300; 
                        var total_count=offset_id+increment;
                        //alert(total_count);
                        document.getElementById("counti2").value =total_count;
                        var tbl=1+offset_id+increment;

                        var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                        //alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       data: {tbl_:tbl,offset_:offset_id,date_:datet_id, today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1,all_:all, searchapi2:searchapi_2,date_end:datet_id_end, banner_search:banner_search },
                         url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },

                        success: function(responsedata) {
                        $('.preloader').hide();
                        //  alert('sd');
                        $('#tab1result').empty().append(responsedata).slideDown(1000);
                        //  $("#apend").load("LiveBar/loadschedulemore");
                        //$("#apend").after("LiveBar/loadsearchschedule").innerHTML;
            //$("#apend").after("LiveBar/tab1loadsearchschedule").innerHTML;
            resetCustomInput();
            $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                                        });
                        
                    }



                    function gototab3(){
                      $('#noschedule3').hide();
                        var offset_id = 0;
                        var increment=0; 
                        var total_count=offset_id+increment;
                        document.getElementById("counti2").value =total_count;
                        var tbl=3+offset_id;
                        var today= "<?php echo date("Y-m-d", strtotime(" +1 day")) ?>";
                        var datet_id= "<?php echo date("Y-m-d", strtotime("+1 day")); ?>";
                        //alert(datet_id);

                          var findval_=$("#findval").val();
                        var displayval_=$("#displayval").val();
                        var findid_=$("#findid").val();
                        var findtype_=$("#findtype").val();
                       // alert(findtype_)
                        var float_=$("#float").val();
                        var searchapi_1=1;
                        var searchapi_2=$("#searchapi1").val();
                        var banner_search=$("#banner_search").val();
                      
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                       
                        data: {tbl_:tbl,offset_:offset_id,date_:datet_id,  today_:today, findval:findval_, displayval:displayval_, findid:findid_, findtype:findtype_, float:float_, searchapi1:searchapi_1, searchapi2:searchapi_2, banner_search:banner_search },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/loadschedulemore",
                        beforeSend: function(){
                               $('.preloader').show();
                            },
                        success: function(responsedata) {
                $('.preloader').hide();
                $('#tab3result').empty().append(responsedata);
                resetCustomInput();
                $('.example').makeScroll();
                        },
                        error: function (xhr, status) {
                                           // alert("Sorry, there was a problem!");
                        },
                        complete: function (xhr, status) {
                            //$('#showresults').slideDown('slow')
                            //alert('done');
                        }
                    });
                    
                    }
        




<!--//////////////////////////////////////////////////////////////////////////-->
                    function opening_form(e){
                      $('#opening_frm').submit(function(e){
                          e.preventDefault();
                          $.ajax({
                              url:'LiveBar',
                              type:'post',
                              data:$('#opening_frm').serialize(),
                              beforeSend: function(){
                               $('.preloader').show();
                            },
                              success:function(){
                                $('.preloader').hide();
                                 $("#oldopening_").load("LiveBar/opening");
                                  //alert("success");
                                 // $('#address1').load("LiveBar/opening");
                              }
                          }).done(function(res) {
                                $('.preloader').hide();
                              });

                      $("#openinghour_").addClass('deactive');
                      $("#oldopening_").removeClass('deactive');
                      $("#happ_button").show();
                      $("#opp_button").show();

                    

                      });
                     
                  }
 </script>

 
 <script type="text/javascript">
   function gotosubmit($x){

     var fixture_id=$('#fixture_id_name'+$x).val();
     var est_ref_id=$('#establishment_ref_name'+$x).val();
     var sport_id=$('#sport_id_name'+$x).val();
     var competition_id=$('#competition_ref_id_name'+$x).val();
                       
     //alert($x);
     //alert(fixture_id);
     //alert(est_ref_id);
     //alert(sport_id);alert(competition_id);

      $.ajax({
                        type: "post",
                        dataType : "html",
                       
                        data: {fixture_id:fixture_id,est_ref_id:est_ref_id,sport_id:sport_id, competition_id:competition_id },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/goto_add_ckbox_data",
                       
                        success: function(responsedata) {
                        },
                        error: function (xhr, status) {
                        },
                        complete: function (xhr, status) {
                        }
                    });
   }
 </script>

  <script type="text/javascript">
   function gotosubmit_weak($x,$i){

     var fixture_id=$('#fixture_id'+$x+$i).val();
     var est_ref_id=$('#establishment_ref'+$x+$i).val();
     var sport_id=$('#sport_id'+$x+$i).val();
     var competition_id=$('#competition_ref_id'+$x+$i).val();
                       
     //alert(+$x+$i);
     //alert(fixture_id);
     //alert(est_ref_id);
     //alert(sport_id);alert(competition_id);

      $.ajax({
                        type: "post",
                        dataType : "html",
                       
                        data: {fixture_id:fixture_id,est_ref_id:est_ref_id,sport_id:sport_id, competition_id:competition_id },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/goto_add_ckbox_data",
                       
                        success: function(responsedata) {
                        },
                        error: function (xhr, status) {
                        },
                        complete: function (xhr, status) {
                        }
                    });
   }
 </script>

  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

  <script type="text/javascript">
    //Stripe.setPublishableKey('pk_live_j9EGwTU2Ckeo9hFF2yHrkHns');
    Stripe.setPublishableKey('pk_live_j9EGwTU2Ckeo9hFF2yHrkHns');
    $(function() {
    var $form = $('#payment-form');
   $form.submit(function(event) {
      
    // Disable the submit button to prevent repeated clicks:
    $form.find('.submit').prop('disabled', true);
    $form.find('.submit').val('Please wait...');

    // Request a token from Stripe:
    Stripe.card.createToken($form, stripeResponseHandler);
    // Prevent the form from being submitted:
    return false;
    });
  });
  function stripeResponseHandler(status, response) {
  
  if (response.error) {
    alert(response.error.message);
    var $form = $('#payment-form');
    $form.find('.submit').prop('disabled', false);
    $form.find('.submit').val('Submit Payment');
  } 
  else {
    //alert('debug');
    var plan = $(".subscribe_plan:checked").val();     
    //var plan = 'statndard_daily_plan';
    var amount = $("#subscribe_amount").val();     
      $.ajax({
      url: '<?php echo base_url('payment/process');?>',
      data: {access_token: response.id,plan:plan,amount:amount},
      type: 'POST',
      dataType: 'JSON',
      success: function(response, status, xhr){
        var ct = xhr.getResponseHeader("content-type") || "";
        //alert(ct);
        console.log(response);
        if(response)
          alert('Payment successfully completed.');
        else{
          alert('Something went wrong. Please try again later..');
        }
        $("#payment_form").hide();
        //$("#payment_update").show();
        // $("#payment_update_text").html(response.success) 
        window.location.href="<?php echo base_url('establishment/profile_settings'); ?>";
      },
      error: function(XMLHttpRequest, textStatus, errorThrown){
      alert(errorThrown);
      
      console.log(error);
      window.location.href="<?php echo base_url('establishment/profile_settings'); ?>";
      }
      });
    //console.log(response.id);
  }
  }
  $('.subscribe_plan').click(function(){
     $('#subscribe_amount').val($(this).data('amount'));
  })
  </script>
<script type="text/javascript">

 var timeleft = 5;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
   
    },1500);

</script>

<script type="text/javascript">
$("#num").show();
setTimeout(function() { $("#num").hide(); }, 6000);
$("#button").hide();
setTimeout(function() { $("#button").show(); }, 6000);
$(".close_1").click(function()
{
  /*$(".thanku-popup").hide();*/
  window.location.href='<?php echo base_url();?>LiveBar'
});
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.simplePopup_1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.show_payment_form').click(function(){
  $('#show_payment_form').simplePopup();
    });
      $('.show_banner_form').click(function(){
  $('#show_banner_form').simplePopup();
    });

});
</script>

<script type="text/javascript">
  
  $(document).ready(function(){

       //alert($('#findval').val());

            if($('#findval').val()!=''){
             // alert('hii');

      $("html, body").scrollTop($('#jumptosearch').offset().top);

  };
    })

</script>


          <script type="text/javascript">
             function gotoprint(){

                 
                        var est_ref_ids=$("#est_ref_ids").val();
                        var sync_date=$("#sync_date").val();
                        //alert(est_ref_ids);
                        //alert(sync_date);
                        //alert(datet_id);
                        $.ajax({
                        type: "post",
                        dataType : "html",
                        data: {est_ref_ids_:est_ref_ids,sync_date_:sync_date },
                        url: "<?php echo base_url(); ?>" + "index.php/LiveBar/printschedulemore",
                      
                        success: function(responsedata) {
                        

                          if(responsedata=="null"){
                             $('#noschedule1').show();
                             $('#noschedule2').show();
                             $('#noschedule3').show();
                             $('#noschedule4').show();
                             $('#noschedule5').show();
                             $('#noschedule6').show();
                             $('#noschedule7').show();
                             $('#noschedule8').show();
                           
                           //window.location = "http://dev.sportshub365.com/establishment_my_tv_schedule/downloadpdf?cp=&ppr=&date_from=&date_end=&search_text=&sport_id=";
                          }

                           if(responsedata!="null"){
                              //alert(responsedata);
                           
                           window.location = "http://sportshub365.com/establishment_my_tv_schedule/downloadpdf?cp=&ppr=&date_from=&date_end=&search_text=&sport_id=";
                            $('#noschedule1').hide();
                            $('#noschedule2').hide();
                             $('#noschedule3').hide();
                             $('#noschedule4').hide();
                             $('#noschedule5').hide();
                             $('#noschedule6').hide();
                             $('#noschedule7').hide();
                             $('#noschedule8').hide();
                           
                          }
                        },
                        error: function (xhr, status) {
                        },
                        complete: function (xhr, status) {
                        }
                        });
                        
                        
                    }
          </script>

</body>
</html>
