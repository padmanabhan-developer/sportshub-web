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
<link href="<?php echo base_url();?>css/jquery.phancy.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/schedule.js"></script>

<style type="text/css">
.tool-addressdown .tooltip-arrow {
left: 188px !important;
top: 71px !important;
}

.tool-addressdown .tooltip-arrow:after, .tool-addressdown .tooltip-arrow:before {
	top: 100% !important;
	left: 50% !important;
	border: solid transparent;
}
.tool-addressdown .tooltip-arrow:after {
	border-color: rgba(136, 183, 213, 0) !important;
	border-top-color:  #d5b421 !important;
	border-width: 19px !important;
	margin-top: 19px !important;
}
.tool-addressdown .tooltip-arrow:before {
	border-color: rgba(194, 225, 245, 0) !important;
	border-top-color: #000 !important;
	border-width: 19px !important;
	margin-top: 20px !important;
}
.tool-addressdown .tooltip.bottom {
    margin-top: 20px !important;
}

      
.stepwizard-step p {
    margin-top: -60px;   
    margin-bottom: 15px;  font-family: 'FjallaOneRegular';
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1.5px;
    background-color: #182847;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
        border-color: #182847;
}
.btn-stepwizard {
    background: #182847;
    color: white;
}

.tooltip-inner {
    max-width: 400px;
    background-color: #d5b421;       box-shadow: 0px 0px 5px 0px #182847;
    text-align: left; font-family: 'FjallaOneRegular';
}

.tooltip.left .tooltip-arrow {
    border-left-color: #d8ba36;
}

.tooltip.top .tooltip-arrow {
    border-top-color: #d8ba36;
}

.tooltip.bottom .tooltip-arrow {
    border-bottom-color: #d8ba36;
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
.tooltip.top .tooltip-arrow {
    bottom: -10px;
    left: 50%;
    margin-left: -5px;
    border-width: 20px 20px 0;
    border-top-color: #d9bb37;
}


.tooltip.top {
    padding: 5px 0;
    margin-top: -30px;
}




.wizard {
    margin: 0px auto;
    background: #d5b522;
    color: white;
        font-family: 'FjallaOneRegular';
}

    .wizard .nav-tabs {
        position: relative;
        margin: 0px auto;
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
    width: 31%;
    margin: 0 auto;
    left: -8%;
    right: 0;
    top: 83%;
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
    width: 35%;
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


@media( max-width : 979px ) {
.connecting-line {
    height: 2px;
    background: #182847;
    position: absolute;
    width: 31% !important;
    margin: 0 auto;
    left: -2% !important;
    right: 0;
    top: 83%;
    z-index: 1;
}
}
@media( max-width : 585px ) {
.connecting-line {
    height: 2px;
    background: #182847;
    position: absolute;
    width: 32% !important;
    margin: 0 auto;
    left: -10% !important;
    right: 0;
    top: 70% !important;
    z-index: 1;
}
.table-overflow{
	display:none !important;
}
.tooltip {
    display: none !important;
}


    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 25px;
        height: 25px;
        line-height: 22px;
    }

    .wizard .nav-tabs > li a {
        width: 25px;
        height: 25px;
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
<body >
<div class="preloader">
<div class="status"> </div>
</div>
<div class="wrapper barwrapper">
	<?php $this->load->view('establishment/header');?>    
    <?php $this->load->view('establishment/left-menu');?>    
<div id="content" class="barcontent">
  <div  class="col-md-10">


<script type="text/javascript">
    $(function () {
      $('#step_1_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('show');
      $('#step_3_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('hide');
      });

    $(function () {
      $('.hidetooltip').on('click', function () {
        $('#step_1_tooltips').tooltip('hide');
      });
    });

    $(function () {
      $(document).on('click', '.hidetooltip2', function () {
        $('#step_3_tooltips').tooltip('hide');
      });
    });

    </script>
       
         
    
      <?php
        $fixture_list1 = 0;
          foreach ($fixture_list as $w => $v) {
            $fixture_list2 = $v['fixture_check'];
            if($fixture_list2 == 'checked')
            {
              $fixture_list1 = 1;
            }
          }
           if($fixture_list1 == 1)
            {
          $step_3 = 2;
          }
          else
          {
                $step_3 = 1;
          }
        ?>

        


        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist" style="border: 1px solid #182847;">


                    <li role="presentation" class="active" style=" margin-left: 13%;">


                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 1</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Add Games And Fixtures To My Tv Schedule</p>
                            </div>
                        </div>

                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <?php if($step_3 == 2) { ?>
                              <span class="round-tab" id="ok">
                                    <i class="fa fa-check" id="ok"></i>
                                </span>
                            <?php } ?>

                            <?php if($step_3 == 1) { ?>
                              
                              <span class="round-tab step1-wizard">
                                </span>
                            <?php } ?>
                             
                        </a>
                    </li>

                    <li role="presentation" class="active">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 2</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Go To My TV Schedule</p>
                            </div>
                        </div>

                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab step2-wizard">
                                </span>
                        </a>
                    </li>   

                    
                </ul>
            </div>

 
        </div>

<br>
<br>
  	<div class="buttons_div">
       <div class="button_row">
        <?php if(count($selected_channel_list)>0) { ?>
            <div class="col3"><a href="#" class="button_left show1">CHOOSE CHANNELS</a></div>
        <?php } ?>    
            <div class="col3"><a href="<?php echo base_url();?>establishment/tv_provider_channel" class="button_middle">CHOOSE TV PROVIDER</a></div>
            <div class="col3"><a href="<?php echo base_url();?>establishment/my_tv_schedule" class="button_right" id="step_3_tooltips" data-toggle="tooltip" data-placement="top" title="<span style='cursor: pointer;' class='hidetooltip2 pull-right'>x</span><b>STEP 2 </b> <br> <span style='text-transform: uppercase;'>Go to My TV Channels to Check the Matches and fixtures you have selected.</span>">Go to my tv schedule</a></div>
        </div>
    </div>
    <div class="schedule" id="channel_search">
      <?php $this->load->view('establishment/channel-schedule');?>
    </div>
    <!--<div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=8255706607fc613d355&width=728&height=90"></script></div>-->
    <!-- close container --> 
  </div>
    <?php 
  $ad_random1 = rand(1,10);
  $ad_random2 = rand(1,10);
  $ad_random3 = rand(1,10);
  $ad_random4 = rand(1,10);
  ?>
      <div class="col-md-2">
          <div class="row table-overflow">
            <div class="col-md-12 right-sidebar">
            <!-- /32361281/DFP_BEHRENTZ_SPORTSHUB_160X600_1 -->
                    <div id='div-gpt-ad-1505826037322-0' style='height:600px; width:160px;'>
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1505826037322-0'); });
                    </script>
                    </div>
            </div>
          </div>
        </div>
      <div class="col-md-2 table-overflow">
      	<div class="row">
            <div class="col-md-12 right-bar">
                <!-- /32361281/DFP_BEHRENTZ_SPORTSHUB_160X600_2 -->
            <div id='div-gpt-ad-1505826037322-1' style='height:600px; width:160px;'>
            <script>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1505826037322-1'); });
            </script>
            </div>
            </div>
            <div class="col-md-12 right-bar"><a href="javascript:;">
            <!-- /32361281/DFP_BEHRENTZ_SPORTSHUB_160X600_3_STICKY -->
            <div id='div-gpt-ad-1505826037322-2' style='height:600px; width:160px;'>
            <script>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1505826037322-2'); });
            </script>
            </div>

            </div>
            <div class="col-md-12 right-bar">
            <!-- /32361281/DFP_BEHRENTZ_SPORTSHUB_160X600_1 -->
                <div id='div-gpt-ad-1505826037322-0' style='height:600px; width:160px;'>
                <script>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1505826037322-0'); });
                </script>
                </div>
            </div>
      </div>
    </div>

  <!-- close content --> 
</div>
<!--close wrapper--> 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script> 
<script type="text/javascript" >
$(document).ready(function() {
default_load_function();
});
</script> 
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

<!-- jQuery 2.1.3 --> 

<!-- jQuery UI 1.11.2 --> 

<!-- AdminLTE App --> 
<script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script> 
<!-- common script--> 

<script src="<?php echo base_url();?>js/jquery.simplePopup.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function(){

    $('.show1').click(function(){
	$('#pop1').simplePopup();
    });
  
    $('.show2').click(function(){
	$('#pop2').simplePopup();
    });  
  
});
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