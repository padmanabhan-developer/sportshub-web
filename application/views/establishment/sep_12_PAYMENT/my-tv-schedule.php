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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>js/establishment/tv_schedule.js"></script>
<script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/establishment/core.js"></script>
    
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
  
  </script>
  <?php include('google_analytics.php')?>
  </head>
  <body>
  <div class="preloader">
<div class="status"> </div>
</div>
  <div class="wrapper barwrapper">
	<?php $this->load->view('establishment/header');?>    
    <?php $this->load->view('establishment/left-menu');?>    
    <div id="content" class="barcontent">
       <div  class="col-md-10">

       <div align="center" style="padding: 20px;
    background: #e1c124;
    margin-bottom: 25px;color: white;
    font-weight: bold;">
         <h2 align="center">Congratulations!</h2>
         <h5 align="center" style="margin-top: 10px;    font-family: 'FjallaOneRegular';">You have successfully set up your account. Go to events and offers to give your profile, a little something extra</h5>
         <h5 align="center" style="margin-top: 10px;    font-family: 'FjallaOneRegular';">Here you can see your selected fixtures; time, date and channel showing the sport.</h5>
         <br>
         <center><a href="<?php echo base_url();?>establishment/events" class="btn btn-primary" style="background: #1b80de;">GO TO EVENTS</a>&nbsp;&nbsp;&nbsp;
         <a class="btn btn-primary" href="<?php echo base_url();?>establishment/offers" style="background: #1b80de;">GO TO OFFERS</a></center>
       </div>
            <a href="<?php echo base_url();?>establishment/schedule" class="add-new-event">Go to  tv schedule</a>
            <div class="events">
                   <h2 class="title2">My TV schedule:</h2>
                    <?php  echo form_open("",$attribute_search['form']);
                        echo form_hidden('caller','Search'); ?>
                       <div class="event-form tv-event-form">
                   
                           
                      <span class="event-form-box">
                      <input id="datepicker-tvschedule-from" class="date-input" type="text" placeholder="Date From" tabindex="1" value="<?php echo $date_from;?>" name="date_from" readonly >
                           <?php //echo form_input($attribute_search['date_from']);?>
                        </span>
                        
                        <span class="event-form-box">
                        <input id="datepicker-tvschedule-to" class="date-input" type="text" placeholder="Date To" tabindex="1" value="<?php echo $date_end;?>" name="date_end" readonly >
                           <?php //echo form_input($attribute_search['date_end']);?>
                        </span>
                        
                        <span class="event-form-box">
                        <input id="search_text_tvschedule" class="date-input" type="text" value="<?php echo $search_text;?>"  placeholder="Search" name="search_text">
                             <?php //echo form_input($attribute_search['search_text']);?>
						<input class="search-button" id="search-button-tvschedule" type="button" >
                              <?php //echo form_submit($attribute_search['submit']);?>
                        </span>
                        <input type="hidden" id="path" value="<?php echo base_url();?>establishment/">
                       
                   </div><!-- close event-form -->
                   
                   <div class="event_row">
                      <ul>
                            <input id="total_sports" type="hidden" value="<?php echo count($sport_list);?>" name="total_sports">    
                            <?php
                            $j=5;
                            $s=0;
                             $checked_sport_arr=explode("~",$sport_id);
                           // print_r($checked_sport_arr);
                            foreach($sport_list as $sport)
                            {
                              $j++;
                              $s++;
                              ?> 
                                <li>
                                   <span class="checkbox-box2">
                                  <input id="sport_<?=$s?>" class="checkBox"  <?php if(in_array($sport['id'], $checked_sport_arr)) echo "checked='checked'";?> type="checkbox" 
                                   onclick="ShowSportFixture('<?php echo base_url();?>establishment/')"
                                    value="<?php echo $sport['id'];?>" name="sport_<?=$s?>" style="">
                                   <label for="sport_<?=$s?>"><?=$sport['sport_name']?></label></span>

                                  </li>
                            <?php
                            }
                            ?>
                                
                            </ul>
                   </div><!-- close event_row -->
                   
                    <div class="events-inner" id="show_fixture">
                        <?php $this->load->view('establishment/display-my-tv-schedule');
                       
                        ?>    

 </div> <!-- close events-inner -->

              </div><!-- close events -->
                     <div style="width:100%; float:left;">&nbsp;</div>
       <div class="pagination_ad">
            <center>
            <?php 
            $ad_random11 = rand(1,10);
            ?>
            <!-- SH365_Leaderboard -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-9427943540446316"
                 data-ad-slot="6688987852"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            </center>
        </div>

              <?php if(count($fixture_list)>0) { ?>
               <div class="button_div">
                 <!-- <a href="<?php echo base_url();?>establishment/downloadpdf" target="_blank" class="butoon_print">Print</a>-->
 					<a href="javascript:;" onClick="ShowSportFixturePDF('<?php echo base_url();?>establishment_my_tv_schedule/')" class="butoon_print">Print</a>
                    <a class="butoon_email" id="email_send">Email</a>
             </div>
             <div class="tvprovider_title" id="error" style="display:none; text-align:right"></div>
             
             <?php } ?> 
            <div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=8255706607fc613d355&width=728&height=90"></script></div> 
         </div><!-- close container -->
    <?php 
  $ad_random1 = rand(1,10);
  $ad_random2 = rand(1,10);
  $ad_random3 = rand(1,10);
  $ad_random4 = rand(1,10);
  ?>
     <div class="col-md-2 table-overflow">
              <div class="row">
                <div class="col-md-12 right-sidebar">
            <!-- SH365_Skyscraper -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:160px;height:600px"
                 data-ad-client="ca-pub-9427943540446316"
                 data-ad-slot="7421639112"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
                </div>
              </div>
            </div>
            <div class="col-md-2 table-overflow">
      <div class="row">
        <div class="col-md-12 right-bar">
            <!-- SH365_Skyscraper -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:160px;height:600px"
                 data-ad-client="ca-pub-9427943540446316"
                 data-ad-slot="7421639112"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div class="col-md-12 right-bar">
            <!-- SH365_Skyscraper -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:160px;height:600px"
                 data-ad-client="ca-pub-9427943540446316"
                 data-ad-slot="7421639112"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div class="col-md-12 right-bar">
            <!-- SH365_Skyscraper -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:160px;height:600px"
                 data-ad-client="ca-pub-9427943540446316"
                 data-ad-slot="7421639112"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <!--<div class="col-md-12 right-bar">&nbsp;</div>
        <div class="col-md-12 right-bar">&nbsp;</div>
        <div class="col-md-12 right-bar">&nbsp;</div>-->
      </div>
    </div>
 
    </div><!-- close content -->
  </div><!--close wrapper-->
    
    <!-- jQuery 2.1.3 -->
    
    <!-- jQuery UI 1.11.2 -->
  	<script type="text/javascript">
    $('#datepicker-tvschedule-from').Zebra_DatePicker({
		format: 'd/m/Y',
		onSelect: function(view, elements) {
			var pathval = $('#path').val();
			var checked_sports=Array();
			var checked_sports_string,is_checked_sport=false;
			if(total_sports > 0)
			{	
				var j=0;
				for(i=1;i<=total_sports;i++)
				{
					if(document.getElementById('sport_'+i).checked == true)
					{   
						checked_sports[j]=document.getElementById('sport_'+i).value;
						is_checked_sport=true;
						j++;
					}
				}
			}
			if(is_checked_sport == true)
			{
				checked_sports_string=checked_sports.join('~');
			}
			 else checked_sports_string='';
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,checked_sports_string);
		}
	});
	$('#datepicker-tvschedule-to').Zebra_DatePicker({format: 'd/m/Y',
			onSelect: function(view, elements) {
			var checked_sports=Array();
			var checked_sports_string,is_checked_sport=false;
			if(total_sports > 0)
			{	
				var j=0;
				for(i=1;i<=total_sports;i++)
				{
					if(document.getElementById('sport_'+i).checked == true)
					{   
						checked_sports[j]=document.getElementById('sport_'+i).value;
						is_checked_sport=true;
						j++;
					}
				}
			}
			if(is_checked_sport == true)
			{
				checked_sports_string=checked_sports.join('~');
			}
			 else checked_sports_string='';
			var pathval = $('#path').val();
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,checked_sports_string);
		}

	});
	$('.dp_clear').click(function() {
			var pathval = $('#path').val();
			var checked_sports=Array();
			var checked_sports_string,is_checked_sport=false;
			if(total_sports > 0)
			{	
				var j=0;
				for(i=1;i<=total_sports;i++)
				{
					if(document.getElementById('sport_'+i).checked == true)
					{   
						checked_sports[j]=document.getElementById('sport_'+i).value;
						is_checked_sport=true;
						j++;
					}
				}
			}
			if(is_checked_sport == true)
			{
				checked_sports_string=checked_sports.join('~');
			}
			 else checked_sports_string='';
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,checked_sports_string);
		
	});
	$( "#search_text_tvschedule" ).keyup(function(event) {
		if(event.which == 13){
			var checked_sports=Array();
			var checked_sports_string,is_checked_sport=false;
			if(total_sports > 0)
			{	
				var j=0;
				for(i=1;i<=total_sports;i++)
				{
					if(document.getElementById('sport_'+i).checked == true)
					{   
						checked_sports[j]=document.getElementById('sport_'+i).value;
						is_checked_sport=true;
						j++;
					}
				}
			}
			if(is_checked_sport == true)
			{
				checked_sports_string=checked_sports.join('~');
			}
			 else checked_sports_string='';
			var pathval = $('#path').val();
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,checked_sports_string);
		}
	});
	$('#search-button-tvschedule').click(function() {
			var pathval = $('#path').val();
			var checked_sports=Array();
			var checked_sports_string,is_checked_sport=false;
			if(total_sports > 0)
			{	
				var j=0;
				for(i=1;i<=total_sports;i++)
				{
					if(document.getElementById('sport_'+i).checked == true)
					{   
						checked_sports[j]=document.getElementById('sport_'+i).value;
						is_checked_sport=true;
						j++;
					}
				}
			}
			if(is_checked_sport == true)
			{
				checked_sports_string=checked_sports.join('~');
			}
			 else checked_sports_string='';
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,checked_sports_string);
		
	});
	
	$('#email_send').click(function() {
		var total_sports=$("#total_sports").val();
		//$('.preloader').show();
		var checked_sports=Array();
		var checked_sports_string,is_checked_sport=false;
		if(total_sports > 0)
		{
			var j=0;
			for(i=1;i<=total_sports;i++)
			{
				if(document.getElementById('sport_'+i).checked == true)
				{   
					checked_sports[j]=document.getElementById('sport_'+i).value;
					is_checked_sport=true;
					j++;
				}
			}
		}
		if(is_checked_sport == true)
		{
			checked_sports_string=checked_sports.join('~');
		}
		else checked_sports_string='';
		date_from=$('#datepicker-tvschedule-from').val();
		date_end = $('#datepicker-tvschedule-to').val();
		search_text= $('#search_text_tvschedule').val();
		$('#error').hide();		
		$.ajax({
		url: '<?php echo base_url();?>establishment/emailpdf',
		type: "GET",
		data: { sport_id:checked_sports_string, date_from:date_from, date_end:date_end, search_text:search_text },
		success: function(data){
				if(data) {
					if(data == 1){
						$('#error').html('Please Check your registered email!');
						$('#error').show();
					}
					else{
						$('#error').html('We have some problem to send email. Please try again later.');
						$('#error').show();
		
					}
				}
			}
		});  
	});
  </script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script>
  <!-- common script-->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

  <script type="text/javascript">
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
     } else {
      //alert('debug');
      var plan = $(".subscribe_plan:checked").val();     
      var amount = $("#subscribe_amount").val();     
      $.ajax({
        url: '<?php echo base_url('payment/process');?>',
        data: {access_token: response.id,plan:plan,amount:amount},
        type: 'POST',
        dataType: 'JSON',
        success: function(response){

          console.log(response);
          if(response.success)
          alert(response.success);
            $("#payment_form").hide();
          //$("#payment_update").show();
          // $("#payment_update_text").html(response.success) 
          window.location.href="<?php echo base_url('establishment/schedule'); ?>";
        },
        error: function(error){
          console.log(error);
        }
      });
      //console.log(response.id);
    }
   }
  $('.subscribe_plan').click(function(){
     $('#subscribe_amount').val($(this).data('amount'));
  })
  </script>
 <?php $this->load->view('establishment/footer_include');?> 
<?php $this->load->view('establishment/cookie_include');?>
<?php //include('info_links.php')?>
  </body>
</html>