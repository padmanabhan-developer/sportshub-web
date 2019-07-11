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
	<?php include('google_analytics.php')?>
  </head>
  <body>
  <div class="wrapper barwrapper">
	<?php $this->load->view('establishment/header');?>    
    <?php $this->load->view('establishment/left-menu');?>    
    <div id="content" class="barcontent">
       <div class="container">
             <?php
			 /*
			  if(($subscription==0) && ($free_status==0)){?>
              <a href="javascript:void(0);" class="add-new-event" data-cta-target=".js-dialog" >add new event</a>
              <div class="js-dialog  modal  dialog" style="text-align: center;">
                <span class="modal-close-btn"></span>
                <div id="open_event">
                  <?php $this->load->view('stripe/index_other');?>
                </div>
              </div>
             <?php }
             else{
			*/	 
				 ?>
            <a href="javascript:void(0);" class="add-new-event" data-cta-target=".js-dialog" onclick="javascript:OpenAddEventForm('<?php echo base_url();?>establishment/','0');">add new event</a>
              <div class="js-dialog  modal  dialog" style="text-align: center;">
                <span class="modal-close-btn"></span>
                   <div id="open_event">
                   <?php $this->load->view('establishment/add-event');?>
                 </div>
              </div>
    <?php //}?>
              
            <?php if(count($all_events)>0 || $caller=="Search" )
            {
            ?> 
            <div class="events">
                   <h2 class="title2">my events</h2>
                   <div class="event-form">
                    <?php  echo form_open(base_url()."establishment/events",$attribute_search['form']);
                           echo form_hidden('caller','Search'); ?>
                      <span class="event-form-box">
                      <input id="datepicker-events-from" class="date-input" type="text" placeholder="Date From" tabindex="1" value="" name="date_from" readonly >
                           <?php //echo form_input($attribute_search['date_from']);?>
                        </span>
                        
                        <span class="event-form-box">
                         <input id="datepicker-events-to" class="date-input" type="text" placeholder="Date To" tabindex="1" value="" name="date_from" readonly >
                           <?php //echo form_input($attribute_search['date_end']);?>
                        </span>
                        
                        <span class="event-form-box">
                        <input id="search_text_event" class="date-input" type="text"  placeholder="Search" name="search_text">
                             <?php //echo form_input($attribute_search['search_text']);?>

                             <input class="search-button" type="button" >
                        </span>
                        <?php echo form_close();?>
                   </div><!-- close event-form -->

                   <?php 
                   if(count($all_events)>0)
                   {
                    ?>
                   <div class="events-inner" id="events-inner">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>DATE & TIME </th>
                            <th>EVENT DESCRIPTION</th>
                            <th>delete</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach($all_events as $event)
                          {
                            ?>
                          <input type="hidden" id="event_id" value="<?php echo $event['id'];?>" >
                          <tr>
                            <td><?php echo $event['date'];?> - <?php echo $event['time'];?> -
                             <?php echo $date = date('h:i A', strtotime($event['time'])+(3600*$event['duration']));

                             //echo $event['duration'];?></td>
                            
                            <td><a  data-cta-target=".js-dialog" href="javascript:void(0)" title="Click here to edit"  onclick="javascript:OpenAddEventForm('<?php echo base_url();?>establishment/','<?php echo $event['id'];?>');"><?php echo $event['title'];?></a></td>
                            <td><a href="<?php echo base_url();?>establishment_events/delete/<?php echo $event['id'];?>"><img src="<?php echo base_url();?>images/delete-icon.png"></a></td>
                          </tr>
                          <?php } ?><!-- close foreach loop -->
                         
                          </tbody>                        
                         </table>

                   </div><!-- close account-history-inner -->
                   <?php } 
                   else echo "<h2>No result found.<h2>";?><!-- close if statement -->
              </div><!-- close events -->
            <?php } 

            else echo "There is no event. Click on Add New Event button to add event";?>

		<div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=8255706607fc613d355&width=728&height=90"></script></div>
         </div><!-- close container -->
         
    </div><!-- close content -->
    
    
    
    
    
    
  </div><!--close wrapper-->
 <script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script>
<script type="text/javascript" >
$(document).ready(function() {
	$('#datepicker-events-from').Zebra_DatePicker({
		format: 'd/m/Y',
		onSelect: function(view, elements) {
			var from_date = $('#datepicker-events-from').val();
			var to_date = $('#datepicker-events-to').val();
			var search_text = $('#search_text_event').val();
			filter_events('<?php echo base_url();?>establishment/', from_date, to_date, search_text);
		}
	});
	$('#datepicker-events-to').Zebra_DatePicker({format: 'd/m/Y',
			onSelect: function(view, elements) {
			var from_date = $('#datepicker-events-from').val();
			var to_date = $('#datepicker-events-to').val();
			var search_text = $('#search_text_event').val();
			filter_events('<?php echo base_url();?>establishment/', from_date, to_date, search_text);
		}

	});
	$('.dp_clear').click(function() {
			var from_date = $('#datepicker-events-from').val();
			var to_date = $('#datepicker-events-to').val();
			var search_text = $('#search_text_event').val();
			filter_events('<?php echo base_url();?>establishment/', from_date, to_date, search_text);
		
	});
	$( "#search_text_event" ).keyup(function() {
			var from_date = $('#datepicker-events-from').val();
			var to_date = $('#datepicker-events-to').val();
			var search_text = $('#search_text_event').val();
			filter_events('<?php echo base_url();?>establishment/', from_date, to_date, search_text);
	
	});
});
</script>
<script src="<?php echo base_url();?>js/establishment/jquery.timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/form_validation.js"></script>

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
    })
    </script>
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
          window.location.href="<?php echo base_url('establishment/profile_settings'); ?>";
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